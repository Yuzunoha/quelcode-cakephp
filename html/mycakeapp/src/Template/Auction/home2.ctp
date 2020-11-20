<h2><?= $authuser['username'] ?> のホーム</h2>
<h3>※出品情報</h3>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th scope="col"><?= $this->Paginator->sort('id') ?></th>
			<th class="main" scope="col"><?= $this->Paginator->sort('name') ?></th>
			<th scope="col"><?= $this->Paginator->sort('created') ?></th>
			<th scope="col"><?= __('Messages') ?></th>
			<th scope="col"><?= __('Transactions') ?></th>
			<th scope="col"><?= __('Reviews') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($biditems as $biditem) : ?>
			<tr>
				<td><?= h($biditem->id) ?></td>
				<td><?= h($biditem->name) ?></td>
				<td><?= h($biditem->created) ?></td>
				<?php if (!empty($biditem->bidinfo)) : ?>
					<td><?= $this->Html->link(__('Message'), ['action' => 'msg', $biditem->bidinfo->id]) ?></td>
					<td><?= $this->Html->link(__('Transaction'), ['controller' => 'Transactions', 'action' => 'index', $biditem->bidinfo->id]) ?></td>
					<td><?= $biditem->bidinfo->is_received ? $this->Html->link(__('Review'), ['controller' => 'Reviews', 'action' => 'add', $biditem->bidinfo->id]) : '' ?></td>
				<?php else : ?>
					<td></td>
					<td></td>
					<td></td>
				<?php endif; ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<div class="paginator">
	<ul class="pagination">
		<?= $this->Paginator->first('<< ' . __('first')) ?>
		<?= $this->Paginator->prev('< ' . __('previous')) ?>
		<?= $this->Paginator->numbers() ?>
		<?= $this->Paginator->next(__('next') . ' >') ?>
		<?= $this->Paginator->last(__('last') . ' >>') ?>
	</ul>
</div>
<h6><?= $this->Html->link(__('<< 落札情報に戻る'), ['action' => 'home']) ?></h6>
