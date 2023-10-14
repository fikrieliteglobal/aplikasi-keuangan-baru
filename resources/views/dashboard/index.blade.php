@extends('template.master_template')

@section('isi')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Pengeluaran Bulan Ini</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 100%; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-12 col-md-6">
                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Monthly Report</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function tampilCharts() {
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                method: "POST",
                url: "{{ url('/dataCharts') }}",
                dataType: "json",
                success: function([label, nominal]) {
                    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                    var donutData = {
                        labels: label,
                        datasets: [{
                            label: 'contoh 1',
                            data: nominal,
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc',
                                '#d2d6de'
                            ],
                        }]
                    }
                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    new Chart(donutChartCanvas, {
                        type: 'doughnut',
                        data: donutData,
                        options: donutOptions
                    })
                }
            });
        }

        function tampilChartBatang() {
            let data_pemasukan = [];
            let data_pengeluaran = [];

            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                method: "POST",
                url: "{{ url('/dataChartsMonthly') }}",
                dataType: "json",
                success: function(data) {
                    BarChart(data.pemasukan, data.pengeluaran)
                }
            });

        }

        function BarChart(data_pemasukan, data_pengeluaran) {
            var areaChartData = {
                labels: ['January', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                        label: 'Pemasukan',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: data_pemasukan
                    },
                    {
                        label: 'Pengeluaran',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: data_pengeluaran
                    },
                ]
            }
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        }

        $(document).ready(function() {
            tampilCharts()
            tampilChartBatang()
        })
    </script>
@endsection
