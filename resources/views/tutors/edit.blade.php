@extends('layouts.app')

@section('content')

<form action="{{ route('tutors.update', ['tutor' => $tutor->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $tutor->user->name }}" required>
    <input type="email" name="email" value="{{ $tutor->user->email }}" required>
    <button type="submit">Update Tutor</button>
</form>
@endsection