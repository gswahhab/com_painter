<?php
/**
 * Painter Customers View
 * 
 * @package		Painter
 * @subpackage	Components
 * @license		GNU/GPL
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class PainterViewCustomers extends JView
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
			$layout = $this->setLayout('edit');
			JToolBarHelper::title(JText::_('COM_PAINTER_EDIT_CUSTOMER_SETTINGS'), 'generic.png');
			JToolBarHelper::save('customer.save');
			JToolBarHelper::apply('customer.apply');
			JToolBarHelper::cancel('customer.cancel');
			$this->form = $this->get('Form');
			break;
		case "list":
			JToolBarHelper::title(JText::_('COM_PAINTER_MANAGE_CUSTOMERS'), 'generic.png');
			JToolBarHelper::addNewX('customer.add');
			JToolBarHelper::editListX('customer.edit');
			JToolBarHelper::deleteList('customer.remove');
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