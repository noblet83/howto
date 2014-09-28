<?php include 'includes/header.php'; ?>
<?php
  //Create DB Object
  $db = new Database();


  if(isset($_POST['submit'])){
    //Assign Vars
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    
    //Simple Validation
    if($name == ''){
      //set error
      $error = "Please fill out all required fields";
    } else{
      $query = "Insert INTO categories 
                (name)
                VALUES('$name')";
      $update_row = $db->update($query);
    }

  }


?>
<form role="form" method="post" action="add_category.php">
  <div class="form-group">
    <label for="category_name">Category Name</label>
    <input type="text" name="name" id="category_name"class="form-control" placeholder="Enter Category">
  </div>
  <div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </div>
  <br>
</form>

<?php include 'includes/footer.php'; ?>