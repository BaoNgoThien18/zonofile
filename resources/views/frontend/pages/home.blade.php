@extends('frontend.layouts.app')

@section('title')
Trang chủ
@endsection
@section('content')

<!-- Container-fluid starts-->
<div class="container-fluid default-dashboard">
    <div class="row">
        <div class="col-xl-6 box-col-7 proorder-md-1">
            <div class="card">
                <div class="card-body premium-card">
                    <div class="row premium-courses-card">
                        <div class="col-md-5 premium-course">
                            <h1 class="f-w-700">Mua gói premium</h1><span class="f-light f-w-400 f-14">Upload không giới
                                hạn, chia sẻ thỏa
                                ga</span><a class="btn btn-square btn-primary f-w-700" href="{{url('upgrade')}}">Nâng cấp</a>
                        </div>
                        <div class="col-md-7 premium-course-img">
                            <div class="premium-message"><img class="img-fluid"
                                    src="{{ asset('frontend/images/massage.gif')}}" alt="massage"></div>
                            <div class="premium-books"><img class="img-fluid"
                                    src="{{ asset('frontend/images/books.gif')}}" alt="books"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-md-6 proorder-xl-6 box-col-6">
            <div class="card">
                <div class="card-header custom-border-bottom">
                    <div class="header-top">
                        <h4>Thông báo trang web</h4>
                        <div class="dropdown icon-dropdown ">
                            <button class="btn dropdown-toggle" id="" type="button"
                                data-bs-toggle="" aria-expanded="false">
                                <svg>
                                    <use href="{{ asset('frontend/images/icon-sprite.svg#setting')}}"> </use>
                                </svg>
                            </button>
                          
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 py-5 mt-3">
                    <?= isset($settings['notice_home']) && isset($settings['notice_home']->value) ? $settings['notice_home']->value : '' ?>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12 box-col-12 proorder-md-4">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h4>Lịch sử hoạt động</h4><span class="mt-3">
                        <span>Ở đây sẽ hiển thị tất cả những hoạt động của bạn trên trang web</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive custom-scrollbar">
                    <table class="table dataTable" id="basic-6">
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
        </div>



        <div class="col-xxl-6 col-md-6 proorder-xl-6 box-col-6">
            <div class="card">
                <div class="card-header custom-border-bottom">
                    <div class="header-top">
                        <h4>Dung lượng</h4>
                        <div class="dropdown icon-dropdown ">
                            <button class="btn dropdown-toggle" id="" type="button"
                                data-bs-toggle="" aria-expanded="false">
                                <svg>
                                    <use href="{{ asset('frontend/images/icon-sprite.svg#setting')}}"> </use>
                                </svg>
                            </button>
                          
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 py-5 my-5">
                    <div id="salesStatsRadialChart"> </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- Container-fluid Ends-->

<script>
/*=======/Sales Stats Radial Chart/=======*/
const salesStatsOption = {
    series: [{{$userSubscription->used_capacity / $userSubscription->total_capacity * 100}}],
    chart: {
        height: 370,
        type: "radialBar",
        offsetY: 0,
    },

    stroke: {
        dashArray: 25,
        curve: "smooth",
        lineCap: "round",
    },
    grid: {
        padding: {
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
        },
    },
    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            hollow: {
                size: "75%",
                image: "frontend/images/apexchart/radial-image.png",
                imageWidth: 140,
                imageHeight: 140,
                imageClipped: false,
            },
            track: {
                show: true,
                background: "rgba(43, 94, 94, 0.1)",
                strokeWidth: "97%",
                opacity: 0.4,
            },
            dataLabels: {
                show: true,
                name: {
                    show: true,
                    fontSize: "16px",
                    fontFamily: undefined,
                    fontWeight: 600,
                    color: undefined,
                    offsetY: -10,
                },
                value: {
                    show: true,
                    // ...fontCommon,
                    colors: "#848789",
                    fontFamily: '"Nunito Sans", sans-serif',
                    fontWeight: 600,
                    fontSize: "20px",
                    color: "#292929",
                    offsetY: 6,
                    formatter: function (val) {
                        return val + "%";
                    },
                },
            },
        },
    },
    labels: ["{{$userSubscription->used_capacity_ui}} đã dùng", "Tổng: {{$userSubscription->total_capacity_ui}}"],
    colors: ["var(--theme-default)", "rgba(43, 94, 94, 0.1)"],
    legend: {
        show: true,
        position: "bottom",
        // ...fontCommon,
        colors: "#848789",
        fontSize: "14px",
        fontFamily: '"Nunito Sans", sans-serif',
        fontWeight: 600,
        markers: {
            width: 18,
            height: 18,
            strokeWidth: 5,
            colors: "#fff",
            strokeColors: "rgba(43, 95, 96 ,0.03)",
            radius: 20,
        },
        onItemClick: {
            toggleDataSeries: false,
        },
        onItemHover: {
            highlightDataSeries: false,
        },
    },
    responsive: [
        {
            breakpoint: 1600,
            options: {
                chart: {
                    height: 600,
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: "70%",
                            imageWidth: 110,
                            imageHeight: 110,
                        },
                        dataLabels: {
                            name: {
                                fontSize: "14px",
                                offsetY: -8,
                            },
                            value: {
                                fontSize: "18px",
                            },
                        },
                    },
                },
            },
        },
        {
            breakpoint: 676,
            options: {
                chart: {
                    height: 350,
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: "68%",
                        },
                    },
                },
            },
        },
        {
            breakpoint: 576,
            options: {
                chart: {
                    height: 320,
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: "70%",
                            imageWidth: 120,
                            imageHeight: 120,
                        },
                    },
                },
            },
        },
        {
            breakpoint: 531,
            options: {
                chart: {
                    height: 300,
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: "70%",
                            imageWidth: 100,
                            imageHeight: 100,
                        },
                    },
                },
            },
        },
        {
            breakpoint: 426,
            options: {
                chart: {
                    height: 280,
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: "70%",
                            imageWidth: 100,
                            imageHeight: 100,
                        },
                    },
                },
            },
        },
    ],
};

const salesStatsChartEl = new ApexCharts(
    document.querySelector("#salesStatsRadialChart"),
    salesStatsOption
);
salesStatsChartEl.render();
</script>

@endsection