<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/16
 * Time: 23:52
 */

namespace App\Zwforum\Image;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

trait ImageUpload
{
    /**
     * @var UploadedFile $file
     */
    protected $file;
    protected $allowed_extensions = ["png", "jpg", "gif", 'jpeg'];

    /**
     * @param UploadedFile $file
     * @param int $userId
     * @return array
     */
    public function updatePortraitImg($file, $userId)
    {
        $this->file = $file;
        $this->checkAllowedExtensionsOrFail();

        $extension = $this->file->getClientOriginalExtension() ?: 'png';
        $portrait_name = $userId . '_' . time();

        $resize = [100, 200, 380];
        $this->saveImageToLocal('portrait', $resize, $portrait_name);

        $result['portrait_min'] = $portrait_name . '_' . $resize[0] . '.' . $extension;
        $result['portrait_mid'] = $portrait_name . '_' . $resize[1] . '.' . $extension;
        $result['portrait_max'] = $portrait_name . '_' . $resize[2] . '.' . $extension;
        return $result;
    }

    /**
     * 上传文章的图片
     *
     * @param $file
     * @return array
     */
    public function uploadImage($file)
    {
        $this->file = $file;
        $this->checkAllowedExtensionsOrFail();
        $local_image = $this->saveImageToLocal('topic', [1440]);
        return ['filename' => config('app.url').'/'.$local_image];
    }

    /**
     * 检查是否为允许的格式
     *
     */
    protected function checkAllowedExtensionsOrFail()
    {
        $extension = strtolower($this->file->getClientOriginalExtension());
        if ($extension && !in_array($extension, $this->allowed_extensions)) {
            throw new ImageUploadException('You can only upload image with extensions: ' . implode($this->allowed_extensions, ','));
        }
    }

    /**
     * 处理并保存图片到本地
     *
     * @param $type
     * @param $resize
     * @param string $filename
     * @return string
     */
    protected function saveImageToLocal($type,$resize,$filename = ''){
        $folderName = ($type == 'portrait')
            ? 'uploads/portraits'
            : 'uploads/images/' . date("Ym", time()) .'/'.date("d", time()) .'/'. Auth::user()->id;
        $destinationPath = public_path() . '/' . $folderName;
        $extension = $this->file->getClientOriginalExtension() ?: 'png';
        $safeName  = $filename? :str_random(10);
        $this->file->move($destinationPath, $safeName);

        if ($this->file->getClientOriginalExtension() != 'gif') {
            foreach ($resize as $v){
                $img = Image::make($destinationPath . '/' . $safeName);
                $img->resize($v, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save($folderName.'/'.$safeName.'_'.$v.'.'.$extension);
            }
            @unlink($destinationPath . '/' . $safeName);
        }
        return $folderName .'/'. $safeName.'_'.$resize[0].'.'.$extension;

    }

    /**
     * 处理并保存通过Base64上传的图片到本地
     *
     * @param $img
     * @param $userId
     * @return bool
     */
    protected function savePortraitByBase64($img,$userId){
        $types = array('jpg', 'gif', 'png', 'jpeg');
        $img = str_replace(array('_','-'), array('/','+'), $img);
        $b64img = substr($img, 0,100);
        if(preg_match("/^(data:s*image\/(\w+);base64,)/", $b64img, $matches)){
            $type = $matches[2];
            if(!in_array($type, $types))
                return false;
            $img = str_replace($matches[1], '', $img);
            $img = base64_decode($img);
            $portrait_name = $userId . '_' . time();
            $folderName = 'uploads/portraits/';
            $destinationPath = public_path() .'/'.$folderName.$portrait_name.'.'.$type;
            file_put_contents($destinationPath, $img);
            $resize = [100, 200, 380];
            foreach ($resize as $v){
                $img = Image::make($destinationPath);
                $img->resize($v, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save($folderName.'/'.$portrait_name.'_'.$v.'.'.$type);
            }
            @unlink($destinationPath);

            $result['portrait_min'] = $portrait_name . '_' . $resize[0] . '.' . $type;
            $result['portrait_mid'] = $portrait_name . '_' . $resize[1] . '.' . $type;
            $result['portrait_max'] = $portrait_name . '_' . $resize[2] . '.' . $type;
            return $result;
        }
    }

}