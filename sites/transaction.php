<?php include('partials/header.inc.php'); ?>


    <div class="dropdown m-3">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            Select Duration: </button>
        <ul class="dropdown-menu">
            <li>
                <h5 class="dropdown-header">Select Duration</h5>
            </li>
            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">Yesterday</a></li>
            <li><a class="dropdown-item" href="#">Last 7 days</a></li>
            <li><a class="dropdown-item" href="#">Last 30 days</a></li>
            <li><a class="dropdown-item" href="#">Last 90 days</a></li>
            <li><a class="dropdown-item" href="#">This month</a></li>
            <li><a class="dropdown-item" href="#">This year</a></li>
            <li><a class="dropdown-item" href="#">Custom date range</a></li>
        </ul>
    </div>

    <!-- <div class="container">
        <div class="m-5 ">
            Duration:
            <select name="duration" id="">
                <option value="none" selected>Select duration</option>
                <option value="today">Today</option>
                <option value="yesterday">Yesterday</option>
                <option value="last 7 days">Last 7 days</option>
                <option value="last 30 days">last 30 days</option>
                <option value="last 90 days">last 90 days</option>
                <option value="this month">This month</option>
                <option value="this year">This Year</option>
                <option value="custom date range">Custom</option>
            </select>
    
        </div> -->

    <div class="container-fluid m-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>


                </tr>
                <tr>
                    <td>Mary</td>
                    <td>Moe</td>
                    <td>mary@example.com</td>


                </tr>
                <tr>
                    <td>July</td>
                    <td>Dooley</td>
                    <td>july@example.com</td>

                </tr>
            </tbody>
        </table>
    </div>




<?php include('partials/footer.inc.php'); ?>