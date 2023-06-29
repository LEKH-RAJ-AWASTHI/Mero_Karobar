<?php
    include("../partials/header.inc.php");
?>

<div class="container-fluid d-flex justify-content-center mt-4 ">
    <h2>Sales Bill</h2>
</div>
<div class="container">
    <form>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" placeholder="Enter Date">
        </div>
        <div class="form-group">
            <label for="particular">Client</label>
            
            <select class="form-control" id="client">
                <option selected>Select Client</option>
                <option>Client 1</option>
                <option>Client 2</option>
                <option>Client 3</option>
                <option>Client 4</option>
            </select>

        </div>
        <div class="form-group">
            <label for="pan-number">PAN Number</label>
            <input type="text" class="form-control" id="pan-number" placeholder="Enter PAN Number">

        </div>
        <div class="form-group">
            <label for="particular">product</label>
            
            <select class="form-control" id="product">
                <option selected>Select Product</option>
                <option>Product 1</option>
                <option>Product 2</option>
                <option>Product 3</option>
                <option>Product 4</option>
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>
<?php include('../partials/footer.inc.php'); ?>
