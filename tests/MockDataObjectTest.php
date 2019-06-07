<?php

namespace UncleCheese\MockDataObjects\Test;


use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\DataList;
use UncleCheese\MockDataObjects\Tasks\MockDataBuilder;


/**
 * @package silverstripe-mock-dataobjects
 * @subpackage tests
 * @author Uncle Cheese <unclecheese@leftandmain.com>
 */
class MockDataObjectTest extends SapphireTest
{


    //protected static $fixture_file = 'MockDataObjects.yml';


    public $record;
    protected $extraDataObjects = [
        Person::class,
        Certification::class,
        ServiceArea::class
    ];

    public function setUpOnce()
    {
        parent::setUpOnce();
        error_reporting(E_ALL);
    }


    public function testDataObjectsCanFill()
    {
        $obj = new Person();
        $obj->fill([
            'include_relations' => false
        ]);
        $obj->write();
        $this->assertEquals(1, $this->getList()->count());
    }

    protected function getList()
    {
        return DataList::create(Person::class);
    }

    public function testGeneratorCreatesRecords()
    {
        MockDataBuilder::create(Person::class)
            ->setCount(10)
            ->setIncludeRelations(false)
            ->generate();
        $this->assertEquals(11, $this->getList()->count());
    }

    public function testFieldsCreateGoodData()
    {
        $rec = new Person();
        $rec->fill();
        $rec->write();

        // Currency
        $this->assertNotNull($rec->Salary);
        $this->assertTrue(is_numeric($rec->Salary));
        $this->assertGreaterThan(1, $rec->Salary);
        $this->assertLessThan(1000, $rec->Salary);

        // Date
        $this->assertNotNull($rec->DateStarted);
        $this->assertGreaterThan(1, strtotime($rec->DateStarted));

        // DateTime
        $this->assertNotNull($rec->LastLogin);
        $this->assertGreaterThan(1, strtotime($rec->LastLogin));

        // Decimal
        $this->assertNotNull($rec->Rating);
        $this->assertGreaterThan(0, $rec->Rating);
        $this->assertLessThan(1000, $rec->Rating);

        // Float
        $this->assertNotNull($rec->Level);
        $this->assertGreaterThan(0, $rec->Rating);
        $this->assertLessThan(1000, $rec->Rating);

        // HTMLText
        $this->assertTrue($rec->obj('Description')->exists());
        $this->assertEquals('<p>', substr($rec->Description, 0, 3));
        $this->assertEquals('</p>', substr($rec->Description, -4, 4));
        $this->assertGreaterThan(7, strlen($rec->Description));

        // HTMLVarchar
        $this->assertTrue($rec->obj('Intro')->exists());
        $this->assertEquals(1, preg_match('/[A-Za-z]+/', $rec->Intro));


        // Int
        $this->assertTrue(is_numeric($rec->Position));
        $this->assertGreaterThan(0, $rec->Position);


        // Percentage
        $this->assertGreaterThan(0, $rec->Accuracy);
        $this->assertLessThan(1, $rec->Accuracy);
        $this->assertEquals(4, strlen($rec->Accuracy));
    }
}
