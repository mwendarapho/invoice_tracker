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

            
                  
                    <div class="card-body">
                        <form method="POST" action="{{ route('invoice.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('User ID') }}</label>

                                <div class="col-md-6">
                                    <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required  autofocus>

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="invoice_no" class="col-md-4 col-form-label text-md-right">{{ __('Invoice No') }}</label>

                                <div class="col-md-6">
                                    <input id="invoice_no" type="text" class="form-control @error('invoice_no') is-invalid @enderror" name="invoice_no" value="{{ old('invoice_no') }}" required  autofocus>

                                    @error('invoice_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                           

                         

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>


                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection