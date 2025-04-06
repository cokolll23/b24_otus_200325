<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

Bitrix\Main\Page\Asset::getInstance()->addCss('/doctors/styles.css');

$arClients = \Otus\Hospital\HospitalClientsTable:: getList([
    'select' => [
        'id',
        'client_first_name'=>'first_name',
        'client_last_name'=>'last_name',
        'contact_full_name' => 'CONTACT.*',
        'contact_POST' => 'CONTACT.POST',
        'attending_doctor_last_name' => 'DOCTOR.NAME',
        'attending_doctor_id' => 'DOCTOR.ID',
        'attending_doctor' => 'DOCTOR.*',
        'attending_doctor_first_name' => 'DOCTOR.FIRST_NAME.VALUE',
        'attending_doctor_PROCEDURES' => 'DOCTOR.PROCEDURES.ELEMENT.NAME',
    ],

])->fetchAll();

foreach ($arClients as $i => $client) {
    $arClients1[$client['id']]['client_first_name'] = $client['client_first_name'];
    $arClients1[$client['id']]['client_last_name'] = $client['client_last_name'];
    $arClients1[$client['id']]['attending_doctor_last_name'] = $client['attending_doctorNAME'];
    $arClients1[$client['id']]['attending_doctor_first_name'] = $client['attending_doctor_first_name'];
    $arClients1[$client['id']]['attending_doctor_PROCEDURES'][] = $client['attending_doctor_PROCEDURES'];

}


pretty_print($arClients1,'array modif');


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>