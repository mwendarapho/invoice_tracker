@extends('layouts.app')
@section('title','Staff Members')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Staff List</h2>
                <br>
                <a href="{{route('staff.create')}}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-user-plus"></i> Add Staff</a>
                <hr/>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-md-right d-print-none">#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th colspan="3" scope="col" class="d-print-none"><i class="fas fa-bars"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach($staffs as $staff)
                <tr>
                    <td class="text-md-right d-print-none">
                        <a class="px-2 btn-sm btn-outline-success" href="{{'staff/'.$staff->id}}">
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </td>
                    <td>{{$staff->code}}</td>
                    <td>{{$staff->name}}</td>
                    <td>{{ \Carbon\Carbon::parse($staff->updated_at)->diffForHumans()}}</td>
                    <td class="d-print-none">
                        <a class="px-2 btn-sm btn-outline-primary" href="{{'staff/'.$staff->id}}/edit"><i class="fas fa-edit"></i></a>
                        <a class="px-2 btn-sm btn-outline-danger" id="delete" href="{{'staff/'.$staff->id}}"><i class="fas fa-trash-alt"></i></a>
                    </td>

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')

    <script type="text/javascript">

        $(document).on('click', '#delete', function(e) {
            e.preventDefault();

            if (confirm('Delete Item, Are you sure?')) {

                var href = $(this).attr('href');
                $.ajax({
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    url: href,
                    //dataType: "json",
                    success: function() {

                        //$('#staff').DataTable().ajax.reload();
                        location.reload();


                        console.log("Successful Del");

                    }

                })
            }
        });

    </script>

@endsection
