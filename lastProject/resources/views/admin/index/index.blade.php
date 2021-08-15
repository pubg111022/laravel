@extends('admin.master.master')
@section('main')
    <!-- top tiles -->
    <div class="row" style="display: inline-block;">
        <div class="tile_count col-md-12">
            <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Order</span>
                <div class="count green">{{ $count }}</div>
                <span class="count_bottom"><i class="green"></i> From
                    {{ session()->has('time1') ? session()->get('time1') : 'This Month' }}</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Order In {{ $year }}</span>
                <div class="count green">{{ $count2 }}</div>
                <span class="count_bottom"><i class="green"><i></i></i> From
                    {{ $year }}</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i> Total In
                    {{ session()->has('time1') ? session()->get('time1') : 'This Month' }}</span>
                <div class="count green">$ {{ $total }}</div>
                <span class="count_bottom"><i class="green"><i></i></i>From
                    {{ session()->has('time1') ? session()->get('time1') : 'This Month' }}</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"> Total In {{ $year }}</span>
                <div class="count green">$ {{ $totalInYear }}</div>
                <span class="count_bottom"><i class="green"><i></i></i> From
                    {{ $year }}</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top text-warning">Order No Process</span>
                <div class="count green">{{ $no_process_count }}</div>
                <span class="count_bottom"><i class="green"><i class=""></i></i>From
                    {{ session()->has('time1') ? session()->get('time1') : 'This Month' }}</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top text-primary">Order Delivering</span>
                <div class="count green">{{ $delivering_count }}</div>
                <span class="count_bottom"><i class="green"><i class=""></i></i> From
                    {{ $year }}</span>
            </div>
        </div>
    </div>
    <!-- /top tiles -->
    <?php
    
    $list = '';
    $count = '';
    $list_product = '';
    $count_product = '';
    $list_total = '';
    foreach ($category as $key => $value) {
        $list .= $value->name . '-';
        $count .= $cate->count_category($value->id) . '-';
    }
    foreach ($order_de as $key => $value) {
        $list_product .= $value->name . '-';
        $count_product .= $value->quantity . '-';
    }
    for ($i = 1; $i <= 12; $i++) {
        $list_total .= $order_detail->getTotalInMonth($i) . '-';
    }
    ?>
    <input type="hidden" name="list" value="{{ $list }}" id="list_category">
    <input type="hidden" name="list" value="{{ $count }}" id="count">
    <input type="hidden" name="list" value="{{ $list_product }}" id="list_product">
    <input type="hidden" name="list" value="{{ $count_product }}" id="count_product">
    <input type="hidden" name="list" value="{{ $list_total }}" id="list_total">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="dashboard_graph">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>Product In Month</h3>
                    </div>
                    <div class="col-md-6">
                        <div id="" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px;">
                            <form action="{{ route('getData') }}" method="POST">
                                @csrf
                                <span style="display: flex">
                                    <input type="date" class="form-control"
                                        value="{{ session()->has('time1') ? session()->get('time1') : '2002-10-11' }}"
                                        name="time1" id="">
                                    <strong style="color: black;line-height: 22px;margin: 10px">To</strong>
                                    <input type="date" class="form-control"
                                        value="{{ session()->has('time2') ? session()->get('time2') : '2021-08-07' }}"
                                        name="time2" id="">
                                    <button type="submit" style="margin-left: 20px" class="btn btn-primary">Check</button>
                                </span> <b class="caret"></b>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="demo-placeholder">
                        <canvas id="myChart" width="400" height="70"></canvas>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-4 col-sm-4 ">
            <div class="x_panel tile fixed_height_320" style="height: 550px">
                <div class="x_title">
                    <h2>Category List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li style="opacity: 0" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        </li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <canvas id="myChart2" width="320" height="80"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-8 ">
            <div class="x_panel tile fixed_height_320 overflow_hidden" style="height: 550px">
                <div class="x_title">
                    <h2>Total Money In {{ $year }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <canvas id="myChart3" width="320" height="145"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="row">
                <!-- Start to do list -->

                <!-- End to do list -->

                <!-- start of weather widget -->
                <div class="col-md-8 col-sm-8 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Daily active users <small>Sessions</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="dropdown" style="opacity: 0;">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row weather-days">
                                <div class="col-sm-2">
                                    <div class="daily-weather">
                                        <!-- weather widget start --><a target="_blank"
                                            href="https://hotelmix.vn/weather/hanoi-19487"><img
                                                src="https://w.bookcdn.com/weather/picture/32_19487_1_33_95a5a6_250_7f8c8d_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=2&domid=1180&anc_id=48148"
                                                alt="booked.net" /></a><!-- weather widget end -->
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="daily-weather">
                                        <!-- weather widget start --><a target="_blank"
                                            href="https://hotelmix.vn/weather/hai-phong-33811"><img
                                                src="https://w.bookcdn.com/weather/picture/32_33811_1_33_95a5a6_250_7f8c8d_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=2&domid=1180&anc_id=84203"
                                                alt="booked.net" /></a><!-- weather widget end -->
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="daily-weather">
                                        <!-- weather widget start --><a target="_blank"
                                            href="https://hotelmix.vn/weather/ho-chi-minh-city-18408"><img
                                                src="https://w.bookcdn.com/weather/picture/32_18408_1_33_95a5a6_250_7f8c8d_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=2&domid=1180&anc_id=84203"
                                                alt="booked.net" /></a><!-- weather widget end -->
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="daily-weather">
                                        <!-- weather widget start --><a target="_blank"
                                            href="https://hotelmix.vn/weather/can-tho-33807"><img
                                                src="https://w.bookcdn.com/weather/picture/32_33807_1_33_95a5a6_250_7f8c8d_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=2&domid=1180&anc_id=48627"
                                                alt="booked.net" /></a><!-- weather widget end -->
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="daily-weather">
                                        <!-- weather widget start --><a target="_blank"
                                            href="https://hotelmix.vn/weather/can-tho-33807"><img
                                                src="https://w.bookcdn.com/weather/picture/32_33807_1_33_95a5a6_250_7f8c8d_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=2&domid=1180&anc_id=48627"
                                                alt="booked.net" /></a><!-- weather widget end -->
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="daily-weather">
                                        <!-- weather widget start --><a target="_blank"
                                            href="https://hotelmix.vn/weather/can-tho-33807"><img
                                                src="https://w.bookcdn.com/weather/picture/32_33807_1_33_95a5a6_250_7f8c8d_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=2&domid=1180&anc_id=48627"
                                                alt="booked.net" /></a><!-- weather widget end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end of weather widget -->
            </div>
        </div>
    </div>

@stop
