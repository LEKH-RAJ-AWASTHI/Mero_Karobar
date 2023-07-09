<?php
    include("../partials/header.inc.php");
?>

<div class="container-fluid d-flex justify-content-center mt-4 ">
    <h2>Purchase Bill</h2>
</div>
<div class="container" id="bill_form">
    <form>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" placeholder="Enter Date">
        </div>
        <div class="form-group" >
            <label for="particular">Client</label>
            
            <select class="form-control" name="client" id="client">

            </select>

        </div>
        <div class="form-group" id="panNumDiv">
            <label for="pan-number">PAN Number</label>
            <input type="text" class="form-control" id="pan_number" placeholder="Enter PAN Number">
        </div>
        <div id="error-message" style="display: none;"></div>
        <div id="success-message" style="display: none;"></div>
        <div class="form-group">
            <label for="particular">product</label>
            
            <select class="form-control" id="product">

            </select>

        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control" id="quantity" placeholder="Enter Quantity">

        </div>
        <div class="form-group">
            <label for="rate">Rate</label>
            <input type="text" class="form-control" id="rate" placeholder="Enter Rate">

        </div>
        <div class="container-fluid d-flex justify-content-center m-3">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </div>
    </form>
    <?php
        if(isset($_POST['submit']))
        {
            echo("hello world");
        }
    ?>
</div>
<script src="../js/bill-client.js"></script>
<script src="../js/get-purchase-price.js"></script>
<?php include('../partials/footer.inc.php'); ?>
