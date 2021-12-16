@extends('backend.layout')

@section('page_title')
{{ 'Dashboard' }}
@endsection

@section('main')

<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-profile"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ $dashboard_counts->post_count }}</h2>
                        <p class="m-b-0 text-muted">Total Posts</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                        <i class="anticon anticon-project"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ round($dashboard_counts->post_count/12) }}</h2>
                        <p class="m-b-0 text-muted">Average post per month</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-gold">
                        <i class="anticon anticon-message"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ $dashboard_counts->message_count }}</h2>
                        <p class="m-b-0 text-muted">Total Messages</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Post Per Months</h5>
                </div>
                <div class="m-t-10" >
                    <canvas class="chart" id="line-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="m-b-0">Post Ratio</h5>
                <div class="m-v-30 text-center">
                    <canvas class="chart" id="doughnut-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('extra_script')

<script src="{{ asset('backend/assets/vendors/chartjs/chart.js') }}"></script>

<script>
    
    $(document).ready(function(){
        const date = new Date();
        let year = date.getFullYear();

        const lineChartMonths = [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ];

        const lineChartData = {
        labels: lineChartMonths,
        datasets: [{
                label: year+' Post Uploads',
                backgroundColor: 'rgba(87, 88, 187, 0.9)',
                borderColor: 'rgba(237, 76, 103, 0.9)',
                data: {{ $line_chart_data }},
            }]
        };

        const lineChartConfig = {
            type: 'line',
            data: lineChartData,
            options: {
                scales: {
                    y: {
                        title: {
                        display: true,
                        align: 'center',
                        text: 'Counts',
                    },
                    min: 0,
                    ticks: {
                        stepSize: 5
                    }
                    },
                    x: {
                        title: {
                        display: true,
                        align: 'center',
                        text: 'Months',
                    }
                    }
                }
            }
        };

        const lineChart = new Chart(
            document.getElementById('line-chart'),
            lineChartConfig
        );

        const doughnutChartData = {
            labels: [
                'Status',
                'Picture',
                'Blog'
            ],
            datasets: [{
                data: {{ $doughnut_chart_data }},
                backgroundColor: [
                'rgba(255, 99, 132, 0.9)',
                'rgba(120, 224, 143, 0.9)',
                'rgba(74, 105, 189, 0.9)'
                ],
                hoverOffset: 2
            }]
        };

        const doughnutChartConfig = {
            type: 'doughnut',
            data: doughnutChartData,
        };

        const doughnutChart = new Chart(
            document.getElementById('doughnut-chart'),
            doughnutChartConfig
        );
    });

</script>

@endsection