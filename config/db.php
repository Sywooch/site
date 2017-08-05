<?php
return get_current_user() == 'mertve'
    ? [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=mertve_cm',
        'username' => 'mertve_cm',
        'password' => 'kekeke12',
        'charset' => 'utf8',
    ]
    : [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=mybd',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ];
