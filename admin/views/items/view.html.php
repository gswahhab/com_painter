<?php
/**
 * Painter Items View
 * 
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class PainterViewItems extends JView
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
			JToolBarHelper::title(JText::_('COM_PAINTER_EDIT_ITEM_SETTINGS'), 'generic.png');
			JToolBarHelper::save('item.save');
			JToolBarHelper::apply('item.apply');
			JToolBarHelper::cancel('item.cancel');
			$this->form = $this->get('Form');
			break;
		case "list":
			JToolBarHelper::title(JText::_('COM_PAINTER_MANAGE_ITEMS'), 'generic.png');
			JToolBarHelper::addNewX('item.add');
			JToolBarHelper::editListX('item.edit');
			JToolBarHelper::deleteList('COM_PAINTER_ITEM_DELETE_WARNING_MSG', 'items.delete');
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