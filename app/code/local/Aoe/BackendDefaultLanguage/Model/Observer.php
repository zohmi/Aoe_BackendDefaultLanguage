<?php

/**
 * Class Aoe_BackendDefaultLanguage_Model_Observer
 *
 * @category Model
 * @package  Aoe_BackendDefaultLanguage
 * @author   Daniel Zohm <daniel.zohm@aoe.com>
 * @license  GNU General Public License (GPLv3)
 * @link     https://github.com/zohmi/Aoe_BackendDefaultLanguage
 */
class Aoe_BackendDefaultLanguage_Model_Observer
{
    /**
     * Event admin_session_user_login_success
     *
     * @param   Varien_Event_Observer $event Event object
     * @return  void
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
     * Add value when saving admin user
     *
     * @return  void
     */
    public function admin_user_save_commit_after()
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
        $tableName  = Mage::getSingleton('core/resource')->getTableName('admin/user');
        $localeCode = Mage::app()->getRequest()->getParam('default_language');
        $user       = Mage::getSingleton('admin/session')->getUser();

        if (!isset($localeCode)) {
            $localeCode = Mage::getModel('core/locale')->getLocale();
        }

        if (null !== $user) {
            $connection->insertOnDuplicate(
                $tableName,
                [
                    'user_id'                  => $user->getId(),
                    'default_backend_language' => $localeCode,
                ]
            );

            Mage::getSingleton('adminhtml/session')->setLocale($localeCode);
        }
    }
}
