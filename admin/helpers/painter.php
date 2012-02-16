<?php
/**
 * Painter Helper
 * 
 * @package		Wholesale
 * @subpackage	Components
 * @license		GNU/GPL
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

abstract Class PainterHelper {
	public static function addSubmenu($submenu){
		// ADD SUBMENU TABS
		JSubMenuHelper::addEntry(JText::_('COM_PAINTER_SUBMENU_PREFS'), 'index.php?option=com_painter', $submenu == 'painter');
		JSubMenuHelper::addEntry(JText::_('COM_PAINTER_SUBMENU_CUSTOMERS'), 'index.php?option=com_painter&view=customers&layout=list', $submenu == 'customers');
		JSubMenuHelper::addEntry(JText::_('COM_PAINTER_SUBMENU_CLIENTS'), 'index.php?option=com_painter&view=clients&layout=list', $submenu == 'clients');
		JSubMenuHelper::addEntry(JText::_('COM_PAINTER_SUBMENU_PROPOSALS'), 'index.php?option=com_painter&view=proposals&layout=list', $submenu == 'proposals');
		JSubMenuHelper::addEntry(JText::_('COM_PAINTER_SUBMENU_MATERIALS'), 'index.php?option=com_painter&view=materials&layout=list', $submenu == 'materials');
		JSubMenuHelper::addEntry(JText::_('COM_PAINTER_SUBMENU_SERVICES'), 'index.php?option=com_painter&view=services&layout=list', $submenu == 'services');
	}
}