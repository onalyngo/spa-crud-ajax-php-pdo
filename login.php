<?php include_once "template/header.php"; ?>

    <div class="container-xl">
        <div class="alert alert-danger d-none"></div>   
        <h4>Login</h4>
        <form name="frmLogin" id="frmLogin" method="post" action="data/authentication.php">
            <div class="row">
                <div class="col-12 my-1">
                    <input type="text" placeholder="Username" required id="username" name="username" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <input type="password" placeholder="Password" required id="password" name="password" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <button type="submit" class="btn btn-primary"> Login </button>
                </div>
            </div>
        </form>
    </div>

<?php include_once "template/footer.php"; ?>