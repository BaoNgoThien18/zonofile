@extends('backend.layouts.app')

@section('title')
Cài đặt hệ thống
@endsection

@php

use App\Models\Setting;

@endphp

@section('content')
<div class="container-fluid">
    <div class="row">
        <section class="col-lg-12">
            <div class="card card-dark card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#custom-tabs-three-home" role="tab"
                                aria-controls="custom-tabs-three-home" aria-selected="true">THÔNG TIN CHUNG</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                            aria-labelledby="custom-tabs-three-home-tab">
                            <form action="{{ route('settings.updateAllSetting') }}" method="POST">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ Setting::findByName('title') ?? '' }}"
                                                placeholder="VD: 6Share">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description"
                                                value="{{ Setting::findByName('description') ?? '' }}"
                                                placeholder="VD: Hệ thống chia sẻ tài liệu">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="keywords">Keywords</label>
                                            <input type="text" class="form-control" name="keywords"
                                                value="{{ Setting::findByName('keywords') ?? '' }}"
                                                placeholder="VD: zono, 6share, files,...">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="author">Author</label>
                                            <input type="text" class="form-control" name="author"
                                                value="{{ Setting::findByName('author') ?? '' }}"
                                                placeholder="VD: 6 Share">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="session_login">Thời gian lưu phiên đăng nhập</label>
                                            <input type="number" class="form-control" name="session_login"
                                                value="{{ Setting::findByName('session_login') ?? '' }}"
                                                placeholder="Nhập thời gian lưu phiên đăng nhập">
                                            <i>Tính bằng giây (VD: 10000000 = 4 tháng)</i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="javascript_header">Script Header</label>
                                            <textarea class="form-control codeMirror" name="javascript_header"
                                                placeholder="Chứa code live chat hoặc jquery trang trí...">{{ Setting::findByName('javascript_header') ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="javascript_footer">Script Footer</label>
                                            <textarea class="form-control codeMirror" name="javascript_footer"
                                                placeholder="Chứa code live chat hoặc jquery trang trí...">{{ Setting::findByName('javascript_footer') ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="notice_home">Thông báo ngoài trang chủ</label>
                                            <textarea class="form-control summernote" id="notice_home"
                                                name="notice_home">{{ Setting::findByName('notice_home') ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-icon-left m-b-10">
                                    <i class="fas fa-save mr-1"></i>Lưu Ngay
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab-notification" role="tabpanel"
                            aria-labelledby="tab-notification">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>Loại thông báo</label>
                                    <select class="form-control select2bs4" name="type_notification">
                                        <option selected value="telegram">Telegram
                                        </option>
                                        <option value="gmail">Gmail
                                        </option>
                                    </select>
                                    <i>Hệ thống sẽ gửi thông báo khi có đơn hàng mới.</i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Token Telegram (<a target="_blank"
                                            href="https://cmsnt.vn/2022/05/huong-dan-cau-hinh-bot-thong-bao-qua-telegram/">Xem
                                            hướng dẫn</a>)</label>
                                    <input type="text" class="form-control" name="token_telegram" value=""
                                        placeholder="5323330732:AAFpurxAdW9vGGPE_cZ2gU_kDP-__kAsOVc">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chat ID Telegram (<a target="_blank"
                                            href="https://cmsnt.vn/2022/05/huong-dan-cau-hinh-bot-thong-bao-qua-telegram/">Xem
                                            hướng dẫn</a>)</label>
                                    <input type="text" class="form-control" name="chat_id_telegram" value=""
                                        placeholder="-788267800">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung thông báo</label>
                                    <textarea name="text_notification"
                                        class="form-control">[{domain}] Có đơn hàng
                                        {service_name} - {service_pack_name} số lượng {amount} đang chờ xử lý</textarea>
                                    <ul>
                                        <li><b>{domain}</b> => Tên website của quý khách.</li>
                                        <li><b>{username}</b> => Tên đăng nhập của khách.</li>
                                        <li><b>{service_name}</b> => Tên dịch vụ khách hàng mua.</li>
                                        <li><b>{service_pack_name}</b> => Tên gói dịch vụ khách hàng mua.</li>
                                        <li><b>{amount}</b> => Số lượng khách hàng mua.</li>
                                        <li><b>{price}</b> => Số tiền khách hàng thanh toán.</li>
                                        <li><b>{url}</b> => Link/ID cần tăng.</li>
                                        <li><b>{note}</b> => Ghi chú của khách hàng.</li>
                                    </ul>
                                </div>
                                <button name="SaveSettings" class="btn btn-info btn-icon-left btn-block m-b-10"
                                    type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab-auto-bank" role="tabpanel"
                            aria-labelledby="tab-auto-bank-tab">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2bs4" name="status_bank">
                                        <option value="0">OFF
                                        </option>
                                        <option selected value="1">ON
                                        </option>
                                    </select>
                                    <i>Chọn OFF hệ thống sẽ tạm dừng auto bank.</i>
                                </div>
                                <div class="form-group">
                                    <label>Ngân hàng</label>
                                    <select class="form-control select2bs4" name="type_bank">
                                        <option value="Vietcombank">Vietcombank </option>
                                        <option value="ACB">ACB </option>
                                        <option selected value="MBBank">MBBank </option>
                                        <option value="VPBank">VPBank </option>
                                        <option value="Techcombank">Techcombank </option>
                                        <option value="TPBank">TPBank </option>
                                        <option value="VPBank">VPBank </option>
                                        <option value="Vietinbank">Vietinbank </option>
                                        <option value="Sacombank">Sacombank </option>
                                        <option value="THESIEURE">THESIEURE </option>
                                        <option value="MOMO">MOMO </option>
                                        <option value="Viettelpay">Viettelpay </option>
                                        <option value="Zalo Pay">Zalo Pay </option>
                                        <option value="Cake">Cake </option>
                                        <option value="Shopee Pay">Shopee Pay </option>
                                        <option value="MSB">MSB </option>
                                        <option value="NamABank">NamABank </option>
                                        <option value="LienVietPostBank">LienVietPostBank </option>
                                        <option value="VietCapitalBank">VietCapitalBank </option>
                                        <option value="BIDV">BIDV </option>
                                        <option value="VIB">VIB </option>
                                        <option value="HDBank">HDBank </option>
                                        <option value="SeABank">SeABank </option>
                                        <option value="GPBank">GPBank </option>
                                        <option value="PVcomBank">PVcomBank </option>
                                        <option value="NCB">NCB </option>
                                        <option value="ShinhanBank">ShinhanBank </option>
                                        <option value="SCB">SCB </option>
                                        <option value="PGBank">PGBank </option>
                                        <option value="Agribank">Agribank </option>
                                        <option value="SaigonBank">SaigonBank </option>
                                        <option value="DongABank">DongABank </option>
                                        <option value="BacABank">BacABank </option>
                                        <option value="StandardChartered">StandardChartered </option>
                                        <option value="Oceanbank">Oceanbank </option>
                                        <option value="VRB">VRB </option>
                                        <option value="ABBANK">ABBANK </option>
                                        <option value="VietABank">VietABank </option>
                                        <option value="Eximbank">Eximbank </option>
                                        <option value="VietBank">VietBank </option>
                                        <option value="IndovinaBank">IndovinaBank </option>
                                        <option value="BaoVietBank">BaoVietBank </option>
                                        <option value="PublicBank">PublicBank </option>
                                        <option value="SHB">SHB </option>
                                        <option value="CBBank">CBBank </option>
                                        <option value="OCB">OCB </option>
                                        <option value="KienLongBank">KienLongBank </option>
                                        <option value="CIMB">CIMB </option>
                                        <option value="HSBC">HSBC </option>
                                        <option value="DBSBank">DBSBank </option>
                                        <option value="Nonghyup">Nonghyup </option>
                                        <option value="HongLeong">HongLeong </option>
                                        <option value="IBK Bank">IBK Bank </option>
                                        <option value="Woori">Woori </option>
                                        <option value="UnitedOverseas">UnitedOverseas </option>
                                        <option value="KookminHN">KookminHN </option>
                                        <option value="KookminHCM">KookminHCM </option>
                                        <option value="COOPBANK">COOPBANK </option>
                                        <option value="EasyPaisa">EasyPaisa </option>
                                        <option value="JazzCash">JazzCash </option>
                                    </select>
                                    <i>Chọn ngân hàng bạn cần sử dụng auto.</i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Token Bank (<a type="button" data-toggle="modal"
                                            data-target="#modal-hd-auto-bank" href="#">Xem
                                            hướng dẫn</a>)</label>
                                    <input type="text" class="form-control" name="token_bank" value=""
                                        placeholder="Nhập token ngân hàng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tài khoản (<a type="button" data-toggle="modal"
                                            data-target="#modal-hd-auto-bank" href="#">Xem
                                            hướng dẫn</a>)</label>
                                    <input type="text" class="form-control" name="stk_bank" value=""
                                        placeholder="Nhập số tài khoản ngân hàng cần Auto">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu Internet Banking (<a type="button"
                                            data-toggle="modal" data-target="#modal-hd-auto-bank" href="#">Xem
                                            hướng dẫn</a>)</label>
                                    <input type="text" class="form-control" name="mk_bank" value=""
                                        placeholder="Nhập mật khẩu internet banking">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung nạp</label>
                                    <input type="text" class="form-control" name="prefix_autobank" value="NAP"
                                        placeholder="Tiền tố nội dung nạp tiền">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú nạp tiền</label>
                                    <textarea id="recharge_notice" name="recharge_notice">
                                        <ul>
                                            <li>Nhập đ&uacute;ng nội dung chuyển tiền.</li>
                                            <li>Cộng tiền trong v&agrave;i gi&acirc;y.</li>
                                            <li>Li&ecirc;n hệ BQT nếu nhập sai nội dung chuyển.</li>
                                        </ul>
                                    </textarea>
                                </div>
                                <button name="SaveSettings" class="btn btn-info btn-icon-left btn-block m-b-10"
                                    type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab-auto-momo" role="tabpanel" aria-labelledby="tab-auto-momo">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2bs4" name="status_momo">
                                        <option value="0">OFF
                                        </option>
                                        <option selected value="1">ON
                                        </option>
                                    </select>
                                    <i>Chọn OFF hệ thống sẽ tạm dừng auto momo.</i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Token MOMO (<a type="button" data-toggle="modal"
                                            data-target="#modal-hd-auto-momo" href="#">Xem
                                            hướng dẫn</a>)</label>
                                    <input type="text" class="form-control" name="token_momo" value=""
                                        placeholder="Nhập token ví momo">
                                </div>
                                <button name="SaveSettings" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                        class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab-nap-the" role="tabpanel" aria-labelledby="tab-nap-the">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2bs4" name="status_napthe">
                                        <option value="0">OFF
                                        </option>
                                        <option selected value="1">ON
                                        </option>
                                    </select>
                                    <i>Chọn OFF hệ thống sẽ tạm dừng nạp thẻ.</i>
                                </div>
                                <div class="form-group">
                                    <label>Partner ID (<a type="button" data-toggle="modal"
                                            data-target="#modal-hd-nap-the" href="#">Xem hướng dẫn</a>)</label>
                                    <input type="text" name="partner_id_card" value="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Partner Key (<a type="button" data-toggle="modal"
                                            data-target="#modal-hd-nap-the" href="#">Xem hướng dẫn</a>)</label>
                                    <input type="text" name="partner_key_card" value="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí Nạp Thẻ</label>
                                    <input type="text" class="form-control" name="ck_napthe" value="30"
                                        placeholder="Nhập phí nạp thẻ nếu có nạp thẻ">
                                    <i>Để 30 tức khách nạp 100.000đ sẽ được
                                        70.000đ</i><br>
                                    <i>Để phí = 0 nếu quý khách muốn cộng cho user giống thực nhận tại hệ thống
                                        card24h.com</i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú nạp thẻ</label>
                                    <textarea id="notice_napthe" name="notice_napthe">
                                        <ul>
                                            <li>Vui l&ograve;ng nhập đầy đủ th&ocirc;ng tin <strong>Serial</strong> -
                                                <strong>Pin</strong> - <strong>Mệnh Gi&aacute;</strong> của thẻ.
                                            </li>
                                            <li>Thẻ được xử l&yacute; tự động trong v&agrave;i gi&acirc;y.</li>
                                            <li>Nạp sai mệnh gi&aacute; mất <strong>50%</strong> gi&aacute; trị thực của
                                                thẻ.</li>
                                        </ul>
                                    </textarea>
                                </div>
                                <button name="SaveSettings" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                        class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab-paypal" role="tabpanel" aria-labelledby="tab-paypal">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2bs4" name="status_paypal">
                                        <option selected value="0">OFF
                                        </option>
                                        <option value="1">ON
                                        </option>
                                    </select>
                                    <i>Chọn OFF hệ thống sẽ tạm dừng nạp paypal.</i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Client ID</label>
                                    <input type="text" class="form-control" name="clientId_paypal" value=""
                                        placeholder="Nhập Client ID Paypal">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Client Secret</label>
                                    <input type="text" class="form-control" name="clientSecret_paypal" value=""
                                        placeholder="Nhập Client Secret Paypal">
                                    <i>Cách lấy Secret và ID Paypal tại đây: <a href="https://youtu.be/6r17Wj3UlNE?t=13"
                                            target="_blank">Xem
                                            Ngay</a></i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rate Paypal</label>
                                    <input type="number" class="form-control" name="rate_paypal" value="23000"
                                        placeholder="Nhập Rate quy đổi sang VND">
                                    <i>Để 23000 tức khách nạp 1 USD sẽ được
                                        23.000đ</i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú nạp paypal</label>
                                    <textarea id="paypal_notice" name="paypal_notice"></textarea>
                                </div>
                                <button name="SaveSettings" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                        class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection