<?php

namespace UncleCheese\MockDataObjects\FieldTypes;


/**
 * Defines the methods that are injected into the {@link Percentage} class for
 * generating mock data
 *
 * @package silverstripe-mock-data
 * @author Uncle Cheese <unclecheese@leftandmain.com>
 */

use Faker\Generator;
use SilverStripe\ORM\DataExtension;


class MockPercentageField extends DataExtension
{


    /**
     * Gets a random percentage
     *
     * @param Faker\Generator
     * @return float
     */
    public function getFakeData(Generator $faker)
    {
        return mt_rand(1, 99) / 100;
    }
}
