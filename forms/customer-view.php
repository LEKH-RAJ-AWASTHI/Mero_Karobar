<?php
include("../partials/header.inc.php");
include("../partials/get-transactions.php");
?>

<?php
// error_reporting(~E_WARNING);

$client_id = get_safe_value($con, $_GET['id']);
// echo $client;
$sql = "Select * from client where client_id=" . $client_id;
$result = mysqli_query($con, $sql) or die(mysqli_error($con) . "  of client");
$client_array = [];
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $client_array[] = $row;
  }
}
// pr($client_array);
// die();
// else{
//   $client_array['empty']=['empty'];
// }
foreach ($client_array as $client) {
  $client_name = $client['name'];
  $client_firm_name = $client['firm_name'];
  $client_pan_number = $client['pan_number'];
  $client_email = $client['email'];
  $client_phone_number = $client['phone_number'];
  $client_image_name = $client['client_img'];
  $client_email = $client['email'];
}

// prx($client_name);
// die();
// $date=date("Y-m-d");

// echo $date;
?>
<div class="client-detail">
  <div class="row m-4">
    <div class="col-1">
      <?php
      // echo $client_image_name;
      if ($client_image_name != '') {
        // display image
        ?>
        <img src="<?php echo SITEURL; ?>images/client/<?php echo $client_image_name ?>" width="70px" alt="Image">
        <?php
      } else {
        // Display the message
        ?>
        <img src="<?php echo SITEURL; ?>images/client/profile-dummy.jpg" width="70px" alt="Dummy Image" srcset="">
        <?php
      }
      ?>
    </div>
    <div class="col-4 mt-2 ">
      <h5>
        <?php echo $client_name; ?>
      </h5>
      <div class="col-6">
        <button type="button" class="btn btn-primary view-profile-btn" data-bs-toggle="modal" data-bs-target="#myModal">
          View Profile
        </button>
      </div>
    </div>
  </div>
  <!-- Profile Modal  -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Profile Information</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="body">
          <div class="client-card">
            <?php
            // echo $client_image_name;
            if ($client_image_name != '') {
              // display image
              ?>
              <img src="<?php echo SITEURL; ?>images/client/<?php echo $client_image_name ?>" width="70px" alt="Image">
              <?php
            } else {
              // Display the message
              ?>
              <img src="<?php echo SITEURL; ?>images/client/profile-dummy.jpg" width="70px" alt="Dummy Image" srcset="">
              <?php
            }
            ?>
            <div class="client-name">
              <?php echo $client_name; ?>
            </div>
            <div class="firm-name">
              <?php echo $client_firm_name; ?>
            </div>
            <div class="client-details">
              <p><strong>Address:</strong> 123 Main Street, City</p>
              <p><strong>PAN Number:</strong>
                <?php echo $client_pan_number; ?>
              </p>
              <p><strong>Contact:</strong>
                <?php echo $client_phone_number; ?>
              </p>
              <p><strong>Email:</strong>
                <?php echo $client_email; ?>
              </p>
            </div>
          </div>
        </div>

      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>


    </div>
  </div>
  <?php
  $transactions = GetTransactions($con, $client_id, null, null);

  $purchase_bill_array = CleanArray($transactions[0]);
  $sales_bill_array = CleanArray($transactions[1]);
  $receipt_bill_array = CleanArray($transactions[2]);
  $voucher_bill_array = CleanArray($transactions[3]);
  // prx($receipt_bill_array);
  
  $all_transactions = array_merge($purchase_bill_array, $sales_bill_array, $receipt_bill_array, $voucher_bill_array);
  // prx($all_transactions);
  usort($all_transactions, function ($a, $b) {
    return strtotime($a['date']) - strtotime($b['date']);
  });
  // prx($all_transactions);
  CleanArray($all_transactions);
  // prx($all_transactions);
  

  ?>

  <div id="all-transaction" class="container mt-5 mb-5">
    <div class="clearfix">
      <h2 class="float-start">Transactions</h2>

      <table class="table table-bordered table-primary">
        <thead>
          <tr>
            <th>Date</th>
            <th>Bill Type</th>
            <th>Particular</th>
            <th>products</th>
            <th>Debit</th>
            <th>Credit</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // if(($purchase_bill_array['empty']==['empty']) && ($sales_bill_array['empty']==['empty']) && ($receipt_bill_array['empty']==['empty']) && ($voucher_bill_array['empty']==['empty'])){
          //     echo "<tr>";
          //     echo '<td colspan="6" style="color: red;" >No data found</td>';
          //     echo "</tr>";
          //   }
          
          // else{
          $debitAmount = 0; // Initialize total debit amount variable
          $creditAmount = 0; // Initialize total credit amount variable
          foreach ($all_transactions as $transaction) {
            // prx($transaction);
            echo "<tr>";
            echo "<td>" . $transaction['date'] . "</td>";
            echo "<td>" . getBillType($transaction, $transactions) . "</td>";
            echo "<td>" . $transaction['particular'] . "</td>";
            // getting the product info from transactional product table
            if (in_array($transaction, $transactions[2]) || in_array($transaction, $transactions[3])) {
              echo "<td></td>"; // Empty product
            } else {

              if (in_array($transaction, $transactions[0])) {
                $sql_product = "Select * from transactional_product where pbid=" . $transaction['purchase_id'];
              } elseif (in_array($transaction, $transactions[1])) {
                $sql_product = "Select * from transactional_product where sbid=" . $transaction['sales_id'];
              }
              $result_product = mysqli_query($con, $sql_product) or die(mysqli_error($con) . "  of transactional product");
              $product_array = [];
              if (mysqli_num_rows($result_product) > 0) {
                while ($row = mysqli_fetch_assoc($result_product)) {
                  $product_array[] = $row;
                }
              }
              // pr($product_array);
              // die();
              else {
                $product_array['empty'] = ['empty'];
              }
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
                  //only the purchase and sales bill has the product
                  if (in_array($transaction, $transactions[0]) || in_array($transaction, $transactions[1])) {
                    echo $product_name['product_name'];
                    echo " (" . $product['quantity'] . "kg x " . $product['rate'] . "/kg)";
                    echo "<br>";
                  }
                }
              }
              echo "</td>";
            }


            // Calculate debit and credit based on bill type
            if (in_array($transaction, $transactions[0]) || in_array($transaction, $transactions[3])) {
              echo "<td>" . $transaction['amount'] . "</td>"; // Debit
              echo "<td></td>"; // Empty Credit
              $debitAmount += $transaction['amount'];

            } elseif (in_array($transaction, $transactions[1]) || in_array($transaction, $transactions[2])) {
              echo "<td></td>"; // Empty Debit
              echo "<td>" . $transaction['amount'] . "</td>"; // Credit
              $creditAmount += $transaction['amount'];

            } else {
              echo "<td></td>";
              echo "<td></td>";
            }

            echo "</tr>";
          }
          echo "<tr>";

          echo "<td colspan='3'><strong>Total</strong></td>";
          if ($debitAmount > $creditAmount) {
            echo "<td colspan=''><strong>Account Receivable = " . ($debitAmount - $creditAmount) . " </strong></td>";
          } elseif ($creditAmount > $debitAmount) {
            echo "<td colspan=''><strong>Account Payble = " . ($creditAmount - $debitAmount) . " </strong></td>";
          } else {
            echo "<td colspan='5'><strong>Balance</strong></td>";
            echo "<td></td>";
            echo "<td></td>";
          }
          echo "<td><strong>" . $debitAmount . "</strong></td>";
          echo "<td><strong>" . $creditAmount . "</strong></td>";
          echo "</tr>";
          // }
          
          ?>
        </tbody>
      </table>
    </div>


    <script src="../js/get-client.js"></script>

    <?php include('../partials/footer.inc.php'); ?>
    <?php
    function getBillType($transaction, $transactions)
    {
      if (in_array($transaction, $transactions[0])) {
        return "Purchase";
      } elseif (in_array($transaction, $transactions[1])) {
        return "Sales";
      } elseif (in_array($transaction, $transactions[2])) {
        return "Receipt";
      } elseif (in_array($transaction, $transactions[3])) {
        return "Voucher";
      } else {
        return "Unknown";
      }
    }
    ?>