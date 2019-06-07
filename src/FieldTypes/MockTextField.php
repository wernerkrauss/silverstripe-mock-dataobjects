<?php

namespace UncleCheese\MockDataObjects\FieldTypes;


/**
 * Defines the methods that are injected into the {@link Text} class for
 * generating mock data
 *
 * @package silverstripe-mock-data
 * @author Uncle Cheese <unclecheese@leftandmain.com>
 */

use Faker\Generator;
use SilverStripe\ORM\DataExtension;


class MockTextField extends DataExtension
{


    /**
     * Gets a random paragraph
     *
     * @param Faker\Generator
     * @return string
     */
    public function getFakeData(Generator $faker)
    {
        return $faker->paragraph(rand(1, 3));
    }
}
