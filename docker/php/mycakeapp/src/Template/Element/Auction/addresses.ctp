<style type="text/css">
  .addresses {
    background: #f3fcff;
    width: 120px
  }
</style>
<table>
  <tbody>
    <tr>
      <th class="addresses">発送先名</th>
      <td><?= h($bidinfo->bidder_name ?? '') ?></td>
    </tr>
    <tr>
      <th class="addresses">発送先住所</th>
      <td><?= h($bidinfo->bidder_address ?? '') ?></td>
    </tr>
    <tr>
      <th class="addresses">発送先電話番号</th>
      <td><?= h($bidinfo->bidder_tel ?? '') ?></td>
    </tr>
  </tbody>
</table>
