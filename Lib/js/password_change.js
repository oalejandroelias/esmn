// validar form de cambio de password
function validar_form(){
  if ($("#new_password").val()!=$("#repeat_new_password").val()) {
    $("[id$='new_password']").val('');
    $("#repeat_new_password").next().text('Las contraseñas no coinciden!');
    return false;
  }
}
