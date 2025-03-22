<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
\Otus\Diag\FileExceptionHandlerLogCustom::print();
function division(float $a,float $b):int
{
  return $a / $b;
}
division(2,2);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");