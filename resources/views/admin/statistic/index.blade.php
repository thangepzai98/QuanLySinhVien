@extends('admin.layout.base')
@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row ">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-primary text-white-all">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#"><i class=""></i> Thống kê doanh thu</a></li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-header">
                       <h4>Thống Kê Doanh Thu Bán Hàng</h4>
                    </div>
                    <div class="card-body">
                        <h4 class="text-center">Biểu Đồ Kinh Doanh Tháng {{ date('m').' Năm '.date('Y') }}</h4>
                       <div class="row">
                           <div class="col-md-12">
                                <canvas id="salesChart"></canvas>
                                <p class="text-center">
                                    <i>Hình 1: Biểu đồ doanh số bán hàng</i>
                                </p>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <canvas id="quantityChart"></canvas>
                                <p class="text-center">
                                    Hình 2: Số lượng bán được theo danh mục sản phẩm
                                </p>
                            </div>
                            <div class="col-md-4">
                                <canvas id="revenueChart"></canvas>
                                <p class="text-center">
                                    Hình 3: Doanh thu theo danh mục sản phẩm
                                </p>
                            </div>
                            <div class="col-md-4">
                                <canvas id="profitChart"></canvas>
                                <p class="text-center">
                                    Hình 4: Lợi nhuận theo danh mục sản phẩm
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script>

    function formatMoney(argument) {
        return argument.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' VNĐ';
    }

    // sales chart
    var ctx = document.getElementById("salesChart").getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($data['labels'] ) !!},
            datasets: [{
                label: 'Doanh Số Bán Hàng',
                data: {!! json_encode($data['revenues'] ) !!},
                borderWidth: 2,
                backgroundColor: '#6777ef',
                borderColor: '#6777ef',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#9aa0ac", // Font Color
                        callback: function(label, index, labels) {
                            return formatMoney(label);
                        }
                    }
                }],
                xAxes: [{
                    ticks: {
                        display: false,
                        fontColor: "#9aa0ac", // Font Color
                    },
                    gridLines: {
                        display: false
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return 'Doanh thu:' + formatMoney(tooltipItem.yLabel);
                    }
                }
            }
        }
    });

    // quantity chart
    var ctx = document.getElementById("quantityChart").getContext('2d');
    var quantityChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    @foreach($data['category'] as $key => $category)
                        "{{ $category['quantity'] }}",
                    @endforeach
                ],
                backgroundColor: [
                    '#191d21',
                    '#63ed7a',
                    '#ffa426',
                    '#fc544b',
                    '#6777ef',
                ],
                label: 'Dataset 1'
            }],
            labels: [
                @foreach($data['category'] as $key => $category)
                 "{{ $key }}",
                @endforeach
            ],
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var indice = tooltipItem.index;                 
                        return  data.labels[indice] +': '+ formatMoney(data.datasets[0].data[indice]);
                    }
                }
            } 
        }
    });

    // revenue chart
    var ctx = document.getElementById("revenueChart").getContext('2d');
    var revenueChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    @foreach($data['category'] as $key => $category)
                        "{{ $category['revenue'] }}",
                    @endforeach
                ],
                backgroundColor: [
                    '#191d21',
                    '#63ed7a',
                    '#ffa426',
                    '#fc544b',
                    '#6777ef',
                ],
                label: 'Dataset 1'
            }],
            labels: [
                @foreach($data['category'] as $key => $category)
                 "{{ $key }}",
                @endforeach
            ],
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var indice = tooltipItem.index;                 
                        return  data.labels[indice] +': '+ formatMoney(data.datasets[0].data[indice]);
                    }
                }
            } 
        }
    });

    // profit chart
    var ctx = document.getElementById("profitChart").getContext('2d');
    var profitChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    @foreach($data['category'] as $key => $category)
                        "{{ $category['profit'] }}",
                    @endforeach
                ],
                backgroundColor: [
                    '#191d21',
                    '#63ed7a',
                    '#ffa426',
                    '#fc544b',
                    '#6777ef',
                ],
                label: 'Dataset 1'
            }],
            labels: [
                @foreach($data['category'] as $key => $category)
                 "{{ $key }}",
                @endforeach
            ],
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var indice = tooltipItem.index;                 
                        return  data.labels[indice] +': '+ formatMoney(data.datasets[0].data[indice]);
                    }
                }
            }   
        }
    });
</script>
@endsection