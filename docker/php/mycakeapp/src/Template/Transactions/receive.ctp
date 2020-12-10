<h2>受け取り済みを登録する</h2>

<?= $this->element('Auction/addresses'); ?>

<?php if (false === $bidinfo->is_sent) : ?>
  商品の発送をお待ちください
<?php elseif (false === $bidinfo->is_received) : ?>
  <?= $this->Form->create($bidinfo) ?>
  <?= $this->Form->button(__('受け取り済み')) ?>
  <?= $this->Form->end() ?>
<?php else : ?>
  受取り済みを登録しました。評価機能をご利用ください
<?php endif ?>
