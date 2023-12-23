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

        function allowDrop(event) {
            event.preventDefault();
        }

        function drag(event) {
            event.dataTransfer.setData("text", event.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var row_id = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(row_id));
            var card_id = parseInt(row_id.substring(4));
            var target_status_div = parseInt(ev.target.getAttribute("id").substring(4))
            console.log(card_id)
            console.log(target_status_div)
            params = {
                card_id: card_id,
                target_status_div: target_status_div
            }

            axios.post("{{ route('cards.update_card_status') }}", params, {})
                .then(function (response) {
                    $("#card_items_data").empty().html(response.data);
                })
                .catch(function (error) {
                    if (error.response) {
                        let status = error.response.status;
                        let message = error.response.data.message;
                        if (status == 422) {
                            toastr.options = {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.error(message);
                            return false;
                        }
                    }
                    if (error instanceof ReferenceError) {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.error(error.message);
                        return false;
                    }
                });
        }

        @if(session()->has('message'))
            toastr.options = {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.success(message);
        @endif
    </script>
@endpush
