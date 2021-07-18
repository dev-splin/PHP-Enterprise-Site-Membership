@extends('layout')

@section('title')
    test
@endsection

@section('content')
    test content
    <ul>
        @foreach ($admin as $a)
            {{$a->admin_id}}<br>
            {{$a->admin_name}}<br>
            {{$a->admin_tel}}<br>
            {{$a->admin_email}}<br>
        @endforeach
    </ul>

@endsection
