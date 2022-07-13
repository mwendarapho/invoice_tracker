@section('title', 'Assign Riders')
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
        <h1>Assign Riders</h1>
    </div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('allocate') }}"  >

    <div class="container  align-content-center">
        
            @csrf
            <div class="form-row  text-center">
            
            <div class="form-group col">
                {{--<label for="invoice_no" class=" col-form-label text-md-right">{{ __('Invoice No') }}</label>--}}

                <div>
                    {{--<input id="invoice" type="text" class="form-control @error('invoice') is-invalid @enderror" name="invoice" value="{{ old('invoice') }}" required  autofocus placeholder="Invoice No">--}}
                    <select class="form-control form-control-lg" name="staff_id" required>
                        <option value="">Select Rider</option>
                        @foreach($riders as $rider)
                        <option value="{{$rider->id}}">{{$rider->name}}</option>
                        @endforeach
                      </select>

                    @error('invoice')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group col-sm-2">
                {{--<label for="save" class=" col-form-label text-md-right">{{ __('--') }}</label>--}}
                <div>

                    <button type="submit" id="save" class="btn btn-success btn-lg form-control ">
                        {{ __('Save') }}
                    </button>
                </div>

            </div>
            </div>
        
    </div>

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th scope="col">Invoice No</th>
            <th scope="col">Customer</th>
            <th scope="col"></th>
            <th scope="col">Town</th>
            <th scope="col">Province</th>
            <th scope="col">Invoice Date</th>
            <th scope="col">Status</th>
            <th scope="col">Staff</th>

        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr class="p-0">                
                <td><a href="invoice/{{ $invoice->invoice_no }}"><i class="fas fa-arrow-circle-right pr-1"></i></a>{{ $invoice->invoice_no }} </td>
                <td>{{ $invoice->customer }}</td>
                <td><input name="invoices[]" value="{{ $invoice->id}}" type="checkbox"</td>
                <td>{{ $invoice->town }}</td>
                <td>{{ $invoice->province }}</td>
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
</form>

@endsection
