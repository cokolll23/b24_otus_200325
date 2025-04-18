<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Otus\Books\PublisherTable as Publisher;



Bitrix\Main\Page\Asset::getInstance()->addCss('/doctors/styles.css');



$arBooks = \Otus\Books\BooksTable:: getList([
    'select' => [
        '*',
        //'PUBLISHERS'
    ],

])->fetchAll();

pretty_print($arBooks);

foreach ($arBooks as $book) {
    // pretty_print((array)$book['publish_date']-> getTimestamp());
    // pretty_print((array)$book['publish_date']-> format('d.m.Y'));
}

/*$book = Otus\Books\BooksTable::getByPrimary(2, [
    'select' => [
        '*',
        'PUBLISHERS'
    ]
])->fetchAll();*/
/*foreach ($book->getPublisher() as $publisher) {
    echo $publisher->getName() . '<br/>';
}*/
//pretty_print($book);


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>