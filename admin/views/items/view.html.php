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
 * View class for a list of items.
 *
 * @since  1.6
 */
class FoodmenuViewItems extends JViewLegacy
{
    protected $items;

    protected $state;

    protected $pagination;

    /**
     * Display the view
     *
     * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
     */
    public function display($tpl = null)
    {

        FoodmenuHelper::addSubmenu('items');


        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->authors       = $this->get('Authors');
        $this->filterForm    = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));

            return false;
        }
        

        $this->addToolbar();
        $this->sidebar = JHtmlSidebar::render();


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
        $canDo = JHelperContent::getActions('com_foodmenu', 'category', $this->state->get('filter.category_id'));
        $user  = JFactory::getUser();

        // Get the toolbar object instance
        $bar = JToolbar::getInstance('toolbar');

        JToolbarHelper::title(JText::_('COM_FOODMENU_ITEMS_TITLE'), 'stack article');

        if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_foodmenu', 'core.create'))) > 0 )
        {
            JToolbarHelper::addNew('item.add');
        }

        if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
        {
            JToolbarHelper::editList('item.edit');
        }

        if ($canDo->get('core.edit.state'))
        {
            JToolbarHelper::publish('items.publish', 'JTOOLBAR_PUBLISH', true);
            JToolbarHelper::unpublish('items.unpublish', 'JTOOLBAR_UNPUBLISH', true);
            JToolbarHelper::archiveList('items.archive');
            JToolbarHelper::checkin('items.checkin');
        }



        if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
        {
            JToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'items.delete', 'JTOOLBAR_EMPTY_TRASH');
        }
        elseif ($canDo->get('core.edit.state'))
        {
            JToolbarHelper::trash('items.trash');
        }

        if ($user->authorise('core.admin', 'com_foodmenu') || $user->authorise('core.options', 'com_foodmenu'))
        {
            JToolbarHelper::preferences('com_foodmenu');
        }
    }

    

    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   3.0
     */
    protected function getSortFields()
    {
        return array(
            'a.ordering'     => JText::_('JGRID_HEADING_ORDERING'),
            'a.state'        => JText::_('JSTATUS'),
            'a.title'        => JText::_('JGLOBAL_TITLE'),
            'category_title' => JText::_('JCATEGORY'),
            'a.created_by'   => JText::_('JAUTHOR'),
            'language'       => JText::_('JGRID_HEADING_LANGUAGE'),
            'a.created'      => JText::_('JDATE'),
            'a.id'           => JText::_('JGRID_HEADING_ID')
        );
    }

}
