@extends('frontend.layouts.app')
@section('title')
Thông báo
@endsection
@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <!-- user profile first-style start-->

                <!-- user profile first-style end-->
                <!-- user profile second-style start-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>Thông báo</h4><span class="mt-3">
                                <span>Ở đây sẽ hiển thị tất cả những hoạt động của bạn trên trang web</span>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Thời gian</th>
                                        <th scope="col">Hoạt động</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\models\Log::where('user_id', Auth::user()->id)->get() as $log)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            {{ $log->created_at }}
                                        </td>
                                        <td>{{$log->action}}</td>
                                    </tr>
                                  
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection