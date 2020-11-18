<h2>発送済みを登録する</h2>
<?php if (false === $bidinfo->is_sent) : ?>
	<?= $this->Form->create($bidinfo) ?>
	<?= $this->Form->button(__('発送済み')) ?>
	<?= $this->Form->end() ?>
<?php elseif (false === $bidinfo->is_received) : ?>
	発送済みを登録しました。受取り連絡をお待ちください
<?php else : ?>
	受取り済みが登録されました。評価機能をご利用ください
<?php endif ?>
