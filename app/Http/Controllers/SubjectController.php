<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends BaseController
{
    public $Model;
    private $subjectResource;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->subjectResource = new SubjectResource(array());
        $this->Model = new Subject();
    }

    public function getData($allowPagination)
    {
        $subjects = parent::index($allowPagination);

        return $this->subjectResource->collection($subjects);
    }

    public function saveData(Request $request)
    {
        // Insert into subject table
        $subject = parent::store($request->subject_info);
        $this->successResponse($subject, 'save successfully');
    }

    public function show($id)
    {
        return parent::show($id);
    }

    public function destroy($id)
    {
        return parent::destroy($id);
    }
}
