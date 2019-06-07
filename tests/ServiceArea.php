<?php


namespace UncleCheese\MockDataObjects\Test;


use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;

class ServiceArea extends DataObject implements TestOnly
{


    private static $db = [
        'Title' => 'Varchar'
    ];


    private static $belongs_many_many = [
        'Persons' => Person::class
    ];
}