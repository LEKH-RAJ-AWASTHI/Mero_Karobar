<?php
    function GetTransactions($con, $client, $str_date, $end_date){
        // $numArgs = count($args);
    //     $numArgs = func_num_args();
    // echo "Num Args: $numArgs<br>";
    // die();

        $client_id=$client;
        $startDate=$str_date;
        $endDate=$end_date;
        // echo $client_id;
        // echo $startDate;
        // echo $endDate;

        
        //
        if($con!=null && $client_id==null && $startDate==null && $endDate==null){ // form submitted without is set
            $transactions=[];
            // Fetching purchase_bill
            $sql="Select * from purchase_bill";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of purchase bill");
            $purchase_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $purchase_bill_array[]=$row;
            }
            }
            else{
            $purchase_bill_array['empty']=['empty'];
            }
            
            array_push($transactions,$purchase_bill_array);
        
            // Fetching sales_bill
            $sql="Select * from sales_bill";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of Sales bill");
            $sales_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $sales_bill_array[]=$row;
            }
            }
            else{
            $sales_bill_array['empty']=['empty'];
            }
            
            array_push($transactions,$sales_bill_array);
            // prx($sales_bill_array);
        
            // Fetching receipt_bill
            $sql="Select * from receipt_bill";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of receipt bill");
            $receipt_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $receipt_bill_array[]=$row;
            }
            }
            else{
            $receipt_bill_array['empty']=['empty'];
            }
            array_push($transactions,$receipt_bill_array);
        
        
            // Fetching voucher_bill
            $sql="Select * from voucher_bill";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of voucher bill");
            $voucher_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $voucher_bill_array[]=$row;
            }
            }
            else{
            $voucher_bill_array['empty']=['empty'];
            }
            array_push($transactions,$voucher_bill_array);
            // prx($voucher_bill_array);
            return $transactions;
        }

        elseif($con!=null && $client_id!=null && $startDate==null && $endDate==null){ // only client_id is set
            $transactions=[];
            $sql="Select * from purchase_bill where client_id='$client_id'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of purchase bill");
            $purchase_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $purchase_bill_array[]=$row;
            }
            }
            else{
            $purchase_bill_array['empty']=['empty'];
            }
            array_push($transactions,$purchase_bill_array);
        
            // Fetching sales_bill
            $sql="Select * from sales_bill where client_id='$client_id'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of Sales bill");
            $sales_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $sales_bill_array[]=$row;
            }
            }
            else{
            $sales_bill_array['empty']=['empty'];
            }
            array_push($transactions,$sales_bill_array);
            // prx($sales_bill_array);
        
            // Fetching receipt_bill
            $sql="Select * from receipt_bill where client_id='$client_id'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of receipt bill");
            $receipt_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $receipt_bill_array[]=$row;
            }
            }
            else{
            $receipt_bill_array['empty']=['empty'];
            }
            array_push($transactions,$receipt_bill_array);
        
        
            // Fetching voucher_bill
            $sql="Select * from voucher_bill where client_id='$client_id'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of voucher bill");
            $voucher_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $voucher_bill_array[]=$row;
            }
            }
            else{
            $voucher_bill_array['empty']=['empty'];
            }
            array_push($transactions,$voucher_bill_array);
            // prx($voucher_bill_array);
            return $transactions;
        }
        elseif($con!=null && $client_id==null && $startDate!=null && $endDate!=null){ // only date is set //in this if block I forgot to add exclamation mark and it cost me 6 hours to find it
            $transactions=[];
            $sql="Select * from purchase_bill where date>='$startDate' and date<='$endDate'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of purchase bill");
            $purchase_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $purchase_bill_array[]=$row;
            }
            }
            else{
            $purchase_bill_array['empty']=['empty'];
            }
            array_push($transactions,$purchase_bill_array);
        
            // Fetching sales_bill
            $sql="Select * from sales_bill where date>='$startDate' and date<='$endDate'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of Sales bill");
            $sales_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $sales_bill_array[]=$row;
            }
            }
            else{
            $sales_bill_array['empty']=['empty'];
            }
            array_push($transactions,$sales_bill_array);
            // prx($sales_bill_array);
        
            // Fetching receipt_bill
            $sql="Select * from receipt_bill where date>='$startDate' and date<='$endDate'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of receipt bill");
            $receipt_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $receipt_bill_array[]=$row;
            }
            }
            else{
            $receipt_bill_array['empty']=['empty'];
            }
            array_push($transactions,$receipt_bill_array);
        
        
            // Fetching voucher_bill
            $sql="Select * from voucher_bill where date>='$startDate' and date<='$endDate'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of voucher bill");
            $voucher_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $voucher_bill_array[]=$row;
            }
            }
            else{
            $voucher_bill_array['empty']=['empty'];
            }
            array_push($transactions,$voucher_bill_array);
            // prx($voucher_bill_array);
            return $transactions;
        }
        elseif($con!=null && $client_id!=null && $startDate!=null && $endDate!=null){   // all are set
            $transactions=[];
            $sql="Select * from purchase_bill where client_id='$client_id' and date>='$startDate' and date<='$endDate'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of purchase bill");
            $purchase_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $purchase_bill_array[]=$row;
            }
            }
            else{
            $purchase_bill_array['empty']=['empty'];
            }
            array_push($transactions,$purchase_bill_array);
        
            // Fetching sales_bill
            $sql="Select * from sales_bill where client_id='$client_id' and date>='$startDate' and date<='$endDate'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of Sales bill");
            $sales_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $sales_bill_array[]=$row;
            }
            }
            else{
            $sales_bill_array['empty']=['empty'];
            }
            array_push($transactions,$sales_bill_array);
            // prx($sales_bill_array);
        
            // Fetching receipt_bill
            $sql="Select * from receipt_bill where client_id='$client_id' and date>='$startDate' and date<='$endDate'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of receipt bill");
            $receipt_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $receipt_bill_array[]=$row;
            }
            }
            else{
            $receipt_bill_array['empty']=['empty'];
            }
            array_push($transactions,$receipt_bill_array);
        
        
            // Fetching voucher_bill
            $sql="Select * from voucher_bill where client_id='$client_id' and date>='$startDate' and date<='$endDate'";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con)." of voucher bill");
            $voucher_bill_array=[];
            if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $voucher_bill_array[]=$row;
            }
            }
            else{
            $voucher_bill_array['empty']=['empty'];
            }
            array_push($transactions,$voucher_bill_array);
            // prx($voucher_bill_array);
        }
        else{
            echo $client_id;
            echo $startDate;
            echo $endDate;
            echo "Invalid number of arguments";
            die();
        }
        // Fetching all values of transactions
    }

    function CleanArray($transactions){
        foreach($transactions as $index => $transaction) {
            if (count($transaction) === 1 && isset($transaction[0]) && $transaction[0] === 'empty') {
                unset($transactions[$index]);
            }
        }
        return $transactions;
    }

    
    
  ?>