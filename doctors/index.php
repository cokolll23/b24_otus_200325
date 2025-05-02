<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
Bitrix\Main\Page\Asset::getInstance()->addCss('/doctors/styles.css');

if (!$_GET['id']) {
    $APPLICATION->SetPageProperty("keywords", "Врачи сайт компания");
    $APPLICATION->SetPageProperty("description", "Врачи на сайте");
    $APPLICATION->SetPageProperty("title", "Врачи");
    $APPLICATION->SetTitle("Врачи");


    $doctors = \Bitrix\Iblock\Elements\ElementDoctorsTable::getList([ //быстрая выборка ORM getList необходимо обозначить Символьный код и Символьный код API здесь doctors
        'select' => [
            'ID',
            'NAME',
            'FIRST_NAME_' => 'FIRST_NAME',
            'MIDDLE_NAME_' => 'MIDDLE_NAME',
            'PROCEDURE_NAME' => 'PROCEDURES.ELEMENT.NAME'
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
    ?>


    <div class="doctors-block cards-list">
        <?php
        foreach ($arDoctors as $i => $doctor) { ?>
            <a href="/doctors/?id=<?= $i; ?>" id="id_<?= $i; ?>" class="card">
                <?= $doctor['DOCTOR_LAST_NAME'] . ' ' . $doctor['DOCTOR_FIRST_NAME'] . ' ' . $doctor['DOCTOR_MIDDLE_NAME'] ?>
            </a>
        <?php } ?>
    </div>
<?php } else {?>
<a href="/doctors">К списку врачей</a>

   <?php $doctorId = $_GET['id'];

    $doctors = \Bitrix\Iblock\Elements\ElementDoctorsTable::getList([ //быстрая выборка ORM getList необходимо обозначить Символьный код и Символьный код API здесь doctors
        'select' => [
            'ID',
            'NAME',
            'FIRST_NAME_' => 'FIRST_NAME',
            'MIDDLE_NAME_' => 'MIDDLE_NAME',
            'PROCEDURE_NAME' => 'PROCEDURES.ELEMENT.NAME',
            //'PROCEDURE_'=>'PROCEDURES.ELEMENT',// вывод всех полей свойства
        ],
        'filter' => [
            'ID' => $doctorId
        ]
    ])->fetchAll();
    foreach ($doctors as $doctor) {
        $arDoctors[$doctor['ID']]['DOCTOR_LAST_NAME'] = $doctor['NAME'];
        $arDoctors[$doctor['ID']]['DOCTOR_FIRST_NAME'] = $doctor['FIRST_NAME_VALUE'];
        $arDoctors[$doctor['ID']]['DOCTOR_MIDDLE_NAME'] = $doctor['MIDDLE_NAME_VALUE'];
        $arDoctors[$doctor['ID']]['DOCTOR_PROCEDERES_NAME'][] = $doctor['PROCEDURE_NAME'];
    }
    $fio = $arDoctors[$doctorId]['DOCTOR_LAST_NAME'] . ' ' . $arDoctors[$doctorId]['DOCTOR_FIRST_NAME'] . ' ' . $arDoctors[$doctorId]['DOCTOR_MIDDLE_NAME'];


    $APPLICATION->SetPageProperty("title", $fio);
    $APPLICATION->SetTitle($fio); ?>
    <div class="doc-container">
    <h2>
        <?= $fio; ?>
    </h2>
    <h3>
    Процедуры :
    </h3>
    <ul>
        <?php foreach ($arDoctors[$doctorId]['DOCTOR_PROCEDERES_NAME'] as $DOCTOR_PROCEDERE_NAME): ?>
            <li><?= $DOCTOR_PROCEDERE_NAME ?></li>
        <?php endforeach; ?>
    </ul>
<?php }
?>
    </div>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>