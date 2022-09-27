<?php 
require_once "data/con.php"; 
include_once "template/header.php"; 
?>
    <div class="container-xl">
        <div class="alert alert-success d-none succ-msg">successfully registered!</div>
        <h4>Register New Member</h4>
        <form name="frmRegister" id="frmRegister" method="post" action="data/registration.php">
            <div class="row">
                <div class="col-12 my-1">
                    <input type="text" placeholder="First Name*" required id="fname" name="fname" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <input type="text" placeholder="Last Name*" required id="lname" name="lname" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <input type="email" placeholder="Email*" id="email" required name="email" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <input type="text" placeholder="Address" id="address" name="address" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <input type="text" placeholder="Username*" id="username" required name="username" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <input type="password" placeholder="Password*" id="password1" required name="password1" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <input type="password" placeholder="Repeat Password*" id="password2" required name="password2" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <button type="submit" class="btn btn-primary"> Register Member </button>
                    <button type="reset" class="btn btn-secondary"> Cancel </button>
                </div>
            </div>
        </form>
    </div>
    
    <script>
        $(document).ready(function(){
            $('#frmRegister').submit(function(e){
                e.preventDefault();

                if( $("#password1").val()!=$("#password2").val() ){
                    alert("Password is incorrect!");
                }else{
                    $.ajax({
                        url: "data/registration.php",
                        type: "post",
                        data:{
                            "fname": $("#fname").val(),
                            "lname": $("#lname").val(),
                            "email": $("#email").val(),
                            "address": $("#address").val(),
                            "username": $("#username").val(),
                            "password1": $("#password1").val()
                        },
                        /*success:function( msg ){
                            $('.succ-msg').html(msg);
                            $('.succ-msg').removeClass("d-none");
                        },*/
                        error:function(){
                            alert("Error! Something went wrong.");
                        }
                    }).done(function(){
                        $('.succ-msg').removeClass("d-none");
                    });
                }
            })
        })
    </script>

<?php include_once "template/footer.php"; ?>