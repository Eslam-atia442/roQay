@php($title='اضافه دوام')
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
            @can('read-shifts')
            <li class="breadcrumb-item">
                <a href="{{route('shifts')}}"
                   class="text-muted">جميع الدوام</a>
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
    @can('create-shifts')
    <div class="card">
        <div class="card-body">
            <form method="post"  id="form" action="{{route('shifts.store')}}" enctype="multipart/form-data">
                @csrf
                @include('dashboard.shift.form')
            </form>
        </div>
    </div>
    @endcan
@endsection
@section('script')

    <script>
        $('#starts_at, #kt_timepicker_3_modal').timepicker({
            minuteStep: 1,
            showSeconds: false,
            showMeridian: true
        });
    </script>
    <script>
        $('#ends_at, #kt_timepicker_3_modal').timepicker({
            minuteStep: 1,
            showSeconds: false,
            showMeridian: true,
            locale: {
                format: 'MM/DD/YYYY h:mm A'
            }
        });
    </script>
    <script>
        // tagging support
        $('#pharmacy').select2({
            placeholder: "اختر الصيدليه",
            tags: true
        });
    </script>
    <script>
        // tagging support
        $('#day').select2({
            placeholder: "اختر الصيدليه",
            tags: true
        });
    </script>
    <script>
        // tagging support
        $('#user').select2({
            placeholder: "اختر صاحب الدوام",
            tags: true
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection

