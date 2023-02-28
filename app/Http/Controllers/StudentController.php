<?php

namespace App\Http\Controllers;

use LDAP\Result;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Models\StudentSession;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Resources\StudentListResource;
use App\Http\Resources\TeacherListResource;
use App\Http\Resources\ClassScheduleResource;
use App\Http\Resources\AdminDashboardResource;
use App\Http\Resources\StudentAdvanceResource;
use App\Http\Resources\DetailForParentResource;
use App\Http\Resources\student\profileOverview;
use App\Http\Resources\AdminClassScheduleResource;
use App\Http\Resources\ClassScheduleAdvanceResource;

class StudentController extends BaseController
{
    private $studentAdvanceResource;
    private $profileOverviewResource;
    public $Model;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->studentAdvanceResource = new StudentAdvanceResource(array());
        $this->profileOverviewResource = new profileOverview(array());
        $this->Model = new Student();
    }

    public function getData($allowPagination)
    {
        $students = parent::index($allowPagination);

        return StudentListResource::collection($students);
    }

    public function saveData(Request $request)
    {
        // Insert into user table
        parent::createModelObject("App\Models\User");
        $user = parent::store($request->user_info);
        $user->assignRole('student');
        // Insert into student table
        parent::createModelObject("App\Models\Student");
        $student_info_tmp = array();
        $student_uid = [
            'user_id' => $user->id
        ];
        $student_info_tmp = (array)array_merge($request->student_info, $student_uid);

        $student = parent::store($student_info_tmp);

        // Insert into parent table
        $parent_info = json_decode($request->parent_info, true);
        foreach ($parent_info as $key => $value) {
            parent::createModelObject("App\Models\User");
            $user_info["first_name"] = $value['first_name'];
            $user_info["last_name"] = $value['last_name'];
            $user_info["email"] = $value['email'];
            $user_info["role"] = $value['role'];
            $user_info["password"] = $value['password'];
            $user = parent::store($user_info);
            $user->assignRole('parent');

            parent::createModelObject("App\Models\Guardian");
            $prt_info["full_name"] = $value['full_name'];
            $prt_info["phone"] = $value['phone'];
            $prt_info["user_id"] = $user->id;
            $parent = parent::store($prt_info);

            parent::createModelObject("App\Models\Guardian_Student");
            $grd_std_info["guardian_id"] = $parent->id;
            $grd_std_info["student_id"] = $student->id;
            $guardian_student = parent::store($grd_std_info);
        }

        $this->successResponse($student, 'save successfully');
    }

    public function getTeacher($id)
    {
        $student = Student::where('id', $id)->first();

        return  TeacherListResource::collection($student->teacher);
    }

    public function show($id)
    {
        return parent::show($id);
    }

    public function destroy($id)
    {
        return parent::destroy($id);
    }

    public function detailForAdmin($id)
    {
        $profile_overview = Student::where('id', $id)->first();

        return  $this->profileOverviewResource->make($profile_overview);
    }

    public function detail($teacher_id, $student_id)
    {
        $subjectIds = DB::table('student_sessions')
            ->where([
                ['student_id', $student_id],
                ['teacher_id', $teacher_id]
            ])
            ->distinct()
            ->pluck('subject_id');

        $student = Student::with(['subject' => function ($query) use ($subjectIds) {
            $query->whereIn('id', $subjectIds);
        }])
            ->where('id', $student_id)->first();

        return  $this->profileOverviewResource->make($student);
    }

    public function detailForParent($student_id)
    {
        $subjectIds = DB::table('student_subjects')
            ->where('student_id', $student_id)
            ->distinct()
            ->pluck('subject_id');

        $student = Student::with(['subject' => function ($query) use ($subjectIds) {
            $query->whereIn('id', $subjectIds);
        }])
            ->where('id', $student_id)->first();

        return  DetailForParentResource::make($student);
    }

    public function getTeacherSlot($student_id, $teacher_id)
    {
        $classUniqueIds = DB::table('student_sessions')
            ->where([
                ['student_id', $student_id],
                ['teacher_id', $teacher_id]
            ])
            ->distinct()
            ->pluck('class_unique_id');

        $class_slot = ClassSchedule::whereIn('class_unique_id', $classUniqueIds)->get();

        return ClassScheduleResource::collection($class_slot);
    }

    public function allClasses($id)
    {
        $student = Student::where('id', $id)->first();

        return ClassScheduleAdvanceResource::collection($student->classSchedule);
    }

    public function sortedClass($id)
    {
        $class_unique_ids = StudentSession::where('student_id', $id)->groupBy('class_unique_id')->pluck('class_unique_id');
        // $student = Student::where('id',$id)->get();
        $sub = ClassSchedule::with('subject')->orderBy('id', 'DESC');
        $sorted_class = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->whereIn('class_unique_id', $class_unique_ids)
            ->groupBy('class_unique_id')
            ->get();
        foreach ($sorted_class as $key => $value) {
            $teacher = Teacher::where('id', $value->teacher_id)->first();
            $subject = Subject::where('id', $value->subject_id)->first();
            $value->teacher = $teacher;
            $value->subject = $subject;
            // $value->students = $student;
        }

        return $sorted_class;

        return  ClassScheduleAdvanceResource::collection($sorted_class);
    }

    public function adminSortedClass()
    {
        $sub = ClassSchedule::with('subject')->orderBy('id', 'DESC');
        $sorted_class = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->groupBy('class_unique_id')
            ->get();
        foreach ($sorted_class as $key => $value) {
            $teacher = Teacher::where('id', $value->teacher_id)->first();
            $subject = Subject::where('id', $value->subject_id)->first();
            $student_ids = StudentSession::where('class_unique_id', $value->class_unique_id)->pluck('student_id');
            $students = Student::whereIn('id', $student_ids)->get();
            $value->teacher = $teacher;
            $value->subject = $subject;
            $value->students = $students;
        }

        return  AdminClassScheduleResource::collection($sorted_class);
    }

    public function adminDashboard()
    {
        $sorted_class = ClassSchedule::whereDate('start_date',Carbon::now())->get();
        foreach ($sorted_class as $key => $value) {
            $teacher = Teacher::where('id', $value->teacher_id)->first();
            $subject = Subject::where('id', $value->subject_id)->first();
            $student_ids = StudentSession::where('class_unique_id', $value->class_unique_id)->pluck('student_id');
            $students = Student::whereIn('id', $student_ids)->get();
            $value->teacher = $teacher;
            $value->subject = $subject;
            $value->students = $students;
        }

        // fetch according role and permission table

        // $users = User::where('roles','user')->count();
        // $admins = User::where('roles','admin')->count();

        // fetch using role column this is not good way
        $students = User::where('role','student')->count();
        $teachers = User::where('role','teacher')->count();
        $subjects = Subject::count();

        $admin_dashboard_info=[
            'sorted_class'=>$sorted_class,
            'students'=>$students,
            'teachers'=>$teachers,
            'subjects'=>$subjects
        ];
        
        return  AdminDashboardResource::make($admin_dashboard_info);
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->successMessage('password change successfully');
    }
}


// code for learning

// $timetableIds = StudentSession::where('student_id',$id)->pluck('class_schedule_id');
// $sub = ClassSchedule::orderBy('id','DESC');
// $timetables = DB::table(DB::raw("({$sub->toSql()}) as sub"))
// ->whereIn('id',$timetableIds)
// ->groupBy('class_unique_id')
// ->get();
// $student = Student::where('id',$id)->first();

// foreach ($timetables as $key => $value) {
//     $subject = Subject::where('id',$value->subject_id)->first();
//     $teacher = Teacher::where('id',$value->teacher_id)->first();
//     $value->subject = $subject->name;
//     $value->teacher = $teacher->full_name;

// }

// return $this->successResponse($timetables, 'fetch record successfully');