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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script type="text/javascript">

    //for edit request
    $(document).on("click", ".editVault", function (e) {
        e.preventDefault();
        swal({
            title: "Edit?",
            text: "Please ensure and then confirm!",
            showCancelButton: !0,
            confirmButtonText: "Yes, Edit it!",
            cancelButtonText: "No, cancel!",
            reverseButtons:!0,
        }).then((result) => {
            if(result.value)
            {
                console.log(result);
                $("#myModal").modal('show');
                var url = this.href;
                $(".checkpassword").prop("href", url)
            }
        })
    });

    //password validation for edit
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
                    swal(
                        'Authenticated!',
                        'Wow',
                        'success'
                    )
                    window.location = url

                } else {
                    // alert('Un authenticated');
                    swal(
                        // icon:'error',
                        'Un Authenticated!',
                        'Wrong Password',
                        'warning'
                    )
                }
            }
        });
    });
</script>

