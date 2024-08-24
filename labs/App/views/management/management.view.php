<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post Management</title>
  <?php loadPartial('head'); ?>


  <!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="css/jquery-dataTables.css">
<!-- Include DataTables JS -->
<script type="text/javascript" charset="utf8" src="js/jquery-dataTables.js"></script>

</head>
<body>
  
  <section class="section">
    <div class="container">
      <div class="level">
        <div class="level-item">
          <a href="/postWriter">
            <button class="button is-success is-rounded" type="submit">Create New Post</button>
          </a>
        </div>
        <div class="level-item">
          <h1 class="title">Post Management</h1>
        </div>
        <div class="level-item">
          <form action="/logout" method="post">
            <button class="button is-danger is-rounded" name="submit" type="submit">Logout</button>
          </form>
        </div>
      </div>
      <?php loadPartial('message'); ?>
    <table class="table is-fullwidth" id="posts-table" class="display">
      <thead>
        <tr>
          <!-- <th><input type="checkbox" id="select-all"></th> -->
          <th><span class="icon"><i class="fas fa-thumbtack"></i></span></th>
          <th>Title</th>
          <th>Post url</th>
          <th>Author</th>
          <th>Category</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if (empty($posts)): ?>
      <tr>
        <td colspan="7">No posts available.</td>
      </tr>
        <?php else: ?>
        <?php foreach ($posts as $post): ?>
        <tr>
          <!-- <td><input type="checkbox" class="select-post"></td> -->
          <td>
            <p style="display: none;"><?php echo $post->sticky?></p>

            <span class="icon sticky-icon sticky-button <?php echo $post->sticky ? 'active' : ''; ?>" data-sticky="<?php echo $post->sticky; ?>" data-postName="<?php echo $post->postName; ?>">
              <i class="fas fa-thumbtack"></i>
            </span>
          </td>
          <td dir="rtl"><?php echo $post->title; ?></td>
          <td><?php echo $post->postName; ?></td>
          <td><?php echo $post->authorDisplayName; ?></td>
          <td><?php echo $post->category; ?></td>
          <td><?php echo $post->publish_date; ?></td>
          <td>
            <a class="button is-small is-link" target="_blank" href="./post/<?php echo $post->postName ?>">View</a>
            <a class="button is-small is-primary" href="./postWriter/<?php echo $post->postName?>">Edit</a>
            <a class="button is-small is-danger publish-button"data-postName="<?php echo $post->postName; ?>"><?php echo $post->publish ? 'Unpublish' : 'Publish'; ?> </a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>


  </div>
</section>
    
<script>
  $(document).ready(function() {
    $('#posts-table').DataTable();
});
</script>
<script>
  const publishButtons = document.querySelectorAll('.publish-button');
  const stickyIcons = document.querySelectorAll('.sticky-icon');

  publishButtons.forEach(button => {
  button.addEventListener('click', async () => {
    const postName = button.getAttribute('data-postName');
    var status;
    //get the text content of the button to determine if it is 'Publish' or 'Unpublish'
    status = button.textContent.match("Publish") ? '1' : '0';
    const response = await fetch('/management/visibility', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams(
      {
        postId: postName,
        operation: status,
      })
    });
    if (response.ok) {
      // Update the button text and class
      button.textContent = button.textContent.match("Publish") ? 'Unpublish' : 'Publish';
    } else {
      alert('An error occurred while updating the visibility.');
    }
  });
});


stickyIcons.forEach(button => {
  button.addEventListener('click', async () => {
    const postName = button.getAttribute('data-postName');
    const status = button.classList.contains('active') ? '0' : '1';
    const response = await fetch('/management/sticky', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams(
      {
        postId: postName,
        operation: status,
      })
    });
    if (response.ok) {
      button.classList.toggle('active');
    } else {
      alert('An error occurred while updating the stickiness.');
    }
  });
});
</script>


<style>
  .sticky-icon {
    cursor: pointer;
    font-size: 1.5rem;
    color: #ccc; /* Default color */
  }

  .sticky-icon.active {
    color: #00b386; /* Active (greenish) color */
  }
</style>
</body>
</html>



