@extends('layout.base')
@section('page_title', isset($rec) ? 'Cập nhật lớp: '.$rec->name : 'Thêm lớp')
@section('slot')
<form id="form" class="text-start" method="POST"
    action="{{isset($rec) ? route('classes.update', ['id' => $rec->id]) : route('classes.create')}}">
    {{ csrf_field() }}
    <label class="form-label mt-3">Môn *</label>
    <div class="input-group input-group-outline">
        <select name="subject_id" class="form-control" required>
            <option value="">-- Chọn môn học --</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}"
                    {{ (isset($rec) && $rec->subject_id == $subject->id) || old('subject_id') == $subject->id ? 'selected' : '' }}>
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>
    </div>

    <label class="form-label mt-3">Tên lớp *</label>
    <div class="input-group input-group-outline">
        <input type="text" name="name" class="form-control" required value="{{$rec->name ?? old('name') ?? ''}}">
    </div>

    <label class="form-label mt-3">Giảng viên *</label>
    <div class="overflow-auto" style="max-height: 50vh;">
        @foreach($teachers as $row)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="teacher_profile_id"
                value="{{$row->profile->id}}" 
                {{ (isset($rec) && $rec->teacher_profile_id == $row->profile->id) ? 'checked' : '' }}>
            <label class="custom-control-label" for="customRadio1">{{$row->name}}</label>
        </div>
        @endforeach
    </div>

    <input type="submit" class="btn bg-gradient-primary my-4 mb-2" value="{{ isset($rec) ? 'Cập nhật' : 'Thêm'}}">
</form>
@stop