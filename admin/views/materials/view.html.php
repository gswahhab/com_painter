<?php
/**
 * Painter Materials View
 * 
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class PainterViewMaterials extends JView
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
			JToolBarHelper::title(JText::_('COM_PAINTER_EDIT_MATERIAL_SETTINGS'), 'generic.png');
			JToolBarHelper::save('material.save');
			JToolBarHelper::apply('material.apply');
			JToolBarHelper::cancel('material.cancel');
			$this->form = $this->get('Form');
			break;
		case "list":
			JToolBarHelper::title(JText::_('COM_PAINTER_MANAGE_MATERIALS'), 'generic.png');
			JToolBarHelper::addNewX('material.add');
			JToolBarHelper::editListX('material.edit');
			JToolBarHelper::deleteList('COM_PAINTER_MATERIAL_DELETE_WARNING_MSG', 'materials.delete');
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