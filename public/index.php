<?php

$work_path = dirname(__FILE__);
$base_path = substr($work_path, 0 , strrpos($work_path, "public"));

define("BASE_PATH",$base_path);
define("WXDEV",1);

require_once BASE_PATH."common/common.func.php";
require_once BASE_PATH."bootstrap/app.php";

$app->run();
