<?php
/**
 * Painter Controller
 *
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

// REQUIRE HELPER FILE
//JLoader::register('PainterHelper', dirname(__FILE__).DS.'helpers'.DS.'painter.php');

// IMPORT CONTROLLER LIBRARY
jimport('joomla.application.component.controller');

// GET CONTROLLER INSTANCE
if($controller = JRequest::getCmd('controller', '')){
	$task = JRequest::getCmd('task', 'display');
	JRequest::setVar('task', $controller.'.'.$task);
}
$controller = JController::getInstance('Painter');

// PERFORM THE REQUESTED TASK
$controller->execute(JRequest::getCmd('task'));

// REDIRECT IF NECESSARY
$controller->redirect();
