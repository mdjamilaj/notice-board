<?php require_once("header.inc.php"); ?>
<?php

// session_start();

$link = mysqli_connect('localhost', 'root', '', 'adminlte');

$query = mysqli_query($link, "SELECT * FROM products");

if(isset($_POST['submit'])){
    $id =  $_POST['product_id'];

    $product_data = mysqli_query($link, "SELECT * FROM `products` WHERE `id` = '$id'");
    $product_row = mysqli_fetch_assoc($product_data);


    $product_name = $product_row['product_name'];
    $product_quentity = $_POST['product_quentity'];
    $product_price = $product_row['product_price'];
    $product_images = $product_row['product_images'];


    $name_check = mysqli_query($link, "SELECT * FROM sell WHERE product_id ='$id'");


if(mysqli_num_rows($name_check) == 0){

    $query = "INSERT INTO sell(product_id, product_quentity, product_price) VALUES ('$id', $product_quentity, '$product_price')";

        $result = mysqli_query($link, $query);

        if($result){
           echo '<script> location.replace("sell.php"); </script>';
        }
    }else{
        $message = "The Product Is Already added!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

}






if(isset($_POST['sell'])){

    $id =  $_POST['user_id'];



    $total = 0;

            $db_sinfo = mysqli_query($link, "SELECT * FROM sell INNER JOIN products ON sell.product_id = products.id");
            while ($row = mysqli_fetch_assoc($db_sinfo)) {


                $total = $total + ($row['product_quentity'] * $row['product_price']);

             }



            $user_id = $id;
            $total_price = $total;
            $discount_op = $_POST['discount_op'];


            $texi_bill =  $_POST['texi_bill'];
            if ($discount_op == 1) {
                $discount = (($total_price/100)*$_POST['discount']);
            }else{
                $discount =  $_POST['discount'];
            }

            

            $query = "INSERT INTO invoice(user_id, total_price, texi_bill, discount) VALUES ('$user_id', '$total_price','$texi_bill', '$discount')";

            $result = mysqli_query($link, $query);


            //invoice id 

            $invoice_data = mysqli_query($link, "SELECT * FROM invoice ORDER BY id DESC LIMIT 1");
            $invoice_row = mysqli_fetch_assoc($invoice_data);

            $invoice_id = $invoice_row['id'];


            $db_sinfo = mysqli_query($link, "SELECT * FROM sell INNER JOIN products ON sell.product_id = products.id");
            while ($row = mysqli_fetch_assoc($db_sinfo)) {

                $product_id = $row['product_id'];
                $product_quentity = $row['product_quentity'];
                $product_price = $row['product_price'];


                $query = "INSERT INTO sell_detials(product_id, product_quentity, product_price, invoice_id) VALUES ('$product_id', '$product_quentity','$product_price', '$invoice_id')";

                $result = mysqli_query($link, $query);

             }




    $db_sell = mysqli_query($link, "SELECT * FROM sell");
        
        while ($row = mysqli_fetch_assoc($db_sell)) {

            $id = $row['id'];
            mysqli_query($link, "DELETE FROM sell WHERE id = '$id'");
    }
    echo "<script type='text/javascript'>window.open('pdf.php?invoice_id=".$invoice_id."');</script>";
}



?>

            <form action="" method="post">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 ml-4 mt-4 lg col-sm-offset-1">
                        
                            <div class="form-group">
                                <select class="form-control" name="product_id" required="" id="class">
                                    <option value="" style="font-weight: bold; font-size: 20px;">Select Product Name</option>
                                    <?php
                                        $result = $query;
                                         while($rowp = mysqli_fetch_assoc($result)){
                                    ?>
                                        <option value="<?php echo $rowp['id'] ?>"><?php echo $rowp['product_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="col-sm-4 ml-4 mt-4 lg col-sm-offset-1">
                        <div class="form-group">
                            <input class="form-control" type="text" name="product_quentity" required="" placeholder="Enter Quentity">
                        </div>
                    </div>
                    <div class="col-sm-2 ml-4 mt-4 lg">
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-info" value="submit" name="submit">submit <i class="fas fa-shopping-cart"></i></button>
                            </div>
                    </div>
                </div>
            </div>
        </form>



<div class="table-responsive">
    <table id="data" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>P-Name</th>
                <th>P-Quentity</th>
                <th>P-Price</th>
                <th>P-image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php

                $total = 0;
            $db_sinfo = mysqli_query($link, "SELECT * FROM sell INNER JOIN products ON sell.product_id = products.id");
            while ($row = mysqli_fetch_assoc($db_sinfo)) { ?>
                <tr>
                    <td><?php echo ucwords($row['product_name']); ?></td>
                    <td><?php echo ($row['product_quentity']); ?></td>
                    <td><?php echo $row['product_price']; ?></td>
                    <td><img style="width: 60px; height:50px;" src="imgp/<?php echo $row['product_images']; ?>" alt=""></td>
                    <td>
                        <a href="delete_sell_pro.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-danger"><i class="fas fa-shopping-cart"></i> Delete</a>
                    </td>
                </tr>

            <?php

                $total = $total + ($row['product_quentity'] * $row['product_price']);

             } ?>

             <tr>
                 <td colspan="2" align="right">Total</td>
                 <td colspan="3">$ <?php echo number_format($total, 2); ?></td>
             </tr>

        </tbody>
    </table>
</div>




<form action="" method="post">
                <div class="container">
                    <div class="row">
                    <div class="col-sm-4 ml-4 mt-4 lg col-sm-offset-1">
                            <div class="form-group">
                                <select class="form-control" name="user_id" id="class" required="">
                                    <option value="" style="font-weight: bold; font-size: 20px;">Select Customer Name</option>
                                    <?php
                                        $query = mysqli_query($link, "SELECT * FROM users");
                                         while($rowc = mysqli_fetch_assoc($query)){
                                    ?>
                                        <option value="<?php echo $rowc['id'] ?>"><?php echo $rowc['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                    </div>
                    <div class="col-sm-4 ml-4 mt-4 lg col-sm-offset-1">
                        <td><input type="text" name="texi_bill" placeholder="Enter Taxi Bill" required="" class="form-control"></td>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 ml-4 mt-4 lg col-sm-offset-1">
                        <td class="form-control">
                            <input type="text" name="discount" placeholder="Enter Discount" required="">
                                <span class="ml-1"><input type="checkbox" name="discount_op" value="1" >%</span>
                        </td>
                    </div>
                    <div class="col-sm-4 ml-4 mt-4 lg col-sm-offset-1">
                    <td><button class="btn btn-success btn-block" name="sell" value="sell">SELL</button></td>
                </div>
                </div>
            </div>
        </form>




<?php require_once("footer.inc.php"); ?>