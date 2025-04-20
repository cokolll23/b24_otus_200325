<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$currentDate = new DateTime();
$curDate = $currentDate->format('Y-m-d H:i:s');
file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/otus/logs.txt', $curDate . PHP_EOL, FILE_APPEND);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");