<div class="messages index">
	<h2><?php echo __('Messages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('message_id'); ?></th>
			<th><?php echo $this->Paginator->sort('thread_id'); ?></th>
			<th><?php echo $this->Paginator->sort('msg_to'); ?></th>
			<th><?php echo $this->Paginator->sort('msg_from'); ?></th>
			<th><?php echo $this->Paginator->sort('message'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($messages as $message): ?>
	<tr>
		<td><?php echo h($message['Message']['message_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($message['Thread']['thread_id'], array('controller' => 'threads', 'action' => 'view', $message['Thread']['thread_id'])); ?>
		</td>
		<td><?php echo h($message['Message']['msg_to']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['msg_from']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['message']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $message['Message']['message_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $message['Message']['message_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $message['Message']['message_id']), null, __('Are you sure you want to delete # %s?', $message['Message']['message_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Message'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Threads'), array('controller' => 'threads', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thread'), array('controller' => 'threads', 'action' => 'add')); ?> </li>
	</ul>
</div>
