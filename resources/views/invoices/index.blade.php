@section('title', 'Invoices')
@extends('layouts.app')
@section('styles')
    <style>
        .table th, .table td {
            padding: 0.3rem;
        }
        .pt-4, .py-4 {
            padding-top: 0.2rem !important;
        }

        .pb-3, .py-3 {
            padding-bottom: 0.5rem !important;
        }
        .pt-3, .py-3 {
            padding-top: 0.5rem !important;
        }

    </style>

@endsection
@section('content')
    <div class="container py-3 text-center">
        <h1>Invoices</h1>
           </div>
    @if (session('messages'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="container  align-content-center">
        <form method="POST" action="{{ route('invoice.store') }}"  >
            @csrf
            <div class="form-row  text-center">
            <div class="form-group col">
                <!--<label for="user_id" class=" col-form-label text-md-right">{{ __('User ID') }}</label>-->

                <div>
                    <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required  autofocus placeholder="User ID">

                    @error('user_id')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group col">
                {{--<label for="invoice_no" class=" col-form-label text-md-right">{{ __('Invoice No') }}</label>--}}

                <div>
                    <input id="invoice_no" type="text" class="form-control @error('invoice_no') is-invalid @enderror" name="invoice_no" value="{{ old('invoice_no') }}" required  autofocus placeholder="Invoice No">

                    @error('invoice_no')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group col-sm-2">
                {{--<label for="save" class=" col-form-label text-md-right">{{ __('--') }}</label>--}}
                <div>

                    <button type="submit" id="save" class="btn btn-primary btn-sm form-control ">
                        {{ __('Save') }}
                    </button>
                </div>

            </div>
            </div>
        </form>
    </div>

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th scope="col">Invoice No</th>
            <th scope="col">Customer</th>
            <th scope="col">Invoice Date</th>
            <th scope="col">Status</th>
            <th scope="col">Staff</th>

        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr class="p-0">
                <td><a href="invoice/{{ $invoice->invoice_no }}"><span data-feather="arrow-right-circle" class="small text-success"></span></a>{{ $invoice->invoice_no }} </td>
                <td>{{ $invoice->customer }}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->created_at)->diffForHumans() }}</td>
                <td>{{ $invoice->state }}</td>
                <td>{{ $invoice->staff }} </td>
                {{--<td>{{ ($invoice->status ? 'paid' : 'unpaid') }}</td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container-fluid align-content-lg-center">
        {{-- $invoices->links() --}}
    </div>

@endsection
