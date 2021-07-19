@extends('layout')

@section('title')
    Main
@endsection

@section('content')

    <header class="py-5">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                <div class="m-4 m-lg-5">
                    <h1 class="display-5 fw-bold">Enterprise Site Membership</h1>
                    <p class="fs-4">IT연구소 인턴 OJT 1차 과제</p>
                    <a class="btn btn-primary btn-lg" href="">Login</a>
                    <a class="btn btn-primary btn-lg" href="/create-member">Create</a>
                </div>
            </div>
        </div>
    </header>
@endsection
