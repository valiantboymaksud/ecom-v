<?php


namespace App\Traits;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait FileSaver
{


    /*
     |--------------------------------------------------------------------------
     | UPLOAD FILE IN LOCAL DISK, LOCAL DISK MEANS PUBLIC DIRECOTROY
     |--------------------------------------------------------------------------
    */
    public function upload_file($uploaded_file, $model, $database_field_name, $base_path, $format = null)
    {
        // <!-- upload file -->
        if ($uploaded_file) {


            // <!-- delete file if exist -->
            if (file_exists($model->$database_field_name)) {
                unlink($model->$database_field_name);
            }



            // <!-- create unique file name -->
            $new_file_name   = $model->id . time() . '-' . rand(11111, 999999) . '.' . $uploaded_file->getClientOriginalExtension();

            if ($format) {
                $new_file_name   = $model->id . time() . '-' . rand(11111, 999999) . '.' . $format;
            }


            // <!-- create upload directory -->
            $directory   = './assets/uploads/' . $base_path . '/' . date('Y') . '/';




            // <!-- create store file to directory -->
            $uploaded_file->move($directory, $new_file_name);



            // <!-- update file name to database -->
            $model->update([$database_field_name => $directory . $new_file_name]);
        }
    }




    /*
     |--------------------------------------------------------------------------
     | UPLOAD FILE WITH RESIZE IN LOCAL DISK, LOCAL DISK MEANS PUBLIC DIRECOTROY
     |--------------------------------------------------------------------------
    */
    public function uploadFileWithResize($uploaded_file, $model, $database_field_name, $basePath, $height = 300, $width = 250)
    {
        try {
            if ($uploaded_file) {
                // <!-- delete file if exist -->
                if (file_exists($model->$database_field_name)) {
                    unlink($model->$database_field_name);
                }
    
                // <!-- create unique file name -->
                $new_file_name   = $model->id . time() . '-' . rand(11111, 999999) . '.webp';
    
                // <!-- create upload directory -->
                $directory   = './assets/uploads/' . $basePath . '/' . date('Y') . '/';
    
                // dd(is_dir($directory), $directory);
                if (!is_dir($directory)) {
                    mkdir($directory, 755, true);
                }
                // <!-- create store file to directory -->
                $resize_image = Image::make($uploaded_file->getRealPath())->encode('webp', 90);
                // if ($format=='webp') {
                //     $resize_image->encode('webp', 75);
                // }
                $resize_image->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($directory . $new_file_name);
    
                // <!-- update file name to database -->
                $model->update([$database_field_name => $directory . $new_file_name]);
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}
