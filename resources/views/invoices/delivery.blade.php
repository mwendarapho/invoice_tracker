@section('title', 'Delivery Sheet')
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 p-5 my-5 bg-white">
            <h1>Delivery Sheet</h1>           
            <hr>
            <br>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name of Rider/Driver</th>
                        <th>Boniface Hassan</th>
                        <th>Sheet No</th>
                        <th>{{ '1829000' }}</th>
                    </tr>
                    <tr>
                        <th>Motor Reg No.</th>
                        <th>KBG 267H</th>
                        <th>Date</th>
                        <th>{{ \Carbon\Carbon::now()}}</th>
                    </tr>
                </thead>
            </table>
            <br>
            <br>
                
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Invoices</th>
                        <th scope="col">Signature</th>
                        <th scope="col">Comments</th>
                        

                    </tr>
                    </thead>
                    <tbody>
                    @for($i=0;$i<10;$i++)
                        <tr> 
                            <td><a href="invoice/{{ $i }}" class="btn-sm btn-outline-success  d-print-none"><i class="fas fa-arrow-circle-right"></i></a> {{ $i }}</td>               
                            <td>Customer 101</td>
                            <td>SNV1002</td>
                            <td></td>
                            <td></td>                            
                        </tr>
                    @endfor
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection
