<?php


namespace UncleCheese\MockDataObjects\Test;


use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;

class Certification extends DataObject implements TestOnly
{


    private static $db = [
        'Title' => 'Varchar'
    ];


    private static $has_one = [
        'Person' => Person::class
    ];
}
