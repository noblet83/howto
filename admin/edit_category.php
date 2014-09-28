<?php include 'includes/header.php'; ?>
<?php
  
  $id = $_GET['id'];

  //Create DB Object
  $db = new Database();

  //Create Query
  $query = "SELECT * FROM categories WHERE id = ".$id;

  //Run Query
  $category = $db->select($query)->fetch_assoc();

  //Create Query
  $query = "SELECT * FROM categories";

  //Run Query
  $categories = $db->select($query);

?>
<?php 
  if(isset($_POST['submit'])){
    //Assign Vars
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    

    //Simple Validation
    if($name == ''){
      //set error
      $error = "Please fill out all required fields";
    } else{
      $query = "UPDATE categories
                SET 
                name = '$name'
                WHERE id =".$id;

      $update_row = $db->update($query);
    }

  }

?>
<?php

  if(isset($_POST['delete'])){
      $query = "Delete FROM categories WHERE id = " .$id;
      $delete_row = $db->delete($query);
    }

?>
<form role="form" method="post" action="edit_category.php?id=<?php echo $id; ?>">
  <div class="form-group">
    <label for="name">Category Name</label>
    <input type="text" name="name" id="category_name"class="form-control" placeholder="Enter Category" value="<?php echo $category['name'];?>">
  </div>
  <div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
    <a href="index.php" class="btn btn-default" role="button">Cancel</a>
    <input type="submit" role="button" name="delete" class="btn btn-danger" value="Delete" />
  </div>
  <br>
</form>

<?php include 'includes/footer.php'; ?>