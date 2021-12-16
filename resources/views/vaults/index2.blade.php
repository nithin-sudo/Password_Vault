@extends('layouts.app')
@include('vaults.editModal')
@include('vaults.showPasswordModal')
@push('page_styles')
    <style>
        .modal {
            overflow-y: auto;
        }

        .modal-open {
            overflow: auto;
        }
        .modal-close {
            overflow: auto;
        }
        .modal-open[style] {
            padding-right: 0px !important;
        }
    </style>
    @endpush
@section('content')
    <div class="bs-example">
        <div class="bg-light clearfix">
{{--            <h1 style="color:chocolate; font-size:55px;" class="text-center"><b>OMNI-VAULT</b></h1>--}}
            <a class="btn btn-warning float-right ml-2" style="margin-right: 50px" href="{{ route('vaults.create') }}"> Create New Site</a>
            <a class="btn btn-primary float-right" style="margin-left: 50px" href="{{ route('dashboard') }}"> Back to Dashboard</a>
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
                <th>S.No</th>
                <th>Title</th>
                <th>Url</th>
                <th>UserName</th>
                <th>Password</th>
                <th>Action</th>
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

        //datatable
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('vaults.sites') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'title', name: 'title'},
                    {data: 'url', name: 'url'},
                    {data: 'username', name: 'username'},
                    {data: 'password', name: 'password'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });

        //for delete request

        $(document).on("click",".removeVault",function(e) {
            e.preventDefault();
            var url = this.href;
            swal({
                title: "Delete?",
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonColor: "#DD6B55",
                reverseButtons: !0
            }).then((result) => {
                if(result.value)
                {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        method: "GET",
                        success: function (result) {
                            var status = result.status;
                            if (status === 'success') {
                                swal({
                                    title:"Done!",
                                    text:"Deleted Successfully"
                                }).then((result) => {
                                    // if(result.value)
                                    // {
                                        location.reload();
                                    // }
                                })

                            } else {
                                swal("Error!","error");
                            }
                        }
                    })
                }
            })

        });
    </script>
@endpush
