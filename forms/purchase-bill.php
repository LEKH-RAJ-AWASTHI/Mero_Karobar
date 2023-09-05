<?php
    include("../partials/header.inc.php");
?>

<?php
        if(isset($_POST['submit']))
        {
            if (!empty($_POST['date'])) {
                $date = get_safe_value($con, $_POST['date']);
            } else {
                $date = date("Y-m-d");
            }

            $selectedProducts=$_POST['product'];
            $enteredRates=$_POST['rate'];
            $enteredQuantities=$_POST['quantity'];
            // $amount=$rate*$quantity;
            if(!empty($_POST['client'])){
                $client_id=get_safe_value($con, $_POST['client']);
            }
            else{
                $client_id=0;
            }
            $particular=get_safe_value($con, $_POST['particular']);
            //calculating total amount
            $amount=0;
            for($i=0; $i<count($selectedProducts); $i++)
            {
                $amount+=$enteredQuantities[$i]* $enteredRates[$i];
            }


            /*
            ..............debugging values..............
            */

            // echo($date);
            // echo("<br>");
            // pr($product_id);
            // echo("<br>");
            // pr($rate);
            // echo("<br>");
            // pr($quantity);
            // echo("<br>");
            // echo($amount);
            // echo("<br>");
            // echo($client_id);
            // echo("<br>");
            // echo($amount);
            
            // die();

            //.......... purchase bill region..........
            $sql="INSERT INTO purchase_bill SET
                    date='$date',
                    particular='$particular',
                    amount='$amount',
                    client_id=$client_id
                    ";
            $res=mysqli_query($con, $sql) or die(mysqli_error($con));
            //............purchase bill region ends............

            // .............transactional product table entry starts
            $pbid=mysqli_insert_id($con);
            for ($i = 0; $i < count($selectedProducts); $i++) {
                $selectedProduct = $selectedProducts[$i]; //it is product id
                $enteredRate = (float)$enteredRates[$i];
                $enteredQuantity= (float)$enteredQuantities[$i];


                //...........this sql contains sql command for inserting data into transactional product
                $sql1= "INSERT INTO transactional_product SET 
                        pid='$selectedProduct',
                        rate='$enteredRate',
                        quantity='$enteredQuantity',
                        pbid='$pbid'
                        ";
                $res1=mysqli_query($con, $sql1) or die(mysqli_error($con));


                //.............update Stock region
                $sql2= "SELECT stock_level FROM stock WHERE product_id=$selectedProduct";
                $res2= mysqli_query($con, $sql2) or die(mysqli_error($con));
                $row= mysqli_fetch_assoc($res2);

                $stock_available=$row['stock_level'];
                $stock_remaining=$stock_available+$enteredQuantity;
                // ..........debugging stock
                // echo $stock_remaining;
                // die();
                $sqlUpdateStock="UPDATE stock SET stock_level='$stock_remaining' WHERE product_id='$selectedProduct'";
                $resUpdateStock=mysqli_query($con, $sqlUpdateStock) or die(mysqli_error($con));
                //................update stock region ends
        
                //............. Process $selectedProduct and $enteredRate
                // .............For example, insert into a database, perform calculations, etc.
            }
            //..................transactional product table entry Ends                                                                                                                                        );
            


            if($res && $resUpdateStock && $res2)
            {
                $_SESSION['add']='
            
                <div id="add" class="alert alert-success" role="alert">
                Transaction added successfully
                
                </div>';
                header("location:".SITEURL."sites/invoices.php");
            }

            else
            {
                $_SESSION['add']="Failed to add transaction";
                header("location:".SITEURL."sites/invoices.php");
          }
        }
    ?>
<div class="container-fluid d-flex justify-content-center mt-4 ">
    <h2>Purchase Bill</h2>
</div>
<div class="container mb-5" id="bill_form">
    <form action="" method="POST">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Enter Date">
        </div>
        <div class="form-group" >
            <label for="client">Client</label>
            
            <select class="form-control" name="client" id="client" onkeydown="return false" onkeypress="return false" required>

            </select>

        </div>
        <div class="form-group" id="panNumDiv">
            <label for="pan-number">PAN Number</label>
            <input type="number" class="form-control" id="pan_number" placeholder="Enter PAN Number" required>
        </div>
        <div class="form-group" id="panNumDiv">
            <label for="particular">Particular</label>
            <input type="text" class="form-control" id="particular" name="particular" placeholder="Enter Particular">
        </div>

        <div id="error-message" style="display: none;"></div>
        <div id="success-message" style="display: none;"></div>
        <div class="row ">
            <label class="col p-2">Select Products</label>
            <img src="../images/plus-icon.png" style="width: 65px; cursor: pointer;" class="col-1" onclick="addProductField();">
        </div>
        <div class="product-info" id="product-info">
            <div class="row border mt-1 mx-2 p-2 rounded">
                <div class="col">
                <label for="product">Product</label>
                    <div class="form-group">                    
                        <select class="form-control" name="product[]" id="product" required>
        
                        </select>
                    </div>
                </div>  
                <div class="col">
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="number" class="form-control" name="rate[]" id="rate" placeholder="Enter Rate" required>
        
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" name="quantity[]" id="quantity" placeholder="Enter Quantity" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center m-3">
        <input type="submit" class="btn btn-primary" name="submit">
    </div>
    </form>
    
</div>
<script src="../js/bill-client.js"></script>
<script src="../js/get-purchase-price.js"></script>
<script type="text/javascript">
    let count=1;

    function addProductField() {
    const productInfo = document.getElementById("product-info");
    const productNo = generateUniqueProductNo(); // Implement this function

    const productField = `
            <div class="row border m-2 p-2 rounded" id="product-field${productNo}">
                <div class="col">
                    <label for="particular">Product</label>
                    <div class="form-group">                    
                        <select class="form-control" name="product[]" onchange="updateRate(${productNo})" id="product${productNo}" required>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control" name="rate[]" id="rate${productNo}" placeholder="Enter Rate" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" name="quantity[]" id="quantity" placeholder="Enter Quantity" required>
                    </div>
                </div>
            </div>
        `;

    productInfo.insertAdjacentHTML("beforeend", productField);

    // Load product data and populate options
    fetch("../forms/get_price.php")
        .then((response) => response.json())
        .then((data) => {
        const productSelect = document.getElementById(`product${productNo}`);
        if (data["empty"]) {
            productSelect.innerHTML = `<option selected>No Product Found</option>`;
        } else {
            const options = data
            .map(
                (item) =>
                `<option value="${item.product_id}">${item.product_name}</option>`
            )
            .join("");
            productSelect.innerHTML = `<option selected>Select Product</option>${options}`;
        }
        })
        .catch((error) => {
        show_message("error", error);
        });
    }

    function updateRate(productNo) {
    // console.log('clicked');
    const selectedProduct = document.getElementById(`product${productNo}`).value;
    const rateInput = document.getElementById(`rate${productNo}`);

    // console.log('Selected Product:', selectedProduct); // Debugging: Check the selected product value

    // Fetch the price for the selected product and populate the rate field
    fetch("../forms/get_price.php")
        .then((response) => response.json())
        .then((data) => {
        const selectedProductData = data.find(item => item.product_id === selectedProduct);
        if (selectedProductData) {
            rateInput.value = selectedProductData.purchase_price;
            rateInput.disabled = false;
        } else {
            rateInput.value = 0;
            show_message('error', 'Cannot find a matching product');
        }
        // console.log(data);
        })
        .catch((error) => {
        show_message("error", error);
        });
    }

    function generateUniqueProductNo() {
    // Your implementation to generate a unique number goes here
    // For example:
    return Math.floor(Math.random() * 1000);
    }

</script>
<?php include('../partials/footer.inc.php'); ?>
