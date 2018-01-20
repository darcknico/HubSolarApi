<?php

$app->get('/registros','RegistroControlador:get');
$app->post('/registros','RegistroControlador:post');

$app->get('/conexiones','ConexionControlador:get');
$app->post('/conexiones','ConexionControlador:post');