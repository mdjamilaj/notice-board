<?php require_once("header.inc.php"); ?>


<h1 class="text-primary text-center mt-4"><i class="fas fa-user-plus"></i> Add Product <small>Add New Product</small></h1>

<?php

$link = mysqli_connect('localhost', 'root', '', 'adminlte');

if (isset($_POST['add_product'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_status = $_POST['product_status'];

    $photo_name =$_FILES['photo']['name'];

    $name_check = mysqli_query($link, "SELECT * FROM products WHERE product_name ='$product_name'");

    if(mysqli_num_rows($name_check) == 0){


        $query = "INSERT INTO products(product_images, product_name, product_price, status) VALUES ('$photo_name', '$product_name', '$product_price', '$product_status')";

        $result = mysqli_query($link, $query);

        if ($result) {
            $success = "Data Insert Success!";
            move_uploaded_file($_FILES['photo']['tmp_name'], 'imgp/' . $photo_name);
        } else {
            $error = "Wrong! Try Again";
        }
        }else{
        $message = "The Product Is Already added!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}




?>


<div class="row">
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
                <input type="text" id="name" placeholder="Enter Product Name" name="product_name" required="" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" id="name" placeholder="Enter Product Price" name="product_price" required="" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" id="name" placeholder="Enter Product Status" name="product_status" required="" class="form-control">
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <div class="form-group">
                    <input id="photo" type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="add_product" value="Add PRODUCT" class="btn btn-success btn-block btn-lg">
            </div>
        </form>
    </div>
</div><br>


<?php require_once("footer.inc.php"); ?>