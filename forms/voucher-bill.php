<?php
    include("../partials/header.inc.php");
?>

<div class="container-fluid d-flex justify-content-center mt-4 ">
    <h2>Voucher Bill</h2>
</div>
<div class="container">
    <form>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" placeholder="Enter Date">
        </div>
        <div class="form-group">
            <label for="particular">particular</label>
            <textarea class="form-control" id="particular" rows="3" placeholder="Enter particular"></textarea>

        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" id="amount" placeholder="Enter amount">

        </div>
        <div class="container-fluid d-flex justify-content-center m-3">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>
<?php include('../partials/footer.inc.php'); ?>
