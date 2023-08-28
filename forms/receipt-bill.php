<?php
    include("../partials/header.inc.php");
?>
<!-- ..........Interest Calculation............ Form -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Interest Calculation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row border m-2 p-2 rounded">
                    <label for="principle">Principle</label>
                    <input type="number" class="form-control" name="principle" placeholder="Enter Principle Amount"
                        id="principle">

                    <label for="interest">Interest</label>
                    <input type="number" class="form-control" name="interest" placeholder="Enter Intersest Rate (Eg: 2)"
                        id="interest">

                    <label for="month">Month</label>
                    <input type="number" class="form-control" name="month" placeholder="Enter number of Month"
                        id="month">
                </div>
                <div class="container-fluid d-flex justify-content-center m-3">
                    <button type="button" class="btn btn-primary" id="calculateInterest">Calculate Interest</button>
                </div>
            </div>

            <div class="result mx-lg-5">
                <h5>Interest Amount <span class="badge bg-secondary" id="interest_total"></span></h5>
                <h5>Total Amount <span class="badge bg-secondary" id="amount_total"></span></h5>


            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>


        </div>
    </div>
</div>
<!-- .............END OF INTEREST CALCULATION SECTION....................-->
<?php
    if(isset($_POST['submit']))
    {
        if (!empty($_POST['date'])) {
            $date = get_safe_value($con, $_POST['date']);
        } else {
            $date = date("Y-m-d");
        }
        $client_id=get_safe_value($con, $_POST['client']);
        $particular=get_safe_value($con, $_POST['particular']);
        $amount=get_safe_value($con, $_POST['amount']);

        $sql="INSERT INTO receipt_bill SET
                date='$date',
                client_id='$client_id',
                particular='$particular',
                amount='$amount'
                ";
        $res=mysqli_query($con, $sql) or die(mysqli_error($con));
        
        if($res)
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
    <h2>Receipt Bill</h2>
</div>
<div class="container">
    <form action="" method="POST">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" placeholder="Enter Date">
        </div>
        <div class="form-group">
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
            <label for="particular">particular</label>
            <textarea class="form-control" name="particular" id="particular" rows="3"
                placeholder="Enter particular"></textarea>
        </div>
        <div class="form-group">
            <label for="amount" id="amtLbl">Amount</label>
            <div class="row">
                <div class="col p-1">
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount">
                </div>
                <div class="col-4 p-1">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Calculate Interest ?
                    </button>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex justify-content-center m-3">
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>
<script src="../js/bill-client.js"></script>
<!-- this javascript text is used to add interest field -->
<script type="text/javascript">
    document.getElementById("calculateInterest").addEventListener('click', function () {
        const principle = parseFloat(document.getElementById("principle").value); // Example principal calculation
        const interestRate = parseFloat(document.getElementById("interest").value); // Example interest rate
        const month = parseFloat(document.getElementById("month").value);
        const interest = principle * interestRate / 100 * month;
        amount_input = document.getElementById("amount_total");
        interest_input = document.getElementById("interest_total");
        interest_input.innerHTML=interest;
        amount_input.innerHTML = interest + principle;


    });
</script>
<?php include('../partials/footer.inc.php'); ?>