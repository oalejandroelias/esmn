

<?php
/**
 * Created by PhpStorm.
 * User: Sidson_Aidson
 * Date: 08/06/2017
 * Time: 11:27
 */

/**
 * client
 */
require_once '../SocketIO.php';

$client = new SocketIO('localhost', 9001);

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
