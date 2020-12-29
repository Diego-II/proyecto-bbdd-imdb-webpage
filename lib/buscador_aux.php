<?php

if(!isset($_POST['buscador'])) exit('No se recibió el valor a buscar');

require_once 'db_config.php';
require_once 'func_aux.php';
