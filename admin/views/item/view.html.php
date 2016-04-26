<?php
/**
 * @package     Foodmenu
 * @subpackage  com_foodmenu
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View to edit an item.
 *
 * @since  1.6
 */
class FoodmenuViewItem extends JViewLegacy
{
    protected $form;

    protected $item;

    protected $state;


    /**
     * Execute and display a template script.
     *
     * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise a Error object.
     *
     * @since   1.6
     */
    public function display($tpl = null)
    {

        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        $this->addToolbar();
        parent::display($tpl);
    }
/**
* Add the page title and toolbar.
*
* @return  void
*
* @since   1.6
*/
    protected function addToolbar()
    {
        JFactory::getApplication()->input->set('hidemainmenu', true);
        $user       = JFactory::getUser();
        $userId     = $user->get('id');
        $isNew      = ($this->item->id == 0);
        $checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

        // Built the actions for new and existing records.
        $canDo = JHelperContent::getActions('com_foodmenu', 'category', $this->item->catid);

        JToolbarHelper::title(
            JText::_('COM_FOODMENU_ITEM_' . ($checkedOut ? 'VIEW_ITEM' : ($isNew ? 'ADD_ITEM' : 'EDIT_ITEM'))),
            'pencil-2 article-add'
        );

        // For new records, check the create permission.
        if ($isNew && (count($user->getAuthorisedCategories('com_foodmenu', 'core.create')) > 0))
        {
            JToolbarHelper::apply('item.apply');
            JToolbarHelper::save('item.save');
            JToolbarHelper::save2new('item.save2new');
            JToolbarHelper::cancel('item.cancel');
        }
        else
        {
            // Can't save the record if it's checked out.
            if (!$checkedOut)
            {
                // Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
                if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId))
                {
                    JToolbarHelper::apply('item.apply');
                    JToolbarHelper::save('item.save');

                    // We can save this record, but check the create permission to see if we can return to make a new one.
                    if ($canDo->get('core.create'))
                    {
                        JToolbarHelper::save2new('item.save2new');
                    }
                }
            }

            // If checked out, we can still save
            if ($canDo->get('core.create'))
            {
                JToolbarHelper::save2copy('item.save2copy');
            }


            JToolbarHelper::cancel('item.cancel', 'JTOOLBAR_CLOSE');
        }

        JToolbarHelper::divider();
    }
}
