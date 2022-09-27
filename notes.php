<?php
require_once "data/con.php";

if( !isset($_SESSION["user"]) ):
    header("location: login.php");
endif;

$query = $db->prepare( "SELECT * FROM personal_notes WHERE user_id=:id ORDER BY id DESC" );
$query->execute(
    [
        "id" => $_SESSION["user"]
    ]
);
?><?php include_once "template/header.php"; ?>
    <div class="container-xl">
        <div class="alert alert-success d-none"></div>
        <h4>My Personal Notes</h4>
        <form name="frmNote" id="frmNote" method="post" action="data/notes.php" class="mb-4">
            <input type="hidden" name="csrf" id="csrf" value="<?php echo $_SESSION["CSRF_TOKEN"] ?>" />
            <div class="row">
                <div class="col-12 my-1">
                    <input type="text" placeholder="Title" required id="title" name="title" class="form-control" />
                </div>
                <div class="col-12 my-1">
                    <textarea id="content" placeholder="Content" name="content" class="form-control"></textarea>
                </div>
                <div class="col-12 my-1">
                    <button type="submit" class="btn btn-primary"> Save </button>
                    <button type="reset" class="btn btn-secondary"> Cancel </button>
                </div>
            </div>
        </form>
        <?php foreach( $query as $key=>$row ): ?>
            <div class="row border border-top-0 border-right-0 border-left-0 mt-1 pb-2">
                <div class="col-6 my-1">
                    <h5><?=$row["title"]?></h5>
                </div>
                <div class="col-6 my-1 text-right">
                    <?=$row["created_at"]?>
                </div>
                <div class="col-12 my-1">
                    <em><?=$row["content"]?></em>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    
<?php include_once "template/footer.php"; ?>