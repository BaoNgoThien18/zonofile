@extends('frontend.layouts.app')
@section('title')
Thông Tin Cá Nhân
@endsection
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="user-profile">
        <div class="row">
            <!-- user profile first-style start-->
            <div class="col-sm-12">
                <div class="card hovercard text-center">
                    <div class="cardheader"></div>
                    <div class="user-image">
                        <div class="avatar">
                            <img id="user-avatar" alt="" src="{{ asset('' . ($user->avatar ?? 'https://cdn-icons-png.flaticon.com/128/9386/9386837.png')) }}">
                        </div>
                        <div class="icon-wrapper" data-bs-toggle="modal" data-bs-target="#editUserModal">
                            <i class="icofont icofont-pencil-alt-5"></i>
                        </div>
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="ttl-info text-start">
                                            <h6><i class="fa fa-envelope"></i> Email</h6>
                                            <span id="user-email">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="ttl-info text-start">
                                            <h6><i class="fa fa-calendar"></i> Ngày tạo</h6>
                                            <span id="user-created-at">{{ $user->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                <div class="user-designation">
                                    <div class="title" id="user-name">{{ $user->name }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <!-- user profile first-style end-->
            <!-- user profile second-style start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h4>Gói Đăng Ký</h4>
                        <span>
                            Thông tin gói đăng ký hiện tại của bạn
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5>
                                <span class="badge fw-bold {{ 
                                    $user->package->id == 1 ? 'badge-primary' : 
                                    ($user->package->id == 2 ? 'badge-success' : 
                                    ($user->package->id == 3 ? 'badge-warning' :
                                    ($user->package->id == 4 ? 'badge-secondary' : 
                                    ($user->package->id == 5 ? 'badge-danger' : 'badge-info')))) 
                                }}">{{ $user->package->name ?? 'Chưa đăng ký' }}</span>
                            </h5>
                            <span class="fs-6">Đã dùng <span
                                    class="fs-3 used-capacity">{{ round($subscription->used_capacity / 1024, 2) }}
                                    GB</span> / <span
                                    class="total-capacity">{{ round($subscription->total_capacity / 1024, 2) }}
                                    GB</span></span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress mb-3">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $subscription->total_capacity > 0 ? round(($subscription->used_capacity / $subscription->total_capacity) * 100, 2) : 0 }}%"
                                aria-valuenow="{{ $subscription->total_capacity > 0 ? round(($subscription->used_capacity / $subscription->total_capacity) * 100, 2) : 0 }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>

                        </div>
                        @if ($subscription)
                        <table role="grid" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <!-- Dung lượng đã sử dụng -->
                                    <td class="cell" style="width: 30%;">
                                        <div class="info">
                                            <div class="title">Dung lượng đã sử dụng</div>
                                            <div class="value">{{ round($subscription->used_capacity, 2) }} MB</div>
                                            <div class="description">Dữ liệu đã lưu trữ</div>
                                        </div>
                                    </td>

                                    <!-- Dung lượng còn lại -->
                                    <td class="cell" style="width: 30%;">
                                        <div class="info">
                                            <div class="title">Dung lượng còn lại</div>
                                            <div class="value">
                                                {{ round(($subscription->total_capacity - $subscription->used_capacity), 2) }}
                                                MB</div>
                                            <div class="description">Bộ nhớ còn trống</div>
                                        </div>
                                    </td>

                                    <!-- Ngày hết hạn -->
                                    <td class="cell" style="width: 40%;">
                                        <div class="info">
                                            <div class="title">Ngày hết hạn</div>
                                            <div class="value">
                                                @if ($subscription->end_date)
                                                {{ \Carbon\Carbon::parse($subscription->end_date)->format('d/m/Y') }}
                                                (Còn
                                                {{ round(\Carbon\Carbon::parse($subscription->end_date)->diffInDays(\Carbon\Carbon::now(), false)) * (-1   ) }}
                                                ngày)
                                                @else
                                                {{ \Carbon\Carbon::now()->format('H:i') }} Giờ
                                                @endif
                                            </div>
                                            <div class="description">Thời hạn</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @else
                        <p>Chưa có thông tin về gói đăng ký của bạn.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h4>Lịch sử hoạt động</h4><span class="mt-3">
                            <span>Ở đây sẽ hiển thị tất cả những hoạt động của bạn trên trang web</span>
                    </div>
                    <div class="card-body">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Hoạt động</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                            <tr>
                                <td>{{$log->created_at->format('d/m/Y H:i')}}</td>
                                <td>{{$log->action}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h4>Lịch sử giao dịch</h4><span class="mt-3">
                            <span>Ở đây sẽ hiển thị tất cả lịch sử giao dịch</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Số tiền</th>
                                    <th scope="col">Phương thức thanh toán</th>
                                    <th scope="col">Mã hóa đơn</th>
                                    <th scope="col">Trạng thái</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $row)
                                <tr>
                                    <th scope="row" class="text-center">{{ $row->id }}</th>
                                    <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ number_format($row->amount) }} VND</td>
                                    <td>{{ $row->payment_method }}</td>
                                    <td>{{ $row->transaction_id }}</td>
                                    <td class="d-flex align-items-center">
                                        @if ($row->status === 'success')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-check-circle bg-light-success font-success">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                        <span class="font-success">Thành công</span>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-x-circle bg-light-danger font-danger">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                        </svg>
                                        <span class="font-danger">Thất bại</span>
                                        @endif
                                    </td>

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

    <!-- Modal Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Chỉnh sửa thông tin người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form chỉnh sửa thông tin người dùng -->
                    <form id="editUserForm">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <!-- Avatar Section -->
                            <div class="d-flex align-items-center justify-content-start">
                                <!-- Avatar Image -->
                                <div class="avatar me-3">
                                    <img src="{{ asset('' . ($user->avatar ?? 'default-avatar.jpg')) }}" alt="Avatar"
                                        class="img-fluid rounded-circle" id="avatar-img" width="100">
                                </div>

                                <!-- Avatar Upload Section -->
                                <div class="d-flex flex-column">
                                    <label class="form-label mb-1">Avatar</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#avatar').on('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#avatar-img').attr('src', e.target.result);
            };
            if (this.files && this.files[0]) {
                reader.readAsDataURL(this.files[0]);
            }
        });
        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                url: "{{ url('user/updateProfile') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        swal("Thành Công!", response.message, "success");
                        $('#name').val(response.user.name);
                        $('#email').val(response.user.email);

                        $('#user-name').text(response.user.name);
                        $('#user-email').text(response.user.email);
                        $('#user-avatar').attr('src', "{{ asset('') }}" + response.user
                            .avatar + '?' + new Date().getTime());
                        $('#sidebar-avatar').attr('src', "{{ asset('') }}" + response.user
                            .avatar + '?' + new Date().getTime());

                    } else {
                        swal("Có Lỗi!", response.message, "error");
                    }
                },
                error: function(xhr, status, error) {
                    swal("Có Lỗi!", "Có lỗi xảy ra, vui lòng thử lại.", "error");
                }
            });
        });
    });
    </script>
    <style>
    .table .caption {
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .cell {
        padding: 10px;
        border: 1px solid #ddd;
        vertical-align: top;
    }

    .value {
        font-size: 18px;
        font-weight: 700;
        margin: 5px 0;
    }

    .description {
        font-size: 14px;
        color: #777;
    }

    .used-capacity,
    .total-capacity {
        font-weight: 700;
        color: #2b5f60;
    }

    .value {
        font-size: 16px;
        color: #333;
    }

    .value:hover {
        cursor: pointer;
        color: #2b5f60;
    }
    </style>
</div>
<!-- Container-fluid Ends-->
@endsection