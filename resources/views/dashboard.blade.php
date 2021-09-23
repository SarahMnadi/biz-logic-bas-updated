<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .chart-wrapper {
            height: 300px;
            float: left;
            margin-left:180px;
            margin-top: 40px;
     
        }
    </style>
</head>

@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffDetails', Auth::user()->user_id) }}">Staff Details</a></li>
                        <li class="breadcrumb-item active"> BIZ-LOGIC BAS Dashboard</li>
                    </ol>
                </div>
               
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-info">
                        <div class="inner">
                            <h3> {{$registered}}</h3>
                            <p> Total Staffs Available</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-green">
                        <div class="inner">
                            <h3> {{$staffs_present}} </h3>
                            <p> Staffs Present Today </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-red">
                        <div class="inner">
                            <h3> 5464 </h3>
                            <p> Absentees </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-times" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-orange">
                        <div class="inner">
                            <h3> 1 </h3>
                            <p style="color: white"> Permitted Absentees </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-red">
                        <div class="inner">
                            <h3> 5464 </h3>
                            <p> Absentees </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-times" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-info">
                        <div class="inner">
                            <h3> {{$registered}}</h3>
                            <p> Total Staffs Available</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-green">
                        <div class="inner">
                            <h3> {{$staffs_present}} </h3>
                            <p> Staffs Present Today </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-red">
                        <div class="inner">
                            <h3> 5464 </h3>
                            <p> Absentees </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-times" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box bg-orange">
                        <div class="inner">
                            <h3> 1 </h3>
                            <p style="color: white"> Permitted Absentees </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
       <!--pie chart starts here--> 
        <div class="container">
            <div class="chart-wrapper">
                <canvas id="myChart"></canvas>
            </div>
        </div>
       
        <div class="container">
            <div class="chart-wrapper">
                <canvas id="myPie"></canvas>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
        <script src="{{ url('js/chart.2.8.0.js') }}"></script>
       
       <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    // labels: ['Present', 'Absent', 'Ruhusa'],
                    datasets: [{
                        label: '# of Votes',
                        // data: [12, 19, 3],
                        backgroundColor: [
                            'white',
                            'yellow',
                             'green',
                            'orange',
                         
                        ],
                        borderColor: [
                            'rgba(25, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                           
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // scales: {
                    //     yAxes: [{
                    //         ticks: {
                    //             beginAtZero: true
                    //         }
                    //     }]
                    // }
                }
            });
    
            var data =[30, 14,20,40];
            var labels = ['ICT', 'HUMAN RESOURCE', 'ADMINSTRATION','FINANCE'];
    
            updateChart(myChart, labels, data);
    
            function updateChart(chart, labels, data) {
                chart.data.labels = labels;
                chart.data.datasets[0].data = data;
                chart.update();
            }
        </script>

<script>
    var ctx = document.getElementById('myPie').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19],
                backgroundColor: [
                    'rgba(0, 0, 0, 0.1)',
                            'blue',
                ],
                borderColor: [
                    'rgba(25, 99, 132, 1)',
                     'rgba(54, 162, 235, 1)',   
                ],
                borderWidth: 1
            }]
        },
        options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // scales: {
                    //     yAxes: [{
                    //         ticks: {
                    //             beginAtZero: true
                    //         }
                    //     }]
                    // }
                }
    });
    </script>



@endsection

