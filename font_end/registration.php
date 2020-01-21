<?php require_once("header.inc.php"); ?>


<h1 class="text-primary text-center mt-4"><i class="fas fa-user-plus"></i> Add Student <small>Add New Student</small></h1>

<?php

$link = mysqli_connect('localhost', 'root', '', 'adminlte');

if (isset($_POST['add_student'])) {

    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $class = $_POST['class'];
    $pcontact = $_POST['pcontact'];

    $photo = explode('.', $_FILES['photo']['name']);
    $photo = end($photo);
    $photo_name = $roll . "." . $photo;


    $roll_check = mysqli_query($link, "SELECT * FROM student_info WHERE roll='$roll'");

    if (mysqli_num_rows($roll_check) == 0) {

        $query = "INSERT INTO student_info(name, roll, class, contact, photo) VALUES ('$name', '$roll', '$class', '$pcontact', '$photo_name')";

        $result = mysqli_query($link, $query);

        if ($result) {
            $success = "Data Insert Success!";
            move_uploaded_file($_FILES['photo']['tmp_name'], 'img/' . $photo_name);
        } else {
            $error = "Wrong! Try Again";
        }
    } else {
        $erro_roll = "This roll number Already Exists!";
    }
}



?>


<div class="row">
    <?php if (isset($erro_roll)) {
        echo '<h2 class="alert alert-danger col-sm-6 col-sm-offset-3">' . $erro_roll . '</h2>';
    } ?>
    <?php if (isset($success)) {
        echo  '<h2 class="alert alert-success col-sm-6 col-sm-offset-3">' . $success . '</h2>';
    } ?>
    <?php if (isset($error)) {
        echo  '<h2 class="alert alert-danger col-sm-6 col-sm-offset-3">' . $error . '</h2>';
    } ?>
</div>

<div class="container d-flex">
    <div class="col-md-6 col-sm-offset-2 ml-5 pl-5"><br>
        <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group">
                <input type="text" id="name" placeholder="Enter full Name" name="name" required="" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" id="roll" placeholder="Enter Roll" required="" pattern="[0-9]{6}" name="roll" class="form-control">
            </div>
            <div class="form-group">
                <select name="class" class="form-control" required="" id="class">
                    <option value="">Select Class Name</option>
                    <option value="One">One</option>
                    <option value="Two">Two</option>
                    <option value="Three">Three</option>
                    <option value="Four">Four</option>
                    <option value="Five">Five</option>
                    <option value="SIX">SIX</option>
                    <option value="SEVEN">SEVEN</option>
                    <option value="Eight">Eight</option>
                    <option value="Nine">Nine</option>
                    <option value="Ten">Ten</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                    <option value="Degree-1y">Degree-1st_year</option>
                    <option value="houners-1y">houners-1st_year</option>
                </select>
            </div>
            <div class="form-group">
                <input type="tel" id="pcontact" required="" placeholder="Enter Parent Contact" pattern="01[1|3|4|5|6|7|8|9][0-9]{8}" name="pcontact" class="form-control">
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <div class="form-group">
                    <input id="photo" type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="add_student" value="Add Student" class="btn btn-success btn-block btn-lg">
            </div>
        </form>
    </div>
</div><br>


<?php require_once("footer.inc.php"); ?>