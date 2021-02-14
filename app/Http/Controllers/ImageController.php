<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function store(UploadedFile $file)
    {

        $upload_path = Storage::putFile('image', $file);
        $extension = $file->extension();
        $mime = $file->getMimeType();

        return Image::create([
            'upload_path' => $upload_path,
            'mime' => $mime,
            'extension' => $extension,
        ]);

    }

    public function update(UploadedFile $file, $image)
    {
        $upload_path = Storage::putFile('image', $file);
        $extension = $file->extension();
        $mime = $file->getMimeType();

        $image = Image::findorfail($image);
        Storage::delete($image->upload_path);

       $image->Update([
            'upload_path' => $upload_path,
            'mime' => $mime,
            'extension' => $extension,
        ]);
        return $image->id;
    }

    public function getImage(Image $image)
    {

        return Storage::get($image->upload_path);
    }

    //
}
