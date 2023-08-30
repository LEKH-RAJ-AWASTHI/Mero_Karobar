<?php
include("../partials/header.inc.php");
include("../partials/get-transactions.php");
?>
<?php
// error_reporting(~E_WARNING);

$client = get_safe_value($con, $_GET['client']);
$date = get_safe_value($con, $_GET['date']);
// echo $client;
// echo $date;
?>
<div class="clearfix">
  <div class="float-start">
    <form action="" method="get">
      <div class="row mt-3 ms-4 ">
        <div class="col-2">
          <select style="width:100%" name="date" id="date">
            <option value="">Date</option>
            <option value="today">Today</option>
            <option value="yesterday">Yesterday</option>
            <option value="last 7 days">Last 7 days</option>
            <option value="last 30 days">Last 30 days</option>
            <option value="this year">This year</option>
          </select>
        </div>
        <div class="col-2">
          <select style="width:100%" name="client" id="client">
          </select>
        </div>
        <div class="col-2">
          <input class="btn btn-secondary btn-sm" type="submit" name="submit" value="submit">
        </div>
      </div>
    </form>
  </div>
</div>


<?php
switch ($date) {
  case "today":
    $startDate = date("Y-m-d");
    $endDate = date("Y-m-d");
    break;

  case "yesterday":
    $startDate = date("Y-m-d", strtotime("-1 day"));
    $endDate = date("Y-m-d", strtotime("-1 day"));
    break;

  case "last 7 days":
    $startDate = date("Y-m-d", strtotime("-7 days"));
    $endDate = date("Y-m-d");
    break;
  case "last 30 days":
    $startDate = date("Y-m-d", strtotime("-30 days"));
    $endDate = date("Y-m-d");
    break;
  case "this year":
    $startDate = date("Y-01-01");
    $endDate = date("Y-m-d");
    break;

  default:
    $startDate = null;
    $endDate = null;
    break;
}

if (isset($_GET['submit'])) {
  // echo $client;
  // echo $startDate;
  // echo $endDate;
  // die();
  $transactions = GetTransactions($con, $client, $startDate, $endDate);
} else {
  $transactions = GetTransactions($con, null, null, null);
}
$transactions = CleanArray($transactions);
$purchase_bill_array = CleanArray($transactions[0]);
$sales_bill_array = CleanArray($transactions[1]);
$receipt_bill_array = CleanArray($transactions[2]);
$voucher_bill_array = CleanArray($transactions[3]);

// prx($purchase_bill_array);
?>

<div id="purchase-bill" class="container mt-5">
  <div class="clearfix">
    <h2 class="float-start">Purchase Transactions</h2>
    <div class="float-end me-5 pe-4">
      <div><a style="width: 80%" href="#sales-bill ">Sales Transactions</a></div>
      <div><a style="width: 80%" href="#receipt-bill ">Receipt Transactions</a></div>
      <div><a style="width: 80%" href="#voucher-bill ">Voucher Transactions</a></div>
    </div>
  </div>

  <table class="table table-bordered table-primary">
    <thead>
      <tr>
        <th>DATE</th>
        <th>Client</th>
        <th>Particular</th>
        <th>products</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($purchase_bill_array['empty']) && $purchase_bill_array['empty'] === 'empty') {
        echo "<tr>";
        echo '<td colspan="5" style="color: red;">No data found</td>';
        echo "</tr>";
      } else {
        $totalAmount = 0; // Initialize total amount variable
        foreach ($purchase_bill_array as $purchase_bill) {
          $totalAmount += $purchase_bill['amount'];
          $sql_product = "Select * from transactional_product where pbid=" . $purchase_bill['purchase_id'];
          $result_product = mysqli_query($con, $sql_product) or die(mysqli_error($con) . "  of transactional product");
          $product_array = [];
          if (mysqli_num_rows($result_product) > 0) {
            while ($row = mysqli_fetch_assoc($result_product)) {
              $product_array[] = $row;
            }
          }
          // pr($product_array);
          // die();
          // else{
          //   $product_array['empty']=['empty'];
          // }
          echo "<tr>";
          echo "<td>" . $purchase_bill['date'] . "</td>";
          echo "<td>";
          $sql_client = "Select name from client where client_id=" . $purchase_bill['client_id'];
          $result_client = mysqli_query($con, $sql_client) or die(mysqli_error($con) . "  of client");
          $client_array = [];
          if (mysqli_num_rows($result_client) > 0) {
            while ($row = mysqli_fetch_assoc($result_client)) {
              $client_array[] = $row;
            }
          }
          // pr($client_array);
          // die();
          else {
            $client_array['empty'] = ['empty'];
          }
          foreach ($client_array as $client) {
            if (isset($client['name'])) {
              $name = $client['name'];
              // Now you can use the $name variable without worrying about the warning
              echo "$name";
          } else {
            ?>
              <p style="color: red;"><?php echo "Name not available<br>" ?> </p>
              <?php
          }
          }


          echo "</td>";
          echo "<td>" . $purchase_bill['particular'] . "</td>";
          // getting the product info from transactional product table
      
          echo "<td>";

          foreach ($product_array as $product) {

            $sql_product_name = "Select product_name from product where product_id=" . $product['pid'];
            $result_product_name = mysqli_query($con, $sql_product_name) or die(mysqli_error($con) . "  of product");
            $product_name_array = [];
            if (mysqli_num_rows($result_product_name) > 0) {
              while ($row = mysqli_fetch_assoc($result_product_name)) {
                $product_name_array[] = $row;
              }
            }
            // pr($product_name_array);
            // die();
            else {
              $product_name_array['empty'] = ['empty'];
            }
            foreach ($product_name_array as $product_name) {
              echo $product_name['product_name'];
              echo " (" . $product['quantity'] . "kg x " . $product['rate'] . "/kg)";
              echo "<br>";
            }
          }
          echo "</td>";
          echo "<td>" . $purchase_bill['amount'] . "</td>";
          echo "</tr>";
        }
        echo "<tr>";
        echo "<td colspan='4'><strong>Total</strong></td>";
        echo "<td><strong>" . $totalAmount . "</strong></td>";
        echo "</tr>";
      }

      ?>
    </tbody>
  </table>
</div>
<hr>
<hr>
<div id="sales-bill" class="container mt-5">
  <h2 class="float-start">Sales Transactions</h2>
  <div class="float-end me-5 pe-4">
    <div><a style="width: 80%" href="#purchase-bill ">Purchase Transactions</a></div>
    <div><a style="width: 80%" href="#receipt-bill ">Receipt Transactions</a></div>
    <div><a style="width: 80%" href="#voucher-bill ">Voucher Transactions</a></div>
  </div>
  <table class="table table-bordered table-active">
    <thead>
      <tr>
        <th>Date</th>
        <th>Client</th>
        <th>Particular</th>
        <th>products</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($sales_bill_array['empty']) && $sales_bill_array['empty'] === 'empty') {
        echo "<tr>";
        echo '<td colspan="5" style="color: red;">No data found</td>';
        echo "</tr>";
      } else {
        $totalAmount = 0; // Initialize total amount variable
        foreach ($sales_bill_array as $sales_bill) {
          $totalAmount += $sales_bill['amount'];
          $sql_product = "Select * from transactional_product where sbid=" . $sales_bill['sales_id']; //Now It works. earlier I have not changed pbid to sbid
          // echo $sales_bill['sales_id'];
          $result_product = mysqli_query($con, $sql_product) or die(mysqli_error($con) . "  of transactional product");
          $product_array = [];
          // prx($result_product);
          if (mysqli_num_rows($result_product) > 0) {
            while ($row = mysqli_fetch_assoc($result_product)) {

              $product_array[] = $row;
            }
          }
          // prx($product_array);
          // die();
          else {
            $product_array['empty'] = ['empty'];
          }
          echo "<tr>";
          echo "<td>" . $sales_bill['date'] . "</td>";
          echo "<td>";

          // getting Client name from the client ID
          $sql_client = "Select name from client where client_id=" . $sales_bill['client_id'];
          $result_client = mysqli_query($con, $sql_client) or die(mysqli_error($con) . "  of client");
          $client_array = [];
          if (mysqli_num_rows($result_client) > 0) {
            while ($row = mysqli_fetch_assoc($result_client)) {
              $client_array[] = $row;
            }
          }
          // pr($client_array);
          // die();
          else {
            $client_array['empty'] = ['empty'];
          }
          foreach ($client_array as $client) {
            if (isset($client['name'])) {
              $name = $client['name'];
              // Now you can use the $name variable without worrying about the warning
              echo "$name";
          } else {
            ?>
              <p style="color: red;"><?php echo "Name not available<br>" ?> </p>
              <?php
          }          }


          echo "</td>";
          echo "<td>" . $sales_bill['particular'] . "</td>";
          // getting the product info from transactional product table
      
          echo "<td>";
          foreach ($product_array as $product) {
            $sql_product_name = "Select product_name from product where product_id=" . $product['pid'];
            $result_product_name = mysqli_query($con, $sql_product_name) or die(mysqli_error($con) . "  of product");
            $product_name_array = [];
            if (mysqli_num_rows($result_product_name) > 0) {
              while ($row = mysqli_fetch_assoc($result_product_name)) {
                $product_name_array[] = $row;
              }
            }
            // pr($product_name_array);
            // die();
            else {
              $product_name_array['empty'] = ['empty'];
            }
            foreach ($product_name_array as $product_name) {
              echo $product_name['product_name'];
              echo " (" . $product['quantity'] . "kg x " . $product['rate'] . "/kg)";
              echo "<br>";
            }
          }
          echo "</td>";
          echo "<td>" . $sales_bill['amount'] . "</td>";
          echo "</tr>";



        }
        echo "<tr>";
        echo "<td colspan='4'><strong>Total</strong></td>";
        echo "<td><strong>" . $totalAmount . "</strong></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>
<hr>
<hr>

<div id="receipt-bill" class="container mt-5">
  <h2 class="float-start">Receipt Transactions</h2>
  <div class="float-end me-5 pe-4">
    <div><a style="width: 80%" href="#purchase-bill ">Purchase Transactions</a></div>
    <div><a style="width: 80%" href="#sales-bill ">Sales Transactions</a></div>
    <div><a style="width: 80%" href="#voucher-bill ">Voucher Transactions</a></div>
  </div>
  <table class="table table-bordered table-info">
    <thead>
      <tr>
        <th>Date</th>
        <th>Client</th>
        <th>Particular</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($receipt_bill_array['empty']) && $receipt_bill_array['empty'] === 'empty') {
        echo "<tr>";
        echo '<td colspan="5" style="color: red;">No data found</td>';
        echo "</tr>";
      } else {
        $totalAmount = 0; // Initialize total amount variable
        foreach ($receipt_bill_array as $receipt_bill) {
          $totalAmount += $receipt_bill['amount'];
          echo "<tr>";
          echo "<td>" . $receipt_bill['date'] . "</td>";
          echo "<td>";
          $sql_client = "Select name from client where client_id=" . $purchase_bill['client_id'];
          $result_client = mysqli_query($con, $sql_client) or die(mysqli_error($con) . "  of client");
          $client_array = [];
          if (mysqli_num_rows($result_client) > 0) {
            while ($row = mysqli_fetch_assoc($result_client)) {
              $client_array[] = $row;
            }
          }
          // pr($client_array);
          // die();
          else {
            $client_array['empty'] = ['empty'];
          }
          foreach ($client_array as $client) {
            if (isset($client['name'])) {
              $name = $client['name'];
              // Now you can use the $name variable without worrying about the warning
              echo "$name";
          } else {
            ?>
              <p style="color: red;"><?php echo "Name not available<br>" ?> </p>
              <?php
          }
          }


          echo "</td>";
          echo "<td>" . $receipt_bill['particular'] . "</td>";
          echo "<td>" . $receipt_bill['amount'] . "</td>";
          echo "</tr>";



        }
        echo "<tr>";
        echo "<td colspan='3'><strong>Total</strong></td>";
        echo "<td><strong>" . $totalAmount . "</strong></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>
<hr>
<hr>

<div id="voucher-bill" class="container my-5 ">
  <h2 class="float-start">Voucher Transactions</h2>
  <div class="float-end me-5 pe-4 ">
    <div><a style="width: 80%" href="#purchase-bill">Purchase Transactions</a></div>
    <div><a style="width: 80%" href="#sales-bill ">Sales Transactions</a></div>
    <div><a style="width: 80%" href="#receipt-bill">Receipt Transactions</a></div>
  </div>
  <table class="table table-bordered table-secondary">
    <thead>
      <tr>
        <th>Date</th>
        <th>Client</th>
        <th>Particular</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($voucher_bill_array['empty']) && $voucher_bill_array['empty'] === 'empty') {
        echo "<tr>";
        echo '<td colspan="5" style="color: red;">No data found</td>';
        echo "</tr>";
      } else {
        $totalAmount = 0; // Initialize total amount variable
        foreach ($voucher_bill_array as $voucher_bill) {
          $totalAmount += $voucher_bill['amount'];
          echo "<tr>";
          echo "<td>" . $voucher_bill['date'] . "</td>";
          echo "<td>";
          $sql_client = "Select name from client where client_id=" . $purchase_bill['client_id'];
          $result_client = mysqli_query($con, $sql_client) or die(mysqli_error($con) . "  of client");
          $client_array = [];
          if (mysqli_num_rows($result_client) > 0) {
            while ($row = mysqli_fetch_assoc($result_client)) {
              $client_array[] = $row;
            }
          }
          // pr($client_array);
          // die();
          else {
            $client_array['empty'] = ['empty'];
          }
          foreach ($client_array as $client) {
            if (isset($client['name'])) {
              $name = $client['name'];
              // Now you can use the $name variable without worrying about the warning
              echo "$name";
          } else {
            ?>
              <p style="color: red;"><?php echo "Name not available<br>" ?> </p>
              <?php
          }          }


          echo "</td>";
          echo "<td>" . $voucher_bill['particular'] . "</td>";
          echo "<td>" . $voucher_bill['amount'] . "</td>";
          echo "</tr>";



        }
        echo "<tr>";
        echo "<td colspan='3'><strong>Total</strong></td>";
        echo "<td><strong>" . $totalAmount . "</strong></td>";
        echo "</tr>";

      }
      ?>
  </table>
</div>
<script src="../js/get-client.js"></script>

<?php include('../partials/footer.inc.php'); ?>
<?php

?>