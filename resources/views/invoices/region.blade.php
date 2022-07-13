@section('title', 'Assign Riders')
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-md-2 p-5 my-5 bg-white">
            <h1>Routes</h1>
            <hr><br/>
        
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

    
            <ul class="list-group">
                @foreach($invoices as $invoice)

                <a href="{{ url('region').'/'.$invoice->town }}"><li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ strtoupper($invoice->town) }}
                <span class="badge badge-primary badge-pill">{{ $invoice->total }}</span>
                </li></a>
                @endforeach
                    
            </ul>
      
            {{--
                
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Region</th>
                        <th scope="col">Province</th>
                        <th scope="col">Total</th>
                        <th scope="col">Printed</th>
                        <th scope="col">Checking</th>
                        <th scope="col">Dispatch</th>
                        <th scope="col">Enroute</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr class="p-0">                
                            <td><a href="invoice/{{ $invoice->invoice_no }}"><i class="fas fa-arrow-circle-right pr-1"></i></a>{{ $invoice->invoice_no }} </td>
                            <td>{{ $invoice->town }}</td>
                            <td>{{ $invoice->province}}</td>
                            <td>{{ $invoice->total }}</td>
                            <td>{{ $invoice->printed }}</td>
                            <td>{{ $invoice->dispatch }} </td>
                            <td>{{ $invoice->delivery }} </td>
                            <td>{{ $invoice->enroute }} </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>--}}
        </div>
    </div>
</div>

@endsection
