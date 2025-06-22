<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User as MainModel;
use App\Models\StudentProfile;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $data['rows'] = MainModel::where( 'role','student')->get();
        return view('students.index', $data);
        return view('students.index', compact('rows'));
    }

    private function generateStudentId(): string
    {
        $year = date('y');
        $studentID = $year;
        $latest = \App\Models\StudentProfile::where('student_id', 'like', $studentID . '%')
            ->orderBy('student_id', 'desc')
            ->value('student_id');
        $lastIndex = $latest ? (int)substr($latest, 2) : 0;
        $nextIndex = $lastIndex + 1;
        return $studentID . str_pad($nextIndex, 3, '0', STR_PAD_LEFT);
    }

    public function add()
    {
        $data['classes'] = Classroom::all();
        $data['student_id'] = $this->generateStudentId();
        return view('students.form')->with($data);
    }

    public function create(Request $request)
    {
        try {
            $params = $request->all();
            $params['password'] = Hash::make($params['password']);
            $params['student_id'] = $this->generateStudentId();
            $params['role'] = 'student';
            DB::transaction(function () use ($params) {
                $profile = StudentProfile::create([
                    'name'         => $params['name'],
                    'dob'          => $params['dob'],
                    'email'        => $params['email'],
                    'class_id'     => $params['class_id'],
                    'student_id'   => $params['student_id'],
                ]);
                $params['profile_id'] = $profile->id;

                MainModel::create([
                    'name'       => $params['name'],
                    'username'   => $params['student_id'],
                    'email'      => $params['email'],
                    'password'   => $params['password'],
                    'role'       => $params['role'],
                    'profile_id' => $profile->id,
                ]);
            });
            return redirect()->route('students')->withSuccess("Đã thêm");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $data['classes'] = Classroom::all();
        $data['rec'] = MainModel::findOrFail($id);
        return view('students.form')->with($data);
    }

    public function update(Request $request, $id)
    {
        try {
            $rec = MainModel::findOrFail($id);
            $params = $request->all();
            if(strlen($params['password']))
                $params['password'] = Hash::make($params['password']);
            else
                unset($params['password']);
            $params['username'] = $params['student_id'];
            $params['role'] = 'student';
            DB::transaction(function () use ($params, $rec) {
                $rec->profile->update($params);
                $rec->update($params);
            });
            return redirect()->route('students')->withSuccess("Đã cập nhật");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function delete($id) {
        try {
            $rec = MainModel::findOrFail($id);
            $rec->profile->delete();
            $rec->delete();
            return redirect()->back()->withSuccess("Đã xóa");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
