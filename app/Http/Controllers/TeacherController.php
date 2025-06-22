<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User as MainModel;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Certificate;

class TeacherController extends Controller
{
    public function index()
    {
        $data['rows'] = MainModel::where('role', 'teacher')->get();
        return view('teachers.index', $data);
    }

    private function generateTeacherId(): string
    {
        $year = date('y');
        $teacherID = $year;
        $latest = \App\Models\TeacherProfile::where('teacher_id', 'like', $teacherID . '%')
            ->orderBy('teacher_id', 'desc')
            ->value('teacher_id');
        $lastIndex = $latest ? (int)substr($latest, 2) : 0;
        $nextIndex = $lastIndex + 1;
        return $teacherID . str_pad($nextIndex, 3, '0', STR_PAD_LEFT);
    }

    public function add()
    {   
        $data['teacher_id'] = $this->generateTeacherId();
        return view('teachers.form', $data);
    }

    public function create(Request $request)
    {
        try {
            $params = $request->all();
            $params['password'] = Hash::make($params['password']);
            $params['role'] = 'teacher';

            DB::transaction(function () use ($params) {
                $profile = TeacherProfile::create([
                    'name'         => $params['name'],
                    'username'     => $params['username'],
                    'phone_number' => $params['phone_number'] ?? null,
                    'email'        => $params['email'],
                    'password'     => $params['password'],
                    'teacher_id'   => $params['teacher_id'],
                    'dob'          => $params['dob'],
                ]);

                $params['profile_id'] = $profile->id;

                MainModel::create([
                    'name'       => $params['name'],
                    'username'   => $params['username'],
                    'email'      => $params['email'],
                    'password'   => $params['password'],
                    'role'       => $params['role'],
                    'profile_id' => $profile->id,
                ]);
            });

            return redirect()->route('teachers')->withSuccess("Đã thêm");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $data['rec'] = MainModel::findOrFail($id);
        return view('teachers.form')->with($data);
    }

    public function update(Request $request, $id)
    {
        try {
            $rec = MainModel::findOrFail($id);
            $params = $request->all();
            if (strlen($params['password']))
                $params['password'] = Hash::make($params['password']);
            else
                unset($params['password']);
            $params['role'] = 'teacher';
            DB::transaction(function () use ($params, $rec) {
                $rec->profile->update($params);
                $rec->update($params);
                $rec->profile->update([
                    'phone_number' => $params['phone_number'] ?? null,
                ]);
            });
            return redirect()->route('teachers')->withSuccess("Đã cập nhật");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
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

