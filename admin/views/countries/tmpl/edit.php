<?php
	defined('_JEXEC') or die('Restricted access');
	require_once(JPATH_ROOT.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'html'.DS.'behavior.php');
	JHtmlBehavior::framework(true);
	JHtml::_('behavior.formvalidation');
?>

<script type="text/javascript">
//<![CDATA[
window.addEvent('domready', function() {
	$$('button.modal').invoke('addEvent', 'click', function(someEvent){
		if($(someEvent.target).hasClass('apply')){
			someTask = 'country.apply';
		}
		if($(someEvent.target).hasClass('save')){
			someTask = 'country.save';
		}
		if($(someEvent.target).hasClass('save2new')){
			someTask = 'country.save2new';
		}
		if($(someEvent.target).hasClass('cancel')){
			someTask = 'country.cancel';
		}
		Joomla.submitform(someTask, document.adminForm);
	});
});
//]]>
</script>

<form action="index.php" method="post" name="adminForm" class="form-validate">
	<input type="hidden" name="option" value="com_painter" />
	<input type="hidden" name="tmpl" value="component" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="hidemainmenu" value="0" />
	<? echo JHTML::_('form.token')."\n"; ?>
	<fieldset class="filter">
		<div class="right">
			<button type="button" class="modal apply"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_APPLY'); ?></button>
			<button type="button" class="modal save"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_SAVE'); ?></button>
			<button type="button" class="modal save2new"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_SAVE2NEW'); ?></button>
			<button type="button" class="modal cancel"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_CANCEL'); ?></button>
		</div>
	</fieldset>
	<div id="editcell">
		<div class="width-60 fltlft">
		<?php foreach($this->form->getFieldsets('base') as $fieldset){ ?>
			<fieldset class="adminform">
				<legend><?php echo JText::_($fieldset->label); ?></legend>
				<dl>
				<?php foreach($this->form->getFieldset($fieldset->name) as $field){ ?>
					<dt><?php echo $field->label; ?></dt>
					<dd><?php echo $field->input; ?></dd>
				<?php } ?>
				</dl>
			</fieldset>
		<?php } ?>
		</div>
		<div class="width-40 fltlft">
		<?php foreach($this->form->getFieldsets('options') as $fieldset){ ?>
			<fieldset class="adminform">
				<legend><?php echo JText::_($fieldset->label); ?></legend>
				<dl>
				<?php foreach($this->form->getFieldset($fieldset->name) as $field){ ?>
					<dt><?php echo $field->label; ?></dt>
					<dd><?php echo $field->input; ?></dd>
				<?php } ?>
				</dl>
			</fieldset>
		<?php } ?>
		</div>
	</div>
</form>
