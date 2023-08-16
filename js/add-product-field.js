function addProductField() {
  const productInfo = document.getElementById("product-info");
  const productNo = generateUniqueProductNo(); // Implement this function

  const productField = `
        <div class="row border m-2 p-2 rounded" id="product-field${productNo}">
            <div class="col">
                <label for="particular">Product</label>
                <div class="form-group">                    
                    <select class="form-control" name="product" onchange="updateRate(${productNo})" id="product${productNo}">
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="rate">Rate</label>
                    <input type="text" class="form-control" name="rate" id="rate${productNo}" placeholder="Enter Rate">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">
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
    productNo++;
}

function generateUniqueProductNo() {
  // Your implementation to generate a unique number goes here
  // For example:
  return Math.floor(Math.random() * 1000);
}
