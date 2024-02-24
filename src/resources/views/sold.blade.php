<!DOCTYPE html>
<html lang="ja">
<?php
use App\Models\buyer;
$buyer = buyer::create([
    'user_id' => $user_id,
    'items_id' => $items_id,
    'datetime' => $datetime,
    'payment' => $payment,
    'session_id' => 1,
    'pay_flg' => 1,
]);
$buyer_id = $buyer->id;

$stripe = new \Stripe\StripeClient(config('stripe.stripe_secret_key'));
$checkout_session = $stripe->checkout->sessions->create([
    'payment_method_types' => [$method],
    'payment_method_options' => [
        'customer_balance' => [
            'funding_type' => 'bank_transfer',
            'bank_transfer' => ['type' => 'jp_bank_transfer'],
        ],
        'konbini' => [
            'expires_after_days' => 7,
        ],
    ],
    'customer' => 'cus_PUkPHfcbVmRBw0',
    'line_items' => [[
        'price_data' => [
            'currency' => 'jpy',
            'product_data' => [
                'name' => $name,
            ],
            'unit_amount' => $value,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => "http://localhost/success/",
    'cancel_url' => "http://localhost/cancel/". $buyer_id,
]);

buyer::where('id','=',$buyer_id)->update([
    'session_id' => $checkout_session['id'],
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>
</html>