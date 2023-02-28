<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    //

    public function getError($message)
    {
        $this->errorResponse($message);
    }

    public function getModel()
    {
        return $this->Model;
    }

    public function createModelObject($model)
    {
        $this->Model = new $model;
    }

    public function index($allowPagination)
    {
        if (str_contains($allowPagination, 'true')) {
            $data = $this->Model::paginate();
        } else {
            $data = $this->Model::get();
        }
        return $data;
    }

    public function store($request)
    {
        $params = $request;

        $Model = $this->getModel();
        foreach ($params as $key => $value) {
            if ($key==='password') {
                $Model->$key = bcrypt($value);
            }else{
            $Model->$key = $value;
            }
        }
        if (!$Model->save()) {
            return $this->getError("faild to save");
        }

        return $Model;
    }

    public function show($id)
    {
        $Model = $this->getModel();
        $Obj = $Model::find($id);
        if (!$Obj) {
            return $this->getError("Can not find {$id}");
        }

        return $Obj;
    }

    public function update($request, $id)
    {
        $params = $request;

        $Model = $this->getModel();
        $Model = $Model::find($id);
        if (!$Model) {
            return $this->getError("Can not find {$id}");
        }
        foreach ($params as $key => $value) {
            $Model->$key = $value;
        }
        if (!$Model->save()) {
            return $this->getError("Faild update {$id}");
        }

        return $Model;
    }

    public function destroy($id)
    {
        $Model = $this->getModel();
        $Obj = $Model::find($id);
        if (!$Obj) {
            return $this->getError("Can not find {$id}");
        }
        if (!$Obj->delete()) {
            return $this->getError("Faild delete {$id}");
        }

        $this->successResponse($Obj, 'delete successfully');
    }
}
