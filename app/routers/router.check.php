<?php 
use Models\Core\Contacts;

$app->get('/check', function() use ($app) {
$messages = Contacts::get_contacts();

$app->render('check.html', [

'messages' => $messages

]);

});