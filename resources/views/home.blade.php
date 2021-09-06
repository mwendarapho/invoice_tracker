@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="text-md-right d-print-none">#</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Printed</th>
                                    <th>Store</th>
                                    <th>Checking</th>
                                    <th>Dispatch</th>
                                    <th>Delivered</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td class="text-md-right d-print-none">
                                            <a class="px-2 btn-sm btn-outline-success" href="{{'staff/'.$invoice->id}}">
                                                <i class="fas fa-arrow-circle-right"></i></a>
                                        </td>
                                        <td>{{$invoice->customers_code}}</td>
                                        <td>{{ $invoice->invoice_no}}</td>
                                        <td>{{ $invoice->invoice_no}}</td>
                                        <td>{{ $invoice->invoice_no}}</td>
                                        <td>{{ $invoice->invoice_no}}</td>
                                        <td>{{ $invoice->invoice_no}}</td>
                                        <td>{{ $invoice->invoice_no}}</td>


                                    </tr>
                                @endforeach

                                </tbody>
                            </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
