<?php
/**
 * @package    Foodmenu
 * @subpackage  com_foodmenu
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Articles list controller class.
 *
 * @since  1.6
 */
class FoodmenuControllerItems extends JControllerAdmin
{

	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  The array of possible config values. Optional.
	 *
	 * @return  JModel
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'Item', $prefix = 'FoodmenuModel', $config = array('ignore_request' => true))
	{
            
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

}
