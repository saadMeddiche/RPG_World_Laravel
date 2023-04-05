<?php

use Illuminate\Support\Facades\File;

function treat_image($file)
{
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move('uploads/games/', $filename);

    return $filename;
}

function delete_image($image)
{
    //Delete the image from upload folder
    $destination = 'uploads/games/' . $image;
    if (File::exists($destination)) File::delete($destination);
}
