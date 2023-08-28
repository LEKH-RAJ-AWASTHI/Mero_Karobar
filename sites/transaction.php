<?php include('../partials/header.inc.php'); ?>


<!-- HTML -->
<div>
  <label for="dateFilter">Date Filter:</label>
  <select id="dateFilter">
    <option value="today">Today</option>
    <option value="yesterday">Yesterday</option>
    <option value="last7days">Last 7 Days</option>
    <!-- ... other options ... -->
  </select>
</div>

<div id="transactionList"></div>

<script>
document.getElementById("dateFilter").addEventListener("change", function() {
  const selectedValue = this.value;
  fetch(`/api/transactions/${selectedValue}`)
    .then(response => response.json())
    .then(transactions => {
      displayTransactions(transactions);
    });
});

function displayTransactions(transactions) {
  const transactionList = document.getElementById("transactionList");
  transactionList.innerHTML = "";
  transactions.forEach(transaction => {
    const transactionItem = document.createElement("div");
    transactionItem.textContent = `Transaction ID: ${transaction.id}, Date: ${transaction.date}`;
    transactionList.appendChild(transactionItem);
  });
}
</script>


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




<?php include('../partials/footer.inc.php'); ?>