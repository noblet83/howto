<?php include 'includes/header.php'; ?>
<?php 
//create db object
$db = new Database;

//create query
$query = "SELECT posts.*, categories.name from posts
            INNER JOIN categories 
            ON posts.category =  categories.id
            ORDER BY posts.id DESC";

//run query
$posts = $db->select($query);

//Create Query
$query = "SELECT * FROM categories
          ORDER by name DESC";

//Run Query
$categories = $db->select($query);



?>

<table class= "table table-striped">
  <tr>
    <th>Post ID#</th>
    <th>Post Title</th>
    <th>Category</th>
    <th>Author</th>
    <th>Date</th>
  </tr>
  
    <?php while($row = $posts->fetch_assoc() ): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><a href="edit_post.php?id=<?php echo urlencode($row['id']); ?>"><?php echo $row['title']; ?></a></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['author']; ?></td>
        <td><?php echo formatDate($row['date']); ?></td>
      </tr>
   <?php endwhile; ?>
  
</table>

<table class= "table table-striped">
  <tr>
    <th>Category ID#</th>
    <th>Category Name</th>
  </tr>
  <?php while($row = $categories->fetch_assoc() ): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><a href="edit_category.php?id=<?php echo urlencode($row['id']); ?>"><?php echo $row['name']; ?></a></td>
      </tr>
   <?php endwhile; ?>
</table>



<?php include 'includes/footer.php'; ?>
       




