<?php

require_once '../../../../config/global.php';
require_once './functions.php';

echo json_encode(get_localidades($_GET["id_municipio"]));