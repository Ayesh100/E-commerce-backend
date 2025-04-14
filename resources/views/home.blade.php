@extends('layouts.master.body')
@section('main-content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Orders</p>
                                    <h4 class="my-1 text-info">{{ $totalOrders }}</h4>
                                    <p class="mb-0 font-13"
                                        style="color: {{ $orderGrowth > 0 ? 'green' : ($orderGrowth < 0 ? 'red' : 'black') }}">
                                        {{ $orderGrowth >= 0 ? '+' : '' }}{{ number_format($orderGrowth, 1) }}% from last
                                        week
                                    </p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                        class='bx bxs-cart'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Revenue</p>
                                    <h4 class="my-1 text-danger">Rs.{{ number_format($totalRevenue, 0) }}</h4>
                                    <p class="mb-0 font-13" style="color: {{ $revenueGrowth >= 0 ? 'green' : 'red' }};">
                                        {{ $revenueGrowth >= 0 ? '+' : '' }}{{ number_format($revenueGrowth, 1) }}% from
                                        last week
                                    </p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                        class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">New Customers</p>
                                    <h4 class="my-1 text-warning">{{ $newCustomersThisWeek }}</h4>
                                    <p class="mb-0 font-13" style="color: {{ $customerGrowth >= 0 ? 'green' : 'red' }}">
                                        {{ $customerGrowth >= 0 ? '+' : '' }}{{ number_format($customerGrowth, 0) }}% from
                                        last week
                                    </p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                        class='bx bxs-bar-chart-alt-2'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Customers</p>
                                    <h4 class="my-1 text-warning">{{ number_format($totalCustomers) }}</h4>
                                    <p class="mb-0 font-13"
                                        style="color: {{ $customerTotalGrowth >= 0 ? 'green' : 'red' }}">
                                        {{ $customerTotalGrowth >= 0 ? '+' : '' }}{{ number_format($customerTotalGrowth, 0) }}%
                                        from last week
                                    </p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                        class='bx bxs-group'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 d-flex justify-content-center">
                    <div class="card radius-10 w-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Sales Overview</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                        data-bs-toggle="dropdown"><i
                                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                        <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <div class="chart-container-1" style="width: 100%; display: flex; justify-content: center;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 d-flex justify-content-center">
                    <div class="card radius-10 w-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Trending Products</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                        data-bs-toggle="dropdown"><i
                                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                        <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <div class="chart-container-2" style="width: 100%; display: flex; justify-content: center;">
                                <canvas id="productSalesDonutChart"></canvas>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($productSales as $product)
                                <li
                                    class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                    {{ $product->product_name }}
                                    <span class="badge bg-primary rounded-pill">{{ $product->total_sales }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card radius-10">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Recent Orders</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Photo</th>
                                    <th>Product ID</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Shipping</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr>
                                        <!-- For Product, using the first order item in each order -->
                                        <td>
                                            @if($order->orderItems->first())
                                                {{ $order->orderItems->first()->product->product_name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->orderItems->first())
                                                <img src="{{ asset('uploads/' . $order->orderItems->first()->product->product_img) }}" class="product-img-2" alt="product img">
                                            @else
                                                <img src="{{ asset('uploads/no-image.png') }}" class="product-img-2" alt="no image">
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->orderItems->first())
                                                #{{ $order->orderItems->first()->product->id }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->status == 'completed')
                                                <span class="badge bg-gradient-quepal text-white shadow-sm w-100">Completed</span>
                                            @elseif($order->status == 'processing')
                                                <span class="badge bg-gradient-blooker text-white shadow-sm w-100">Processing</span>
                                            @elseif($order->status == 'pending')
                                                <span class="badge bg-gradient-bloody text-white shadow-sm w-100">Pending</span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="badge bg-gradient-grey text-white shadow-sm w-100">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>Rs.{{ number_format($order->total_price) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                @if ($order->status == 'completed')
                                                    <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
                                                @elseif($order->status == 'processing')
                                                    <div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
                                                @elseif($order->status == 'pending')
                                                    <div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 20%"></div>
                                                @elseif($order->status == 'cancelled')
                                                    <div class="progress-bar bg-gradient-grey" role="progressbar" style="width: 0%"></div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                        

            <div class="row row-cols-1 row-cols-lg-2">
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <p class="font-weight-bold mb-1 text-secondary">Weekly Revenue</p>
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <h4 class="mb-0">Rs.{{ number_format($revenueThisWeek, 0) }}</h4>
                                </div>
                                <div class="">
                                    @if($revenueGrowth >= 0)
                    <p class="mb-0 align-self-center font-weight-bold text-success ms-2">
                        {{ number_format($revenueGrowth, 1) }}% <i class="bx bxs-up-arrow-alt mr-2"></i>
                    </p>
                @else
                    <p class="mb-0 align-self-center font-weight-bold text-danger ms-2">
                        {{ number_format(abs($revenueGrowth), 1) }}% <i class="bx bxs-down-arrow-alt mr-2"></i>
                    </p>
                @endif
                                </div>
                            </div>
                            <div class="chart-container-0 mt-5">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Orders Summary</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                        data-bs-toggle="dropdown"><i
                                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:;">Action</a>
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container-1 mt-3 d-flex justify-content-center">
                                <canvas id="ordersProcessedChart"></canvas>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                                Completed <span class="badge bg-gradient-quepal rounded-pill">{{ $completedCount }}</span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                Pending <span class="badge bg-gradient-ibiza rounded-pill">{{ $pendingCount }}</span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                Process <span class="badge bg-gradient-deepblue rounded-pill">{{ $processingCount }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div><!--end row-->

        </div>
    </div>
    <!--end page wrapper -->


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('myChart').getContext('2d');


            var ordersChartData = @json($ordersChartData);

            // Create the chart
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ordersChartData.labels,
                    datasets: ordersChartData.datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                // Adjust step size if needed
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.dataset.label + ': ' + tooltipItem
                                        .formattedValue;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    var canvas = document.getElementById('productSalesDonutChart');
    if (canvas) {
        var ctx = canvas.getContext('2d');
    
        var productSalesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($productSales->pluck('product_name')) !!},
                datasets: [{
                    data: {!! json_encode($productSales->pluck('total_sales')) !!},
                    backgroundColor: [
                        '#4caf50',
                        '#f44336',
                        '#2196f3',
                        '#ffc107',
                        '#9c27b0',
                        '#3f51b5'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cutout: '60%', // Donut effect
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 11
                            },
                            boxWidth: 10,
                            padding: 8,
                        }
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.parsed;
                                return label + ': ' + value + ' sales';
                            }
                        }
                    }
                },
                layout: {
                    padding: 10
                }
            }
        });
    } else {
        console.error('Canvas with ID productSalesDonutChart not found.');
    }
});
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx3 = document.getElementById('revenueChart').getContext('2d');

            var revenueChartData = @json($revenueChartData);
            // Create the bar chart for weekly revenue
            var revenueChart = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: revenueChartData.labels,
                    datasets: revenueChartData.datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                // Optionally adjust the step size here, if needed
                                stepSize: 100 // You can adjust this value based on your data scale
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.dataset.label + ': Rs.' + tooltipItem
                                        .formattedValue;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var ctx4 = document.getElementById('ordersProcessedChart').getContext('2d');

    
    var orderSummaryChartData = @json($orderSummaryChartData);

    // Create the doughnut chart for the orders summary
    var orderSummaryChart = new Chart(ctx4, {
        type: 'doughnut',
        data: {
            labels: orderSummaryChartData.labels,
            datasets: orderSummaryChartData.datasets
        },
        options: {
            responsive: true,
            cutout: '60%', // Adjust to make it donut style
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 10
                        },
                        boxWidth: 10,
                        padding: 8
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed;
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
