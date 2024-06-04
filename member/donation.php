<?php
include('includes/header.php');
require('../razorpay-php/Razorpay.php');
use Razorpay\Api\Api;


$keyId = 'rzp_test_ySXEeUvsAdZYvS';
$keySecret = 'ouQ1Tyd0OJv66xjLQA6Zqh5D';
$api = new Api($keyId, $keySecret);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = intval($_POST['amount']) * 100; 

    // Create an order
    $orderData = [
        'receipt'         => 'rcptid_11', 
        'amount'          => $amount, 
        'currency'        => 'INR',
        'payment_capture' => true 
    ];

    $razorpayOrder = $api->order->create($orderData);
    $orderId = $razorpayOrder['id'];

    $_SESSION['razorpay_order_id'] = $orderId;

    $data = [
        "key"               => $keyId,
        "amount"            => $orderData['amount'],
        "name"              => "Swami Vidyanand Seva Mandal Pune",
        "description"       => "Donation",
        "image"             => "",
        "prefill"           => [
            "name"              =>  $_SESSION["LoggedInMember"]["userName"] ,
            "contact"           =>  $_SESSION["LoggedInMember"]["MobileNo"] ,
        ],
        "notes"             => [
            "address"           => "Pune",
            "merchant_order_id" => "12312321",
        ],
        "theme"             => [
            "color"             => "#4100ff"
        ],
        "order_id"          => $orderId,
    ];

    $json = json_encode($data);
}
?>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<div class="py-5 bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-4 text-center">
                    <?php alertMessage(); ?>
                    <div class="p-5">
                        <h2 class="text-dark mb-3 fw-bold">Swami Vidyanand Seva Mandal Pune</h2>
                        <h5 class="text-dark mb-3">Donations</h5>

                        <form method="POST" id="donationForm">
                            <div class="my-3">
                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" required>
                            </div>
                            <div class="my-3">
                                <button type="submit" class="btn btn-success w-50 mt-2">Proceed to Donate</button>
                            </div>
                        </form>

                        <?php if (isset($json)) { ?>
                            <script>
                                var options = <?= $json ?>;
                                options.handler = function (response){
                                    alert('Payment successful! Payment ID: ' + response.razorpay_payment_id);
                                    var form = document.createElement('form');
                                    form.setAttribute('method', 'post');
                                    form.setAttribute('action', 'member-code.php');

                                    var hiddenField = document.createElement('input');
                                    hiddenField.setAttribute('type', 'hidden');
                                    hiddenField.setAttribute('name', 'razorpay_payment_id');
                                    hiddenField.setAttribute('value', response.razorpay_payment_id);
                                    form.appendChild(hiddenField);

                                    document.body.appendChild(form);
                                    form.submit();
                                };

                                var rzp1 = new Razorpay(options);

                                rzp1.open();
                            </script>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
