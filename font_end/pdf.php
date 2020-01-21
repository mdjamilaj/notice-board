<?php

$link = mysqli_connect('localhost', 'root', '', 'adminlte');

$invoice_id = $_GET['invoice_id'];

$invoice_data = mysqli_query($link, "SELECT * FROM invoice WHERE id = '$invoice_id'");
$invoice_row = mysqli_fetch_assoc($invoice_data);

$date_time = $invoice_row['date_time'];
$texi_bill = $invoice_row['texi_bill'];
$discount = $invoice_row['discount'];


?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/style.css">
  <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>

<div class="w-66 mt-2" style="width: 68% !important;  margin: auto !important;">
	
<!-- 	<h4 class="pull-right"><?php echo $date_time; ?></h4>
	<table class="table">
		
	</table> -->

		<header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <h1>INVOICE</h1>
      <div id="company" class="clearfix">
        <div style="font-size: 20px; font-weight: bold;color: red; font-family: Arial, Helvetica, sans-serif;">AJ Shopping</div>
        <div>455 Foggy Heights,<br /> Zindabazar, Sylhet</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:mdjamilaj@mail.com">mdjamilaj@mail.com</a></div>
      </div>
      <div id="project">

		<?php

			$db_customer = mysqli_query($link, "SELECT * FROM invoice INNER JOIN users ON invoice.user_id = users.id WHERE invoice.id = '$invoice_id'");
			$db_row = mysqli_fetch_assoc($db_customer);

		?>


        <div><span>INVOICE# :</span> <?php echo $invoice_id; ?></div>
        <div><span>Customer :</span> <?php echo $db_row['name']; ?></div>
        <div><span>ADDRESS :</span> <?php echo $db_row['address']; ?></div>
        <div><span>EMAIL :</span> <a href="mailto:john@example.com"><?php echo $db_row['email']; ?></a></div>
        <div><span>Phone :</span> <?php echo $db_row['phone']; ?></div>
        <div><span>DATE :</span> <?php echo $invoice_row['date_time']; ?></div>
      </div>
      
    </header>
    <main>
      <div class="table-responsive">
      <table class="table borderless">
        <thead>
          <tr>
            <th class="service">Name</th>
            <th class="desc">status</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
        	<?php

                $total = 0;
            $db_sinfo = mysqli_query($link, "SELECT * FROM sell_detials INNER JOIN products ON sell_detials.product_id = products.id WHERE invoice_id = '$invoice_id'");
            while ($row = mysqli_fetch_assoc($db_sinfo)) { ?>
                <tr>
                    <td class="service"><?php echo ucwords($row['product_name']); ?></td>
                    <td class="desc" style="max-width: 200px !important"><?php echo ($row['status']); ?></td>
                    <td class="unit"><?php echo $row['product_price']; ?></td>
                    <td class="qty"><?php echo ($row['product_quentity']); ?></td>
                    <td class="total">$<?php echo number_format(($row['product_quentity'] * $row['product_price']),2); ?></td>
                </tr>

            <?php

                $total = $total + ($row['product_quentity'] * $row['product_price']);

             } ?>
          <tr>
            <td colspan="4" class="pull-right">SUBTOTAL :</td>
            <td class="pull-right">$ <?php echo number_format($total, 2); ?></td>
          </tr>
          <tr>
            <td colspan="4" class="pull-right">TAX-Bill :</td>
            <td class="pull-right">$ <?php echo number_format($texi_bill, 2); ?></td>
          </tr>
          <tr>
            <td colspan="4" class="pull-right">Discount :</td>
            <td class="pull-right">$ <?php echo number_format($discount, 2); ?></td>
          </tr>
          <tr>
            <td colspan="4" class="grand total" style="font-weight: bold; font-size: 20px">GRAND TOTAL</td>
            <td class="grand total" style="font-weight: bold; font-size: 20px">$ <?php echo number_format((($total+$texi_bill)-$discount), 2); ?></td>
          </tr>
        </tbody>
      </table>
      </div>
      <div id="notices" class="text-center mt-5">
      	<div class="mb-3" style="font-weight: bold; font-size: 20px">
		      		<?php

							$total = number_format((($total+$texi_bill)-$discount), 2); 
							echo getIndianCurrency($total); 

					?> only
      	</div>
        <div style="font-size: 20px; font-weight: bold;color: red; font-family: Arial, Helvetica, sans-serif;">AJ SHOPPING</div>
        <p style="font-weight: bold;color: black;">455 Foggy Heights, AZ 85004, Sylhet</p><hr>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
</div>

</body>
</html>















<?php



function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Sense' : '';
    return ($Rupees ? $Rupees . 'Dollar ' : '') . $paise;
}

?>


