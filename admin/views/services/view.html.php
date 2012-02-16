<?php
/**
 * Painter Services View
 * 
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class PainterViewServices extends JView
{
	protected $filter;
	protected $items;
	protected $page;
	protected $form;
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Customers view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		$layout = JRequest::getCmd('layout', 'list');
		$this->setLayout($layout);
		switch($layout){
		case "edit":
			JToolBarHelper::title(JText::_('COM_PAINTER_EDIT_SERVICE_SETTINGS'), 'generic.png');
			JToolBarHelper::save('service.save');
			JToolBarHelper::apply('service.apply');
			JToolBarHelper::cancel('service.cancel');
			$this->form = $this->get('Form');
			break;
		case "list":
			JToolBarHelper::title(JText::_('COM_PAINTER_MANAGE_SERVICES'), 'generic.png');
			JToolBarHelper::addNewX('service.add');
			JToolBarHelper::editListX('service.edit');
			JToolBarHelper::deleteList('service.remove');
			// GET DATA FROM THE MODEL
			$this->filter	= $this->get('State');
			$this->items	= $this->get('Items');
			$this->page		= $this->get('Pagination');
			break;
		default:
			break;
		}
		parent::display($tpl);
	}
}