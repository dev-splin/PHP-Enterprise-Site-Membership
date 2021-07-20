@extends('layout')

@section('title')
    CreateMemberTest


@endsection

@section('content')
    <script type="text/javascript">

    </script>

    <section class="bg-light py-5">
        <div class="container px-5 my-5 px-5">
            <div class="text-center mb-5">
                <h2 class="fw-bolder">회원 가입</h2>
                <p class="lead mb-0">정보를 입력해주세요</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <form class="row g-3" action="/create-member" method="POST">
                        @csrf
                        <!-- Email-->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') border-danger @enderror" id="email" name="email" placeholder="name@example.com" oninput="checkEmail()" required value="{{old('email') ? old('email') : ''}}">
                            <label for="email">Email</label>
                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') border-danger @enderror" id="password" name="password" placeholder="Password" required value="{{old('password') ? old('password') : ''}}">
                            <label for="password">Password</label>
                            @error('password')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- CheckPassword -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('checkPassword') border-danger @enderror" id="checkPassword" name="checkPassword" placeholder="CheckPassword" required value="{{old('checkPassword') ? old('checkPassword') : ''}}">
                            <label for="checkPassword">CheckPassword</label>
                            @error('checkpassword')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" placeholder="Name" required value="{{old('name') ? old('name') : ''}}">
                            <label for="name">Name</label>
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Tel -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('tel') border-danger @enderror" id="tel" name="tel" placeholder="010-1234-5678" required value="{{old('tel') ? old('tel') : ''}}">
                            <label for="tel">Tel</label>
                            @error('tel')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Birth -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('birth') border-danger @enderror" id="birth" name="birth" placeholder="1994.03.11" required value="{{old('birth') ? old('birth') : ''}}">
                            <label for="birth">Birth</label>
                            @error('birth')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Button-->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg mb-3">가입하기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        //아이디 체크하여 가입버튼 비활성화, 중복확인.
        function checkEmail() {
            var inputed = $("#email").val();

            console.log(inputed);

            $.ajax({
                type : 'POST',
                data : {
                    "_token": "{{ csrf_token() }}",
                    email : inputed
                },
                url : "/create-member/check-email",
                success : function(data) {
                    if(inputed=="" && data=='0') {
                        $("#email").addClass("border-primary")
                    } else if (data == '0') {
                        $("#email").addClass("border-success")
                    } else if (data == '1') {
                        $("#email").addClass("border-danger")
                    }
                }
            });
        }
    </script>

@endsection
