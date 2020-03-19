<?php

namespace UncleCheese\MockDataObjects\FieldTypes;


/**
 * Defines the methods that are injected into the {@link Boolean} class for
 * generating mock data
 *
 * @package silverstripe-mock-data
 * @author Uncle Cheese <unclecheese@leftandmain.com>
 */

use Faker\Generator;
use SilverStripe\ORM\DataExtension;


class MockBooleanField extends DataExtension
{


    /**
     * Gets a random boolean value
     *
     * @param Faker\Generator
     * @return boolean
     */
    public function getFakeData(Generator $faker)
    {
        return $faker->boolean();
    }
}
