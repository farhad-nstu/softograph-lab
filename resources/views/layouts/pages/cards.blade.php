@extends('layouts.app')
@section('title', $title)
@push('style')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fileinput.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/toastr/css/toastr.min.css') }}">

    <style>
        .info {
            background-color: aqua;
        }
        #uploaded_documents {
            max-height: 355px;
            overflow-y: auto;
        }
        #added_expenses {
            max-height: 189px;
            overflow-y: auto;
        }
        #uploaded_documents img {
            height: 100px;
            width: 100px;
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
                                <a href="{{ url()->previous() }}" class="btn btn-light waves-effect"><i
                                        class="fas-light fas fa-angle-double-left"></i> Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route(\Request::route()->getName()) }}" method="get">
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="card_id">Cards</label>
                                <select name="card_id" id="card_id"
                                    class="form-control select2"
                                    style="width:100%">
                                    <option value="">-------</option>
                                    @foreach ($cards as $card)
                                        <option value="{{ $card->id }}">{{ $card->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status"
                                    class="form-control select2"
                                    style="width:100%">
                                    <option value="">-------</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="mb-0 mb-md-3">
                                <button type="submit" class="btn btn-success">Search</button>
                                <a href="{{ route(\Request::route()->getName()) }}" class="btn btn-info">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped  nowrap w-100">
                        <thead>
                            <tr class="table-hd-bg">
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cards && count($cards) > 0)
                                @foreach ($cards as $card)
                                    <tr>
                                        <td>{{ $card->name }}</td>
                                        <td>{{ $card->status }}</td>
                                        <td>
                                            @can('cards.show')
                                                <a href="{{ route('cards.show', $card->id) }}"
                                                    class="btn btn-primary waves-effect waves-light"><i class="fas fa-eye"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
