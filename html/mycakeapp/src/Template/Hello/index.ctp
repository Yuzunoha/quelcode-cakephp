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
        <th>name</th>
        <td><?= $this->Form->text('Form1.name') ?></td>
      </tr>
      <tr>
        <th>mail</th>
        <td><?= $this->Form->text('Form1.mail') ?></td>
      </tr>
      <tr>
        <th>age</th>
        <td><?= $this->Form->text('Form1.age') ?></td>
      </tr>
      <tr>
        <th></th>
        <td><?= $this->Form->submit('送信') ?></td>
      </tr>
      <?= $this->Form->end() ?>
    </table>
  </div>
</body>

</html>
