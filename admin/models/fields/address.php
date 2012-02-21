<?php
/**
 * Painter Address Form Field
 *
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class JFormFieldAddress extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 */
	public $type = 'Address';
	/**
	 * Method to get the user field input markup.
	 *
	 * @return  string  The field input markup.
	 */
	protected function getInput()
	{
		// GET THE DATA
		$doc	= JFactory::getDocument();
		$table	= JTable::getInstance('Addresses', 'Table');
		$html	= array();
		$script	= array();
		if($this->value){
			$table->load($this->value);
		}else{
			// IS THIS FOR CUSTOMER OR CLIENT?
		}

		$link	= "index.php?option=com_painter&amp;view=addresses&amp;layout=list&amp;tmpl=component";
		$html[]	= "<div class=\"fltlft\">";
		$html[] = "\t<div class=\"button2-left\">";
		$html[] = "\t\t<div class=\"blank\">";
		$html[] = "\t\t\t<a href=\"{$link}\" class=\"modal\" id=\"modal_{$this->id}\" rel=\"{handler: 'iframe', size: {x: 700, y: 400}}\" title=\"\">".JText::_('COM_PAINTER_ADDRESS_BUTTON_LABEL')."</a>";
		$html[] = "\t\t</div>";
		$html[] = "\t</div>";
		$html[]	= "</div>";
		$html[]	= "<div class=\"fltlft\">";
		$html[] = "<p>{$this->value}</p>";
		$html[]	= "</div>";
		// CREATE THE HTML ELEMENT STRING
		
		// LOAD THE MODAL BEHAVIOR SCRIPT.
		JHtml::_('behavior.modal', 'a.modal');
		
		// CREATE THE JAVASCRIPT INTERFACE
		$script[] = "window.addEvent('domready', function(){";
		$script[] = "\tif($('jform_base_client_id').value){";
		$script[] = "\t\t$('modal_{$this->id}').href += '&amp;client_id=' + $('jform_base_client_id').value;";
		$script[] = "\t}";
		$script[] = "});";
		
		$script = implode("\n", $script);
		$doc->addScriptDeclaration($script);
		
		return implode("\n", $html);
	}
}