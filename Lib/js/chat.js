url_get_message = ruta+'test/get_message';
url_get_chat_contact = ruta+'test/get_chat_contact';
url_get_usuario = ruta+'usuario/get_usuario';

$("#chat").load(ruta+"Lib/modals/chat.html",function(result){
  var chatStatus = sessionStorage.getItem('chatClass');
  getChatContact().done(function(){
    divChatContent = $('.div-chat-content');
    divChatContentHeight = $('.div-chat-content').height();
    $('.div-chat-content').scroll(function(){toggleArrowScroll()});
    if (chatStatus == "chat-close") {
      $('.contacts-container').addClass('d-none');
      $('.toggle-chat i').addClass('chat-open');
      $('.toggle-chat i').attr('data-original-title','Abrir Chat');
    }else if (chatStatus == "chat-open") {
      $('.contacts-container').removeClass('d-none');
      $('.toggle-chat i').addClass('chat-close');
      $('.toggle-chat i').attr('data-original-title','Cerrar Chat');
      var openChat = sessionStorage.getItem('open-chat');
      if (openChat > 0) { $('.contact[data-idusuario="'+openChat+'"]').click(); }
    }
    $('[data-toggle="tooltip"]').tooltip({boundary: 'window'});
    $('.contacts').perfectScrollbar();

  });
});

(function ($) {
  // alternar placeholder
  $(document).on('change keydown keypress input', 'p[data-placeholder]', function() {
    if (this.textContent) {
      this.dataset.divPlaceholderContent = 'true';
    }
    else {
      delete(this.dataset.divPlaceholderContent);
    }
  });

  // $(document).ready(function () {
  // });
  // cambio dinamico de altura input_chat
  $(document).on('keyup', '.input-chat p[contenteditable]', function(){
    var pHeight = ($(this).height());
    if (pHeight > $(this).css('min-height').slice(0, -2)) {
      $(divChatContent).height( divChatContentHeight + 20 - pHeight );
    }
    else if (pHeight == $(this).css('min-height').slice(0, -2)){
      $(divChatContent).height( divChatContentHeight );
    }
  });

  // mostrar y ocultar div chat
  $(document).on('click', '.chat-contact-close, .chat-contact-close i', function(e){
    if (e.target === this) {
      sessionStorage.setItem('open-chat', '0');
      $('.chat-container').animate({right: '-80px'}, 150);
      $('.chat-container').addClass('chat-container-close');
      $('.input-chat p[contenteditable]').attr('contenteditable',false);
    }
  });
  $(document).on('click', '.contact', function(){
    var idUsuario = $(this).attr('data-idusuario');
    var nombre = $(this).attr('data-nombre');
    var apellido = $(this).attr('data-apellido');
    var foto = $(this).attr('data-foto');
    $('.chat-contact').attr('data-idusuario', idUsuario);
    $('.chat-contact .contact-image').attr('src', foto);
    $('.chat-contact .contact-person').text(nombre+' '+apellido);

    getMessages(idUsuario).done(function(){
      sessionStorage.setItem('open-chat', idUsuario);
      $('.chat-container').animate({right: '220px'}, 150);
      $('.chat-container').removeClass('chat-container-close');
      $('.input-chat p[contenteditable]').attr('contenteditable',true);
      $('.chat-container').removeClass('d-none');
      var i = $('.contact[data-idusuario="'+idUsuario+'"').find('i[data-i="newMsg"]');
      if ( i.length > 0 ) i.remove();
      scrollDownChat();
    });

  });

  $(document).on('click', '.chat-contact', function(e){
    if (e.target === this) {
      $('.chat-container').toggleClass('chat-container-hidden', 150);
      $('.scrolldown-chat').toggleClass('d-none');
    }
  });

  // enviar mensaje por chat
  $(document).on('keydown', '.input-chat p[contenteditable]', function(e) {
    if (e.which == 13) {
      e.preventDefault();
      sendMessage();
    }
  });

  // focus en contenteditable
  $(document).on('click', '.div-chat-content', function(){
    $('.input-chat p[contenteditable]').focus();
  })

  // evento search
  $(document).on('keyup', '.contact-search input', function(e){
    var str = e.target.value;
    if ($.trim(str).length > 2) {
      searchContact(str);
    }else {
      $('.contact-search-box').html(''); // limpiar div
    }
  })


})(jQuery);

// conectar a socket
const socket = io.connect('https://192.168.0.114:8080', {
  secure: true,
  reconnection: true,
  reconnectionDelay: 1000,
  reconnectionDelayMax : 5000,
  reconnectionAttempts: 99999,
  query: {idUsuario: idUsuarioActual, sessionToken: sessionStorage.getItem('token')}
});

// socket.on('connect', () => {
//   anunciarId(socket.id, idUsuarioActual);
// });

// function anunciarId(idSocket, idUsuarioActual){
//   socket.emit('anunciarId',{
//     idSocket: idSocket,
//     idUsuario: idUsuarioActual,
//     sessionToken: sessionStorage.getItem('token')
//   });
// }

function convertToPlaintext() {
  var textContent = this.textContent;
  this.innerHTML = "";
  this.textContent = textContent;
}

var contentEditableNodes = document.querySelectorAll('[contenteditable]');

[].forEach.call(contentEditableNodes, function(div) {
  div.addEventListener("input", convertToPlaintext, false);
});

// enviar mensaje
function sendMessage(){
  var pInput = $('p[contenteditable=true]');
  var msg = $.trim(pInput.text());
  var idUsuario = $('.chat-contact').attr('data-idusuario');
  if ( msg != '' && !!msg.replace(/\s/g, '').length ) {
    var divChat = $('.div-chat-content');

    $.ajax({
      url: ruta+"Test/send_message",
      type: "POST",
      data: { msg, idUsuario, idSocket: socket.id },
      success: function(data) {
        // console.log(data);
        if (data == 'success') {
          pInput.text(''); // limpiar input
          delete(pInput[0].dataset.divPlaceholderContent); //reponer placeholder
          $('.input-chat p[contenteditable]').focus(); //focus en input
          $(divChatContent).height( divChatContentHeight ); //formatear tamaño del div
        }
      },
      error: function(e){
        console.log(e);
        socket.emit( 'message', {
          msg: 'Error: No se pudo enviar el mensaje',
          class: 'error',
          fromSocket: socket.id
        } );
      }
    });
  }

  return false;
}

// evento de errores
socket.on( 'errorMsg', function( data ) {
  console.log(data);
  switch (data.type) {
    case 'token':console.log('logout');
      if (data.action == 'logout') { window.location = ruta+'login/logout' }
      break;
    default:

  }
})

// evento de mensajes
socket.on( 'message', function( data ) {
  console.log(data);
  var actualContent = $( ".div-chat" );
  var idUsuario = $('.chat-contact').attr('data-idusuario');
  var today = new Date();
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  if (data.class == 'success') {
    if (data.fromSocket == socket.id) {
      var dataPlacement = 'left';
      var classChat = 'div-chat-sent';
    }else {
      var dataPlacement = 'right';
      var classChat = 'div-chat-received';
    }
    if ((idUsuario == data.from || idUsuario == data.to ) && !$(".chat-container").hasClass('chat-container-close')) {
      var newMsgContent = '<div class="div-chat-inner '+classChat+'" \
      data-toggle="tooltip" data-placement="'+dataPlacement+'" title="'+date+' '+time+'">\
      <p class="chat-message">'+data.msg+'</p>\
      </div>';
      var color = ($('.chat-container').hasClass('chat-container-hidden')) ? 'gold' : 'ghostwhite';
      $('.chat-contact').effect("highlight", {'color':color}, 600);
    }else {
      var contact = $('.div-contact').find('[data-idusuario='+data.from+']');
      if ( contact.length > 0 ) {
        var circle = contact.find('i.fa-circle');
        if ( circle.length == 0 ) {
          var iHtml = '<i class="fa fa-circle text-info" data-i="newMsg" style="margin-top: 8px;"></i>';
          contact.append(iHtml);
        }
      }else {
        htmlContact = makeContact(data.from, data.fromNombre, data.fromApellido, data.fromFoto, true);
        $('.contacts').append(htmlContact);
      }
    }
  }else if (data.class == 'error') {
    var newMsgContent = '<div class="div-chat-inner div-chat-sent-error text-center mx-auto">\
    <p class="chat-message text-danger">'+data.msg+'</p>\
    </div>';
  }
  actualContent.append(newMsgContent);
  $('[data-toggle="tooltip"]').tooltip({boundary: 'window'});
  scrollDownChat();
});

// scroll down chat
function scrollDownChat(){
  divChatContent.stop().animate({
    scrollTop: divChatContent[0].scrollHeight
  },0);
}

// alternar flecha del scroll del chat
function toggleArrowScroll(){
  var maxScroll = divChatContent.prop('scrollHeight') - divChatContent.innerHeight(),
  actualScroll = divChatContent.scrollTop();
  if (maxScroll != actualScroll && !$('.chat-container').hasClass('chat-container-hidden')) {
    // if (divChatContent.prop('scrollHeight') != divChatContent.innerHeight()) {
    $('.scrolldown-chat').show();
  }else {
    $('.scrolldown-chat').hide();
  }
}

// obtener contactos
function getChatContact(){
  return $.ajax({
    type:"POST",
    url: url_get_chat_contact,
    data: {  },
    success:function (respuesta) {
      // console.log(respuesta);
      var obj = JSON.parse(respuesta), htmlContact, id_usuario, foto, nombre, apellido;

      $.each(obj, function(key, value){
        if (idUsuarioActual == value.id_usuario_remitente) {
          id_usuario = value.id_usuario_destino;
          foto = value.foto_destino;
          nombre = value.nombre_destino;
          apellido = value.apellido_destino;
        }else {
          id_usuario = value.id_usuario_remitente;
          foto = value.foto_remitente;
          nombre = value.nombre_remitente;
          apellido = value.apellido_remitente;
        }
        htmlContact = makeContact(id_usuario, nombre, apellido, foto);
        $('.contacts').append(htmlContact);
      });
    }, error:function (respuesta) {
      console.log("error: "+respuesta.responseText);
    }
  });
}

// crear div de un contacto
function makeContact(id_usuario, nombre, apellido, foto, newMsg=false){
  var iHtml = (newMsg) ? '<i class="fa fa-circle text-info" style="margin-top: 8px;"></i>' : '';
  if (foto == null || foto == '') {
    foto = ruta+'/files/images/index.png';
  }
  return '<div class="contact pointer" \
  data-idusuario="'+id_usuario+'"\
  data-nombre="'+nombre+'"\
  data-apellido="'+apellido+'"\
  data-foto="'+foto+'">\
  <img class="contact-image" src="'+foto+'" alt="">\
  <p class="contact-person">'+nombre+' '+apellido+'</p>'+iHtml+'\
  </div>';
}

// obtener mensajes
function getMessages(idUsuario){
  return $.ajax({
    type:"POST",
    url: url_get_message,
    data: { idUsuario },
    success:function (respuesta) {
      // console.log(respuesta);
      var obj = JSON.parse(respuesta);
      var htmlMessage;
      $('.div-chat-content .div-chat').html('');
      var idUsuario = $('.chat-contact').attr('data-idusuario');
      $.each(obj, function(key, value){
        htmlMessage = '';
        if (value.id_usuario_remitente == idUsuario) {
          htmlMessage += '<div class="div-chat-inner div-chat-received" data-toggle="tooltip" data-placement="right" title="'+value.fecha+'">';
        }else {
          htmlMessage += '<div class="div-chat-inner div-chat-sent" data-toggle="tooltip" data-placement="left" title="'+value.fecha+'">';
        }
        htmlMessage += '<p class="chat-message">'+value.texto+'</p></div>';
        $('.div-chat-content .div-chat').append(htmlMessage);
      });
      $(function () {
        $('[data-toggle="tooltip"]').tooltip({boundary: 'window'})
      })
      if (!!window.chrome) {
        $('.div-chat-content').css('overflow','unset');
        $('.div-chat-content').css('overflow','auto');
      }
      // scrollDownChat();
    }, error:function (respuesta) {
      console.log("error: "+respuesta);
      console.log(respuesta.responseText);
    }
  });
}

// abrir y cerrar divs del chat
function toggleChat(i){
  if ($(i).hasClass('chat-open')) {
    $('.contacts-container').removeClass('d-none');
    $(i).removeClass('chat-open');
    $(i).addClass('chat-close');
    $('.toggle-chat i').attr('data-original-title','Cerrar Chat');
    sessionStorage.setItem('chatClass','chat-open');
  }else if ($(i).hasClass('chat-close')) {
    $('.contacts-container').addClass('d-none');
    $('.chat-container').addClass('d-none');
    $(i).removeClass('chat-close');
    $(i).addClass('chat-open');
    $('.toggle-chat i').attr('data-original-title','Abrir Chat');
    sessionStorage.setItem('chatClass','chat-close');
  }
  $('[data-toggle="tooltip"]').tooltip({boundary: 'window'});
}

// buscar contactos
function searchContact(params){
  $.ajax({
     type:"POST",
     url: url_get_usuario,
     data: { id:null, params },
     success:function (respuesta) {
       var obj = JSON.parse(respuesta);
       $('.contact-search-box').html(''); // limpiar div
       $.each(obj, function(key, value){
         let span = $('<span/>', {
           class: "badge badge-pill badge-success m-1 pointer",
           html: value.nombre+' '+value.apellido
         }).bind('click',function(){
           var find = $('.contacts').find('.contact[data-idusuario="'+value.usuario_id+'"]');
           if (find.length > 0) {
             $(find).click();
           }else {
             var contact = makeContact(value.usuario_id, value.nombre, value.apellido, value.foto);
             $('.contacts').append(contact);
           }}).appendTo('.contact-search-box');
       });
     }, error:function (respuesta) {
       console.log("error: "+respuesta);
     }
   });
}
