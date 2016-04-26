<?php
/***
 * @package     Foodmenu
 * @subpackage  com_foodmenu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Foodmenu Table class.
 *
 * @since  1.6
 */
class FoodmenuTableItem extends JTable
{
    /**
     * Constructor
     *
     * @param   JDatabaseDriver &$db Database connector object
     *
     * @since   1.6
     */
    public function __construct(&$db)
    {
        $this->setColumnAlias('published', 'state');
        parent::__construct('#__foodmenu', 'id', $db);
    }

    /**
     * Stores an item.
     *
     * @param   boolean $updateNulls True to update fields even if they are null.
     *
     * @return  boolean  True on success, false on failure.
     *
     * @since   1.6
     */
    public function store($updateNulls = false)
    {

        // Set publish_up to null date if not set
        if (!$this->publish_up) {
            $this->publish_up = $this->_db->getNullDate();
        }

        // Set publish_down to null date if not set
        if (!$this->publish_down) {
            $this->publish_down = $this->_db->getNullDate();
        }


        return parent::store($updateNulls);
    }


    /**
     * Overloaded check function
     *
     * @return  boolean  True on success, false on failure
     *
     * @see     JTable::check
     * @since   1.5
     */
    public function check()
    {



        // Check for valid category
        if (trim($this->catid) == '') {
            $this->setError(JText::_('COM_FOODMENU_WARNING_CATEGORY'));

            return false;
        }


        // Check the publish down date is not earlier than publish up.
        if ((int)$this->publish_down > 0 && $this->publish_down < $this->publish_up) {
            $this->setError(JText::_('JGLOBAL_START_PUBLISH_AFTER_FINISH'));

            return false;
        }

        return true;
    }
    public function bind($src, $ignore = array())
    {
        // Bind the rules.
        if (isset($array['rules']) && is_array($array['rules']))
        {
            $rules = new JAccessRules($array['rules']);
            $this->setRules($rules);
        }
        
        return parent::bind($src, $ignore); 
    }

    /**
     * Method to compute the default name of the asset.
     * The default name is in the form table_name.id
     * where id is the value of the primary key of the table.
     *
     * @return  string
     *
     * @since   11.1
     */
    protected function _getAssetName()
    {
        $keys = array();

        foreach ($this->_tbl_keys as $k) {
            $keys[] = (int)$this->$k;
        }

        return $this->_tbl . '.' . implode('.', $keys);
    }
    /**
     * We provide our global ACL as parent
     * @see JTable::_getAssetParentId()
     */
    protected function _getAssetParentId(JTable $table = null, $id = null)
    {
        $asset = JTable::getInstance('Asset');
        $asset->loadByName('com_foodmenu');
        return $asset->id;
    }



}

