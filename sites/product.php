<?php include('partials/header.inc.php'); ?>


    <div class="modal" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Voucher Bill</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="container">
                    <form>
                        <div class="form-group my-3">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Product Name">

                        </div>
                        <div class="container-fluid d-flex justify-content-center m-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>



    <div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Product Page</h2>
    </div>
    <div class="container my-2">
        <div class="buttons" style="width: 300px;">
            <div class="d-grid">
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addProduct">Add Product

                </button>
            </div>
            <br>
        </div>
    </div>


    <div class="container">
        <div class="container search-box pb-3 fs-5">

            <input style="width: 800px" class="p-2" type="search" name="" id="">
            <button class="p-2 px-5" type="submit">Search</button>
        </div>
        <div class="container">


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-block"> Delete</button>
                            <button type="button" class="btn btn-info btn-block"> View Account</button>

                        </td>

                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-block"> Delete</button>
                            <button type="button" class="btn btn-info btn-block"> View Account</button>
                        </td>

                    </tr>
                    <tr>
                        <td>July</td>
                        <td>Dooley</td>
                        <td>july@example.com</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-block"> Delete</button>
                            <button type="button" class="btn btn-info btn-block"> View Account</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


<?php include('partials/footer.inc.php'); ?>  