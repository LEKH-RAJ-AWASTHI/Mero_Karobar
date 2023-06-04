<?php
    include("../partials/header.inc.php");
?>
<div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Add Client</h2>
    </div>


<div class="container border border-warning border-3 rounded p-5 my-3">

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label for="firm">Firm Name</label>
            <input type="text" class="form-control" id="firm" name="firm" placeholder="Enter Name">
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
            $destination_path='../images/client/'.$image_name;
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
              header("location:".SITEURL."forms/add-client.php");
              die();
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
            header("location:".SITEURL."/sites/customer.php");
        }

          else{
            $_SESSION['add']="Failed to add Client";
              header("location:".SITEURL."/sites/customer.php");
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

<?php include('../partials/footer.inc.php'); ?>
