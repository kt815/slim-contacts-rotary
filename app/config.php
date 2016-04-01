<?php

use Illuminate\Database\Capsule\Manager as Capsule;
 
$capsule = new Capsule;
 
$capsule->addConnection(array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'slim_contacts',
    'username' => 'root',
    'password' => '',
    'prefix' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',));

$capsule->bootEloquent();
$capsule->setAsGlobal();
 
// Connect using the Laravel Database component
$conn = $capsule->connection();
