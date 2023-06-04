<?php include('partials/header.inc.php'); ?>


    
    <div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Account Page</h2>
    </div>

    <div class="row">
        <a class="col" href="#">Add product Account</a>
        <a class="col" href="#">Add vendor Account</a>
        <a class="col" href="#">Add customer Account</a>
    </div>
 


    <div class="container-fluid">
        <input type="search" name="" id="">
        <button type="submit">Search</button>
    </div>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Column 1</th>
                    <th scope="col">Column 2</th>
                    <th scope="col">Column 3</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="row">R1C1</td>
                    <td>R1C2</td>
                    <td>R1C3</td>
                </tr>
                <tr class="">
                    <td scope="row">Item</td>
                    <td>Item</td>
                    <td>Item</td>
                </tr>
            </tbody>
        </table>
    </div>

   <?php include('partials/footer.inc.php'); ?>