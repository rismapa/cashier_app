@extends('layouts.main')

@section('content')

  <h4 class="mb-4">Selamat datang, {{ auth()->user()->name }} !</h4>

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Column Chart</h4>
                </div>
                <div class="card-body">
                    <div id="column_chart" data-colors='["#2ab57d", "#5156be", "#fd625e"]' class="apex-charts" dir="ltr"></div>                                      
                </div>
            </div><!--end card-->
        </div>
    </div><!-- end row-->
    

@endsection

@section('script')
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- apexcharts init -->
    <script src="assets/js/pages/apexcharts.init.js"></script>
@endsection

