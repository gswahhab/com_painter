<?php
/**
 * Painter Address View
 * 
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class PainterViewAddresses extends JView
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
			// GET DATA FROM THE MODEL
			$this->form = $this->get('Form');
			break;
		case "list":
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