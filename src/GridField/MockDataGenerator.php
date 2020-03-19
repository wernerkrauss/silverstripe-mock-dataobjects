<?php

namespace UncleCheese\MockDataObjects\GridField;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridField_ActionProvider;
use SilverStripe\Forms\GridField\GridField_DataManipulator;
use SilverStripe\Forms\GridField\GridField_FormAction;
use SilverStripe\Forms\GridField\GridField_HTMLProvider;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\SS_List;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;
use UncleCheese\MockDataObjects\Tasks\MockDataBuilder;


/**
 * Defines the component for {@link GridField} that allows for populating the record set
 * with mock records.
 *
 * @package silverstripe-mock-dataobjects
 * @author Uncle Cheese <unclecheese@leftandmain.com>
 */
class MockDataGenerator implements GridField_HTMLProvider, GridField_DataManipulator, GridField_ActionProvider
{


    /**
     * Adds the HTML to the GridField that includes options for the mock data as well as the action button
     *
     * @param GridField
     * @return array
     */
    public function getHTMLFragments($gridField)
    {
        Requirements::javascript('unclecheese/mock-dataobjects:client/dist/javascript/mock_dataobjects.js');
        Requirements::css('unclecheese/mock-dataobjects:client/dist/css/mock_dataobjects.css');

        $forTemplate = new ArrayData([]);
        $forTemplate->Colspan = count($gridField->getColumns());
        $forTemplate->CountField = TextField::create('mockdata[Count]', '', '10')
            ->setAttribute('maxlength', 2)
            ->setAttribute('size', 2);
        $forTemplate->RelationsField = new CheckboxField('mockdata[IncludeRelations]', '', false);
        $forTemplate->DownloadsField = new CheckboxField('mockdata[DownloadImages]', '', false);
        $forTemplate->Cancel = GridField_FormAction::create($gridField, 'cancel', _t('MockData.CANCEL', 'Cancel'),
            'cancel', null)
            ->setAttribute('id', 'action_mockdata_cancel' . $gridField->getModelClass())
            ->addExtraClass('mock-data-generator-btn cancel');

        $forTemplate->Action = GridField_FormAction::create($gridField, 'mockdata', _t('MockData.CREATE', 'Create'),
            'mockdata', null)
            ->addExtraClass('mock-data-generator-btn create ss-ui-action-constructive')
            ->setAttribute('id', 'action_mockdata_' . $gridField->getModelClass());

        return [
            'before' => $forTemplate->renderWith(MockDataGenerator::class)
        ];
    }


    /**
     * Adds the records to the database and returns a new {@link DataList}
     *
     * @param GridField
     * @param SS_List
     * @return SS_List
     * @throws \Exception
     */
    public function getManipulatedData(GridField $gridField, SS_List $dataList)
    {
        $state = $gridField->State->MockDataGenerator;
        $count = (string)$state->Count;
        if (!$count) {
            return $dataList;
        }
        $generator = new MockDataBuilder($gridField->getModelClass());
        $ids = $generator
            ->setCount($count)
            ->setIncludeRelations($state->IncludeRelations)
            ->setDownloadImages($state->DownloadImages === true)
            ->generate();

        foreach ($ids as $id) {
            $dataList->add($id);
        }

        return $dataList;
    }


    /**
     * Return a list of the actions handled by this action provider.
     *
     * @param GridField
     * @return array with action identifier strings.
     */
    public function getActions($gridField)
    {
        return ['mockdata'];
    }


    /**
     * Handle an action on the given {@link GridField}.
     *
     * @param GridField
     * @param String Action identifier, see {@link getActions()}.
     * @param array Arguments relevant for this
     * @param array All form data
     */
    public function handleAction(GridField $gridField, $actionName, $arguments, $data)
    {
        if ($actionName !== 'mockdata') {
            return;
        }
        $state = $gridField->State->MockDataGenerator;
        $state->Count = $data['mockdata']['Count'];
        $state->IncludeRelations = isset($data['mockdata']['IncludeRelations']);
        $state->DownloadImages = isset($data['mockdata']['DownloadImages']);
    }
}
