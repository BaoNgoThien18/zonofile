<?php 

return [
    'vnpay' =>  [
        'vnp_TmnCode' => env('VNP_TMNCODE', 'your_tmn_code'),
        'vnp_HashSecret' => env('VNP_HASHSECRET', 'your_hash_secret'),
        'vnp_Url' => env('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
        'vnp_ReturnUrl' => env('VNP_RETURNURL', 'http://yourdomain.com/payment/return'),
    ]
];