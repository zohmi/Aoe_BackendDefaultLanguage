<?php

class Aoe_BackendDefaultLanguage_Block_Adminhtml_System_Account_Edit_Form extends Mage_Adminhtml_Block_System_Account_Edit_Form
{
    /**
     * Adding additional field to system account edit form
     * @return  void
     * @author  Daniel Zohm <daniel.zohm@aoemedia.de>
     * @since   2012-07-22
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();

        $fieldset = $this->getForm()->getElement('base_fieldset');
        $locale   = Mage::app()->getLocale();

        $fieldset->addField('default_language', 'select', array(
                'name'   => 'default_language',
                'label'  => Mage::helper('adminhtml')->__('Backend Default Language'),
                'title'  => Mage::helper('adminhtml')->__('Backend Default Language'),
                'value'  => $locale->getLocaleCode(),
                'values' => $locale->getTranslatedOptionLocales(),
            )
        );
    }
}