<?php
/**
 * Painter Model for Regions
 * 
 * @package    Painter
 * @subpackage Component
 * @license    GNU/GPL
 */
 
// CHECK TO ENSURE THIS FILE IS INCLUDED IN JOOMLA!
defined('_JEXEC') or die();
 
jimport( 'joomla.application.component.modellist' );
 
class PainterModelRegions extends JModelList
{
	public function __construct($config = array()){
		parent::__construct($config);
	}
}