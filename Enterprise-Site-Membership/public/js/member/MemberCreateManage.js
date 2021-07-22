

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

function checkInputEmail(inputObj, textObj) {

        let inputValue = inputObj.val();

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
            url : "/create-member/check-email",
            success : function(data) {
                if (data == '1') {
                    changeClassAndSmallText(inputObj, "form-control border-danger", textObj, "text-danger", "중복된 이메일 입니다.");
                } else if (data == '0') {
                    changeClassAndSmallText(inputObj, "form-control border-success", textObj, "text-success", "사용 가능한 이메일 입니다.");
                }
            }
        });
}

function checkInputPassword(checkObj, inputObj, textObj) {
    let checkValue = checkObj.val();
    console.log("check : " + checkValue);
    let inputValue = inputObj.val();
    console.log("input : " + inputValue);

    if(checkValue === inputValue) {
        changeClassAndSmallText(inputObj, "form-control border-success", textObj, "text-success", "비밀번호가 같습니다.");
    } else {
        changeClassAndSmallText(inputObj, "form-control border-danger", textObj, "text-danger", "비밀번호가 다릅니다.");
    }
}

function exceptionInput(inputObj, keyCodeSet) {
    inputObj.keypress(function (){
       var keyCode =  event.keyCode;

       if(!keyCodeSet.has(keyCode))
           event.returnValue = false;
    });
}


function changeClassAndSmallText(inputObj, inputClass, textObj, textClass, Msg) {
    inputObj.attr("class", inputClass);

    textObj.prop("disabled", true);
    textObj.attr("class", textClass);
    textObj.text(Msg);
}


function isPossibleLength(inputObj, length) {
    let inputValue =  inputObj.val();

    if(inputValue.length > length) {
        return false;
    }

    return true;
}


function isValidation(inputed, regex) {

    if(regex.test(inputed)) {
        return true;
    }

    return false;
}
