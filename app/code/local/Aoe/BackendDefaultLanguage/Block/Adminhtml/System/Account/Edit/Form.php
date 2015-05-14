<?php

/**
 * Class Aoe_BackendDefaultLanguage_Block_Adminhtml_System_Account_Edit_Form
 *
 * @category Block
 * @package  Aoe_BackendDefaultLanguage
 * @author   Daniel Zohm <daniel.zohm@aoe.com>
 * @license  GNU General Public License (GPLv3)
 * @link     https://github.com/zohmi/Aoe_BackendDefaultLanguage
 */
class Aoe_BackendDefaultLanguage_Block_Adminhtml_System_Account_Edit_Form
    extends Mage_Adminhtml_Block_System_Account_Edit_Form
{
    /**
     * Adding additional field to system account edit form
     *
     * @return  void
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();

        $fieldset = $this->getForm()->getElement('base_fieldset');
        $locale   = Mage::app()->getLocale();

        $fieldset->addField(
            'default_language',
            'select',
            [
                'name'   => 'default_language',
                'label'  => Mage::helper('adminhtml')->__('Backend Default Language'),
                'title'  => Mage::helper('adminhtml')->__('Backend Default Language'),
                'value'  => $locale->getLocaleCode(),
                'values' => $locale->getTranslatedOptionLocales(),
            ]
        );
    }
}
