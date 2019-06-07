<?php

use Faker\Generator;
use SilverStripe\Admin\CMSMenu;
use UncleCheese\MockDataObjects\Admin\MockChildrenController;


if (!class_exists(Generator::class)) {
    throw new RuntimeException("The silverstripe-mock-dataobjects module requires the Faker PHP library. You can install it by running 'composer require fzaninotto/faker:1.1.*@dev' in your web root. If you installed this module via composer, make the directory fzaninotto/faker exists in vendor/.");
}

define('MOCK_DATAOBJECTS_DIR', basename(dirname(__FILE__)));

CMSMenu::remove_menu_class(MockChildrenController::class);
