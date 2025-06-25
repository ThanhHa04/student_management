<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom as MainModel;
use Illuminate\Support\Facades\DB;
use App\Models\ClassroomStudent;
use App\Models\Subject;
use App\Models\User;
use App\Models\TeacherSubject;
use App\Models\TeacherProfile;
use App\Models\StudentProfile;

class ClassroomController extends Controller
{
    public function index()
    {
        $data['rows'] = MainModel::all();
        return view('classes.index', $data);
    }

    public function add()
    {
        $subjects = Subject::all();
        $teachers = TeacherProfile::with('user')->get();
        $students = StudentProfile::with('user')->get();
        
        return view('classes.form', [
            'subjects' => $subjects,
            'teachers' => $teachers,
            'students' => $students,
        ]);
    }

    public function view($classroom_id) {
        $classroom = MainModel::with('teacher.user')->findOrFail($classroom_id);
        $classroom_students = ClassroomStudent::with('student.user')->where('classroom_id',$classroom_id)->get();
        return view('classes.class_info', compact('classroom_students','classroom'));
    }

    public function create(Request $request)
    {
        try {
            $params = $request->all();
            DB::transaction(function () use ($params) {
                MainModel::create($params);
            });
            return redirect()->route('classes')->withSuccess("Đã thêm");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $data['subjects'] = Subject::all();
        $data['teachers'] = TeacherProfile::with(['user' => function($q) {
    $q->where('role', 'teacher'); // lọc tại chỗ luôn
}])->get();
        $data['students'] = StudentProfile::with('user')->get();
        $data['rec'] = MainModel::findOrFail($id);
        return view('classes.form', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $subjects = Subject::all();
            $rec = MainModel::findOrFail($id);
            $params = $request->all();
            DB::transaction(function () use ($params, $rec) {
                $rec->update($params);
            });
            return redirect()->route('classes')->withSuccess("Đã cập nhật");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $rec = MainModel::findOrFail($id);
            if($rec->students->count() > 0)
                throw new \Exception('Bạn phải chuyển hết sinh viên ra khỏi lớp trước khi xóa lớp');
            $rec->delete();
            return redirect()->back()->withSuccess("Đã xóa");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
