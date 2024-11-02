<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    private static $category,$image,$imageName, $directory,$imgUrl,$extension;

    public static function saveCategory($request){
     self::$category  =  new Category();
     self::$category->category_name = $request->category_name;
     self::$category->image = self::getImgUrl($request);
     self::$category->save();
    }
    private static function getImgUrl($request){
       self::$image = $request->file('image');
       self::$extension = self::$image->extension();
       self::$imageName = $request->category_name.'-'.rand(111,999).'.'.self::$extension;
       self::$directory = 'admin-assets/category-image/';
       self::$image->move(self::$directory,self::$imageName);
       self::$imgUrl  = self::$directory.self::$imageName;
       return self::$imgUrl;
    }

    public static function status($id){
       self::$category = Category::find($id);
       if (self::$category->status == 1 ){
           self::$category->status = 0;
       }else{
           self::$category->status = 1;
       }
        self::$category->save();
    }

    public static function deleteCategory($id){
      self::$category =  Category::find($id);
      if (file_exists(self::$category->image)){
          unlink( self::$category->image);
      }
        self::$category->delete();
    }
}
