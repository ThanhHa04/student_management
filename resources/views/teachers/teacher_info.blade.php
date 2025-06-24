@extends('layout.base')
@section('page_title', $subject->name ) 
@section('slot')
<div class="container">
    <p class="mt-3" class="text-s"><strong>Danh sách môn học:</strong></p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Mã</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Giảng viên</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Ngày tham gia</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teacher_subject_list as $teacher)
            <tr>
                <td class="text-xs">{{ $teacher->teacherProfile?->teacher_id }}</td>
                <td class="text-xs">{{ $teacher->teacherProfile?->user?->name }}</td>
                <td class="text-xs">{{ $teacher->created_at }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Chưa có thông tin</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <p class="mt-3" class="text-s"><strong>Danh sách lớp:</strong></p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">ID</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Tên lớp</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Ngày tổ chức</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classroom_list as $class)
            <tr>
                <td class="text-xs">{{ $class->id }}</td>
                <td class="text-xs">{{ $class->name }}</td>
                <td class="text-xs">{{ $class->created_at }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Chưa có thông tin</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('subjects') }}" class="btn btn-sm btn-secondary mt-3" >←</a>
</div>
@endsection
