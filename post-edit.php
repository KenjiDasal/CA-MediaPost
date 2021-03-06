<?php require_once 'config.php';

try {
  $rules = [
    'post_id' => 'present|integer|min:1'
  ];
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Illegal request");
  }
  $post_id = $request->input('post_id');
  /*Retrieving a customer object*/
  $post = Post::findById($post_id);
  if ($post === null) {
    throw new Exception("Illegal request parameter");
  }
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");

  $request->redirect("/post-index.php");
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit post</title>

  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/style.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/form.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">


</head>
<body>
  <div class="container-fluid p-0">
    <?php require 'include/navbar.php'; ?>
    <main role="main">
      <div>
        <div class="row d-flex justify-content-center">
          <h1 class="t-peta engie-head pt-5 pb-5">Edit post</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <?php require "include/flash.php"; ?>
          </div>
        </div>

        <div class="row justify-content-center pt-4">
          <div class="col-lg-10">
            <form method="post" action="<?= APP_URL ?>/post-update.php" enctype="multipart/form-data">

              <!--This is how we pass the ID-->
              <input type="hidden" name="post_id" value="<?= $post->id ?>" />


              <div class="form-group">
                <label class="labelHidden" for="ticketPrice">Title</label>
                <input placeholder="Title" name="title" type="text" id="title" class="form-control" value="<?= old('title', $post->title) ?>" />
                <span class="error"><?= error("title") ?></span>
              </div>

              <!--textarea does not have a 'value' attribute, so in this case we have to put our php for filling in the old form data INSIDE the textarea tag.-->
              <div class="form-group">
                <label class="labelHidden" for="date">Description</label>
                <textarea placeholder="Description" name="description" rows="3" id="description" class="form-control"><?= old('description', $post->description) ?></textarea>

              </div>


              <div class="form-group">
                <label class="labelHidden" for="startDate">Author Name</label>
                <input placeholder="Start Date" type="text" name="author_name" class=" form-control" id="startDate" <?= old("author name", $post->author_name) ?>" />
                <span class="error"><?= error("Author Name") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="endDate">likes</label>
                <input placeholder="End Date" type="number" name="likes" class="dateInput form-control" id="quantity" min="0" max="255" <?= old("likes", $post->likes) ?> />
                <span class="error"><?= error("likes") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="venueDescription">Contact Name</label>
                <input placeholder="Contact Name" type="text" name="date" id="contactName" class="form-control" value="<?= old("date", $post->date) ?>" />
                <span class="error"><?= error("date") ?></span>
              </div>


              <div class="form-group">
                <label>Profile image:</label>
                <?php
                $image = Image::findById($post->img_id);
                if ($image != null) {
                ?>
                  <img src="<?= APP_URL . "/" . $image->file ?>" width="150px" />
                <?php
                }
                ?>
                <input type="file" name="profile" id="profile" />
                <span class="error"><?= error("profile") ?></span>
              </div>

              <div class="form-group">
                <a class="btn btn-default" href="<?= APP_URL ?>/post-index.php">Cancel</a>
                <button type="submit" class="btn btn-primary">Store</button>
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