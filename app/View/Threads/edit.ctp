<div class="threads form">
<?php echo $this->Form->create('Thread'); ?>
	<fieldset>
		<legend><?php echo __('Edit Thread'); ?></legend>
	<?php
		echo $this->Form->input('thread_id');
		echo $this->Form->input('thread_user1');
		echo $this->Form->input('thread_user2');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Thread.thread_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Thread.thread_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Threads'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Messages'), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>
