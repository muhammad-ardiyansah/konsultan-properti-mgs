@extends('konsultan.layouts.dash-konsultan-layout-horizontal')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Developer</a></li>
                        <li class="breadcrumb-item active">Registrasi Developer</li>
                    </ol>
                </div>
                <h4 class="page-title">Registrasi Developer</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">

            <div class="tab-content">

                <div class="tab-pane show active" id="bordered-tabs-preview">
                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active'=>'developer']) }}" aria-expanded="@if ($developerTabActive) true @else false @endif" class="nav-link {{ $developerTabActive }}">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">List Developer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active'=>'user']) }}" aria-expanded="@if ($userTabActive) true @else false @endif" class="nav-link {{ $userTabActive }}">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block">List User Developer</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="tab">

                            @if($developerTabActive)
                                @include('konsultan.sub-dev-index-registrasi-developer', ['datas' => $datas, 'dpds' => $dpds])
                            @endif

                            @if($userTabActive)
                                @include('konsultan.sub-dev-user-index-registrasi-developer', ['datas' => $datas])
                            @endif

                        </div>
                    </div>                                          
                </div> <!-- end preview-->

            </div>   


        </div>
    </div>

</div>
@endsection