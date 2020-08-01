<!DOCTYPE html>
<html>

<head>
  <title><?= $title ?></title>
  <style>
    h1 {
      font-size: 48pt;
      margin: 0px 0px 10px 0px;
      padding: 0px 20px;
      color: white;
      background: linear-gradient(to right, #aaa, #fff);
    }

    p {
      font-size: 14pt;
      color: #666;
    }
  </style>
</head>

<body>
  <header class="row">
    <h1><?= $title ?></h1>
  </header>
  <div class="row">
    <pre><?php print_r($data); ?></pre>
  </div>
  <div class="row">
    <table>
      <?= $this->Form->create(
        null,
        [
          'type' => 'post',
          'url' => [
            'controller' => 'Hello',
            'action' => 'index'
          ]
        ]
      ) ?>
      <tr>
        <th>CheckBox</th>
        <td>
          <?= $this->Form->checkbox('Form1.check', ['id' => 'check1']) ?>
          <?= $this->Form->label('check1', 'check box') ?></td>
      </tr>
      <tr>
        <th>RadioButton</th>
        <td>
          <?= $this->Form->radio('Form1.radio', [
            ['text' => 'male', 'value' => '男性', 'checked' => true],
            ['text' => 'female', 'value' => '女性']
          ]) ?></td>
      </tr>
      <tr>
        <th></th>
        <td>
          <?= $this->Form->submit('送信') ?></td>
      </tr>
      <?= $this->Form->end() ?>
    </table>
  </div>
</body>

</html>
