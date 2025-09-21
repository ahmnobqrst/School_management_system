<?php


namespace App\Traits;
use Illuminate\Support\Facades\File;

trait studentimagetrait {


    public function SaveImageStudent($image,$pathimage){
     
      
             $file_extension = $image->getClientOriginalExtension();
             $file_name = time().'.'. $file_extension;
             
             $path = $pathimage.$file_name;
             $image->move(public_path($pathimage),$file_name);

            
             
             return $path;
    

     }

    public function uploadImageimage($image, $folder)
    {
      // $rand = rand(999999, 1000000);
      // $imageName = time() . '_' . $rand . '.' . $image->getClientOriginalExtension();
      // $image->move(storage_path('app/public/' . $folder), $imageName);
      // return $folder . '/' . $imageName;
  
      $rand = rand(999999, 1000000);
      $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
      $image->move(storage_path('app/public/' . $folder), $imageName);
      return $folder . '/' . $imageName;
    }


    public function delete_file($filename)
    {
      if ($filename) {
      
        if (File::exists(storage_path('app/public/' . $filename))) {
          File::delete(storage_path('app/public/' . $filename));
        }
      }
    }




}