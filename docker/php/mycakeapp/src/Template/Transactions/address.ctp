<h2>落札者の住所を登録する</h2>
<?= $this->Form->create($bidinfo) ?>
<fieldset>
	<?php
	echo $this->Form->control('bidder_name');
	echo $this->Form->control('bidder_address');
	echo $this->Form->control('bidder_tel');
	?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
