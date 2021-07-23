@extends('Layout')

@section('title')
    CreateMemberTest
@endsection

@section('script')
<script src="{{ asset("js/member/MemberCreateManage.js") }}"></script>
<script src="{{ asset("js/member/MemberInfoLength.js") }}"></script>
<script src="{{ asset("js/member/MemberInputInfo.js") }}"></script>

{{--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />--}}
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="js/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/daterangepicker/daterangepicker.css" />

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
                            <input type="email" class="form-control @error('email') border-danger @enderror" id="email" name="email" placeholder="name@example.com" value="{{old('email') ? old('email') : ''}}" required>
                            <label for="email">Email</label>
                            <small class="text-dark" style="display:none" id="emailSmallText"></small>
                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Email Code -->
                        <div class="row g-2" id="divEmailCode" >
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="checkEmail" placeholder="Check Email" required>
                                    <label for="checkEmail">Email Code</label>
                                </div>
                            </div>
                            <div class="col-md-auto d-grid">
                                <div class="d-grid">
                                    <button type="button" class="btn btn-primary btn-lg mb-3" id="sendEmailCodeButton">이메일 전송</button>
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') border-danger @enderror" id="password" name="password" placeholder="Password" value="{{old('password') ? old('password') : ''}}" required>
                            <label for="password">Password</label>
                            <small class="text-dark" style="display:none" id="passwordSmallText"></small>
                            @error('password')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Check Password -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="checkPassword" name="checkPassword" placeholder="Check Password" required>
                            <label for="checkPassword">CheckPassword</label>
                            <small class="text-dark" style="display:none" id="checkPasswordSmallText"></small>
                        </div>

                        <!-- Name -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" placeholder="Name" required value="{{old('name') ? old('name') : ''}}">
                            <label for="name">Name</label>
                            <small class="text-dark" style="display:none" id="nameSmallText"></small>
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Tel -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('tel') border-danger @enderror" id="tel" name="tel" placeholder="010-1234-5678" required value="{{old('tel') ? old('tel') : ''}}">
                            <label for="tel">Tel</label>
                            <small class="text-dark" style="display:none" id="telSmallText"></small>
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
                            <button type="submit" class="btn btn-primary btn-lg mb-3" disabled="disabled" id="buttonCreate">가입하기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>

        $(document).ready(function(){
            makeKeycodeSet();

            emailId = $("#email");
            emailCodeId = $("#sendEmailCodeButton");
            passwordId = $("#password");
            checkPasswordId = $("#checkPassword");
            nameId = $("#name");
            telId = $("#tel");
            birthId = $("#birth");

            // 여기 부터 유효성 검사, 입력 방지
            // Email
            let isEmailValidationComplete = false;
            let isEmailCheckComplete = false;
            let isPasswordComplete = false;
            let isNameCheckComplete = false;
            let isTelCheckComplete = false;
            let isBirthCheckComplete = false;

            exceptionInput(emailId, emailKeyCodeSet);

            emailId.bind("focusin keyup", function (e) {
                isEmailValidationComplete = checkInput(emailId,$("#emailSmallText"),emailRegex,emailLength);
            });

            emailId.focusout(function () {
                if(isEmailValidationComplete) {
                    checkInputEmail(emailId,$("#emailSmallText"));
                }
            });


            // Email Code
            emailCodeId.click(function () {
                console.log("click");
                sendEmail(emailId);
            });


            // Password
            exceptionInput(passwordId, passwordKeyCodeSet);

            passwordId.bind("focusin keyup", function (e) {
                checkInput(passwordId,$("#passwordSmallText"),passwordRegex,passwordLength);
            });


            // Check Password
            let isCheckPasswordComplete = false;

            exceptionInput(checkPasswordId, passwordKeyCodeSet);

            checkPasswordId.bind("focusin keyup", function (e) {
                isCheckPasswordComplete = checkInput(checkPasswordId,$("#checkPasswordSmallText"),passwordRegex,passwordLength);
            });

            checkPasswordId.focusout(function () {
                if(isCheckPasswordComplete) {
                    checkInputPassword(passwordId, checkPasswordId,$("#checkPasswordSmallText"));
                    isCheckPasswordComplete = false;
                }
            });


            // Name
            exceptionInput(nameId, nameKeyCodeSet);

            nameId.bind("focusin keyup", function () {
                checkInput(nameId,$("#nameSmallText"),nameRegex,nameLength);
            });


            // Tel
            exceptionInput(telId, telKeyCodeSet);

            telId.bind("focusin keyup", function (e) {
                checkInput(telId,$("#telSmallText"),telRegex,telLength);
            });


            // Birth
            birthId.focusin(function (){
                birthId.daterangepicker({
                    locale : {
                        "format" : "YYYY.MM.DD",
                        "applyLabel" : "확인",
                        "cancelLabel" : "취소",
                        "daysOfWeek" : ["일", "월", "화", "수", "목", "금", "토"],
                        "monthNames" : ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"]
                    },
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'),10),
                    isCustomDate : function () {
                        $(".yearselect").css("float", "left");
                        $(".monthselect").css("float", "right");
                        $(".cancelBtn").css("float", "right");
                    }
                });
            });

        });

    </script>

@endsection

