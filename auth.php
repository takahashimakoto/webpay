<?php

require 'vendor/autoload.php';
use WebPay\WebPay;

$webpay = new WebPay('test_secret_dHh2fLeBJ80menecnFf863Et');
$charge_response = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (empty($_POST['charge_id'])) {
    $charge_response = $webpay->charge->create(array(
    'amount' => $_POST['amount'],
    'currency' => 'jpy',
    'card' => $_POST['webpay-token'],
    'capture' => false,
  ));
  $charge_id = $charge_response->id;

  } else {
    $charge_id = $_POST['charge_id'];
    $params = array('id' => $charge_id);
    if (!empty($_POST['amount'])) {
      $params['amount'] = $_POST['amount'];
    }
    $charge_response = $webpay->charge->capture($params);
  }
}

?>

<!doctype html>
<html>
<body>

<h1>仮売上をあげる</h1>
<form action="/webpay/auth.php" method="post">
  金額：<input type='text' name='amount'><br>
  <script src="https://checkout.webpay.jp/v2/" class="webpay-button" data-key="test_public_ccOfYo3DJ4lH9bObjBefN56v" data-lang="ja"></script>
</form>

<h1>実売上にする</h1>
<form action="/webpay/auth.php" method="post">
  <input type='hidden' name='action' value='capture'>
  Charge ID：<input type='text' name='charge_id' value='<?php echo @$charge_id; ?>'><br>
  金額：<input type='text' name='amount' value='<?php echo @$_POST["amount"]; ?>'><br>
  <input type='submit' value='実売上にする'>
</form>

</body>
</html>

<h1>ChargeReseponse</h1>
<pre><?php print_r($charge_response); ?></pre>
