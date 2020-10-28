@extends('admin.layouts.master')
@section('title', 'Home')
@section('content')
    <h1 class="page-header">Dashboard</h1>

    <section class="row text-center placeholders">
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Pending Order</div>
                <div class="panel-body">
                    <h4>{{ $statistics['pending_order'] }}</h4>
                    <p>Piece</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Completed Order</div>
                <div class="panel-body">
                    <h4>{{ $statistics['completed_order'] }}</h4>
                    <p>Piece</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Total Product</div>
                <div class="panel-body">
                    <h4>{{ $statistics['total_product'] }}</h4>
                    <p>Piece</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">User</div>
                <div class="panel-body">
                    <h4>{{ $statistics['total_user'] }}</h4>
                    <p>User</p>
                </div>
            </div>
        </div>
    </section>

    <section class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Best Seller
                </div>
                <div class="panel-body">
                    <canvas id="chat_best_seller">

                    </canvas>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Monthly Orders
                </div>
                <div class="panel-body">
                    <canvas id="monthly_orders">

                    </canvas>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2//Chart.bundle.min.js"></script>
    <script>

            @php
                $keys = "";
                $values = "";
                foreach($show_best_seller as $report)
                    {
                        $keys .="\"$report->product_name\", ";
                        $values .= "$report->piece, ";
                    }
            @endphp

        var ctx = document.getElementById('chat_best_seller').getContext('2d');
        var chat_best_seller = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [{!! $keys !!}],
                datasets: [{
                    label: '# of Best Seller',
                    data: [{!! $values !!}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

            @php
                $keys = "";
                $values = "";
                foreach($show_best_seller as $report)
                    {
                        $keys .="\"$report->product_name\", ";
                        $values .= "$report->piece, ";
                    }
            @endphp

        var ctx = document.getElementById('chat_best_seller').getContext('2d');
        var chat_best_seller = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [{!! $keys !!}],
                datasets: [{
                    label: '# of Best Seller',
                    data: [{!! $values !!}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        @php
            $keys = "";
            $values = "";
            foreach($monthly_orders as $report)
                {
                    $keys .="\"$report->month\", ";
                    $values .= "$report->piece, ";
                }
        @endphp

        var ctx = document.getElementById('monthly_orders').getContext('2d');
        var monthly_orders = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [{!! $keys !!}],
                datasets: [{
                    label: '# of Monthly Orders',
                    data: [{!! $values !!}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend : {
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
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
