// 입력 확인
function checkInput(inputObj, textObj, regex, length) {

    let isPossible = true;

    let inputValue = inputObj.val();

    if (inputValue == "") {
        changeClassAndSmallText(inputObj, "form-control border-warning", textObj, "text-warning", "공백입니다. 정보를 입력해 주세요.");
        isPossible = false;
    } else if (!isPossibleLength(inputObj, length)) {
        changeClassAndSmallText(inputObj, "form-control border-danger", textObj, "text-danger", length + "자를 초과하였습니다.");
        isPossible = false;
    } else if (!isValidation(inputValue, regex)) {
        changeClassAndSmallText(inputObj, "form-control border-warning", textObj, "text-warning", "알맞지 않은 형식입니다.")
        isPossible = false;
    } else if (isValidation(inputValue, regex)) {
        changeClassAndSmallText(inputObj, "form-control border-success", textObj, "text-success", "알맞은 형식입니다.")
    }

    return isPossible;
}

// 중복 이메일 체크
function checkInputEmail(inputObj, textObj) {

        let inputValue = inputObj.val();
        let isDuplicate = true;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : 'POST',
            data : {
                email : inputValue
            },
            async : false,
            url : "/create-member/check-email",
            success : function(data) {
                if (data == '1') {
                    changeClassAndSmallText(inputObj, "form-control border-danger", textObj, "text-danger", "중복된 이메일 입니다.");
                } else if (data == '0') {
                    isDuplicate = false;
                    changeClassAndSmallText(inputObj, "form-control border-success", textObj, "text-success", "사용 가능한 이메일 입니다.");
                }
            }
        });

        return isDuplicate;
}

// 이메일 코드 전송
function sendEmail(emailObj) {

    let emailValue = emailObj.val();
    let result;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        async : false,
        data : {
            email : emailValue
        },
        url : "/create-member/send-email",
        success : function(data) {
            result = data;
        }
    });

    return result;
}

// 비밀번호 확인
function checkInputPassword(checkObj, inputObj, textObj) {
    let checkValue = checkObj.val();
    let inputValue = inputObj.val();

    let isSame = false;

    if(checkValue === inputValue) {
        isSame = true;
        changeClassAndSmallText(inputObj, "form-control border-success", textObj, "text-success", "비밀번호가 같습니다.");
    } else {
        isSame = false;
        changeClassAndSmallText(inputObj, "form-control border-danger", textObj, "text-danger", "비밀번호가 다릅니다.");
    }

    return isSame;
}

// 입력 방지
function exceptionInput(inputObj, keyCodeSet) {

    inputObj.keypress(function (){
       let keyCode =  event.keyCode;

       if(!keyCodeSet.has(keyCode))
           event.returnValue = false;
    });
}

function hangeulExceptionInput(inputObj) {
    let regex = /[ㄱ-ㅎ가-힣]+/;
    inputObj.keyup(function (){
        let inputValue = inputObj.val();
        if(regex.test(inputValue)) {
            inputObj.val(inputValue.replace(regex,""));
        }
    });
}

// class와 small(text) 바꾸기
function changeClassAndSmallText(inputObj, inputClass, textObj, textClass, Msg) {
    inputObj.attr("class", inputClass);

    textObj.show();
    textObj.attr("class", textClass);
    textObj.text(Msg);
}

// 입력 제한 길이 확인
function isPossibleLength(inputObj, length) {
    let inputValue =  inputObj.val();

    if(inputValue.length > length) {
        return false;
    }

    return true;
}

// 유효성 검사
function isValidation(inputed, regex) {

    if(regex.test(inputed)) {
        return true;
    }

    return false;
}
