<?php

    function upload_image($path , $image)
    {
        $imageName  = time() . \Str::random(45) . '.' . $image->extension();
        $image->move(public_path('uploads/'.$path) , $imageName);
        return $imageName;
}

