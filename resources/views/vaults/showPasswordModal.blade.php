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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script type="text/javascript">


    //show password
    $(document).on("click",".showPassword", function (e) {
        e.preventDefault();
        $("#myModal1").modal('show');
        var url = this.href;
        $(".displayPassword").prop("href", url)
    });

    //password validation for show password
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
                    swal(
                        'Authenticated!',
                        'Wow',
                        'success'
                    )
                    $('.showingpassword').html(result.password);
                    $("#myModal2").modal('show');
                }
                else {
                    // alert('Un authenticated');
                    swal(
                        'Un Authenticated!',
                        'Wrong Password',
                        'warning'
                    )
                }
            }
        })
    });

    </script>
