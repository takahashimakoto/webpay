<?php

require 'vendor/autoload.php';
use WebPay\WebPay;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $webpay = new WebPay('test_secret_dHh2fLeBJ80menecnFf863Et');
  $result = $webpay->charge->create(array(
    'amount' => $_POST['amount'],
    'currency' => 'jpy',
    'card' => $_POST['webpay-token'],
  ));
}
?>

<!doctype html>
<html>
<body>
<form action="/webpay/charge.php" method="post">
  金額：<input type='text' name='amount'><br>
  <script src="https://checkout.webpay.jp/v2/" class="webpay-button" data-key="test_public_ccOfYo3DJ4lH9bObjBefN56v" data-lang="ja"></script>
</form>
</body>
</html>

