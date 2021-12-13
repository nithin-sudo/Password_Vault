@extends('layouts.app')

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
            <h1 style="color:chocolate; font-size:55px;" class="text-center"><b>OMNI-VAULT</b></h1>
            <a class="btn btn-warning float-right ml-2" href="{{ route('vaults.create') }}"> Create New Site</a>
            <a class="btn btn-primary float-right" href="{{ route('dashboard') }}"> Back to Dashboard</a>
        </div>
    </div>


    <!--modal for edit password!-->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <strong>Enter User Password:</strong>
                    <input type="password" name="password" class="form-control passwordclass" style="margin-bottom:30px;" placeholder="Enter Password For Edit">
                    <a style="background-color: #2d3748;margin-right:10px;" href="" class="btn btn-primary checkpassword">Submit</a>
                </div>
            </div>
        </div>
    </div>


    <!--modal for password!-->

    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content !-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <strong>Enter User Password:</strong>
                    <input type="password" name="password" class="form-control passwordclass1" style="margin-bottom: 30px;" placeholder="Enter Password to show">
                    <a style="background-color: green; margin-right: 10px" href="" class="btn btn-primary displayPassword">Submit</a>
                </div>
            </div>
        </div>
    </div>


    <!--modal for display password!-->

    <div class="modal fade " id="myModal2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content !-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <strong>Your Site Password:<p style="color:green;" class="showingpassword"></p></strong>
                </div>
            </div>
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

        $(document).on("click", ".editVault", function (e) {
            e.preventDefault();
            $("#myModal").modal('show');
            var url = this.href;
            $(".checkpassword").prop("href", url)
        });

        $(document).on("click", ".checkpassword", function (e) {
            e.preventDefault();
            var password = ($(".passwordclass").val());
            var url = this.href;
            $.ajax({
                url: "{{route('vaults.password')}}",
                data: {'password': password},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                success: function (result) {
                    var status = result.status;
                    if (status === 'success') {
                        window.location = url
                    } else {
                        alert('Un authenticated');
                    }
                }
            });
        });

        $(document).on("click",".showPassword", function (e) {
            e.preventDefault();
            $("#myModal1").modal('show');
            var url = this.href;
            $(".displayPassword").prop("href", url)

        });

        $(document).on("click",".displayPassword",function (e) {
            e.preventDefault();
            var password = ($(".passwordclass1").val());
            var url = this.href;

            $.ajax({
                url:url,
                data:{'password':password},
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                method:"POST",
                success: function(result){
                    var status = result.status;
                    if(status === 'success') {
                        $("#myModal1").modal('hide');
                        console.log(result.password);
                        $('.showingpassword').html(result.password);
                        $("#myModal2").modal('show');
                    }
                    else {
                        alert('Un authenticated');
                    }
                }
            })
        });


    </script>
@endpush
