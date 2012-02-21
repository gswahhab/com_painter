<?php
	defined('_JEXEC') or die('Restricted access');
	$user		= JFactory::getUser();
	$ordering	= $this->filter->get('list.ordering');
	$order_dir	= $this->filter->get('list.direction');
	require_once(JPATH_ROOT.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'html'.DS.'behavior.php');
	JHtmlBehavior::framework(true);
?>

<script type="text/javascript">
//<![CDATA[
window.addEvent('domready', function() {
	$$('button.modal').invoke('addEvent', 'click', function(someEvent){
		if($(someEvent.target).hasClass('add')){
			someTask = 'address.add';
		}
		if($(someEvent.target).hasClass('edit')){
			someTask = 'address.edit';
		}
		if($(someEvent.target).hasClass('delete')){
			someTask = 'addresses.delete';
		}
		if($(someEvent.target).hasClass('cancel')){
			if(window.parent){
				window.parent.SqueezeBox.close();
			}
			return true;
		}
		Joomla.submitform(someTask, document.adminForm);
	});
});
//]]>
</script>
<form action="index.php" method="post" name="adminForm">
	<input type="hidden" name="option" value="com_painter" />
	<input type="hidden" name="view" value="addresses" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="chosen" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<? echo $this->filter->get('list.ordering'); ?>" />
	<input type="hidden" name="filter_order_Dir" value="<? echo $this->filter->get('list.direction'); ?>" />
	<? echo JHTML::_('form.token')."\n"; ?>
	<fieldset class="filter">
		<div class="right">
			<button type="button" class="modal add"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_ADD'); ?></button>
			<button type="button" class="modal edit"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_EDIT'); ?></button>
			<button type="button" class="modal delete"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_DELETE'); ?></button>
			<button type="button" class="modal cancel"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_CANCEL'); ?></button>
		</div>
	</fieldset>
	<table class="adminlist">
		<thead>
			<tr>
				<th width="5">
					<? echo JText::_('Num'); ?>
				</th>
				<th width="5">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<? echo count( $this->items ); ?>);" />
				</th>
				<th class="title">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ADDRESS_NAME_LABEL'), 'address_name', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th>
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ADDRESS_CITY_LABEL'), 'address_city', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th class="title">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ADDRESS_REGION_LABEL'), 'region_name', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th class="title">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ADDRESS_POSTAL_LABEL'), 'address_postal_code', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th width="10%" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_PUBLISHED_LABEL'), 'c.published', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th width="15%" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ORDERING_LABEL'), 'c.ordering', $order_dir, $ordering, 'filter');?>
					<? echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'addresses.saveorder'); ?>
				</th>
				<th nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ACCESS_LABEL'), 'c.access', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th width="1%">
					<? echo JText::_('COM_PAINTER_LIST_ADDRESS_ID_LABEL'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?
		$k = 0;
		for($i=0; $i < count($this->items); $i++){
			$row		= $this->items[$i];
			$checked	= JHTML::_('grid.id', $i, $row->address_id );
			$link		= JRoute::_('index.php?option=com_painter&task=address.edit&address_id='. $row->address_id.'&tmpl=component&'.JUtility::getToken().'=1');
			?>
			<tr class="row<? echo $k; ?>">
				<td>
					<? echo $this->page->getRowOffset($i); ?>
				</td>
				<td align="center">
					<? echo $checked; ?>
				</td>
				<td>
					<?
					if(JTable::isCheckedOut($user->get('id'), $row->checked_out)){
						echo JHTML::_('grid.checkedout', $row, $i, 'address_id');
						echo JText::_( $row->address_name);
					}else{
						echo "<a href=\"{$link}\">" . htmlspecialchars($row->address_name, ENT_QUOTES) . "</a>";
					}
					?>
				</td>
				<td>
					<? echo $row->address_city; ?>
				</td>
				<td>
					<? echo $row->region_name; ?>
				</td>
				<td>
					<? echo $row->address_postal_code; ?>
				</td>
				<td align="center">
					<?php echo JHtml::_('jgrid.published', $row->published, $i, 'addresses.', true, 'cb'); ?>
				</td>
				<td class="order">
					<span><? echo $this->page->orderUpIcon( $i, ($i > 0), 'addresses.orderup', 'Move Up'); ?></span>
					<span><? echo $this->page->orderDownIcon( $i, count($this->items), true, 'addresses.orderdown', 'Move Down'); ?></span>
					<input type="text" name="order[]" size="5" value="<? echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td align="center">
					<? echo $row->access; ?>
				</td>
				<td>
					<? echo $row->address_id; ?>
				</td>
			</tr>
			<?
			$k = 1 - $k;
		}
		?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10">
					<? echo $this->page->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
</form>