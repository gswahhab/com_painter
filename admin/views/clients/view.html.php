<?php
/**
 * Painter Clients View
 * 
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class PainterViewClients extends JView
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
			JToolBarHelper::title(JText::_('COM_PAINTER_EDIT_CLIENT_SETTINGS'), 'generic.png');
			JToolBarHelper::save('client.save');
			JToolBarHelper::apply('client.apply');
			JToolBarHelper::cancel('client.cancel');
			$this->form = $this->get('Form');
			break;
		case "list":
			JToolBarHelper::title(JText::_('COM_PAINTER_MANAGE_CLIENTS'), 'generic.png');
			JToolBarHelper::addNewX('client.add');
			JToolBarHelper::editListX('client.edit');
			JToolBarHelper::deleteList('client.remove');
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