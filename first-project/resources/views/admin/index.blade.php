@extends('admin.layout.master')
@section('title', config('app.name'. '- Admin Panel'))
@section('content')
    <h1 class="page-header">Dashboard</h1>
    <section class="row text-center placeholders">
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">All Orders</div>
                <div class="panel-body">
                    <h4>{{ $statistics['orders'] }}</h4>
                    <p>Order</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Waiting Orders</div>
                <div class="panel-body">
                    <h4>{{ $statistics['waiting_orders'] }}</h4>
                    <p>Order</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Cargo</div>
                <div class="panel-body">
                    <h4>{{ $statistics['cargo_orders'] }}</h4>
                    <p>Order</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Done Order</div>
                <div class="panel-body">
                    <h4>{{ $statistics['done_orders'] }}</h4>
                    <p>Order</p>
                </div>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Best Seller</div>
                <div class="panel-body">
                    <canvas id="chart_best_seller"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Order per Months</div>
                <div class="panel-body">
                    <canvas id="chart_per_months"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        @php
            $labels = '';
            $data = '';
            foreach($best_seller as $value){
                $labels .= "\"$value->product_name\", ";
                $data .= "\"$value->piece\", ";
            }
        @endphp

        var ctx = document.getElementById('chart_best_seller').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'horizontalBar',

            data: {
                labels: [{!! $labels !!}],
                datasets: [{
                    label: 'Bestseller',
                    borderColor: '#004684',
                    data: [{!! $data !!}]
                }]
            },

            options: {
                legend: {
                    display:false
                },
                scales : {
                    xAxes: [
                        {
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });

        @php
            $labels = '';
            $data = '';
            foreach($order_per_months as $value){
                $labels .= "\"$value->month\", ";
                $data .= "\"$value->piece\", ";
            }
        @endphp

        var ctx = document.getElementById('chart_per_months').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',

            data: {
                labels: [{!! $labels !!}],
                datasets: [{
                    label: 'Order per Months',
                    borderColor: '#004684',
                    data: [{!! $data !!}]
                }]
            },

            options: {
                legend: {
                    display:false
                },
                scales : {
                    xAxes: [
                        {
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });
    </script>
@endsection