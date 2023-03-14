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

    public function deleteSubject($id)
    {
        Subject::where('id', $id)->delete();

        return $this->successMessage('subject deleted successfully');
    }

    public function saveData(Request $request)
    {
        // Insert into subject table
        if ($request->subject_extra_info['mode'] == 'edit') {
            $update_subject_info["name"] = $request->subject_info['name'];
            $subject = parent::update($update_subject_info, $request->subject_extra_info['current_subject_id']);
        } else {
            $subject = parent::store($request->subject_info);
        }
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
