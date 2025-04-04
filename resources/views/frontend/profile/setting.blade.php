@extends('frontend.layouts.app')

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Tài khoản của tôi</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="d-flex"> <img class="img-70 rounded-circle" alt=""
                                            src="https://admin.pixelstrap.net/zono/assets/images/user/7.jpg">
                                        <div class="flex-grow-1">
                                            <h3 class="mb-1 f-w-600">Ngô Thiên Bảo</h3>
                                            <p><span class="btn btn-warning py-0 px-3">Hạng Vip 3</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h6 class="form-label">Bio</h6>
                                <textarea class="form-control" rows="5">Tôi là một người chơi fifai rất giỏi</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tên tài khoản</label>
                                <input class="form-control" placeholder="Ngô Bảo">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" placeholder="ngobaoprovip13@domain.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input class="form-control" type="password" value="password">
                            </div>

                            <div class="form-footer">
                                <button class="btn btn-primary btn-block">Lưu lại</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <form class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Thông tin số dư</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="card border border-primary">
                                    <div class="card-header ">
                                        <h4>50.000đ</h4>
                                        <p class="f-m-light mt-1">Số dư hiện tại</p>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-settings">
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                        <path
                                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                        </path>
                                                    </svg></li>
                                                <li><i class="view-html fa fa-code"></i></li>
                                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                                <li><i class="icofont icofont-error close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 col-12">
                                <div class="card border border-danger">
                                    <div class="card-header ">
                                        <h4>80.000đ</h4>
                                        <p class="f-m-light mt-1">Tổng nạp</p>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-settings">
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                        <path
                                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                        </path>
                                                    </svg></li>
                                                <li><i class="view-html fa fa-code"></i></li>
                                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                                <li><i class="icofont icofont-error close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 col-12">
                                <div class="card border border-blue">
                                    <div class="card-header ">
                                        <h4>30.000đ</h4>
                                        <p class="f-m-light mt-1">Đã tiêu</p>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-settings">
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                        <path
                                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                        </path>
                                                    </svg></li>
                                                <li><i class="view-html fa fa-code"></i></li>
                                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                                <li><i class="icofont icofont-error close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>

        </form>
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="my-1">Các file gần đây</h4>
                    <span>File của tôi </span>
                    <div class="mt-2 d-flex flex-wrap">
                        <div class="btn-group m-1">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="true">Loại</button>
                            <ul class="dropdown-menu dropdown-block text-start">
                                <li class="my-1">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fa fa-youtube-play font-danger me-2 f-28"></i> Youtube
                                    </a>
                                </li>
                                <li class="my-1">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fa fa-th font-info me-2 f-28"></i> Khối
                                    </a>
                                </li>
                                <li class="my-1">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fa fa-file-text-o font-secondary me-2 f-28"></i> Tài liệu
                                    </a>
                                </li>
                                <li class="my-1">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fa fa-music font-warning me-2 f-28"></i> Âm nhạc
                                    </a>
                                </li>
                                <li class="my-1">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fa fa-download font-primary me-2 f-28"></i> Tải xuống
                                    </a>
                                </li>
                                <li class="my-1">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fa fa-folder font-info me-2 f-28"></i> Thư mục
                                    </a>
                                </li>
                                <li class="my-1">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fa fa-file-archive-o font-secondary me-2 f-28"></i> Lưu trữ
                                    </a>
                                </li>
                                <li class="my-1">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fa fa-trash font-danger me-2 f-28"></i> Xóa
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="btn-group m-1">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Người </button>
                            <div class="dropdown-menu p-4 text-muted form-wrapper">
                                <p>Some example text that's free-flowing within the dropdown menu.</p>
                                <p class="mb-0">And this is more example text. </p>
                            </div>
                        </div>
                        <div class="btn-group m-1">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Lần sửa đổi gần đây
                                nhất</button>
                            <div class="dropdown-menu p-4 text-muted form-wrapper">
                                <p>Some example text that's free-flowing within the dropdown menu.</p>
                                <p class="mb-0">And this is more example text. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Chủ sở hữu</th>
                                        <th scope="col">Sửa đổi lần cuối</th>
                                        <th scope="col">Kích cỡ tệp</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Mark Jecno
                                            <i style="margin-bottom: -7px; width: 12px;" data-feather="users"></i>
                                        </th>
                                        <td>Mark Jecno</td>
                                        <td>22/08/2024</td>
                                        <td>-</td>
                                        <td>
                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Thêm">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="user-plus"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Tải xuống">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="download"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Chỉnh sửa">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="edit"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Yêu thích">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="star"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mark Jecno
                                            <i style="margin-bottom: -7px; width: 12px;" data-feather="user"></i>
                                        </th>
                                        <td>Mark Jecno</td>
                                        <td>22/08/2024</td>
                                        <td>-</td>
                                        <td>
                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Thêm">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="user-plus"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Tải xuống">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="download"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Chỉnh sửa">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="edit"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Yêu thích">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="star"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mark Jecno
                                            <i style="margin-bottom: -7px; width: 12px;" data-feather="users"></i>
                                        </th>
                                        <td>Mark Jecno</td>
                                        <td>22/08/2024</td>
                                        <td>-</td>
                                        <td>
                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Thêm">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="user-plus"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Tải xuống">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="download"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Chỉnh sửa">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="edit"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Yêu thích">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="star"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mark Jecno
                                            <i style="margin-bottom: -7px; width: 12px;" data-feather="users"></i>
                                        </th>
                                        <td>Mark Jecno</td>
                                        <td>22/08/2024</td>
                                        <td>-</td>
                                        <td>
                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Thêm">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="user-plus"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Tải xuống">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="download"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Chỉnh sửa">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="edit"></i>
                                            </button>

                                            <button class="btn btn-light rounded-pill my-1" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Yêu thích">
                                                <i style="margin-bottom: -7px; width: 12px; display: inline-block;"
                                                    data-feather="star"></i>
                                            </button>
                                        </td>
                                    </tr>
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