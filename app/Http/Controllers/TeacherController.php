<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Models\StudentSession;
use App\Models\StudentTeacher;
use App\Models\TeacherAssignment;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TeacherResource;
use App\Http\Resources\StudentListResource;
use App\Http\Resources\TeacherListResource;
use App\Http\Resources\TeacherAdvanceResource;
use App\Http\Resources\Teacher\profileOverview;
use App\Http\Resources\ClassScheduleAdvanceResource;
use App\Http\Resources\ClassScheduleForTeacherDetail;

class TeacherController extends BaseController
{
    private $profileOverviewResource;
    public $Model;
    private $imageOrFile;
    private $teacherAdvanceResource;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->teacherAdvanceResource = new TeacherAdvanceResource(array());
        $this->profileOverviewResource = new profileOverview(array());
        $this->Model = new Teacher();
        $this->imageOrFile = new uploadImageOrFileController();
    }

    public function getData($allowPagination)
    {
        $teachers = parent::index($allowPagination);

        return TeacherListResource::collection($teachers);
    }

    public function deleteTeacher($id)
    {
        $teacher = Teacher::where('id', $id)->first();
        User::where('id', $teacher->user_id)->delete();

        return $this->successMessage('teacher deleted successfully');
    }

    public function saveData(Request $request)
    {

        // Insert into user table
        parent::createModelObject("App\Models\User");
        if ($request->user_extra_info['mode'] == 'edit') {
            $update_user_info["first_name"] = $request->user_info['first_name'];
            $update_user_info["last_name"] = $request->user_info['last_name'];
            $update_user_info["email"] = $request->user_info['email'];
            $update_user_info["role"] = $request->user_info['role'];
            $update_user_info["password"] = $request->user_info['password'];
            $user = parent::update($update_user_info, $request->user_extra_info['current_user_id']);
        } else {
            $user = parent::store($request->user_info);
            $user->assignRole('teacher');
        }

        // Insert/Update  teacher table
        parent::createModelObject("App\Models\Teacher");
        if ($request->user_extra_info['mode'] == 'edit') {
            $update_student_info["phone"] = $request->teacher_info['phone'];
            $update_teacher_info["dob"] = $request->teacher_info['dob'];
            $update_teacher_info["full_name"] = $request->teacher_info['full_name'];
            $update_teacher_info["country"] = $request->teacher_info['country'];

            $teacher = parent::update($update_teacher_info, $request->user_extra_info['current_teacher_id']);
        } else {
            $teacher_info['phone'] = $request->teacher_info['phone'];
            $teacher_info['dob'] = $request->teacher_info['dob'];
            $teacher_info['full_name'] = $request->teacher_info['full_name'];
            $teacher_info['country'] = $request->teacher_info['country'];
            $teacher_info['user_id'] = $user->id;
            $teacher = parent::store($teacher_info);
        }


        $this->successResponse($teacher, 'save successfully');
    }

    public function detail($student_id, $teacher_id)
    {
        $subjectIds = DB::table('student_sessions')
            ->where([
                ['student_id', $student_id],
                ['teacher_id', $teacher_id]
            ])
            ->distinct()
            ->pluck('subject_id');

        $teacher = Teacher::with(['subject' => function ($query) use ($subjectIds) {
            $query->whereIn('id', $subjectIds);
        }])
            ->where('id', $teacher_id)->first();

        return  $this->profileOverviewResource->make($teacher);
    }

    public function profileOverview($id)
    {
        $profile_overview = Teacher::where('id', $id)->first();

        return  $this->profileOverviewResource->make($profile_overview);
    }
    public function getStudent($id)
    {
        $teacher = Teacher::where('id', $id)->first();

        return  StudentListResource::collection($teacher->student);
    }

    public function allClasses($id)
    {
        $teacher = Teacher::where('id', $id)->first();

        return ClassScheduleAdvanceResource::collection($teacher->classSchedule);
    }

    public function sortedClass($id)
    {
        $sub = ClassSchedule::with('subject')->orderBy('id', 'DESC');
        $sorted_class = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->where('teacher_id', $id)
            ->groupBy('class_unique_id')
            ->get();

        // $studentIds = StudentTeacher::where('teacher_id',$id)->pluck('student_id');
        // $students = Student::whereIn('id',$studentIds)->get();

        foreach ($sorted_class as $key => $value) {
            $studentIds = StudentSession::where('class_schedule_id', $value->id)->pluck('student_id');
            $students = Student::whereIn('id', $studentIds)->get();
            $subject = Subject::where('id', $value->subject_id)->first();
            $value->student = $students;
            $value->subject = $subject;
        }


        return  ClassScheduleForTeacherDetail::collection($sorted_class);
    }

    public function todayClass($id)
    {
        $sorted_class = ClassSchedule::whereDate('start_date', '=', Carbon::today()->toDateString())
            ->where('teacher_id', $id)->get();

        $index = 0;

        foreach ($sorted_class as $key => $value) {
            $assignmentIds = TeacherAssignment::where('class_schedule_id', $value->id)->pluck('assignment_id');
            $resource_file = Assignment::whereIn('id', $assignmentIds)->get();

            $subject = Subject::where('id', $value->subject_id)->first();
            $value->subject = $subject;
            foreach ($resource_file as $key => $rf) {
                # code...
                $resource_file[$index] = [
                    "file_info"=>$this->imageOrFile->getFile($rf->assignment),
                    "file_type"=>$rf->type
                ];
                $index = $index + 1;
            }
            $value->resource_file = $resource_file;
        }


        return  $this->successResponse($sorted_class, 200);
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
