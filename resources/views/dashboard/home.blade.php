@php($title='الصفحه الرئيسيه')
@extends('adminLayouts.app')
@section('title')
    {{settings('site_name')}}
@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h5 class="text-success font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <div class="row">

        <div class="col-md-3">
            <div class="card card-custom gutter-b" style="height: 150px">
                <div class="card-body">
                    <span class="svg-icon svg-icon-warning svg-icon-3x">
                        <i class="fa fas fa-users text-success icon-3x"></i>
                    </span>
                    <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['users']}}</div>
                    <a class="text-muted font-weight-bold font-size-lg mt-1">عدد الموظفين</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom gutter-b" style="height: 150px">
                <div class="card-body">
                    <span class="svg-icon svg-icon-warning svg-icon-3x">
                        <i class="fa fas fa-leaf text-info icon-3x"></i>
                    </span>
                    <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['pharmacies']}}</div>
                    <a class="text-muted font-weight-bold font-size-lg mt-1">عدد الصيدليات</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom gutter-b" style="height: 150px">
                <div class="card-body">
                    <span class="svg-icon svg-icon-warning svg-icon-3x">
                        <i class="fas fa-user-tie text-danger icon-3x"></i>
                    </span>
                    <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['admins']}}</div>
                    <a class="text-muted font-weight-bold font-size-lg mt-1">عدد المديرين</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom gutter-b" style="height: 150px">
                <div class="card-body">
                    <span class="svg-icon svg-icon-warning svg-icon-3x">
                        <i class="far fa-calendar-check text-warning icon-3x"></i>
                    </span>
                    <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['roles']}}</div>
                    <a class="text-muted font-weight-bold font-size-lg mt-1">عدد الصلاحيات</a>
                </div>
            </div>
        </div>

    </div>
@endsection
