<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends BaseController
{
    //
    private $imageOrFile;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->imageOrFile = new uploadImageOrFileController();
    }

    public function userImage(Request $request,$id){
        if ($user_image = $request->file('user_image')) {
            $groupId = 0;
            $uploadGroupId = $this->imageOrFile->manageUploads($user_image, $savepath = 'userImage', $groupId);

            parent::createModelObject("App\Models\User");
            $user_info = [
                "user_image" => $uploadGroupId,
            ];
            parent::update($user_info,$id);
        }
    }
}
