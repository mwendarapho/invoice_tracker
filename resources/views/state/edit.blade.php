@extends('layouts.app')
@section('title','Create state')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 offset-md-3 p-5 my-5 bg-white">
                <h2 class="pt-2">Update state</h2>
                <hr/>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                    {!! Form::model($state, ['method' => 'PATCH','route' => ['state.update', $state->id]]) !!}


                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{$state->name}}" autofocus
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" id="name">
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
