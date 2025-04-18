<?php
if (file_exists(__DIR__ . '/src/autoloader.php')){
	require_once __DIR__ . '/src/autoloader.php';
}
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/autoload.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/autoload.php");
}
require_once __DIR__ . '/include/functions/pretty_print.php';
//require_once __DIR__ . '/src/Otus/Diag/FileExceptionHandlerLogCustom.php';