<?php require_once 'config.php';
?>

<!--Compare this to post-edit.php & post-view.php -->
<!-- The Form code is similar, but this time we simply display the empty form for a post 
 In edit & view we do validation and get the post first before then displaying the form with the post details. -->

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Create post</title>

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
          <h1 class="t-peta engie-head pt-5 pb-5">Create post</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <?php require "include/flash.php"; ?>
          </div>
        </div>

        <div class="row justify-content-center pt-4">
          <div class="col-lg-10">
            <!--Enctype - How the form should be encoded. 
            It tells the web server to send this off as a multipart request. 
            We are telling the browser we want to attach a file to the request body.-->
            <form method="post" action="<?= APP_URL ?>/post-store.php" enctype="multipart/form-data">
              <!--This is how we pass the ID-->

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
                <input placeholder="Author Name" type="" name="author_name" class=" form-control" id="authorName" value="<?= old("author_name") ?>" />
                <span class="error"><?= error("author_name") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="Likes">Start Date</label>
                <input placeholder="Start Date" type="" name="likes" class="form-control" id="Likes" value="<?= old("likes") ?>" />
                <span class="error"><?= error("likes") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="date">Date</label>
                <input placeholder="Date" type="date" name="end_date" class="dateInput form-control" id="date" value="<?= old("end_date") ?>" />
                <span class="error"><?= error("end_date") ?></span>
              </div>

              <div class="form-group">
                <!--An uploaded file is moved into a temporary directory-->
                <label for="profile">Profile image:</label>
                <input type="file" name="profile" id="profile">
                <span class="error"><?= error("profile") ?></span>
              </div>

              <div class="form-group">
              <a class="btn btn-default" href="<?= APP_URL ?>/home.php">Cancel</a>
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