@extends('frontend.layouts.app')
@section('title')
Nâng cấp tài khoản
@endsection
@section('content')
<!-- Container-fluid starts -->
<div class="container-fluid default-dashboard">
    <div class="row justify-content-center">
        @foreach($packages as $package)
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <form action="{{ url('payment/createOrder/Vnpay') }}" method="GET">
                @csrf

                <div class="card text-center h-100">
                    <div class="card-header">
                        <h4>{{ $package->name }}</h4>
                    </div>
                    <div class="">
                        <div class="card-body premium-card d-flex flex-column align-items-center">
                            <!-- Hình ảnh -->
                            <div class="image-content mb-3">
                                <img src="{{ asset('frontend/images/premium-courses.png') }}" class="img-fluid" alt="Premium">
                            </div>
    
                            <!-- Thông tin gói -->
                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                            <input type="hidden" name="amount" value="{{ $package->price }}">

                            <div class="note mb-3">
                                CHỈ TỪ <b>{{ number_format($package->price) }}₫/{{ $package->duration}} Ngày</b>
                            </div>
                            
                            <!-- Mô tả -->
                            <div class="d-flex flex-column text-left mb-3" style="text-align: left !important">
                                {!! str_replace(
                                    '<div', 
                                    '<div><i class="icofont icofont-arrow-right"></i>', 
                                    $package->description
                                ) !!}
                            </div>
    
                            <!-- Nút mua -->
                            <div class="mt-auto d-flex justify-content-center mb-3">
                                <button class="btn btn-primary px-4" type="submit">MUA NGAY</button>
                            </div>
    
                            {{-- <!-- Nút xem chi tiết -->
                            <div class="mt-3">
                                <a class="btn btn-outline-danger f-w-700" href="{{ url('pricing') }}">Xem chi tiết</a>
                            </div> --}}
                        </div>
                    </div>
        
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
<!-- Container-fluid Ends -->
@endsection
