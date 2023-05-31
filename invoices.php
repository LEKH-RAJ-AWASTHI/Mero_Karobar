<?php include('partials/header.inc.php'); ?>
    <!-- purchase bill -->
    <div class="forms mt-5 pt-5">
      <!-- The Modal -->
      <div class="modal" id="purchaseModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Purchase Bill</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
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
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>

      <!-- sales bill -->
      
      <!-- The Modal -->
      <div class="modal" id="salesModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Sales Bill</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
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
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>

      <!-- //voucher bill -->
      
      <!-- The Modal -->
      <div class="modal" id="voucherModal">
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
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>

        <!-- //receipt bill -->
          
          <!-- The Modal -->
          <div class="modal" id="receiptModal">
            <div class="modal-dialog">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Receipt Bill</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
          
                <!-- Modal body -->
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
          
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
          
              </div>
            </div>
          </div>
        </div>

    <div class="body">

        <div class="container mt-3">
            <h2 class="mt-5 pt-5">Invoices</h2>

            <div class="d-flex justify-content-around">
                <div class="row">

                    <div class="card m-3 shadow" style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Purchase Bill</h4>
                            </div>
                            <button href="customer.html" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#purchaseModal">View
                                
                            </button>

                        </div>
                    </div>
                    <div class="card m-3 shadow" style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Sales Bill</h4>
                            </div>
                            <button href="#" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#salesModal">View
                                
                            </button>

                        </div>
                    </div>
                    <div class="card m-3 shadow " style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Voucher Bill</h4>
                            </div>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#voucherModal">View
                                
                            </button>

                        </div>
                    </div>

                    <div class="card m-3 shadow " style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Receipt Bill</h4>
                            </div>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#receiptModal">View
                                
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php include('partials/footer.inc.php'); ?>