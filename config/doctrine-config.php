<?php

// Paths to Entities that we want Doctrine to see
$paths = array(
    "module/Module/src/Entity",
    "module/MyApplication/src/Entity"
);

// Tells Doctrine what mode we want
$isDevMode = true;

// Doctrine connection configuration
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'root',
    'dbname' => 'emailmkt'
);

