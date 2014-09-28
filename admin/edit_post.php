<?php include 'includes/header.php'; ?>
<?php
  $id = $_GET['id'];

  //Create DB Object
  $db = new Database();

  //Create Query
  $query = "SELECT * FROM posts WHERE id = ".$id;

  //Run Query
  $post = $db->select($query)->fetch_assoc();

  //Create Query
  $query = "SELECT * FROM categories";

  //Run Query
  $categories = $db->select($query);

?>

<?php 
  if(isset($_POST['submit'])){
    //Assign Vars
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $category = mysqli_real_escape_string($db->link, $_POST['category']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

    //Simple Validation
    if($title == ''|| $body == ''|| $category== '' || $author == ''){
      //set error
      $error = "Please fill out all required fields";
    } else{
      $query = "UPDATE posts 
                SET 
                title = '$title',
                body  = '$body',
                category = '$category',
                author = '$author',
                tags = '$tags'
                WHERE id =".$id;

      $update_row = $db->update($query);
    }

  }
?>

<?php

  if(isset($_POST['delete'])){
      $query = "Delete FROM posts WHERE id = " .$id;
      $delete_row = $db->delete($query);
    }

?>

<form role="form" method="post" action="edit_post.php?id=<?php echo $id; ?>">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="<?php echo $post['title'];?>">
  </div>
  <div class="form-group">
    <label for="body">Post Body</label>
    <textarea name="body" id="body" class="form-control" placeholder="Enter Post Body"><?php echo $post['body'];  ?></textarea>
  </div>
  <label for="category">Category</label>
  <select name="category" id="category" class="form-control">
    <?php while($row = $categories->fetch_assoc()): ?>
      <?php if($row['id'] == $post['category']){
        $selected = 'selected' ;
      } else{
          $selected = "";
      }?>
	   <option value="<?php echo $row['id'];?>"<?php echo $selected ?>><?php echo $row['name'];?></option>
    <?php endwhile; ?>
	</select>
  <div class="form-group">
    <label for="author">Author</label>
    <input type="text" class="form-control" name="author" id="author" placeholder="Enter Author Name"value="<?php echo $post['author'];?>">
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter tags" value="<?php echo $post['tags'];?>">
  </div>
  <br>
  <div>
	  <button type="submit" name="submit" class="btn btn-default">Submit</button>
	  <a href="index.php" class="btn btn-default" role="button">Cancel</a>
    <input type="submit" role="button" name="delete" class="btn btn-danger" value="Delete" />
  </div>
  <br>
</form>



<?php include 'includes/footer.php'; ?>