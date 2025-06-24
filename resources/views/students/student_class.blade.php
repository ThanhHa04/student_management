@extends('layout.base')

@section('page_title', 'Thông tin')

@section('slot')
<div class="container">
    <p class="mt-3" class="text-s"><strong>Sinh viên: {{ $student->user->name }}</strong></p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <!-- <th class="text-xs">ID</th> -->
                <th class="text-xs">Tên lớp</th>
                <th class="text-xs">Ngày tham gia</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classes as $class)
            <tr>
                <!-- <td class="text-xs">{{ $class->id }}</td> -->
                <td class="text-xs">{{ $class->name }}</td>
                <td class="text-xs">{{ $class->created_at }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Sinh viên chưa tham gia lớp học nào</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('students') }}" class="btn btn-sm btn-secondary mt-3" >←</a>
</div>
@endsection
