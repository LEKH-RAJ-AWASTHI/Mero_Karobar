<?php include('partials/header.inc.php'); ?>


    <div class="modal" id="addClient">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add Client</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
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
                        <input type="file" name="image" accept=".jpg,.jpeg,.png" class="form-control" id="image">

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
        

        <?php 
    if(isset($_POST['submit']))
    {
        // echo "clicked";
        // get the values from form
        $name=get_safe_value($con,$_POST['name']);
        $address=get_safe_value($con,$_POST['address']);
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
            $destination_path='/images/client/'.$image_name;
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
            //   header("location:".SITEURL."admin/add-category.php");
              die();
      
            }
          }
         

      }
      else{
        //don't upload image and 
        $image_name='';
      }

      $sql="insert into tbl_category set
            name='$name',
            address='$address',
            PAN_NUMBER='$name',
            name='$name',
            image_name='$image_name',
            
            ";
      
      $res= mysqli_query($con, $sql);

      if($res){
        $_SESSION['add']='
    
        <div id="add" class="alert alert-success" role="alert">
        Category added Successfully
        
      </div>
      ';


        // REDIRECT TO MANAGE ADMIN 
        // header("location:".SITEURL."admin/manage-category.php");

      }
      else{
        //failed to add category
        $_SESSION['add']="Failed to add category";
        //   header("location:".SITEURL."admin/add-category.php");

      }
    }
  ?>
<?php include('partials/footer.inc.php'); ?>