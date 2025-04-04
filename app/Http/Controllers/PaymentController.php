<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Package;
use App\Models\Subscription;
use App\Http\Controllers\TelegramController;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createOrderVnpay(Request $request)
    {
        $vnp_TmnCode = config('payment.vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('payment.vnpay.vnp_HashSecret');
        $vnp_Url = config('payment.vnpay.vnp_Url');
        $vnp_ReturnUrl = config('payment.vnpay.vnp_ReturnUrl');
        

        $package_id = $request->package_id; 
        $package = Package::find($package_id); 
    
        if (!$package) {
            session()->flash('error', 'Gói dịch vụ không hợp lệ!');
            return redirect()->route('upgrade');
        }
        session(['package_id' => $package->id]);

        $vnp_TxnRef = now()->timestamp; // Mã giao dịch
        $vnp_OrderInfo = "Thanh toán đơn hàng #$vnp_TxnRef - {$package->name}";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->amount * 100; // VNPay tính bằng đơn vị VND * 100
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->bank_code ?? '';
        $vnp_IpAddr = $request->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,  
         ];

        if ($vnp_BankCode) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);



        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }
    public function paymentReturnVnpay(Request $request)
    {
        if ($request->vnp_ResponseCode == '00') {
            // Lưu thông tin thanh toán
            $payment = new Payment();
            $payment->user_id = auth()->id();
            $payment->amount = $request->vnp_Amount / 100;
            $payment->transaction_id = $request->vnp_TxnRef;
            $payment->payment_method = 'VNPay';
            $payment->status = 'success';
            $payment->save();
    
            $package_id = session('package_id');
            $package = Package::where('id', $package_id)->first();    
            if (!$package) {
                session()->flash('error', 'Gói đăng ký không hợp lệ!');
                return redirect()->route('upgrade');
            }
    
            // Tăng rank cho người dùng dựa trên package rank
            $user = auth()->user();
            $user->rank = max($user->rank, $package->id); // Cập nhật rank nếu gói mới cao hơn
            $user->save();

            $userSubscription = Subscription::where('user_id', auth()->id())->first();
            if ($userSubscription) {

                // Cập nhật bảng subscriptions
                $userSubscription->package_id = $package->id;
                $userSubscription->total_capacity += $package->capacity;
                $userSubscription->used_capacity = 0;
                $userSubscription->start_date = now();
                $userSubscription->end_date = now()->addDays($package->duration); // Thời hạn gói
                $userSubscription->status = '1';
                $userSubscription->save();


            } else {

                 // Lưu thông tin vào database
                 $subscription = Subscription::create([
                    'user_id' =>  auth()->id(),
                    'package_id' =>  $package->id,
                    'total_capacity' => $package->capacity,
                    'used_capacity' => 0,
                    'start_date' =>  now(),
                    'end_date' => now()->addDays($package->duration),
                    'status' => '1',
                ]);

                // send tele 

             
            }
    
            $telegram = new TelegramController();
            $telegram->send(now() . PHP_EOL . $user->email . ' thanh toán thành công ( '.$package->name.' ) với giá: ' . number_format($package->price) . 'đ');

            session()->flash('success', 'Thanh toán thành công!');
        } else {
            session()->flash('error', 'Thanh toán thất bại, vui lòng thử lại!');
        }
    
        return redirect()->route('profile');
    }
}