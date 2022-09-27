<?php
require_once "data/con.php";

if( !isset($_SESSION["user"]) ):
    header("location: login.php");
endif;

?><?php include_once "template/header.php"; ?>
    <div class="container-xl">
        <div class="alert alert-success d-none"></div>
        <h4>Members</h4>
        <button class="btn btn-success add-member">Add new member</button>
        <div class="my-4 garyboy" style="display: none">
            <h5 class="myembro">Register New Member</h5>
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
                    <input type="hidden" name="userid" id="userid" />
                    
                    <button type="button" class="myembroButoks btn btn-primary"> Register Member </button>
                    <button type="button" class="btn btn-secondary"> Cancel </button>
                </div>
            </div>
        </div>
        <div class="members">
            
        </div>
    </div>

    <script>
        let memData = "";
        $(document).ready(function(){
            listMembers();

            $('.myembroButoks').click(function(e){
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
                            "password1": $("#password1").val(),
                            "id": $("#userid").val()
                        },
                        error:function(){
                            alert("Error! Something went wrong.");
                        }
                    }).done(function(){
                        $('.garyboy').slideUp("fast");
                        $(".members").html("");
                        listMembers();                        
                    });
                }
            })
        })

        function listMembers()
        {
            $.ajax({
                url: "data/members.php",
                type: "get",
                data:{
                    type:"list"
                },
                dataType: "json",
                success:function( data ){
                    $(data).each(function(i, item){
                        memData = '<div data-row-id="'+item.id+'" class="row"><div class="col-3 my-1">' +item.fname+ ' ' +item.lname+ '</div>' +
                                  '<div class="col-3 my-1">' +item.email+ '</div>' +
                                  '<div class="col-3 my-1">' +item.created_at+ '</div>' +
                                  '<div class="col-1 my-1"><button data-id="'+item.id+'" class="editBtn btn btn-info">edit</button></div>' +
                                  '<div class="col-1 my-1"><button data-id="'+item.id+'" class="deleteBtn btn btn-danger">delete</button></div></div>'
                        $('.members').append(memData);
                    });

                    $('.editBtn').on("click", function(){
                        let usrid = $(this).data("id");
                        $.ajax({
                            url: "data/members.php",
                            type: "get",
                            data:{
                                type: "edit",
                                id: usrid
                            },
                            dataType:"json",
                            success:function( data ){
                                $("#fname").val(data.fname)
                                $("#lname").val(data.lname)
                                $("#email").val(data.email)
                                $("#address").val(data.address)
                                $("#username").val(data.username)
                                $("#userid").val(data.id)
                                
                            }
                        }).done(function(){
                            $(".myembro").html("Edit Data");
                            $(".myembroButoks").html("Update Data");
                            
                            $(".garyboy").slideDown("slow");
                        })
                    });

                    $('.deleteBtn').on("click", function(){
                        let usrid = $(this).data("id");
                        $.ajax({
                            url: "data/members.php",
                            type: "post",
                            data:{
                                type: "delete",
                                id: usrid
                            }
                        }).done(function(){
                            $("[data-row-id="+usrid+"]").hide()
                        })
                    });

                    $('.add-member').on("click", function(){
                        $('.garyboy').slideDown("slow");
                    })
                    $('.btn-secondary').on("click", function(){
                        $('.garyboy').slideUp("slow");
                    })
                    
                }
            });
        }
    </script>

<?php include_once "template/footer.php"; ?>