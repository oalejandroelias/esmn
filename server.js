const fs = require('fs');
const socket = require( 'socket.io' );
const express = require( 'express' );
const https = require( 'https' );
const mysql = require( 'mysql' );
const logFile = '/var/www/html/esmn/server.js.log';

function clockTick() {
  var currentTime = new Date(),
  month = currentTime.getMonth() + 1,
  day = currentTime.getDate(),
  year = currentTime.getFullYear(),
  hours = currentTime.getHours(),
  minutes = currentTime.getMinutes(),
  seconds = currentTime.getSeconds(),
  text = (day + "/" + month + "/" + year + ' ' + hours + ':' + minutes + ':' + seconds);
  return text;
}

var db_config = {
  host: "localhost",
  user: "esmn",
  password: "esmn123",
  database: "esmn"
};

var pool = mysql.createPool(db_config);

function doQuery(query) {
  pool.getConnection(function(err, connection) {
    if (!err) {
      console.log(clockTick() + '- DB Connected!. Executing: '+ query);
    }else {
      console.log(clockTick() + '- error when connecting to db:', err);
      setTimeout(doQuery(query), 2000);
    }

    // Use the connection
    connection.query(query, function (error, results, fields) {
      // When done with the connection, release it.
      connection.release();
      // Handle error after the release.
      if (!error) {
        return results;
      }else {
        console.log(clockTick() + '- db error', error.code);
        doQuery(query);
      }
      // Don't use the connection here, it has been returned to the pool.
    });
  });
}

function anunciarId( client, idUsuario, token ){
  console.log('anunciarId '+client+', '+idUsuario+', '+token);
  if ( Number.isInteger(parseInt(idUsuario)) ) {
    if ( users.find( u => u.id == idUsuario && u.token == token ) != undefined ) {
      var query = "UPDATE usuario SET id_socket = "+pool.escape(client.id)+" WHERE usuario.id = "+pool.escape(idUsuario);
      return doQuery(query);
    }else logoutUser( idUsuario, client );//console.log("no query: "+idUsuario+','+token)
  }else {
    console.log(idUsuario + " no es un numero!");
    return false;
  }
}

function logoutUser( idUsuario, client ){
  console.log('logout '+idUsuario+', '+client.id);
  unsetUser( idUsuario );
  client.emit( 'errorMsg', { type: 'token', action: 'logout' } );
}

function emitMessage( data, client ){
  if (data.class == 'success') {
    client.to(`${data.fromSocket}`).to(`${data.toSocket}`).emit( 'message',
    { msg: data.msg,
      class: data.class,
      to: data.to,
      toSocket: data.toSocket,
      from: data.from,
      fromNombre: data.fromNombre,
      fromApellido: data.fromApellido,
      fromFoto: data.fromFoto,
      fromSocket: data.fromSocket
    });
  }else if (data.class == 'error') {
    client.to(`${data.fromSocket}`).emit('message',
    { msg: data.msg,
      class: data.class,
      fromSocket: data.fromSocket
    });
  }
}

function setUser( idUsuario, token, idSocket ){
  if ( Number.isInteger(parseInt(idUsuario)) && typeof token == 'string') {
    users.push({ 'id':idUsuario, 'token':token, 'socket':idSocket });
    console.log(users);
    return true;
  }else return false;
}

function unsetUser( idUsuario ){
  users = users.filter(item => item.id !== idUsuario);
}

const options = {
  key: fs.readFileSync('/var/www/html/esmn/apache-selfsigned.key'),
  cert: fs.readFileSync('/var/www/html/esmn/apache-selfsigned.pem'),
  ca: fs.readFileSync('/var/www/html/esmn/dhparam.pem')
};
const app = express();
const server = https.createServer( options, app );
const io = socket.listen( server );

let users = new Array();

io.sockets.on( 'connection', function( client ) {
  console.log(client.handshake.query.sessionToken);
  // set sessionToken
  client.on('token', function(data){
    // console.log('id_usuario: '+data.id_usuario);
    // console.log('token: '+data.token);
    let u = setUser( data.id_usuario, data.token, client.id );
    // if (!u)
  });

  client.on('untoken', function(data){
    unsetUser( data.id_usuario );
  });

  // anunciar id
  anunciarId( client, client.handshake.query.idUsuario, client.handshake.query.sessionToken );

  // enviar mensaje
  client.on( 'message', function( data ) {
    emitMessage( data, client );
  });

  client.on('disconnect', function(e) {
    // update user online = 0
    var query = "UPDATE usuario SET ci_token = '', online = 0 WHERE usuario.id_socket = '"+client.id+"'";
    // connection.query(query, function(error, rows, fields) {
    //   if (!!error) {
    //     fs.appendFile(logFile, '['+clockTick+'] - '+error);
    //   }else {
    //     // console.log(rows);
    //   };
    // })
  });

});

io.sockets.on('error', function (e) {console.log(clockTick() + '- IO error: ' + e);});

server.listen( 8080, '192.168.0.114' );
