@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="app-admin-wrap layout-sidebar-large">
    <!-- =============== Left side End ================-->
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <!-- ============ Body content start ============= -->
        <div class="main-content">
            <div class="breadcrumb">
                <h1 class="mr-2">Dashboard</h1>
                <ul>
                    <li><a href="#">Super Admin</a></li>

                </ul>
            </div>
            <div class="separator-breadcrumb border-top"></div>

            <select class="form-control col-3" id="client">
                <option value="0">Select all Client</option>
                @foreach($client as $value)
                <option value="{{$value['id']}}">{{$value['name']}}</option>
                @endforeach
            </select>
            <br />
            <div class="row">
                <!-- ICON BG-->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center"><i class="i-Add-User"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0" id="total-count">Customers</p>
                                <p class="text-primary text-24 line-height-1 mb-2" id="totalCustomer">{{ $totalClientAdminCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center"><i class="i-Gift-Box"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Gift Sent</p>
                                <p class="text-primary text-24 line-height-1 mb-2" id="totalClientGiftSentCount">{{ $totalGiftSentCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Campaigns</p>
                                <p class="text-primary text-24 line-height-1 mb-2" id="totalCampCount">{{ @$campaignsCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Campaign</div>
                            <div id="echartBar" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-sm-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title">Sales by Countries</div>
                                <div id="echartPie" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div> --}}
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card card-chart-bottom o-hidden mb-4">
                                <div class="card-body">
                                    <div class="text-muted">Gift sent worth (last month)</div>
                                    <p class="mb-4 text-primary text-24">₹{{ $maximumBudget }}</p>
                                </div>
                                <div id="echart1" style="height: 260px;"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card card-chart-bottom o-hidden mb-4">
                                <div class="card-body">
                                    <div class="text-muted">Gift sent worth (last week)</div>
                                    <p class="mb-4 text-warning text-24">₹{{ $reedemedBudget }}</p>
                                </div>
                                <div id="echart2" style="height: 260px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card o-hidden mb-4" id="card_overFlow">
                                {{-- <div class="card-header d-flex align-items-center border-0">
                                        <h3 class="w-50 float-left card-title m-0">New Users</h3>
                                        <div class="dropdown dropleft text-right w-50 float-right">
                                            <button class="btn bg-gray-100" id="dropdownMenuButton1" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="nav-icon i-Gear-2"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1"><a
                                                    class="dropdown-item" href="#">Add new user</a><a
                                                    class="dropdown-item" href="#">View All users</a><a
                                                    class="dropdown-item" href="#">Something else here</a></div>
                                        </div>
                                    </div> --}}
                                <div>
                                    <div class="table-responsive">
                                        <table class="table text-center" id="user_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Status</th>
                                                    {{-- <th scope="col">Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recentUsers as $item)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $item['firstname'] . '' . $item['last_name'] }}</td>
                                                    {{-- <td><img class="rounded-circle m-0 avatar-sm-table"
                                                                    src="{{ url('assets/dist-assets/images/faces/1.jpg') }}"
                                                    alt="" /></td> --}}
                                                    <td>{{ $item['email'] }}</td>
                                                    <td><span @if ($item['is_active']==true) class="badge badge-success" @else class="badge badge-danger" @endif>
                                                            @if ($item['is_active'] == true)
                                                            Active
                                                            @else
                                                            Deactive
                                                            @endif
                                                        </span></td>
                                                    {{-- <td><a class="text-success mr-2" href="#"><i
                                                                        class="nav-icon i-Pen-2 font-weight-bold"></i></a><a
                                                                    class="text-danger mr-2" href="#"><i
                                                                        class="nav-icon i-Close-Window font-weight-bold"></i></a>
                                                            </td> --}}
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

                <div class="col-lg-6 col-md-12">
                    <div class="card mb-4" id="card_overFlow">
                        <div class="card-body">
                            <div class="card-title">Most Gifted Product</div>
                            @foreach ($topSellingProduct as $item)
                            <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-3">
                                <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" @php $imageUrl='/assets/images/no-image.jpg' ; if (!empty($item->productDefaultImage->image)) {
                                $imageUrl = getImage($item->productDefaultImage->image, 'product');
                                }
                                @endphp
                                src="{{ url($imageUrl) }}" alt="">
                                <div class="flex-grow-1">
                                    <h5><a href="#"></a>{{ $item['name'] }}</h5>
                                    <p class="m-0 text-small text-muted">
                                        @if (strlen($item['description']) > 40)
                                        {{ substr($item['description'], 0, 40) . '...' }}
                                        @else
                                        {{ $item['description'] }}
                                        @endif
                                    </p>
                                    <p class="text-small text-danger m-0">₹{{ $item['price'] }}
                                        {{-- <del class="text-muted">$500</del> --}}
                                    </p>
                                </div>
                                <div>
                                    {{-- <a class="btn btn-outline-primary mt-3 mb-3 m-sm-0 btn-rounded btn-sm">
                                        {{ url("/edit-product", $item->id) }}
                                    View
                                    details
                                    </a> --}}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="card mb-4">
                            <div class="card-body p-0">
                                <div class="card-title border-bottom d-flex align-items-center m-0 p-3"><span>User
                                        activity</span><span class="flex-grow-1"></span><span
                                        class="badge badge-pill badge-warning">Updated daily</span></div>
                                <div class="d-flex border-bottom justify-content-between p-3">
                                    <div class="flex-grow-1"><span class="text-small text-muted">Pages / Visit</span>
                                        <h5 class="m-0">2065</h5>
                                    </div>
                                    <div class="flex-grow-1"><span class="text-small text-muted">New user</span>
                                        <h5 class="m-0">465</h5>
                                    </div>
                                    <div class="flex-grow-1"><span class="text-small text-muted">Last week</span>
                                        <h5 class="m-0">23456</h5>
                                    </div>
                                </div>
                                <div class="d-flex border-bottom justify-content-between p-3">
                                    <div class="flex-grow-1"><span class="text-small text-muted">Pages / Visit</span>
                                        <h5 class="m-0">1829</h5>
                                    </div>
                                    <div class="flex-grow-1"><span class="text-small text-muted">New user</span>
                                        <h5 class="m-0">735</h5>
                                    </div>
                                    <div class="flex-grow-1"><span class="text-small text-muted">Last week</span>
                                        <h5 class="m-0">92565</h5>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between p-3">
                                    <div class="flex-grow-1"><span class="text-small text-muted">Pages / Visit</span>
                                        <h5 class="m-0">3165</h5>
                                    </div>
                                    <div class="flex-grow-1"><span class="text-small text-muted">New user</span>
                                        <h5 class="m-0">165</h5>
                                    </div>
                                    <div class="flex-grow-1"><span class="text-small text-muted">Last week</span>
                                        <h5 class="m-0">32165</h5>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                </div>
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <h5 class="card-title m-0 p-3">Last 20 Day Leads</h5>
                            <div id="echart3" style="height: 360px;" value={{ $recentUsers }}></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============ Search UI Start ============= -->
<div class="search-ui">
    <div class="search-header">
        <img src="{{ url('assets/images/send-logo.jpeg') }}" alt="" class="logo">
        <button class="search-close btn btn-icon bg-transparent float-right mt-2">
            <i class="i-Close-Window text-22 text-muted"></i>
        </button>
    </div>
    <input type="text" placeholder="Type here" class="search-input" autofocus>
    <div class="search-title">
        <span class="text-muted">Search results</span>
    </div>
    <div class="search-results list-horizontal">
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="../../dist-assets/images/products/headphone-1.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="#" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">₹300
                            <del class="text-secondary">₹400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-danger">Sale</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="../../dist-assets/images/products/headphone-2.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="#" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">₹300
                            <del class="text-secondary">₹400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-primary">New</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="../../dist-assets/images/products/headphone-3.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="#" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">₹300
                            <del class="text-secondary">₹400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-primary">New</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="../../dist-assets/images/products/headphone-4.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="#" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">₹300
                            <del class="text-secondary">₹400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-primary">New</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGINATION CONTROL -->
    <div class="col-md-12 mt-5 text-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination d-inline-flex">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
{{-- @dd($lradsCount) --}}
<!-- <script src="{{ url('assets/js/pages/dashboard.init.js') }}"></script> super-->
<script>
    $("#client").change(function() {
        var id = $("#client").val();
        $.ajax({
            type: "get",
            url: '{{ url("super-admin/client-data")}}/' + id,

            success: function(response) {
                if (response.success) {
                    $("#total-count").text(response.count.card_name);
                    $("#totalCustomer").text(response.count.totalCustomer);
                    $("#totalCampCount").text(response.count.totalCampCount);
                    $("#totalClientGiftSentCount").text(response.count.totalClientGiftSentCount);

                } else {
                    message('error', response.message);
                }
            }
        });
    });

    function ownKeys(object, enumerableOnly) {
        var keys = Object.keys(object);
        if (Object.getOwnPropertySymbols) {
            var symbols = Object.getOwnPropertySymbols(object);
            if (enumerableOnly) symbols = symbols.filter(function(sym) {
                return Object.getOwnPropertyDescriptor(object, sym).enumerable;
            });
            keys.push.apply(keys, symbols);
        }
        return keys;
    }

    function _objectSpread(target) {
        for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i] != null ? arguments[i] : {};
            if (i % 2) {
                ownKeys(source, true).forEach(function(key) {
                    _defineProperty(target, key, source[key]);
                });
            } else if (Object.getOwnPropertyDescriptors) {
                Object.defineProperties(target, Object.getOwnPropertyDescriptors(source));
            } else {
                ownKeys(source).forEach(function(key) {
                    Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));
                });
            }
        }
        return target;
    }

    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true
            });
        } else {
            obj[key] = value;
        }
        return obj;
    }

    $(document).ready(function() {
        // Chart in Dashboard version 1
        var echartElemBar = document.getElementById('echartBar');
        if (echartElemBar) {
            var echartBar = echarts.init(echartElemBar);
            echartBar.setOption({
                legend: {
                    borderRadius: 0,
                    orient: 'horizontal',
                    x: 'right',
                    data: ['Online'] //, 'Offline'
                },
                grid: { 
                    left: '8px',
                    right: '8px',
                    bottom: '0',
                    containLabel: true
                },
                tooltip: {
                    show: true,
                    backgroundColor: 'rgba(0, 0, 0, .8)'
                },
                xAxis: [{
                    type: 'category',
                    data: ['January', 'February', 'March', 'April', 'May', 'June', 'July',
                        'August', 'September', 'October', 'November', 'December'
                    ],
                    // data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    axisTick: {
                        alignWithLabel: true
                    },
                    splitLine: {
                        show: false
                    },
                    axisLine: {
                        show: true
                    }
                }],
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}'
                    },
                    // min: 0,
                    // max: 100000,
                    // interval: 25000,
                    axisLine: {
                        show: false
                    },
                    splitLine: {
                        show: true,
                        interval: 'auto'
                    }
                }],
                series: [{
                        name: '',
                        data: [{{ $countArr }}
                        ],
                        label: {
                            show: false,
                            color: '#0168c1'
                        },
                        type: 'bar',
                        barGap: 0,
                        color: '#bcbbdd',
                        smooth: true,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowOffsetY: -2,
                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                            }
                        }
                    }
                    // , {
                    //     name: 'Offline',
                    //     data: [45000, 82000, 35000, 93000, 71000, 89000, 49000, 91000, 80200, 86000, 35000, 40050],
                    //     label: {
                    //         show: false,
                    //         color: '#639'
                    //     },
                    //     type: 'bar',
                    //     color: '#7569b3',
                    //     smooth: true,
                    //     itemStyle: {
                    //         emphasis: {
                    //             shadowBlur: 10,
                    //             shadowOffsetX: 0,
                    //             shadowOffsetY: -2,
                    //             shadowColor: 'rgba(0, 0, 0, 0.3)'
                    //         }
                    //     }
                    // }
                ]
            });
            $(window).on('resize', function() {
                setTimeout(function() {
                    echartBar.resize();
                }, 500);
            });
        } // Chart in Dashboard version 1


        var echartElemPie = document.getElementById('echartPie');

        if (echartElemPie) {
            var echartPie = echarts.init(echartElemPie);
            echartPie.setOption({
                color: ['#62549c', '#7566b5', '#7d6cbb', '#8877bd', '#9181bd', '#6957af'],
                tooltip: {
                    show: true,
                    backgroundColor: 'rgba(0, 0, 0, .8)'
                },
                series: [{
                    name: 'Sales by Country',
                    type: 'pie',
                    radius: '60%',
                    center: ['50%', '50%'],
                    data: [{
                        value: 535,
                        name: 'USA'
                    }, {
                        value: 310,
                        name: 'Brazil'
                    }, {
                        value: 234,
                        name: 'France'
                    }, {
                        value: 155,
                        name: 'BD'
                    }, {
                        value: 130,
                        name: 'UK'
                    }, {
                        value: 348,
                        name: 'India'
                    }],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }]
            });
            $(window).on('resize', function() {
                setTimeout(function() {
                    echartPie.resize();
                }, 500);
            });
        } // Chart in Dashboard version 1


        var echartElem1 = document.getElementById('echart1');

        if (echartElem1) {
            var echart1 = echarts.init(echartElem1);
            echart1.setOption(_objectSpread({}, echartOptions.lineFullWidth, {}, {
                series: [_objectSpread({
                    data: [30, 40, 20, 50, 40, 80, 90]
                }, echartOptions.smoothLine, {
                    markArea: {
                        label: {
                            show: true
                        }
                    },
                    areaStyle: {
                        color: 'rgba(102, 51, 153, .2)',
                        origin: 'start'
                    },
                    lineStyle: {
                        color: '#663399'
                    },
                    itemStyle: {
                        color: '#663399'
                    }
                })]
            }));
            $(window).on('resize', function() {
                setTimeout(function() {
                    echart1.resize();
                }, 500);
            });
        } // Chart in Dashboard version 1


        var echartElem2 = document.getElementById('echart2');

        if (echartElem2) {
            var echart2 = echarts.init(echartElem2);
            echart2.setOption(_objectSpread({}, echartOptions.lineFullWidth, {}, {
                series: [_objectSpread({
                    data: [30, 10, 40, 10, 40, 20, 90]
                }, echartOptions.smoothLine, {
                    markArea: {
                        label: {
                            show: true
                        }
                    },
                    areaStyle: {
                        color: 'rgba(255, 193, 7, 0.2)',
                        origin: 'start'
                    },
                    lineStyle: {
                        color: '#FFC107'
                    },
                    itemStyle: {
                        color: '#FFC107'
                    }
                })]
            }));
            $(window).on('resize', function() {
                setTimeout(function() {
                    echart2.resize();
                }, 500);
            });
        } // Chart in Dashboard version 1


        var echartElem3 = document.getElementById('echart3');

        if (echartElem3) {
            var echart3 = echarts.init(echartElem3);

            echart3.setOption(_objectSpread({}, echartOptions.lineNoAxis, {}, {
                series: [{
                    data: [{{ $leadGraph }}
                    ],
                    lineStyle: _objectSpread({
                        color: 'rgba(102, 51, 153, 0.8)',
                        width: 3
                    }, echartOptions.lineShadow),
                    label: {
                        show: true,
                        color: '#212121'
                    },
                    type: 'line',
                    smooth: true,
                    itemStyle: {
                        borderColor: 'rgba(102, 51, 153, 1)'
                    }
                }]
            }));
            $(window).on('resize', function() {
                setTimeout(function() {
                    echart3.resize();
                }, 500);
            });
        }
    });
</script>

@endsection