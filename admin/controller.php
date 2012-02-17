<?php
/**
 * Painter Controller
 *
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

// PRIVILEGE CHECK
if(!JFactory::getUser()->authorise('core.manage', 'com_wholesale')){
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// REQUIRE HELPER FILE
//JLoader::register('PainterHelper', dirname(__FILE__).DS.'helpers'.DS.'painter.php');

// IMPORT CONTROLLER LIBRARY
jimport('joomla.application.component.controller');

class PainterController extends JController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Medthod to display the correct view and layout
	 *
	 * @return  JController  A JController object to support chaining.
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$viewLayout = JRequest::getCmd('layout', 'default');
		$viewName = JRequest::getCmd('view', $this->default_view);
		switch($viewLayout){
		case "edit":
			$modelName = substr($viewName, 0, strlen($viewName) - 1);
			break;
		case "list":
		default:
			$modelName = $viewName;
			PainterHelper::addSubmenu(strtolower($viewName));
			break;
		}
		$view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath, 'layout' => $viewLayout));
		// Get/Create the model
		if ($model = $this->getModel($modelName))
		{
			// Push the model into the view (as default)
			$view->setModel($model, true);
		}

		$view->document = $document;

		$view->display();
		
		return $this;
	}
}