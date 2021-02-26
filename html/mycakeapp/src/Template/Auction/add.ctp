<h2>商品を出品する</h2>
<?= $this->Form->create($biditem, ['type' => 'file']) ?>
<fieldset>
	<legend>※商品名と終了日時を入力：</legend>
	<?php
	echo $this->Form->hidden('user_id', ['value' => $authuser['id']]);
	echo '<p><strong>USER: ' . $authuser['username'] . '</strong></p>';
	echo $this->Form->control('name');
	echo $this->Form->control('description', ['type' => 'textarea']);
	echo $this->Form->control('image', ['type' => 'file']); // image_name(255)に加工する
	echo $this->Form->hidden('finished', ['value' => 0]);
	echo $this->Form->control('endtime');
	echo $this->Form->control('password_confirm', ['type' => 'text']);
	?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
