<?php
/**
 * @package     Foodmenu
 *
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

/**
 * Helper for standard content style extensions.
 * This class mainly simplifies static helper methods often repeated in individual components
 *
 * @since  3.1
 */
class FoodmenuHelper extends JHelperContent
{
    /**
     * Configure the Linkbar.
     *
     * @param   string  $vName  The name of the active view.
     *
     * @return  void
     *
     * @since   1.6
     */
    public static function addSubmenu($vName = 'items')
    {
        JHtmlSidebar::addEntry(
            JText::_('COM_FOODMENU_SUBMENU_ITEMS'),
            'index.php?option=com_foodmenu&view=items',
            $vName == 'items'
        );
        JHtmlSidebar::addEntry(
            JText::_('COM_FOODMENU_SUBMENU_CATEGORIES'),
            'index.php?option=com_categories&extension=com_foodmenu',
            $vName == 'categories');
    }
}
