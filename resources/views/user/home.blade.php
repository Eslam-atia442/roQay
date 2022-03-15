@php($title='الصفحه الرئيسيه')
@extends('userLayouts.app')
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

    <div class="card">
        <div class="text-right">
            <div class="card-header">
            </div>
        </div>

            <div class="card-body">
                {!! $dataTable->table([],true) !!}



{{--                <input class="form-control" name="starts_at" id="starts_at"--}}
{{--                       readonly placeholder="اختر بدايه الدوام" type="text"/>--}}



    </div>
    </div>
@endsection
@section('scriptUser')
    {!! $dataTable->scripts() !!}
    <script src="assets/js/work.js"></script>
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
            showMeridian: true
        });
    </script>

@endsection
