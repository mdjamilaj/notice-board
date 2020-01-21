
<?php require_once("header.inc.php"); ?>

<?php

// session_start();

$link = mysqli_connect('localhost', 'root', '', 'adminlte');

$query = mysqli_query($link, "SELECT * FROM products");

if(isset($_GET['add'])){

    if(isset($_SESSION['cart'])){
        $session = array();
        $session = $_SESSION['cart'];
        $check = 0;

        foreach ($session as $key => $value) {
            if($_GET['add'] == $value){
                $check = 0;
                $msg = "The Product Already Add to cart";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                    echo "<script>window.location = 'index.php'</script>";
                break;
            }else{
                $check = 1;
            }
        }if($check == 1){
            array_push($session, $_GET['add']);
            $session = $_SESSION['cart'];
        }
    }else{
        $product = array();
        $product[0] = $_GET['add'];
        $_SESSION['cart'] = $product;
    }
}


?>

<div class="container">
    <div class="row text-center py-5">
        <?php
            $result = $query;
            while($row = mysqli_fetch_assoc($result)){
                component($row['product_name'],$row['product_price'],$row['product_images'],$row['status'],$row['id']);
            }
        ?>
    </div>
</div>


<?php

function component($productname,$productprice,$productimg,$productstatus,$productid){
    $element='
    
    <div class="col-md-3 col-sm-6 my-5 my-md-0">
            <form action="index.php" method="POST">
            <div class="card shadow mb-5">
            <div>
            <img src="imgp/'.$productimg.'" alt="Image" class="img-fluid card-img-top">
            </div>
            <div class="card-body">
                <h3 class="text-center" style="font-weight: bold; font-size: 20px; color: #111">' . $productname . '</h3>
                <p class="card-text">' . $productstatus . '</p>
                <h5>
                    <span class="price"> $' . $productprice .' </span>
                </h5>
                <a type="submit" class="bag-btn"  data-id='.$productid.' href="index.php?add='.$productid.'">Add to Cart <i class="fas fa-shopping-cart"></i></a>
                <input type="hidden" name="product_id" value="' . $productid .'">
            </div>
            </div>
            </form>
        </div>
    ';
    echo $element;
}

?>


<?php require_once("footer.inc.php"); ?>