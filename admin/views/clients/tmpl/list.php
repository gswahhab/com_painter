<?php
	defined('_JEXEC') or die('Restricted access');
	$user	=& JFactory::getUser();
	$uri	=& JURI::getInstance();
	$base = $uri->root();
?>

<script type="text/javascript">
//<![CDATA[
//]]>
</script>
<form action="index.php" method="post" name="adminForm">
	<input type="hidden" name="option" value="com_painter" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="chosen" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="hidemainmenu" value="1" />
	<input type="hidden" name="filter_order" value="<? echo $this->filter->filter_order; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<? echo $this->filter->filter_order_Dir; ?>" />
	<? echo JHTML::_('form.token')."\n"; ?>
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
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_CLIENT_NAME_LABEL'), 'client_name', $this->filter->filter_order_Dir, $this->filter->filter_order, 'filter'); ?>
				</th>
				<th width="70" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_PUBLISHED_LABEL'), 'published', $this->filter->filter_order_Dir, $this->filter->filter_order, 'filter'); ?>
				</th>
				<th width="75" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ORDERING_LABEL'), 'ordering', $this->filter->filter_order_Dir, $this->filter->filter_order, 'filter');?>
					<? echo JHTML::_('grid.order', $this->items); ?>
				</th>
				<th width="120" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ACCESS_LABEL'), 'access', $this->filter->filter_order_Dir, $this->filter->filter_order, 'filter'); ?>
				</th>
				<th>
					<? echo JText::_('COM_PAINTER_LIST_CLIENT_DESCRIPTION_LABEL'); ?>
				</th>
				<th width="1%">
					<? echo JText::_('COM_PAINTER_LIST_CLIENT_ID_LABEL'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?
		$k = 0;
		for($i=0; $i < count($this->items); $i++){
			$row		= $this->items[$i];
			$access		= JHTML::_('grid.access', $row, $i);
			$checked	= JHTML::_('grid.id', $i, $row->client_id );
			$link		= JRoute::_('index.php?option=com_painter&task=client.edit&client_id='. $row->client_id.'&'.JUtility::getToken().'=1');
			if($row->published){
				$publish_img = "publish_g.png";
				$publish_alt = "Published";
			}else{
				$publish_img = "publish_x.png";
				$publish_alt = "Unpublished";
			}
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
						echo JHTML::_('grid.checkedout', $row, $i, 'client_id');
						echo JText::_( $row->client_name);
					}else{
						echo "<a href=\"{$link}\">" . htmlspecialchars($row->client_name, ENT_QUOTES) . "</a>";
					}
					?>
				</td>
				<td align="center">
					<a href="javascript:void(0);" onclick="return listItemTask('cb<? echo $i; ?>', '<? echo $row->published ? 'unpublish' : 'publish'; ?>')"><img src="images/<? echo $publish_img; ?>" width="16" height="16" border="0" alt="<? echo $publish_alt; ?>" /></a>
				</td>
				<td class="order">
					<span><? echo $this->page->orderUpIcon( $i, ($i > 1), 'orderup', 'Move Up'); ?></span>
					<span><? echo $this->page->orderDownIcon( $i, count($this->items), true, 'orderdown', 'Move Down'); ?></span>
					<input type="text" name="order[]" size="5" value="<? echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td align="center">
					<? echo $access; ?>
				</td>
				<td>
					<? echo $row->client_description; ?>
				</td>
				<td>
					<? echo $row->client_id; ?>
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