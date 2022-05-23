@extends('layouts.admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ count($courses) }}</h3>

                    <p>Courses</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">All Courses <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ count($lecturers) }}</h3>

                    <p>Lecturers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">All Courses <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ count($students) }}</h3>

                    <p>Students</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">All Courses <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@push('script')
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<!-- FLOT CHARTS -->
<script src="{{asset('template/admin/plugins/flot/jquery.flot.js')}}"></script>
<script src="{{asset('template/admin/plugins/flot/plugins/jquery.flot.pie.js')}}"></script>
<script>
    $(function () {
        let label = '{{ $courses_label }}'
        let data = '{{ $courses_data }}'

        label = label.replace(/&quot;/g, "'").split("'")
        label = label.filter(function(item){
            if(item !== '[' && item !== ']' && item !== ','){
                return item
            } 
        })

        data = data.replace('[',"")
        data = data.replace(']',"")
        data = data.split(',')
        console.log(label)
        var areaChartData = {
            labels  : label,
            datasets: [{
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : data
            }]
        }
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        barChartData.datasets[0] = temp0

        var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false,
            legend             : false,
        }

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
    })
</script>
@endpush
