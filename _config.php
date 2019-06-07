<?php

use SilverStripe\Admin\CMSMenu;
use SilverStripe\Core\Manifest\ClassLoader;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;
use Faker\Generator;
use UncleCheese\MockDataObjects\FieldTypes\MockDBField;
use UncleCheese\MockDataObjects\Admin\MockChildrenController;


if(!class_exists(Generator::class)) {
    throw new RuntimeException("The silverstripe-mock-dataobjects module requires the Faker PHP library. You can install it by running 'composer require fzaninotto/faker:1.1.*@dev' in your web root. If you installed this module via composer, make the directory fzaninotto/faker exists in vendor/.");
}

define('MOCK_DATAOBJECTS_DIR',basename(dirname(__FILE__)));

DataObject::add_extension(DBField::class, MockDBField::class);

foreach(ClassLoader::inst()->getManifest()->getDescendantsOf(DBField::class) as $class) {
	$mockClass = "UncleCheese\MockDataObjects\FieldTypes\Mock{$class}Field";
	if(class_exists($mockClass)) {
		DataObject::add_extension($class, $mockClass);
	}
}

CMSMenu::remove_menu_item(MockChildrenController::class);
