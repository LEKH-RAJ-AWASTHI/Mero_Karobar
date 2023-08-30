<?php include('../partials/header.inc.php'); ?>

<?php
    if(isset($_SESSION['add'])){
      echo $_SESSION['add']; //Displaying session message
      unset($_SESSION['add']); //removing session message
    }
    if(isset($_SESSION['delete'])){
      echo $_SESSION['delete']; //Displaying session message
      unset($_SESSION['delete']); //removing session message
    }
    if(isset($_SESSION['remove'])){
      echo $_SESSION['remove']; //Displaying session message
      unset($_SESSION['remove']); //removing session message
    }
    if(isset($_SESSION['client-not-exist'])){
      echo $_SESSION['client-not-exist']; //Displaying session message
      unset($_SESSION['client-not-exist']); //removing session message
    }
    if(isset($_SESSION['update'])){
      echo $_SESSION['update']; //Displaying session message
      unset($_SESSION['update']); //removing session message
    }
    if(isset($_SESSION['upload'])){
      echo $_SESSION['upload']; //Displaying session message
      unset($_SESSION['upload']); //removing session message
    }
    if(isset($_SESSION['db-error'])){
      echo $_SESSION['db-error']; //Displaying session message
      unset($_SESSION['db-error']); //removing session message
    }
    ?>

    <div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Customer Page</h2>
    </div>
    <div class="container my-3">
        <div class="buttons" style="width: 300px;">

            <a href="<?php echo SITEURL; ?>forms/add-client.php"> 
                <button class="btn btn-primary mt-3" >Add Client</button>
            </a>
            
            <br>
        </div>
    </div>

<?php //search button ?>
    <!-- <div class="container">
        <div class="container search-box pb-3 p-0 fs-5">

            <input style="width: 800px" class="p-2" type="search" name="" id="">
            <button class="p-2 px-5" type="submit">Search</button>
        </div> -->
        <div class="container mb-5"> 


            <table class="table table-bordered">
                <thead>
                    
                        <th>S.No</th>
                        <th>Customer Name</th>
                        <th>Firm Name</th>
                        <th>Address</th>
                        <th>PAN Number</th>
                        <th>Email</th>
                        <th>Phone Number </th>
                        <th>Image</th>
                </thead>
                <tbody>
                <?php
                $sql="SELECT * FROM client";
                $res= mysqli_query($con,$sql);

                if($res){
                    //count rows
                    $count=mysqli_num_rows($res);// function to show the number of rows
                    if($count>0)
                    {
                        $sn=1;
                       while($rows=mysqli_fetch_assoc($res))
                       {
                            $id= $rows['client_id'];
                            $name=$rows['name'];
                            $firm_name=$rows['firm_name'];
                            $pan_number=$rows['pan_number'];
                            $email=$rows['email'];
                            $phone_number=$rows['phone_number'];
                            $image_name= $rows['client_img'];
                           
                            //for address
                            $sqlAddr="SELECT * FROM address WHERE client_id='$id'";
                            $resAddr=mysqli_query($con, $sqlAddr);
                            if($resAddr)
                            {
                                $countAddr=mysqli_num_rows($resAddr);
                                if($countAddr>0)
                                {
                                    while ($rowsAddr=mysqli_fetch_assoc($resAddr)) {
                                        $address_id=$rowsAddr['id'];
                                        $province=$rowsAddr['province'];
                                        $district=$rowsAddr['district'];
                                        $city=$rowsAddr['city'];


                                        //concatination of address
                                        $address=$province.', '.$district.', '. $city;

                                    }
                                }
                            }
                            // displaying the value in table
                            ?>
                            <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $firm_name; ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo $pan_number; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phone_number; ?></td>

                            <td>
                                <?php 
                                    if($image_name!=''){
                                        // display image
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/client/<?php echo $image_name?>" width="70px" alt="Image">
                                        <?php
                                    }
                                    else
                                    {
                                        // Display the message
                                        echo '<p style="color:red;"">No image found</p>';
                                    }
                                ?>
                            </td>

                            <td>
                                <a style="width: 100%" href="<?php echo SITEURL; ?>forms/customer-view.php?id=<?php echo $id ?>&image_name=<?php echo $image_name?>" class="btn btn-info btn-sm m-1">View</a>
                                <a style="width: 100%" href="<?php echo SITEURL; ?>forms/update-client.php?id=<?php echo $id ?>&image_name=<?php echo $image_name?>" class="btn btn-secondary btn-sm m-1">Update</a>
                                <a style="width: 100%" href="<?php echo SITEURL; ?>forms/delete-client.php?id=<?php echo $id ?>&image_name=<?php echo $image_name?>" class="btn btn-danger btn-sm m-1" onclick="remove_client()">Remove Client</a>
                            </td>
                         </tr>
                            <?php 
                        }
                    }
                    else
                    {
                        // echo "We donot have data in database";
                    }
                }
            ?>
                </tbody>
            </table>
        </div>
        

       
     <script type="text/javascript">
        // Define the districts for each state
        var districtsByState = {
          Koshi: ["Morang", "Sunsari", "Dhankuta", "Sankhuwasabha", "Bhojpur", "Terhathum", "Okhaldhunga", "Khotang", "Solukhumbu", "Udayapur"],
          Madhesh: ["Saptari", "Siraha", "Dhanusha", "Mahottari", "Sarlahi", "Bara", "Parsa", "Rautahat"],
          Bagmati: ["Sindhuli", "Ramechhap", "Dolakha", "Sindhupalchok", "Kavrepalanchok", "Lalitpur", "Bhaktapur", "Kathmandu", "Nuwakot", "Rasuwa", "Dhading", "Makwanpur", "Chitwan"],
          Gandaki: ["Gorkha", "Manang", "Mustang", "Parbat", "Baglung", "Gulmi", "Palpa", "Nawalpur", "Syangja", "Tanahun", "Lamjung"],
          Lumbini: ["Arghakhanchi", "Kapilvastu", "Parasi", "Rupandehi", "Gulmi", "Palpa", "Nawalpur", "Syangja", "Tanahun", "Lamjung"],
          Karnali: ["Dolpa", "Humla", "Jumla", "Kalikot", "Mugu", "Banke", "Bardiya", "Dailekh", "Jajarkot", "Surkhet", "Salyan", "Rukum", "Rolpa"],
          Sudurpaschim: ["Achham", "Baitadi", "Bajhang", "Bajura", "Dadeldhura", "Darchula", "Doti", "Kailali", "Kanchanpur"]
            // Add more districts for each state here
        };

        // Function to populate the district select options based on the selected state
        function populateDistricts() {
            var stateSelect = document.getElementById("state");
            var districtSelect = document.getElementById("districts");
            var selectedState = stateSelect.value;

            // Clear previous district options
            districtSelect.innerHTML = "<option value=''>Select a district</option>";

            // Populate district options based on the selected state
            if (selectedState) {
                var districts = districtsByState[selectedState];
                for (var i = 0; i < districts.length; i++) {
                    var option = document.createElement("option");
                    option.value = districts[i];
                    option.textContent = districts[i];
                    districtSelect.appendChild(option);
                }
            }
        }
        remove_client(){
            alert("Are you sure you want to remove this client?");
        }
    </script>

<?php include('../partials/footer.inc.php'); ?>
