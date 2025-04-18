<?php
namespace Otus\Books;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\DateField,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\TextField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator,
    Bitrix\Main\ORM\Fields\Validator\Base,
    Bitrix\Main\ORM\Fields\Validators\RegExpValidator,
    Bitrix\Main\ORM\Fields\Relations\Reference,
    Bitrix\Main\ORM\Fields\Relations\OneToMany,
    Bitrix\Main\ORM\Fields\Relations\ManyToMany,
    Bitrix\Main\Entity\Query\Join;

use Bitrix\Main\Entity\Event;
use Bitrix\Main\Entity\EventResult;
use Bitrix\Main\Entity\EntityError;

use Otus\Books\PublisherTable as Publisher;

/**
 * Class Table
 *
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> name string(50) optional
 * <li> text text optional
 * <li> publish_date date optional
 * <li> ISBN string(50) optional
 * <li> author_id int optional
 * <li> publisher_id int optional
 * <li> wikiprofile_id int optional
 * </ul>
 *
 * @package Bitrix\
 **/

class BooksTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'books';
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
            new TextField(
                'text',
                [
                    'title' => Loc::getMessage('_ENTITY_TEXT_FIELD'),
                ]
            ),
            new DateField(
                'publish_date',
                [
                    'title' => Loc::getMessage('_ENTITY_PUBLISH_DATE_FIELD'),
                ]
            ),
            new StringField(
                'ISBN',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                    'title' => Loc::getMessage('_ENTITY_ISBN_FIELD'),
                ]
            ),
            new IntegerField(
                'author_id',
                [
                    'title' => Loc::getMessage('_ENTITY_AUTHOR_ID_FIELD'),
                ]
            ),
            new IntegerField(
                'publisher_id',
                [
                    'title' => Loc::getMessage('_ENTITY_PUBLISHER_ID_FIELD'),
                ]
            ),
            new IntegerField(
                'wikiprofile_id',
                [
                    'title' => Loc::getMessage('_ENTITY_WIKIPROFILE_ID_FIELD'),
                ]
            ),

            (new ManyToMany('PUBLISHERS', Publisher::class))
                ->configureTableName('book_publisher')
                ->configureLocalPrimary('id', 'book_id')
                ->configureLocalReference('BOOKS')
                ->configureRemotePrimary('id', 'publisher_id')
                ->configureRemoteReference('PUBLISHERS'),
        ];
    }
}