<?php
/**
 * Painter Countries View
 * 
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class PainterViewCountries extends JView
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
			JToolBarHelper::title(JText::_('COM_PAINTER_EDIT_COUNTRY_SETTINGS'), 'generic.png');
			JToolBarHelper::save('country.save');
			JToolBarHelper::apply('country.apply');
			JToolBarHelper::cancel('country.cancel');
			$this->form = $this->get('Form');
			break;
		case "list":
			JToolBarHelper::title(JText::_('COM_PAINTER_MANAGE_COUNTRIES'), 'generic.png');
			JToolBarHelper::addNewX('country.add');
			JToolBarHelper::editListX('country.edit');
			JToolBarHelper::deleteList('COM_PAINTER_COUNTRY_DELETE_WARNING_MSG', 'countries.delete');
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