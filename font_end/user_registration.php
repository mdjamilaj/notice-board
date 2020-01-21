<?php require_once("header.inc.php"); ?>


<h1 class="text-primary text-center mt-4"><i class="fas fa-user-plus"></i> Add Student <small>Add New Student</small></h1>

<?php

$link = mysqli_connect('localhost', 'root', '', 'adminlte');

if (isset($_POST['user_registration'])) {

    $name = $_POST['name'];
    $Address = $_POST['Address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $photo = explode('.', $_FILES['photo']['name']);
    $photo = end($photo);
    $photo_name = $phone . "." . $photo;


    $phone_check = mysqli_query($link, "SELECT * FROM users WHERE phone='$phone'");

    if (mysqli_num_rows($phone_check) == 0) {

        $query = "INSERT INTO users(name, Address, email, phone, password, photo) VALUES ('$name', $Address, '$email', '$phone', '$password', '$photo_name')";

        $result = mysqli_query($link, $query);

        if ($result) {
            $success = "Data Insert Success!";
            move_uploaded_file($_FILES['photo']['tmp_name'], 'imgu/' . $photo_name);
        } else {
            $error = "Wrong! Try Again";
        }
    } else {
        $erro_roll = "This Phone number Already Exists!";
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
                <input type="text" id="Address" placeholder="Enter Address" name="Address" required="" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" id="email" placeholder="Enter Email Address" required="" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="tel" id="phone" required="" placeholder="Enter Contact" pattern="01[1|3|4|5|6|7|8|9][0-9]{8}" name="phone" class="form-control">
            </div>
            <div class="form-group"> 
                <input type="password" id="password" required="" placeholder="Enter Password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <div class="form-group">
                    <input id="photo" type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="user_registration" value="Add User" class="btn btn-success btn-block btn-lg">
            </div>
        </form>
    </div>
</div><br>


<?php require_once("footer.inc.php"); ?>