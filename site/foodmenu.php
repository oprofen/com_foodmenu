<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_foodmenu
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('Foodmenu');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();