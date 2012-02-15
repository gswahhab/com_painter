<?php
/**
 * Painter Default View
 * 
 * @package		Painter
 * @subpackage	Components
 * @license		GNU/GPL
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class PainterViewPainter extends JView
{
	protected $filter;
	protected $items;
	protected $page;
	protected $data;

	/**
	 * Customers view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title(JText::_('COM_PAINTER_DEFAULT_TITLE'), 'generic.png');
		JToolBarHelper::preferences('com_painter', '500');
		parent::display($tpl);
	}
}