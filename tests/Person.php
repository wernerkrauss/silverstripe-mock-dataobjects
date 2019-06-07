<?php


namespace UncleCheese\MockDataObjects\Test;


use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;

class Person extends DataObject implements TestOnly
{


    private static $db = [
        'IsMember' => 'Boolean',
        'Salary' => 'Currency',
        'DateStarted' => 'Date',
        'LastLogin' => 'Datetime',
        'Rating' => 'Decimal',
        'Level' => 'Float',
        'Description' => 'HTMLText',
        'Intro' => 'HTMLVarchar',
        'Position' => 'Int',
        'Accuracy' => 'Percentage',
        'Biography' => 'Text',
        'StartTime' => 'Time',
        'FirstName' => 'Varchar',
        'LastName' => 'Varchar',
        'Address' => 'Varchar',
        'Website' => 'Varchar',
        'Email' => 'Varchar',
        'City' => 'Varchar',
        'State' => 'Varchar',
        'Zip' => 'Varchar',
        'CountryCode' => 'Varchar',
        'Phone' => 'Varchar',
        'Company' => 'Varchar',
        'YearStarted' => 'Year',
        'Latitude' => 'Float',

    ];


    private static $has_many = [
        'Certifications' => Certification::class
    ];


    private static $many_many = [
        'ServiceAreas' => ServiceArea::class
    ];
}
