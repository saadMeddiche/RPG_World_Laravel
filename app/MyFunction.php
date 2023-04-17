<?php

use Illuminate\Support\Facades\File;

//This function renames the input file with a unique name and moves it to the uploads directory
function treat_image($file)
{
    // Generate a new filename by concatenating the current timestamp and the file's original extension
    $filename = time() . '.' . $file->getClientOriginalExtension();

    // Move the input file to the 'uploads/' directory using the new filename
    $file->move('uploads/', $filename);

    // Return the new filename
    return $filename;
}

//This function deletes the specified image from the uploads directory
function delete_image($image)
{
    // Construct the path to the file to be deleted by appending the filename to the 'uploads/' directory
    $destination = 'uploads/' . $image;

    // Check if the file exists in the specified location
    if (File::exists($destination)) {

        // If the file exists, delete it using the File::delete method from the Laravel framework
        File::delete($destination);
    }
}
