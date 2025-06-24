@extends('layout.base')
@section('page_title', 'Danh sách sinh viên trong lớp: '.$classroom->name)
@section('slot')
<div class="card">
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Họ và tên</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mã số sinh viên</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày sinh</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classroom_students as $row)
                    <tr>
                        <td class="text-xs">{{$row->student->user->name}}</td>
                        <td class="text-xs">{{$row->student->student_id}}</td>
                        <td class="text-xs">{{date('d/m/Y', strtotime($row->student->dob))}}</td>
                        <td class="align-middle">
                            @if(in_array(auth()->user()->role, ['teacher']))
                            <a class="text-secondary font-weight-bold text-xs" 
                                href="{{route('scores.thisSubjectStudent', ['student_id' => $row->student->user->id, 'class_id' => $classroom->id])}}">Xem</a> | 
                            <a class="text-secondary font-weight-bold text-xs"
                                href="{{route('students.delete', ['id' => $row->student->user->id])}}">Xóa</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td class="align-middle text-secondary font-weight-bold text-xs">Không có dữ liệu</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop