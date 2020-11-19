<style type="text/css">
  .review {
    background: #f3fcff;
    width: 120px
  }
</style>
<h2>取引の評価を登録する</h2>
<h3>取引情報</h3>
<table>
  <tbody>
    <tr>
      <th class="review">取引相手</th>
      <td><?= h($target_user_name) ?></td>
    </tr>
    <tr>
      <th class="review">商品名</th>
      <td><?= h($item_name) ?></td>
    </tr>
  </tbody>
</table>
<?php if ($isReviewed) : /* ログインユーザがレビューを送信済みでない */ ?>
  <h3>評価情報</h3>
  <table>
    <tbody>
      <tr>
        <th class="review">value</th>
        <td><?= h($review->value) ?></td>
      </tr>
      <tr>
        <th class="review">comment</th>
        <td><?= nl2br(h($review->comment)) ?></td>
      </tr>
    </tbody>
  </table>
  レビューありがとうございました。
<?php else : /* ログインユーザがレビューを送信済みである */ ?>
  <?php
  echo $this->Form->create($review);
  echo '<fieldset>';
  echo $this->Form->control('value', [
    'type' => 'radio',
    'options' => [
      1 => '1(悪い)',
      2 => '2',
      3 => '3',
      4 => '4',
      5 => '5(良い)'
    ]
  ]);
  echo $this->Form->control('comment', ['type' => 'textarea']);
  echo '</fieldset>';
  echo $this->Form->button(__('Submit'));
  echo $this->Form->end();
  ?>
<?php endif; ?>
