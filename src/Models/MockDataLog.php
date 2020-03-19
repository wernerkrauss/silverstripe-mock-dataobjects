<?php

namespace UncleCheese\MockDataObjects\Models;

use SilverStripe\ORM\DataObject;


/**
 * Defines a database record of a mock data creation. Has references to the class
 * of data created and its ID.
 *
 * @package silverstripe-mock-dataobjects
 * @author Uncle Cheese <unclecheese@leftandmain.com>
 */
class MockDataLog extends DataObject
{


    private static $db = [
        'RecordClass' => 'Varchar',
        'RecordID' => 'Int'
    ];


    private static $indexes = [
        'RecordClass' => true,
        'RecordID' => true
    ];

    private static $table_name = 'MockDataLog';
}
