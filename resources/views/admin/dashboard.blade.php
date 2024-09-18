@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bảng điều khiển </h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Doanh thu hôm nay</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($todaysEarnings, 0, ',', '.') }} {{ $settings->currency_icon }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Doanh thu tuần này</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($weekEarnings, 0, ',', '.') }} {{ $settings->currency_icon }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4> Doanh thu tháng này</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($monthEarnings, 0, ',', '.') }} {{ $settings->currency_icon }}
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Doanh thu năm nay</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($yearEarnings, 0, ',', '.') }} {{ $settings->currency_icon }}
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.order.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4> Đơn hàng hôm nay</h4>
                            </div>
                            <div class="card-body">
                                {{ $todaysOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.pending-orders') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng chờ xử lý hôm nay</h4>
                            </div>
                            <div class="card-body">
                                {{ $todaysPendingOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.order.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đơn hàng</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalOrders }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.pending-orders') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đơn hàng chờ xử lý</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPendingOrders }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.canceled-orders') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đơn hàng bị hủy</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCanceledOrders }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.delivered-orders') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4> Tổng số đơn hàng đã hoàn thành</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCompleteOrders }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.reviews.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đánh giá</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalReview }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.brand.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-copyright"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4> Tổng số thương hiệu</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalBrands }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.category.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số danh mục</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCategories }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.subscribers.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số người đăng ký</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSubscriber }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.vendor-list.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số nhà cung cấp
                                </h4>
                            </div>
                            <div class="card-body">
                                {{ $totalVendors }}
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.customer.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số người dùng</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalUsers }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Top-Selling Products -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Sản phẩm bán chạy nhất</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng đã bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topSellingProducts as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->total_sold }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- Chart Container -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thống kê doanh thu</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
    </section>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js setup
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line', // Choose line or bar chart
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8',
                    'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                ], // Months
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: [{{ implode(',', $revenueData) }}], // Pass revenue data here
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.4, // Add smooth curve
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Highlight points
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                            }
                        },
                        title: {
                            display: true,
                            text: 'Doanh thu (VND)', // Title for Y axis
                        },
                        grid: {
                            color: 'rgba(200, 200, 200, 0.3)', // Light grid lines for better visibility
                            lineWidth: 1
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(200, 200, 200, 0.3)',
                            lineWidth: 1
                        },
                        title: {
                            display: true,
                            text: 'Tháng', // Title for X axis
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                            }
                        }
                    },
                    legend: {
                        display: true,
                        labels: {
                            color: 'black',
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
    @endpush
    
@endsection
