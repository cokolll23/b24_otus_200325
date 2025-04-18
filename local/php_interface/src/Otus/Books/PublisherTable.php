<?php
namespace Otus\Books;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

/**
 * Class Table
 *
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> name string(50) optional
 * </ul>
 *
 * @package Bitrix\
 **/

class PublisherTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'publishers';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            new IntegerField(
                'id',
                [
                    'primary' => true,
                    'autocomplete' => true,
                    'title' => Loc::getMessage('_ENTITY_ID_FIELD'),
                ]
            ),
            new StringField(
                'name',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                    'title' => Loc::getMessage('_ENTITY_NAME_FIELD'),
                ]
            ),

            (new ManyToMany('BOOKS', Books::class))
                ->configureTableName('book_publisher')
                ->configureLocalPrimary('id', 'book_id')
                ->configureLocalReference('BOOKS')
                ->configureRemotePrimary('id', 'publisher_id')
                ->configureRemoteReference('PUBLISHERS'),
        ];
    }
}