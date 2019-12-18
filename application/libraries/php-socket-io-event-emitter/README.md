PHP Socket Client 
===================

Fork from : ```https://github.com/psinetron/PHP_SocketIO_Client```


***install***


```
php composer require touskar/php-socket-io-event-emitter
```


***Php***
```php

require_once '../SocketIO.php';

$client = new SocketIO('localhost', 9001);

//connection handshake query( for auth - optional)
$client->setQueryParams([
    'token' => 'edihsudshuz',
    'id' => '8780',
    'cid' => '344',
    'cmp' => 2339
]);

$success = $client->emit('eventFromPhp', [
    'name' => 'Goku',
    'age' => '23',
    'address' => 'Sudbury, On, Canada'
]);

if(!$success)
{
    var_dump($client->getErrors());
}
else{
    var_dump("Success");
}

```

***Node Js***


```js

var app = require('http').createServer(handler)
   var io = require('socket.io')(app);
   var fs = require('fs');
   
   app.listen(9001);
   
   function handler (req, res) {
       res.writeHead(200);
       res.end('Hello Word');
   }
   
   
   io.on('connection', function (socket) {
   
       console.log("New Connection with transport", socket.conn.transport.name);
   
       console.log('With handshake', socket.handshake);
   
   
       console.log('With query', socket.handshake.query);
   
       socket.on('eventFromPhp', function (data) {
           console.log('Data from Php', data, JSON.parse(data));
       });
   });
   
```
   
   **2 - API**
   -------------
***.```setMaxRetry(n)```***
```
$client->setMaxRetry(10);//default 5
```

***.```setRetryInterval(interval)```***
```
$client->setRetryInterval(100);// 100 ms, default 200
```


***.```setProtocole(protocol)```***
```
$client->setProtocole(SocketIO::NO_SECURE_PROTOCOLE);
$client->setProtocole(SocketIO::TLS_PROTOCOLE);
$client->setProtocole(SocketIO::SSL_PROTOCOLE);
```

***.```setPort(port)```***
```
$client->setPort(80);
```

***.```setPath(path)```***
```
$client->setPath('/socket.io/EIO=3');
```

***.```setHost(host)```***
```
$client->setPath('localhost');
```

