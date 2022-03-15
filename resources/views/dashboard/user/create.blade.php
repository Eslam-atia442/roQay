@php($title='اضافه موظف')
@extends('adminLayouts.app')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Breadcrumb-->
        <h5 class="text-success font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            @can('read-users')
            <li class="breadcrumb-item">
                <a href="{{route('users')}}"
                   class="text-muted">الموظفين</a>
            </li>
            @endcan
            <li class="breadcrumb-item">
                <a href="{{route('admin')}}"
                   class="text-muted">الصفحة الرئيسية</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')
    @can('create-users')
    <div class="card">
        <div class="card-body">
            <form method="post"  id="form" action="{{route('users.store')}}" enctype="multipart/form-data">
                @csrf
                @include('dashboard.user.form')
            </form>
        </div>
    </div>
    @endcan
@endsection
@section('script')
    <script !src="">
        var avatar2 = new KTImageInput('kt_image_2');
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection

