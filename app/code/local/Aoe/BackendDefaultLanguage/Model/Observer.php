<?php

/**
 * @TODO    Allow only existing languages
 */
class Aoe_BackendDefaultLanguage_Model_Observer
{
    /**
     * Event admin_session_user_login_success
     *
     * @param   Varien_Event_Observer $event
     * @return  void
     * @author  Daniel Zohm <daniel.zohm@aoemedia.de>
     * @since   2012-07-22
     */
    public function admin_session_user_login_success(Varien_Event_Observer $event)
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $tableName  = Mage::getSingleton('core/resource')->getTableName('admin/user');

        $select = $connection->select()
            ->from($tableName, 'default_backend_language')
            ->where('user_id = ?', $event->getUser()->getId());

        $localeCode = $connection->fetchOne($select);

        if (false !== $localeCode) {
            Mage::getSingleton('adminhtml/session')->setLocale($localeCode);
        }
    }

    /**
     * @param   Varien_Event_Observer $event
     * @return  void
     * @author  Daniel Zohm <daniel.zohm@aoemedia.de>
     * @since   2012-07-22
     */
    public function admin_user_save_commit_after(Varien_Event_Observer $event)
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
        $tableName  = Mage::getSingleton('core/resource')->getTableName('admin/user');
        $localeCode = Mage::app()->getRequest()->getParam('default_language');
        $user       = Mage::getSingleton('admin/session')->getUser();

        if (!isset($localeCode)) {
            $localeCode = Mage::getModel('core/locale')->getLocale();
        }

        if (null !== $user) {
            $connection->insertOnDuplicate($tableName, array(
                'user_id'                   => $user->getId(),
                'default_backend_language'  => $localeCode,
            ));

            Mage::getSingleton('adminhtml/session')->setLocale($localeCode);
        }
    }
}
