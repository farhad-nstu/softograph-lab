@extends('layouts.app')
@section('title', $title)
@push('style')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/toastr/css/toastr.min.css') }}">

    <style>
        .info {
            background-color: aqua;
        }
    </style>
@endpush
@section('body')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">@yield('title')</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap gap-2 float-end">
                                <a href="javascript:void(0)" id="cardCreateButton" class="btn btn-primary waves-effect"><i
                                    class="fas-light fas fa-plus"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-responsive" id="card_items_data">
                    @include('layouts.pages.common.files.card_items')
                </div>
            </div>
        </div>
    </div>
    @include('layouts.pages.common.files.card_create_modal')
@stop

@push('script')
@include('layouts.pages.common.js.card_create_form_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
<script src="{{ asset('backend/assets/libs/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('js/form_clearer.js') }}"></script>
    <script>
        $("#cardCreateButton").on("click", function() {
            $("#cardCreateModal").modal('show');
        });
        $(".modalCloseBtn").on("click", function() {
            $("#cardCreateModal").modal('hide');
        });
        @if(session()->has('message'))
            toastr.options = {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.success(message);
        @endif
    </script>
@endpush
