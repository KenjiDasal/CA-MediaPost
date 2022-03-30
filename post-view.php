<?php require_once 'config.php';

try {

  // The $rules array has 3 rules, post_id must be present, must be an integer and have a minimum value of 1.  
  // note post_id was passed in from post_index.php when you chose a post by clicking a radio button. 
  $rules = [
    'post_id' => 'present|integer|min:1'
  ];
  // $request->validate() is a function in HttpRequest(). You pass in the 3 rules above and it does it's magic. 
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Illegal request");
  }

  // get the post_id out of the request (remember it was passed in from post_index.php)
  $post_id = $request->input('post_id');
 
  //Retrieve the post object from the database by calling findById($post_id) in the post.php class
  $post = Post::findById($post_id);
  if ($post === null) {
    throw new Exception("Illegal request parameter");
  }
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");

  // some exception/error occured so re-direct to the home page
  $request->redirect("/home.php");
}

?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>View Customer</title>

  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">


</head>

<body>
  <div class="container-fluid p-0">
    <?php require 'include/navbar.php'; ?>
    <main role="main">
      <div>
        <div class="row d-flex justify-content-center">
          <h1 class="t-peta engie-head pt-5 pb-5">View post</h1>
        </div>

        <div class="row justify-content-center pt-4">
          <div class="col-lg-10">
            <form method="get">
              <!--This is how we pass the ID-->
              <input type="hidden" name="post_id" value="<?= $post->id ?>" />

              <!--Disabled so the user can't intereact. This form is for viewing only.-->
              <div class="form-group">
                <label class="labelHidden" for="ticketPrice">Title</label>
                <input placeholder="Title" name="title" type="text" id="title" class="form-control" value="<?= old('title') ?>" />
                <span class="error"><?= error("title") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="date">Description</label>
                <textarea placeholder="Description" name="description" rows="3" id="description" class="form-control" value="<?= old('description') ?>"></textarea>
                <span class="error"><?= error("description") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="authorName">Author Name</label>
                <input placeholder="Author Name" type="date" name="author_name" class="dateInput form-control" id="authorName" value="<?= old("author_name") ?>" />
                <span class="error"><?= error("author_name") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="Likes">Start Date</label>
                <input placeholder="Start Date" type="date" name="likes" class="dateInput form-control" id="Likes" value="<?= old("likes") ?>" />
                <span class="error"><?= error("likes") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="date">Date</label>
                <input placeholder="Date" type="date" name="end_date" class="dateInput form-control" id="date" value="<?= old("end_date") ?>" />
                <span class="error"><?= error("end_date") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="venueDescription">Image</label>
                <?php
                try {
                  $image = Image::findById($post->img_id);
                } catch (Exception $e) {
                }
                if ($image !== null) {
                ?>
                  <img src="<?= APP_URL . "/" . $image->file ?>" width="205px" alt="image" class="mt-2 mb-2" />
                <?php
                }
                ?>
              </div>

              <div class="form-group">
                <a class="btn btn-default" href="<?= APP_URL ?>/home.php">Cancel</a>
                <button class="btn btn-warning" formaction="<?= APP_URL ?>/post-edit.php">Edit</button>
                <button class="btn btn-danger btn-post-delete" formaction="<?= APP_URL ?>/post-delete.php">Delete</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
    <?php require 'include/footer.php'; ?>
  </div>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/festival.js"></script>

  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</body>

</html>