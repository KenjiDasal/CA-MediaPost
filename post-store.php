<?php
require_once 'config.php';

try {
    

    // Array of author_names, this is used for the author_name validation rule - see line 18
    
    $rules = [
        "title" => "present|minlength:2|maxlength:64",
        "description" => "present|minlength:20|maxlength:2000",
        "author_name" => "present|minlenght:20|maxlength:2000",
        "likes" => "present|minlenght:20|maxlength:2000",
        "date" => "present|match:/\A[0-9]{4}[-][0-9]{2}[-][0-9]{2}/"

    ];

    $request->validate($rules);
    if ($request->is_valid()) {
        //Pass the name of the file upload button as a parameter
        $file = new FileUpload("profile");
        //Get our new FileUpload object, which is stored in a temporary folder on our web server
        $file = $file->get();
        //Create an image object and store the file path in that object.
        $image = new Image();
        /*Save the pathname for where the image is stored in the database*/
        $image->file = $file;
        $image->save();

        // !!Check .... If your Image is saved to the Database, but your 'Festival' has not, you know code is correct to at least this point ...

        // Create an empty $festival object
        $festival = new Festival();

        // festival-create.php passed title, description, author_name etc... in it's request object
        // not get title, description, author_name etc from the request object and assign these values to the appropriate attributes in the $festival object. 
        $festival->title = $request->input("title");
        $festival->description = $request->input("description");
        $festival->author_name = $request->input("author_name");
        $festival->likes = $request->input("likes");
        $festival->date = $request->input("date");

        // When the Image was saved to the database ($image->save() above) and ID was created for that image. 
        // Now get that id from the $image, and assign it to $festival->img_id so it can be saved as in the festival table as a foreign key. 
        $festival->img_id = $image->id;
        
        // save() is a function in the Festival class, you will have written part of it - to update an existing festival
        // now you will add more code to the save() function so it can create a new festival or update an existing festival.  
        $festival->save();


        $request->session()->set("flash_message", "The festival was successfully added to the database");
        //Class that changes the appearance of the Bootstrap message.
        $request->session()->set("flash_message_class", "alert-info");
        $request->session()->forget("flash_data");
        $request->session()->forget("flash_errors");
        // redirect back to the home page - festival-index.php
        $request->redirect("/festival-index.php");
    } else {
        //Get all session data from the form and store under the key 'flash_data'.
        $request->session()->set("flash_data", $request->all());
        $request->session()->set("flash_errors", $request->errors());

        //Redirect the user to the create page.
        $request->redirect("/festival-create.php");
    }
} catch (Exception $ex) {
    /*Get all data and errors again and redirect.*/
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());
    $request->redirect("/festival-create.php");
}