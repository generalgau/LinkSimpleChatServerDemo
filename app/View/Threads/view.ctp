<div class="threads view">
<h2><?php echo __('Thread'); ?></h2>
	<dl>
		<dt><?php echo __('Message Id'); ?></dt>
		<dd>
			<?php echo h($thread['Thread']['message_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($thread['Thread']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($thread['Thread']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Thread'), array('action' => 'edit', $thread['Thread']['message_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Thread'), array('action' => 'delete', $thread['Thread']['message_id']), null, __('Are you sure you want to delete # %s?', $thread['Thread']['message_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Threads'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thread'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Messages'), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Messages'); ?></h3>
	<?php if (!empty($thread['Message'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Message Id'); ?></th>
		<th><?php echo __('Msg To'); ?></th>
		<th><?php echo __('Msg From'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($thread['Message'] as $message): ?>
		<tr>
			<td><?php echo $message['message_id']; ?></td>
			<td><?php echo $message['msg_to']; ?></td>
			<td><?php echo $message['msg_from']; ?></td>
			<td><?php echo $message['message']; ?></td>
			<td><?php echo $message['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'messages', 'action' => 'view', $message['message_id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'messages', 'action' => 'edit', $message['message_id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'messages', 'action' => 'delete', $message['message_id']), null, __('Are you sure you want to delete # %s?', $message['message_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
