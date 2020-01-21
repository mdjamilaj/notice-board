<?php require_once("header.inc.php"); ?>


<h1 class="text-primary text-center"><i class="fas fa-user-edit"></i> Update Student Data <small>Jamil Academy</small></h1>

<?php

$link = mysqli_connect('localhost', 'root', '', 'adminlte');

$id =  base64_decode($_GET['id']);
$db_data = mysqli_query($link, "SELECT * FROM `student_info` WHERE `id` = '$id'");
$db_row = mysqli_fetch_assoc($db_data);
if (isset($_POST['update_student'])) {

    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $class = $_POST['class'];
    $pcontact = $_POST['pcontact'];

    
    $query = "UPDATE student_info SET name='$name',roll='$roll',class='$class',contact='$pcontact' WHERE id = '$id'";
    $result = mysqli_query($link, $query);


    if ($result) {
        $success = "Update Seccussful!";
    }else{
        $error = "Your update value wrong! Try Again.";
    }
}
?>


<div class="row">
    <?php if (isset($success)) {
        echo '<h2 class="alert alert-success col-sm-6 col-sm-offset-3">' . $success . '</h2>';
    } ?>
    <?php if (isset($error)) {
        echo '<h2 class="alert alert-danger col-sm-6 col-sm-offset-3">' . $error . '</h2>';
    } ?>
</div>


<div class="container d-flex">
    <div class="col-md-6 col-sm-offset-3"><br>
        <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group">
                <label for="">Full Name:</label>
                <input type="text" value="<?= $db_row['name'] ?>" id="name" placeholder="Enter full Name" name="name" required="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Roll Number:</label>
                <input type="text" value="<?= $db_row['roll'] ?>" id="roll" placeholder="Enter Roll" required="" pattern="[0-9]{6}" name="roll" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Enter Class:</label>
                <input type="text" value="<?= $db_row['class'] ?>" id="class" placeholder="Enter Roll" required="" name="class" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Parent Contact:</label>
                <input type="tel" value="<?= $db_row['contact'] ?>" id="pcontact" required="" placeholder="Enter Parent Contact" pattern="01[1|3|4|5|6|7|8|9][0-9]{8}" name="pcontact" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="update_student" value="Update Student" class="btn btn-success btn-block btn-lg">
            </div>
        </form>
    </div>
</div>


<?php require_once("footer.inc.php"); ?>