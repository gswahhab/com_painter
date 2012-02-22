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
			$foreign_key = $this->element['foreign_key'];
		}

		$link	= "index.php?option=com_painter&amp;view=addresses&amp;layout=list&amp;tmpl=component";
		$html[]	= "<div id=\"container_{$this->id}\" class=\"fltlft\">";
		$html[] = "<p style=\"padding-right: 10px\">{$foreign_key}</p>";
		$html[]	= "</div>";
		$html[]	= "<div class=\"fltlft\">";
		$html[] = "\t<div class=\"button2-left\">";
		$html[] = "\t\t<div class=\"blank\">";
		$html[] = "\t\t\t<a href=\"{$link}\" class=\"modal\" id=\"modal_{$this->id}\" rel=\"{handler: 'iframe', size: {x: 800, y: 400}}\" title=\"\">".JText::_('COM_PAINTER_ADDRESS_BUTTON_LABEL')."</a>";
		$html[] = "\t\t</div>";
		$html[] = "\t</div>";
		$html[]	= "</div>";
		// CREATE THE HTML ELEMENT STRING
		
		// LOAD THE MODAL BEHAVIOR SCRIPT.
		JHtml::_('behavior.modal', 'a.modal');
		
		// CREATE THE JAVASCRIPT INTERFACE
		$script[] = "window.addEvent('domready', function(){";
		$script[] = "\tif($('jform_base_client_id')){";
		$script[] = "\t\tif($('jform_base_client_id').value){";
		$script[] = "\t\t\t$('modal_{$this->id}').href += '&client_id=' + $('jform_base_client_id').value;";
		$script[] = "\t\t}";
		$script[] = "\t}";
		$script[] = "\tif($('jform_base_customer_id')){";
		$script[] = "\t\tif($('jform_base_customer_id').value){";
		$script[] = "\t\t\t$('modal_{$this->id}').href += '&customer_id=' + $('jform_base_customer_id').value;";
		$script[] = "\t\t}";
		$script[] = "\t}";
		$script[] = "});";
		
		$script = implode("\n", $script);
		$doc->addScriptDeclaration($script);
		
		return implode("\n", $html);
	}
}