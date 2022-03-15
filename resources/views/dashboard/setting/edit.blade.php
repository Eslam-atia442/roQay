@php($title='الاعدادات')
@extends('adminLayouts.app')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Breadcrumb-->
        <h5 class="text-warning font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-warning">
                <a href="{{route('admin')}}"
                   class="text-muted">الصفحة الرئيسية</a>
            </li>

        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                @csrf
                @include('dashboard.setting.form')
            </form>
        </div>
    </div>


@endsection
@section('script')
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_2');
    </script>
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_3');
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form', function () {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>

    <script src="assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>

    <script>
        var terms_ar = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create( document.querySelector( '#terms_ar' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            terms_ar.init();
        });
    </script>
    <script>
        var terms_en = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create( document.querySelector( '#terms_en' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            terms_en.init();
        });
    </script>
    <script>
        var privacy_ar = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create( document.querySelector( '#privacy_ar' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            privacy_ar.init();
        });
    </script>
    <script>
        var privacy_en = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create( document.querySelector( '#privacy_en' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            privacy_en.init();
        });
    </script>
    <script>
        var usage_ar = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create( document.querySelector( '#usage_ar' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            usage_ar.init();
        });
    </script>
    <script>
        var usage_en = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create( document.querySelector( '#usage_en' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            usage_en.init();
        });
    </script>
    <script>
        var about_ar = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create( document.querySelector( '#about_ar' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            about_ar.init();
        });
    </script>
    <script>
        var about_en = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create( document.querySelector( '#about_en' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            about_en.init();
        });
    </script>
@endsection

