@extends('admin.layouts.dashboard')

@section('header')
@endsection

@section('content')
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <h1 class="page-title"></h1>
            <div class="row">
                <div class="col-4">
                    <div class="slide-right" id="slide-right"></div>
                </div>
            </div>
            <!--/APP-SIDEBAR-->
        </div>

        <!--app-content open-->
        <div class="page-header">
            <h1 class="page-title">Widgets</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                </ol>
            </div>
        </div>
        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <!-- PAGE-HEADER END -->

            <!-- ROW OPEN -->
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <small class="text-muted">New users</small>
                                <h2 class="mb-2 mt-0">2,897</h2>
                                <div id="circle" class="mt-3 mb-3 chart-dropshadow-secondary"></div>
                                <div class="chart-circle-value-3 text-secondary fs-20"><i class="icon icon-user-follow"></i>
                                </div>
                                <p class="mb-0 text-start"><span class="dot-label bg-secondary me-2"></span>Monthly
                                    users <span class="float-end">60%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="widget text-center">
                                <small class="text-muted">Total Tax</small>
                                <h2 class="mb-2 mt-0">$7,543</h2>
                                <div id="circle-1" class="mt-3 mb-3 chart-dropshadow-success"></div>
                                <div class="chart-circle-value-3 text-success fs-20"><i class="icon icon-briefcase"></i>
                                </div>
                                <p class="mb-0 text-start"><span class="dot-label bg-success me-2"></span>Monthly
                                    Income <span class="float-end">$5,863</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="widget text-center">
                                <small class="text-muted">Total Profit</small>
                                <h2 class="mb-2 mt-0">$4,468</h2>
                                <div id="circle-2" class="mt-3 mb-3 chart-dropshadow-warning"></div>
                                <div class="chart-circle-value-3 text-warning fs-20"><i class="icon icon-chart"></i>
                                </div>
                                <p class="mb-0 text-start"><span class="dot-label bg-warning me-2"></span>Monthly
                                    Profit <span class="float-end">$9,234</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="widget text-center">
                                <small class="text-muted">Total Sales</small>
                                <h2 class="mb-2 mt-0">$6,974</h2>
                                <div id="circle-3" class="mt-3 mb-3 chart-dropshadow-danger"></div>
                                <div class="chart-circle-value-3 text-danger fs-20"><i class="icon icon-basket"></i>
                                </div>
                                <p class="mb-0 text-start"><span class="dot-label bg-danger me-2"></span>Monthly
                                    Sales <span class="float-end">$8,097</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW CLOSED -->

            <!-- ROW OPEN -->
            <div class="row row-cards">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-header pb-0 border-bottom-0">
                            <h3 class="card-title">Total Revenue</h3>
                            <div class="card-options">
                                <a class="btn btn-sm btn-primary" href="javascript:void(0)"><i
                                        class="fa fa-bar-chart mb-0"></i></a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <h3 class="d-inline-block mb-2">46,789</h3>
                            <div class="progress h-2 mt-2 mb-2">
                                <div class="progress-bar bg-primary" style="width: 50%;" role="progressbar"></div>
                            </div>
                            <div class="float-start">
                                <div class="mt-2">
                                    <i class="fa fa-caret-up text-success"></i>
                                    <span>12% increase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-header pb-0 border-bottom-0">
                            <h3 class="card-title">Total Requests</h3>
                            <div class="card-options">
                                <a class="btn btn-sm btn-success" href="javascript:void(0)"><i
                                        class="fa fa-send-o mb-0"></i></a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <h3 class="d-inline-block mb-2">23,536</h3>
                            <div class="progress h-2 mt-2 mb-2">
                                <div class="progress-bar bg-success" style="width: 50%;" role="progressbar">
                                </div>
                            </div>
                            <div class="float-start">
                                <div class="mt-2">
                                    <i class="fa fa-caret-down text-success"></i>
                                    <span>5% decrease</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-header pb-0 border-bottom-0">
                            <h3 class="card-title">Requests Answered</h3>
                            <div class="card-options">
                                <a class="btn btn-sm btn-warning" href="javascript:void(0)"><i
                                        class="fa fa-mail-reply mb-0"></i></a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <h3 class="d-inline-block mb-2">32,784</h3>
                            <div class="progress h-2 mt-2 mb-2">
                                <div class="progress-bar bg-warning" style="width: 50%;" role="progressbar">
                                </div>
                            </div>
                            <div class="float-start">
                                <div class="mt-2">
                                    <i class="fa fa-caret-up text-warning"></i>
                                    <span>10% increase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-header pb-0 border-bottom-0">
                            <h3 class="card-title">Support Cost</h3>
                            <div class="card-options">
                                <a class="btn btn-sm btn-danger" href="javascript:void(0)"><i
                                        class="fa fa-money mb-0"></i></a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <h3 class="d-inline-block mb-2">14,563</h3>
                            <div class="progress h-2 mt-2 mb-2">
                                <div class="progress-bar bg-danger" style="width: 50%;" role="progressbar"></div>
                            </div>
                            <div class="float-start">
                                <div class="mt-2">
                                    <i class="fa fa-caret-down text-danger"></i>
                                    <span>15% decrease</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW CLOSED -->

            <!-- ROW OPEN -->
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-primary img-card box-primary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">7,865</h2>
                                    <p class="text-white mb-0">Total Followers </p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-secondary img-card box-secondary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">86,964</h2>
                                    <p class="text-white mb-0">Total Likes</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-heart-o text-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card  bg-success img-card box-success-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">98</h2>
                                    <p class="text-white mb-0">Total Comments</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-info img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">893</h2>
                                    <p class="text-white mb-0">Total Posts</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW CLOSED -->

            <!-- ROW OPEN -->
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-order">
                                <!-- <h6 class="mb-2">Orders</h6> -->
                                <h2 class="text-end"><i
                                        class="fa fa-cart-plus icon-size float-start text-danger text-danger-shadow border-danger brround p-3"></i><span>$7,543</span>
                                </h2>
                                <p class="mb-0 pt-5">This Week Orders<span class="float-end">60%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-widget">
                                <!-- <h6 class="mb-2">Total Tax</h6> -->
                                <h2 class="text-end"><i
                                        class="mdi mdi-eye icon-size float-start text-warning text-warning-shadow border-solid border-warning brround p-3"></i><span>5,578</span>
                                </h2>
                                <p class="mb-0 pt-5">This Week Views<span class="float-end">35%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-widget">
                                <!-- <h6 class="mb-2">Total Profit</h6> -->
                                <h2 class="text-end"><i
                                        class="icon-size mdi mdi-currency-usd float-start text-primary text-primary-shadow border-solid border-primary brround p-3"></i><span>$2,987</span>
                                </h2>
                                <p class="mb-0 pt-5">This Week Earnings<span class="float-end">74%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-widget">
                                <!-- <h6 class="mb-2">Total Sales</h6> -->
                                <h2 class="text-end"><i
                                        class="mdi mdi-comment-account-outline icon-size float-start text-success text-success-shadow border-solid border-success brround p-3"></i><span>9743</span>
                                </h2>
                                <p class="mb-0 pt-5">This Week Comments<span class="float-end">789</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW END -->
        </div>
    </div>
   
@endsection
<!--app-content closed-->
@section('scripts')
@endsection
