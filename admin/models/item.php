<?php
/**
 * @package     Foodmenu
 * @subpackage  com_foodmenu
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Item Model.
 *
 * @since  1.6
 */
defined('_JEXEC') or die;


class FoodmenuModeLItem extends JModelAdmin
{
    /**
     * @var        string    The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix = 'COM_FOODMENU';

    /**
     * The type alias for this content type.
     *
     * @var      string
     * @since    3.2
     */
    public $typeAlias = 'com_foodmenu.item';


    protected function prepareTable($table)
    {
        $date = JFactory::getDate();
        $user = JFactory::getUser();

        $table->title = htmlspecialchars_decode($table->title, ENT_QUOTES);
    }

    /**
     * Returns a Table object, always creating it.
     *
     * @param   string $type The table type to instantiate
     * @param   string $prefix A prefix for the table class name. Optional.
     * @param   array $config Configuration array for model. Optional.
     *
     * @return  JTable    A database object
     */
    public function getTable($type = 'Item', $prefix = 'FoodmenuTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }


    /**
     * Method to get the record form.
     *
     * @param   array $data Data for the form.
     * @param   boolean $loadData True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed  A JForm object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_foodmenu.item', 'item', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_foodmenu.edit.item.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }




    protected function canDelete($record)
    {
        if (!empty($record->id)) {
            if ($record->published != -2) {
                return;
            }

            $user = JFactory::getUser();

            return $user->authorise('core.delete', 'com_foodmenu.category.' . (int)$record->catid);
        }
    }

    protected function canEditState($record)
    {
        // Check against the category.
        if (!empty($record->catid)) {
            $user = JFactory::getUser();

            return $user->authorise('core.edit.state', 'com_foodmenu.category.' . (int)$record->catid);
        } // Default to component settings if category not known.
        else {
            return parent::canEditState($record);
        }
    }
}
