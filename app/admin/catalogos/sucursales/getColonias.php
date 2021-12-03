<?php

require_once '../../../../config/global.php';
require_once './functions.php';

echo json_encode(get_colonias($_GET["id_municipio"]));