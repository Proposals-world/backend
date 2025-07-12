@extends('admin.layout.app')

@section('title', 'Dashboard') <!-- Title for the page -->

@section('page-title', 'Admin Dashboard') <!-- Main title on the page -->

@section('subtitle', 'Overview') <!-- Subtitle in the breadcrumb -->

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">
                        <h4 class="page-title">Dashboard</h4>
                        <form class="d-flex mb-xxl-0 mb-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary ms-2">
                                <i class="ri-refresh-line"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-xxl-4 row-cols-lg-3 row-cols-md-2">
                <div class="col">
                    <div class="card widget-icon-box">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Customers">Customers
                                    </h5>
                                    <h3 class="my-3">{{ $stats['total_users'] }}</h3>
                                    <p class="mb-0 text-muted text-truncate">
                                        <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                            {{ $stats['users_since_last_month'] }}</span>
                                        <span>Since last month</span>
                                    </p>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                        <i class="ri-group-line"></i>
                                    </span>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col">
                    <div class="card widget-icon-box">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-muted text-uppercase fs-13 mt-0" title="Average Revenue">
                                        Revenue</h5>
                                    <h3 class="my-3">{{ $stats['total_revenue'] }} $</h3>
                                    <p class="mb-0 text-muted text-truncate">
                                        <span class="badge bg-danger me-1"><i class="ri-arrow-up-line"></i>
                                            {{ $stats['this_month_revenue'] }} $</span>
                                        <span>Since last month</span>
                                    </p>

                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                        <i class="ri-money-dollar-circle-line"></i>
                                    </span>
                                </div>
                            </div>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col">
                    <div class="card widget-icon-box">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-muted text-uppercase fs-13 mt-0" title="Growth">Customers Growth</h5>
                                    <h3 class="my-3">{{ $stats['user_growth_percentage'] }}%</h3>

                                    <span class="mb-0 text-muted text-truncate">Since last month</span>

                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                        <i class="ri-donut-chart-line"></i>
                                    </span>
                                </div>
                            </div>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col">
                    <div class="card widget-icon-box">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-muted text-uppercase fs-13 mt-0" title="Contact Usage">
                                        Contacts</h5>
                                    <h3 class="my-3">{{ $stats['total_matches'] }}</h3>
                                    <p class="mb-0 text-muted text-truncate">
                                        <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                            {{ $stats['matches_since_last_month'] }}</span>
                                        <span>Since last month</span>
                                    </p>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar">
                                        <i class="ri-pulse-line"></i>
                                    </span>
                                </div>
                            </div>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col">
                    <div class="card widget-icon-box">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-muted text-uppercase fs-13 mt-0" title="Contact Usage">
                                        subscriptions</h5>
                                    <h3 class="my-3">{{ $stats['total_subscriptions'] }}</h3>
                                    <p class="mb-0 text-muted text-truncate">
                                        <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                            {{ $stats['subscriptions_since_last_month'] }}</span>
                                        <span>Since last month</span>
                                    </p>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar">
                                        <i class="ri-bank-card-line"></i>
                                    </span>
                                </div>
                            </div>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <h4 class="header-title">Contact Sales</h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div id="total-sales-chart" class="apex-charts mb-3 mt-n5" data-colors="#9e086c"></div>

                            @foreach ($totalSalesChart['city_names'] as $index => $city)
                                <h5 class="mb-1 mt-0 fw-normal">{{ $city }}</h5>
                                <div class="progress-w-percent">
                                    <span
                                        class="progress-value fw-bold">{{ number_format($totalSalesChart['city_sales'][$index]) }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ ($totalSalesChart['city_sales'][$index] / max($totalSalesChart['city_sales']->toArray())) * 100 }}%;"
                                            aria-valuenow="{{ $totalSalesChart['city_sales'][$index] }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <h4 class="header-title">Revenue</h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="bg-light-subtle border-top border-bottom border-light">
                                <div class="row text-center">
                                    <div class="col">
                                        <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> This Month Revenue
                                        </p>
                                        <h3 class="fw-normal mb-3">
                                            <span>${{ number_format($revenueAndSalesChart['current_month_revenue'], 2) }}</span>
                                        </h3>
                                    </div>
                                    <div class="col">
                                        <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Total Revenue</p>
                                        <h3 class="fw-normal mb-3">
                                            <span>${{ number_format($revenueAndSalesChart['total_revenue'], 2) }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div dir="ltr">
                                <div id="revenue-sales-chart" class="apex-charts mt-1" data-colors="#a0076c,#17a497">
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <h4 class="header-title">Contact Usage</h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">Usage Report</a>
                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="contact-usage-chart" class="apex-charts" data-colors="#17a497"></div>
                            <div class="text-center mt-3">
                                <h5 class="mb-1 mt-0 fw-normal">Contact Usage Rate</h5>
                                <div class="progress progress-lg mb-2">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $totalSalesChart['contact_usage_percentage'] }}%;"
                                        aria-valuenow="{{ $totalSalesChart['contact_usage_percentage'] }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted">{{ $totalSalesChart['contact_usage_percentage'] }}% of purchased contacts have been accessed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <h4 class="header-title">Package Performance</h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">Package Report</a>
                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>Sales</th>
                                            <th>Revenue</th>
                                            <th>Contacts Used</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- This would be populated with package performance data -->
                                        <tr>
                                            <td>Basic Package</td>
                                            <td>{{ number_format(rand(50, 200)) }}</td>
                                            <td>${{ number_format(rand(500, 2000), 2) }}</td>
                                            <td>{{ rand(40, 90) }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Standard Package</td>
                                            <td>{{ number_format(rand(100, 400)) }}</td>
                                            <td>${{ number_format(rand(2000, 8000), 2) }}</td>
                                            <td>{{ rand(40, 90) }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Premium Package</td>
                                            <td>{{ number_format(rand(30, 150)) }}</td>
                                            <td>${{ number_format(rand(3000, 12000), 2) }}</td>
                                            <td>{{ rand(40, 90) }}%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- container -->

    </div>

    @push('scripts')
        <!-- ApexCharts -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    series: [{
                            name: "Revenue",
                            type: "area",
                            data: @json($revenueAndSalesChart['revenue'])
                        },
                        {
                            name: "Sales",
                            type: "bar",
                            data: @json($revenueAndSalesChart['sales'])
                        }
                    ],
                    chart: {
                        height: 335,
                        type: "line",
                        stacked: false,
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ["#a0076c", "#17a497"],
                    dataLabels: {
                        enabled: true,
                        enabledOnSeries: [1]
                    },
                    stroke: {
                        width: [2, 1],
                        curve: "smooth"
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "25%"
                        }
                    },
                    labels: @json($revenueAndSalesChart['months']),
                    xaxis: {
                        type: "category",
                        labels: {
                            rotate: -45
                        }
                    },
                    yaxis: [{
                            title: {
                                text: "Net Revenue"
                            }
                        },
                        {
                            opposite: true,
                            title: {
                                text: "Number of Sales"
                            }
                        }
                    ],
                    tooltip: {
                        theme: "dark"
                    },
                    legend: {
                        position: "bottom"
                    }
                };

                var chart = new ApexCharts(document.querySelector("#revenue-sales-chart"), options);
                chart.render();

                // Radial Chart for Total Sales (Same as Average Sales)
                var totalSalesOptions = {
                    series: [{{ $totalSalesChart['sales_percentage'] }}], // Percentage of sales
                    chart: {
                        height: 367,
                        type: "radialBar"
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -135,
                            endAngle: 135,
                            dataLabels: {
                                name: {
                                    fontSize: "14px",
                                    color: undefined,
                                    offsetY: 100
                                },
                                value: {
                                    offsetY: 55,
                                    fontSize: "24px",
                                    color: undefined,
                                    formatter: function(val) {
                                        return val + "%";
                                    }
                                }
                            },
                            track: {
                                background: "rgba(170,184,197, 0.2)",
                                margin: 0
                            }
                        }
                    },
                    fill: {
                        gradient: {
                            enabled: true,
                            shade: "dark",
                            shadeIntensity: 0.2,
                            inverseColors: false,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 50, 65, 91]
                        }
                    },
                    stroke: {
                        dashArray: 4
                    },
                    colors: ["#9e086c"],
                    labels: ["Contact Purchase Rate"],
                    responsive: [{
                        breakpoint: 380,
                        options: {
                            chart: {
                                height: 180
                            }
                        }
                    }],
                    grid: {
                        padding: {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: 0
                        }
                    }
                };

                var totalSalesChart = new ApexCharts(document.querySelector("#total-sales-chart"),
                    totalSalesOptions);
                totalSalesChart.render();

                // Contact Usage Donut Chart
                var contactUsageOptions = {
                    series: [{{ $totalSalesChart['contact_usage_percentage'] }}, {{ 100 - $totalSalesChart['contact_usage_percentage'] }}],
                    chart: {
                        type: 'donut',
                        height: 240
                    },
                    labels: ['Accessed', 'Not Accessed'],
                    colors: ['#17a497', '#f0f0f0'],
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    }
                };

                var contactUsageChart = new ApexCharts(document.querySelector("#contact-usage-chart"),
                    contactUsageOptions);
                contactUsageChart.render();
            });
        </script>
    @endpush
    <!-- content -->
@endsection
