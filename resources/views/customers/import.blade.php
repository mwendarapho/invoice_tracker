@extends('layouts.app')
@section('title','Import Customer')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 offset-md-3 p-5 my-5 bg-white">
                <h2 class="pt-2">Import Customer</h2>
                <hr/>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="pt-4" action="{{ route('import.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="customersFile" class="col-sm-2 col-form-label">File [ csv ]</label>
                        <div class="col-sm-10">
                            <input type="file" name="customersFile" value="{{ old('customersFile') }}" autofocus
                                   class="form-file-input  @error('customersFile') is-invalid @enderror"
                                   id="customersFile">
                            @error('customersFile')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary btn-lg">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
