<?php namespace xesc\Http\Controllers;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UploadController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

     protected static  $dishesImgPath="/public/image/dishes/";
	public function postDishes(Request $request)
	{
		$file =$request->file('file');


        if($request->hasFile('file'))
        {
            try
            {


                $filename=md5(time().rand()). '.'.substr($file->getMimeType(),strrpos( $file->getMimeType(),'/')+1);
                $file->move(self::$dishesImgPath.$filename);

                return ['ok'=>true,'msg'=>["data"=>["url"=>self::$dishesImgPath.$filename]]];
            }catch (FileException $e)
            {
                return false;
            }

        }
	}



}
