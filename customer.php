<?php include('partials/header.inc.php'); ?>
<?php
    if(isset($_SESSION['add'])){
      echo $_SESSION['add']; //Displaying session message
      unset($_SESSION['add']); //removing session message
    }
    if(isset($_SESSION['upload'])){
      echo $_SESSION['upload']; //Displaying session message
      unset($_SESSION['upload']); //removing session message
    }
    ?>

    <div class="modal" id="addClient">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add Client</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- M    odal body -->
            <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Firm Name</label>
                        <input type="text" class="form-control" id="name" name="firm" placeholder="Enter Name">
                    </div>
                    <label for="address">Address</label>
                    <div class="row border m-2 p-2 rounded">
                <div class="col">

                    <label for="state" class="form-label">Province:</label>
                    <input class="form-control" list="states" name="province" id="state" oninput="populateDistricts()">
                    <datalist id="states">
                        <option value="">Select a state</option>
                        <option value="Koshi"></option>
                        <option value="Madhesh"></option>
                        <option value="Bagmati"></option>
                        <option value="Gandaki"></option>
                        <option value="Lumbini"></option>
                        <option value="Karnali"></option>
                        <option value="Sudurpaschim"></option>
                    </datalist>
                </div>

                <div class="col">

                    <label for="district" class="form-label">District:</label>
                    <input class="form-control" list="districts" name="district" id="district">
                    <datalist id="districts">
                        <option value="">Select a district</option>

                    </datalist>
                </div>
                <div class="col">
                    <label for="city" class="form-label">City:</label>
                    <input class="form-control" name="city" id="city">

                </div>
            </div>
                    <div class="form-group">
                        <label for="PAN-Number">PAN-Number</label>
                        <input type="text" class="form-control" id="PAN-Number" name="PAN_Number" placeholder="Enter PAN-Number">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">

                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" accept="image/*" class="form-control" id="image">

                    </div>
                    <div class="container-fluid d-flex justify-content-center m-3">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
        <h2>Customer Page</h2>
    </div>
    <div class="container my-3">
        <div class="buttons" style="width: 300px;">
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addClient">Add Client
                                
            </button>
            <br>
        </div>
    </div>


    <div class="container">
        <div class="container search-box pb-3 p-0 fs-5">

            <input style="width: 800px" class="p-2" type="search" name="" id="">
            <button class="p-2 px-5" type="submit">Search</button>
        </div>
        <div class="container">


            <table class="table table-bordered">
                <thead>
                    
                        <th>S.No</th>
                        <th>Customer Name</th>
                        <th>Firm Name</th>
                        <th>Address</th>
                        <th>PAN Number</th>
                        <th>Email</th>
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
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name?>" class="btn btn-secondary">Update category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name?>" class="btn btn-danger">Remove category</a>

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
        

        <?php 
    if(isset($_POST['submit']))
    {
        // echo "clicked";
        // get the values from form
        $name=get_safe_value($con,$_POST['name']);
        $firm=get_safe_value($con,$_POST['firm']);
        $province=get_safe_value($con,$_POST['province']);
        $district=get_safe_value($con,$_POST['district']);
        $city=get_safe_value($con,$_POST['city']);
        $PAN_Number=get_safe_value($con,$_POST['PAN_Number']);
        $email=get_safe_value($con,$_POST['email']);

        


        //checking whether image is selected or not and doing futher operations
        if(isset($_FILES['image']['name']))//checking if image is selected or not and if file has name or not( name can be shown by using print_r the value of $_FILES['image'])
        {
          
        // pr($_FILES['image']);
        // die();
          //upload the image
          // to upload image we need image we need image name, source path and destination path
          $image_name=$_FILES['image']['name'];
          //Renaming the image to be uploaded to remove the conflict between the files
          // step 1: get the extention of the image
          if($image_name!="")
          {
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);//extracting extention from the image name
            // echo time(); //generates random value
            // echo $ext;
            // die();
            
            $image_name="client_".time().".".$ext; 
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path='images/client/'.$image_name;
            //upload image
            $upload=move_uploaded_file($source_path, $destination_path);
          //   if ($file['error'] == 0) {
          //     $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
          //     if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
          //         $upload=move_uploaded_file($source_path, $destination_path);
          //     }
          // }
            
            //check whether image is uploaded or not
            //if image is not uploaded then we will stop the process and redirect with error message
            if(!$upload){
              $_SESSION['upload']=
              '<div id="add" class="alert alert-danger" role="alert">
                Failed to upload image.
                </div>';
            //   header("location:".SITEURL."admin/add-Client.php");
              // die();
      
            }
          }
        }

        else{
          // echo("image not selected");
          //don't upload image and 
          $image_name='';
        }
        // echo($name);
        //   echo($firm);
        //   echo($province);
        //   echo($district);
        //   echo($city);
        //   echo($PAN_Number);
        //   echo($email);
        //   echo($image_name);
        //   die();

        //sql query to save data into client database


        $sql="INSERT INTO client SET
              name='$name',
              firm_name='$firm', 
              pan_number='$PAN_Number',
              email='$email',
              client_img='$image_name'
              ";
        
         $res= mysqli_query($con, $sql);
        if($res){
          $client_id=mysqli_insert_id($con);
          $sql2="INSERT INTO address SET
              client_id='$client_id',
              province='$province',
              district='$district',
              city='$city'
              ";
          $res2=mysqli_query($con, $sql2);
          if($res2)
          {
            $_SESSION['add']='
        
            <div id="add" class="alert alert-success" role="alert">
            Client added Succesfully
            
            </div>';
            // header("location:".SITEURL."index.php");
          }

          else{
            $_SESSION['add']="Failed to add Client";
              // header("location:".SITEURL."customer.php");
    
          }
        }

        
    
    }
  ?>
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
    </script>
<?php include('partials/footer.inc.php'); ?>
