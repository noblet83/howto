<?php include 'includes/header.php'; ?>
<?php
  //Create DB Object
  $db = new Database();


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
			$query = "Insert INTO posts 
						(title, body, category, author, tags)
						VALUES('$title', '$body', $category, '$author', '$tags')";
			$insert_row = $db->insert($query);
		}

	}


?>
<?php


  $query = "SELECT * FROM categories";

  //Run Query
  $categories = $db->select($query);

?>
<form role="form" method="post" action="add_post.php">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label for="body">Post Body</label>
    <textarea name="body" id="body" class="form-control" placeholder="Enter Post Body"></textarea>
  </div>
  <label for="category">Category</label>
  <select name="category" id="category" class="form-control">
    <?php while($row = $categories->fetch_assoc()): ?>
      <?php if($row['id'] == $post['category']){
        $selected = 'selected' ;
      } else{
          $selected = "";
      }?>
	   <option <?php echo $selected ?>value ="<?php echo $row['id']; ?>"><?php echo $row['name'];?></option>
    <?php endwhile; ?>
	</select>
  <div class="form-group">
    <label for="author">Author</label>
    <input type="text" class="form-control" name="author" id="author" placeholder="Enter Author Name">
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter tags">
  </div>
  <br>
  <div>
	  <button type="submit" name="submit" class="btn btn-default">Submit</button>
	  <a href="index.php" class="btn btn-default" role="button">Cancel</a>
  </div>
  <br>
</form>



<?php include 'includes/footer.php'; ?>