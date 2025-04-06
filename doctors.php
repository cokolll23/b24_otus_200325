<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Доктора");
$doctors = \Bitrix\Iblock\Elements\ElementDoctorsTable::getList([ //быстрая выборка ORM getList необходимо обозначить Символьный код и Символьный код API здесь doctors
    'select' => [
        'ID',
        'NAME',
        'FIRST_NAME_' => 'FIRST_NAME',
        'MIDDLE_NAME_' => 'MIDDLE_NAME',
        'PROCEDURE_NAME' => 'PROCEDURES.ELEMENT.NAME',
        //'PROCEDURE_'=>'PROCEDURES.ELEMENT',// вывод всех полей свойства
    ],
    'filter' => [// 'ID' => $doctorId
    ]
])->fetchAll();

foreach ($doctors as $doctor) {
    $arDoctors[$doctor['ID']]['DOCTOR_LAST_NAME'] = $doctor['NAME'];
    $arDoctors[$doctor['ID']]['DOCTOR_FIRST_NAME'] = $doctor['FIRST_NAME_VALUE'];
    $arDoctors[$doctor['ID']]['DOCTOR_MIDDLE_NAME'] = $doctor['MIDDLE_NAME_VALUE'];
    $arDoctors[$doctor['ID']]['DOCTOR_PROCEDERES_NAME'][] = $doctor['PROCEDURE_NAME'];
}

pretty_print($arDoctors); ?>
<style>
    .flex{
        display: flex;
        justify-content: space-evenly;
    }

</style>
    <div class="doctors-block flex">
        <?php
        foreach ($arDoctors as $i => $doctor) { ?>
            <div id="id_<?= $i; ?>" class="">
                <?= $doctor['DOCTOR_LAST_NAME'] . ' ' . $doctor['DOCTOR_FIRST_NAME'] . ' ' . $doctor['DOCTOR_MIDDLE_NAME'] ?>
            </div>
        <?php } ?>
    </div>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");