<?php

namespace App\Http\Controllers;

use App\Http\Resources\Admin\UserResource;
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

    public function userInfo($id){

        parent::createModelObject("App\Models\User");
        $user = $this->fetch($id);

        return UserResource::make($user);
    }

    public function changePassword(Request $request, $id)
    {
        parent::createModelObject("App\Models\User");
        $this->update($request->password_info, $id);
        return $this->successMessage('password change successfully');
    }
}
