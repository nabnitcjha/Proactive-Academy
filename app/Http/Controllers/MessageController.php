<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use App\Http\Resources\GroupMessageResource;
use App\Http\Resources\MessageResource;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{
    private $messageResource;
    public $Model;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->messageResource = new MessageResource(array());
        $this->Model = new Message();
    }

    public function fetchMessages($friend_id, $my_id)
    {

        $messageInfo =  $this->privateMessage($friend_id, $my_id);

        return    $this->successResponse(
            $this->messageResource->collection($messageInfo),
            'fetch all record successfully'
        );
    }

    public function fetchGroupMessages($class_unique_id, $my_id)
    {
        $message = Message::where([
            ['class_unique_id',$class_unique_id]
            ])->orderBy('id', 'DESC')->get();

        return    $this->successResponse(
           GroupMessageResource::collection($message),
            'fetch all record successfully'
        );
    }

    public function sendMessage(Request $request)
    {
        // Insert into message table

        $message_info["my_id"] = $request->message_info['my_id'];
        $message_info["friend_id"] = $request->message_info['friend_id'];
        $message_info["message"] = $request->message_info['message'];
        $message_info["message_type"] = $request->message_info['message_type'];
        $message_info["class_unique_id"] = $request->message_info['class_unique_id'];

        parent::store($message_info);

        broadcast(new MessageSent($request->message_info));
    }

    public function privateMessage($friend_id, $my_id)
    {
        $messageInfo = Message::with(['friend' => function ($query) {
            $query->select('id', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"));
        }])->with(['me' => function ($query) {
            $query->select('id', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"));
        }])
            ->where([
                ['my_id', $my_id],
                ['friend_id', $friend_id]
            ])->orWhere([
                ['my_id', $friend_id],
                ['friend_id', $my_id]
            ])
            ->orderBy('id', 'DESC')->get(['id', 'message', 'message_type','my_id', 'friend_id']);

        return $messageInfo;
    }
}
