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
                        <div class="row g-2" id="divEmailCode" style="display:none">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="checkEmailCode" placeholder="Check Email" required>
                                    <label for="checkEmail">Email Code</label>
                                    <small class="text-dark" style="display:none" id="checkEmailCodeSmallText"></small>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="d-grid">
                                    <button type="button" class="btn btn-primary btn-lg mb-3" id="sendEmailCodeButton">이메일 코드 전송</button>
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
                        <div class="form-floating mb-3" id="divCheckPassword" style="display:none">
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
                            <small class="text-dark" style="display:none" id="birthSmallText"></small>
                            @error('birth')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Button-->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg mb-3" disabled="disabled" id="createButton">가입하기</button>
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
            sendEmailCodeButtonId = $("#sendEmailCodeButton");
            checkEmailCodeId = $("#checkEmailCode");
            passwordId = $("#password");
            checkPasswordId = $("#checkPassword");
            nameId = $("#name");
            telId = $("#tel");
            birthId = $("#birth");

            let isInputEmailComplete = false;
            let isInputPasswordComplete = false;
            let isInputNameComplete = false;
            let isInputTelComplete = false;
            let isInputBirthComplete = false;

            // 여기 부터 유효성 검사, 입력 방지
            // ---------- Email ----------
            let isPossibleValidatedEmail = false;

            // 입력 방지
            exceptionInput(emailId, emailKeyCodeSet);

            // 유효성 검사
            emailId.bind("focusin keyup", function (e) {
                isPossibleValidatedEmail = checkInput(emailId,$("#emailSmallText"),emailRegex,emailLength);
            });

            // 이메일 코드 전송,확인 박스 보이기 / 숨기기
            emailId.focusout(function () {
                if(isPossibleValidatedEmail === true ) {
                    let isDuplicate = checkInputEmail(emailId,$("#emailSmallText"));
                    if(isDuplicate == true) {
                        $("#divEmailCode").hide();
                        isInputEmailComplete = false;
                    } else {
                        $("#divEmailCode").show();
                        checkEmailCodeId.val("");
                        changeClassAndSmallText(checkEmailCodeId, "form-control", $("#checkEmailCodeSmallText"), "text-dark", "이메일 코드 전송 후, 받은 코드를 입력해주세요.");
                    }
                } else {
                    $("#divEmailCode").hide();
                    isInputEmailComplete = false;
                }
            });


            // ---------- Email Code ----------
            let emailCode;

            // 이메일 전송
            sendEmailCodeButtonId.click(function () {
                emailCode = sendEmail(emailId);
            });

            // 입력 방지
            exceptionInput(checkEmailCodeId, emailCodeKeyCodeSet);

            // 이메일 코드 확인, 모든 입력 완료 유무 확인
            checkEmailCodeId.focusout(function () {
               if(emailCode === checkEmailCodeId.val()){
                   changeClassAndSmallText(checkEmailCodeId, "form-control border-success", $("#checkEmailCodeSmallText"), "text-success", "코드가 일치합니다.");
                   isInputEmailComplete = true;
               } else {
                   changeClassAndSmallText(checkEmailCodeId, "form-control border-danger", $("#checkEmailCodeSmallText"), "text-danger", "잘못된 코드입니다.");
                   isInputEmailComplete = false;
               }
               checkInputComplete();
            });


            // ---------- Password ----------
            let isPossibleValidatedPassword = false;

            // 입력 방지
            exceptionInput(passwordId, passwordKeyCodeSet);

            // 유효성 검사
            passwordId.bind("focusin keyup", function (e) {
                isPossibleValidatedPassword = checkInput(passwordId,$("#passwordSmallText"),passwordRegex,passwordLength);
            });

            // 패스 워드 확인 박스 보이기 / 숨기기
            passwordId.focusout(function () {
                if(isPossibleValidatedPassword === true ) {
                    $("#divCheckPassword").show();
                    checkPasswordId.val("");
                    changeClassAndSmallText(checkPasswordId, "form-control", $("#checkPasswordSmallText"), "text-dark", "비밀번호를 확인해주세요.");
                } else {
                    $("#divCheckPassword").hide();
                    isInputPasswordComplete = false;
                }
            });


            // ---------- Check Password ----------
            let isPossibleValidatedCheckPassword = false;

            // 입력 방지
            exceptionInput(checkPasswordId, passwordKeyCodeSet);

            // 유효성 검사
            checkPasswordId.bind("focusin keyup", function (e) {
                isPossibleValidatedCheckPassword = checkInput(checkPasswordId,$("#checkPasswordSmallText"),passwordRegex,passwordLength);
            });

            // 패스 워드 일치 확인, 모든 입력 완료 유무 확인
            checkPasswordId.focusout(function () {
                let isSame;
                if(isPossibleValidatedCheckPassword === true ) {
                    isSame = checkInputPassword(passwordId, checkPasswordId, $("#checkPasswordSmallText"));

                    if(isSame === true) {
                        isInputPasswordComplete = true;
                    } else {
                        isInputPasswordComplete = false;
                    }
                } else {
                    isInputPasswordComplete = false;
                }
                checkInputComplete();
            });


            // ---------- Name ----------
            let isPossibleValidatedName = false;

            // 입력 방지
            exceptionInput(nameId, nameKeyCodeSet);

            // 유효성 검사
            nameId.bind("focusin keyup", function () {
                isPossibleValidatedName = checkInput(nameId,$("#nameSmallText"),nameRegex,nameLength);
            });

            // 모든 입력 완료 유무 확인
            nameId.focusout(function () {
                if(isPossibleValidatedName === true ) {
                    isInputNameComplete = true;
                } else {
                    isInputNameComplete = false;
                }
                checkInputComplete();
            });


            // Tel
            let isPossibleValidatedTel = false;

            // 입력 방지
            exceptionInput(telId, telKeyCodeSet);

            // 유효성 검사
            telId.bind("focusin keyup", function (e) {
                isPossibleValidatedTel = checkInput(telId,$("#telSmallText"),telRegex,telLength);
            });

            // 모든 입력 완료 유무 확인
            telId.focusout(function () {
                if(isPossibleValidatedTel === true ) {
                    isInputTelComplete = true;
                } else {
                    isInputTelComplete = false;
                }
                checkInputComplete();
            });


            // Birth
            // 입력 방지
            exceptionInput(birthId, birthKeyCodeSet);

            // 날짜 선택
            birthId.focusin(function (){
                birthId.daterangepicker({
                    locale : {
                        "format" : "YYYY.MM.DD",
                        "applyLabel" : "확인",
                        "cancelLabel" : "취소",
                        "daysOfWeek" : ["일", "월", "화", "수", "목", "금", "토"],
                        "monthNames" : ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"]
                    },
                    alwaysShowCalendars : true,
                    autoApply : true,
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'),10) + 1,
                    isCustomDate : function () {
                        $(".yearselect").css("float", "left");
                        $(".monthselect").css("float", "right");
                        $(".cancelBtn").css("float", "right");
                    }
                });
            });

            // 모든 입력 완료 유무 확인
            birthId.focusout(function () {
                isInputBirthComplete = true;
                changeClassAndSmallText(birthId, "form-control border-success", $("#birthSmallText"), "text-success", "날짜를 선택했습니다.");
                checkInputComplete();
            });

            // 모든 입력 완료 유무 확인(생성 버튼 활성화)
            function checkInputComplete() {
                if(isInputEmailComplete === true &&
                    isInputPasswordComplete === true &&
                    isInputNameComplete === true &&
                    isInputTelComplete === true &&
                    isInputBirthComplete === true ) {
                    $("#createButton").prop("disabled", false);
                } else {
                    $("#createButton").prop("disabled", true);
                }
            }
        });

    </script>

@endsection

