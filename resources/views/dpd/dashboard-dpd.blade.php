@extends('dpd.layouts.dash-dpd-layout')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li> -->
                        <li class="breadcrumb-item active">Beranda</li>
                    </ol>
                </div>
                <h4 class="page-title">Beranda</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
    <div class="col-12">
        <div class="card widget-flat">
            <div class="card-body">
                Selamat datang perwakilan DPD {{ Auth::user()->name }}
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

</div>

@endsection