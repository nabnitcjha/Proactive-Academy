<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassScheduleAdvanceResource;
use App\Http\Resources\ClassScheduleForTeacherDetail;
use App\Http\Resources\StudentListResource;
use App\Http\Resources\TeacherAdvanceResource;
use App\Http\Resources\TeacherListResource;
use App\Http\Resources\teacher\profileOverview;
use App\Http\Resources\TeacherResource;
use App\Models\ClassSchedule;
use App\Models\Student;
use App\Models\StudentSession;
use App\Models\StudentTeacher;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends BaseController
{
    private $profileOverviewResource;
    public $Model;
    private $teacherAdvanceResource;
    
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->teacherAdvanceResource = new TeacherAdvanceResource(array());
        $this->profileOverviewResource = new profileOverview(array());
        $this->Model = new Teacher();
    }

    public function getData($allowPagination)
    {
        $teachers = parent::index($allowPagination);

        return TeacherListResource::collection($teachers);
    }

    public function saveData(Request $request)
    {
        // Insert into user table
        parent::createModelObject("App\Models\User");
        $user = parent::store($request->user_info);

        $user->assignRole('teacher');

        // Insert into teacher table
        parent::createModelObject("App\Models\Teacher");
        $teacher_info['phone'] = $request->teacher_info['phone'];
        $teacher_info['dob'] = $request->teacher_info['dob'];
        $teacher_info['full_name'] = $request->teacher_info['full_name'];
        $teacher_info['country'] = $request->teacher_info['country'];
        $teacher_info['user_id'] = $user->id;
        $teacher = parent::store($teacher_info);

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
        $profile_overview = Teacher::where('id',$id)->first();

        return  $this->profileOverviewResource->make($profile_overview);

    }
    public function getStudent($id)
    {
        $teacher = Teacher::where('id',$id)->first();

        return  StudentListResource::collection($teacher->student);

    }

    public function allClasses($id){
        $teacher = Teacher::where('id',$id)->first();

        return ClassScheduleAdvanceResource::collection($teacher->classSchedule);
    }

    public function sortedClass($id)
    {
        $sub = ClassSchedule::with('subject')->orderBy('id', 'DESC');
        $sorted_class = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->where('teacher_id',$id)
            ->groupBy('class_unique_id')
            ->get();

            // $studentIds = StudentTeacher::where('teacher_id',$id)->pluck('student_id');
            // $students = Student::whereIn('id',$studentIds)->get();

            foreach ($sorted_class as $key => $value) {
                $studentIds = StudentSession::where('class_schedule_id',$value->id)->pluck('student_id');
                $students = Student::whereIn('id',$studentIds)->get();
                $subject = Subject::where('id',$value->subject_id)->first();
                $value->student=$students;
                $value->subject=$subject;
            }


        return  ClassScheduleForTeacherDetail::collection($sorted_class);
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
