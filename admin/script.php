<?php
defined('_JEXEC') or die;
class com_foodmenuInstallerScript
{
function install($parent)
{
$parent->getParent()->setRedirectURL('index.php?option=com_foodmenu');
}
function uninstall($parent)
{
    echo '<p>' . JText::_('COM_FOODMENU_UNINSTALL_TEXT') . '</p>';

function update($parent)
{
echo '<p>' . JText::_('COM_FOODMENU_UPDATE_TEXT') . '</p>';
}
function preflight($type, $parent)
{
echo '<p>' . JText::_('COM_FOODMENU_PREFLIGHT_' . $type .
'_TEXT') . '</p>';
}
function postflight($type, $parent)
{
echo '<p>' . JText::_('COM_FOODMENU_POSTFLIGHT_' . $type .
'_TEXT') . '</p>';
}
}
}
