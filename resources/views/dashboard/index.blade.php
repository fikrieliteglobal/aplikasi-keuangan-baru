@extends('template.master_template')

@section('isi')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Donut Chart</h3>

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
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
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

        $(document).ready(function() {
            tampilCharts()
        })
    </script>
@endsection
