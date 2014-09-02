<div class="messages view">
<h2><?php echo __('Message'); ?></h2>
	<dl>
		<dt><?php echo __('Message Id'); ?></dt>
		<dd>
			<?php echo h($message['Message']['message_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Thread'); ?></dt>
		<dd>
			<?php echo $this->Html->link($message['Thread']['thread_id'], array('controller' => 'threads', 'action' => 'view', $message['Thread']['thread_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Msg To'); ?></dt>
		<dd>
			<?php echo h($message['Message']['msg_to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Msg From'); ?></dt>
		<dd>
			<?php echo h($message['Message']['msg_from']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($message['Message']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($message['Message']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Message'), array('action' => 'edit', $message['Message']['message_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Message'), array('action' => 'delete', $message['Message']['message_id']), null, __('Are you sure you want to delete # %s?', $message['Message']['message_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Messages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Threads'), array('controller' => 'threads', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thread'), array('controller' => 'threads', 'action' => 'add')); ?> </li>
	</ul>
</div>
