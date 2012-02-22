<?php
/**
 * Painter Addresses Controller
 *
 * @package    Painter
 * @subpackage Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controlleradmin');

class PainterControllerAddresses extends JControllerAdmin
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		$this->view_item = "addresses&tmpl=component";
		$this->view_list = "addresses&tmpl=component";
		if($client_id = JRequest::getInt('client_id', 0)){
			$this->view_item = "addresses&tmpl=component&client_id={$client_id}";
			$this->view_list = "addresses&tmpl=component&client_id={$client_id}";
		}
		if($customer_id = JRequest::getInt('customer_id', 0)){
			$this->view_item = "addresses&tmpl=component&customer_id={$customer_id}";
			$this->view_list = "addresses&tmpl=component&customer_id={$customer_id}";
		}
	}
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		parent::display();
	}
	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 */
	public function getModel($name = 'Addresses', $prefix = 'Painter', $config = array('ignore_request' => true))
	{
		switch($this->getTask()){
		case "delete":
		case "saveorder":
		case "orderup":
		case "orderdown":
		case "publish":
		case "unpublish":
			$name = 'Address';
			break;
		default:
			if(JRequest::getCmd('layout') == 'edit'){
				$name = 'Address';
			}
			break;
		}
		return parent::getModel($name, 'PainterModel', $config);
	}
}