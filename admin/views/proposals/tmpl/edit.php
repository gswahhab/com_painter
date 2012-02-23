<?php
	defined('_JEXEC') or die('Restricted access');
	JHtml::_('behavior.modal');
	JHtml::_('behavior.formvalidation');
?>

<script type="text/javascript">
//<![CDATA[
window.addEvent('domready', function() {
	$$('button.modal').invoke('addEvent', 'click', function(someEvent){
		if($(someEvent.target).hasClass('add')){
			SqueezeBox.open("index.php?option=com_painter&task=item.addgroup&layout=editgroup&tmpl=component&proposal_id={$this-form->getValue('proposal_id', 'base')}", {handler: 'iframe', size: {x:600, y:300}});
		}
	});
});
//]]>
</script>

<form action="index.php" method="post" name="adminForm" class="form-validate" enctype="multipart/form-data">
	<input type="hidden" name="option" value="com_painter" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="hidemainmenu" value="0" />
	<? echo JHTML::_('form.token')."\n"; ?>
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
		<?php foreach($this->form->getFieldsets('params') as $fieldset){ ?>
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
		<? if($this->form->getValue('proposal_id', 'base')){ ?>
		<div class="width-100 fltlft">
			<fieldset class="adminform">
				<legend><?php echo JText::_('COM_PAINTER_PROPOSAL_ITEM_GROUPS_LEGEND'); ?></legend>
				<div class="fltrt">
					<button type="button" class="modal add"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_ADD_GROUP'); ?></button>
				</div>
			</fieldset>
		</div>
		<? } ?>
	</div>
</form>
