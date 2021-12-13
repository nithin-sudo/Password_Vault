@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
                <h1 style="color: chocolate; font-size:55px;" class="text-center"><b>OMNI-VAULT</b></h1>
                <a class="btn btn-primary" href="{{ route('dashboard') }}" style="margin-left:90px; margin-bottom:5px; "> Back to Dashboard</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p style="color:green"><b>{{ $message }}</b></p>
        </div>
    @endif

    <div class="container mt-5">
        <table class="table table-bordered yajra-datatable" style="width:75em">
            <thead>
            <tr>
                <th>ID</th>
                <th>USER NAME</th>
                <th>EMAIL</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@push('page_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.display') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},

                ]
            });

        });
    </script>
@endpush
