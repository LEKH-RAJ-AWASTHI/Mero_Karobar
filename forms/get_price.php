<?php
include("../config/connection.inc.php");
$sqlProduct="SELECT product_id FROM product";
$res=mysqli_query($con, $sqlProduct);
$num_of_product=mysqli_num_rows($res);

$sql = "SELECT product_id, product_name, purchase_price, sales_price
FROM (
    SELECT p.product_id, p.product_name, pr.purchase_price, pr.sales_price,
           ROW_NUMBER() OVER (PARTITION BY p.product_id ORDER BY pr.effective_date DESC, pr.id DESC) AS row_num
    FROM product p
    JOIN price pr ON p.product_id = pr.product_id
    WHERE pr.effective_date <= CURDATE()
) AS subquery
WHERE row_num = 1;
";
$result = mysqli_query($con, $sql);
$output = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row; // Append each row to the $output array
    }
} else {
    $output['empty'] = ['empty'];
}

mysqli_close($con);

echo json_encode($output);
?>