<?php

namespace App\Helper;
use Intervention\Image\ImageManagerStatic as Image;

class UploadImages
{
    public static function upload($image, $subfolder = '',$old_path=null,$subSubF='' , $width = 800)
    {

        $response = new \stdClass();
        $alloweed_types = [
            'png',
            'jpeg',
            'jpg',
            'svg',
            'webp',
        ];
        // check if file is valide image
        if (!in_array($image->extension(), $alloweed_types)) {
            $response->status = 400;
            $response->message = 'image type not allowed';
            $response->data = [];
            echo json_encode($response);
            die;
        }

        // upload the image
        if (!file_exists(public_path('/uploads/'. $subfolder.'/'.$subSubF))) {
            mkdir(public_path('/uploads/'. $subfolder.'/'.$subSubF), 0775);
        }
        if($old_path){
            if(file_exists($old_path)){
                unlink($old_path);
            }
        }
        $fileName = sha1(rand(1, 9999) * (float)microtime()) . '.webp';

        Image::make($image->getRealPath())
            /*->resize($width, null, function ($constraint) {
                //$constraint->aspectRatio();
//                $constraint->upsize();
            })*/
            ->save(public_path('/uploads/'. $subfolder.'/'.$subSubF.'/'.$fileName),70);

        return $fileName;
    }

    public static function UploadVideo($Video, $subfolder = '',$old_path=null,$subSubF='')
    {
        $response = new \stdClass();
        $alloweed_types = [
            'flv','avi','wmv', 'mp4', 'm3u8', '3gp', '3gp', 'mov',
        ];
        // check if file is valide image
        if (!in_array($Video->extension(), $alloweed_types)) {
            $response->status = 400;
            $response->message = 'Video type not allowed';
            $response->data = [];
            echo json_encode($response);
            die;
        }

        // upload the image
        if (!file_exists(public_path('/uploads/'. $subfolder.'/'.$subSubF))) {
            mkdir(public_path('/uploads/'. $subfolder.'/'.$subSubF), 0775);
        }

        $fileName = sha1(random_int(1, 5000) * (float)microtime()) . '.' . $Video->extension();
        $Video->move(public_path('/uploads/'. $subfolder.'/'.$subSubF), $fileName);
        return $fileName;
    }

    public static function UploadFile($Video, $subfolder = '',$old_path=null,$subSubF='')
    {
        $response = new \stdClass();
        // upload the image
        if (!file_exists(public_path('/uploads/'. $subfolder.'/'.$subSubF))) {
            mkdir(public_path('/uploads/'. $subfolder.'/'.$subSubF), 0775);
        }

        $fileName = sha1(random_int(1, 5000) * (float)microtime()) . '.' . $Video->extension();
        $Video->move(public_path('/uploads/'. $subfolder.'/'.$subSubF), $fileName);
        return $fileName;
    }

}
