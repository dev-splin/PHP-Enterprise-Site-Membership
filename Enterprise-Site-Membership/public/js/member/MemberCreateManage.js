
function inputCheckEmail(inputObj, textObj, regex, length) {

    var isPossible = inputCheck(inputObj, textObj, regex, length);

    if(isPossible) {
        inputObj.focusout(function () {
            var inputValue = inputObj.val();

            $.ajax({
                type : 'POST',
                data : {
                    "_token": "{{ csrf_token() }}",
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
        });
    }
}

function inputCheck(inputObj, textObj, regex, length) {

    var isPossible = true;

    inputObj.bind("focus input", function () {
        var inputValue = inputObj.val();

        if(inputValue == "") {
            changeClassAndSmallText(inputObj, "form-control border-warning", textObj, "text-warning", "공백입니다. 정보를 입력해 주세요.");
            isPossible = false;
        } else if(!isPossibleLength(inputObj,length)) {
            changeClassAndSmallText(inputObj, "form-control border-danger", textObj, "text-danger", length + "자를 초과하였습니다.");
            isPossible = false;
        } else if(!isValidation(inputObj,regex)) {
            changeClassAndSmallText(inputObj, "form-control border-warning", textObj, "text-warning", "알맞지 않은 형식입니다.")
            isPossible = false;
        } else if(isValidation(inputObj,regex)) {
            changeClassAndSmallText(inputObj, "form-control border-success", textObj, "text-success", "알맞은 형식입니다.")
            isPossible = false;
        }
    });

    return isPossible;
}

function exceptionInput(inputObj, exceptionInputRegex) {
    inputObj.on("input", function (){
       var inputValue =  $(this).val();

       if(inputValue.length > 0 && inputValue.test(exceptionInputRegex)) {
           inputValue = inputValue.replace(exceptionInputRegex, "");
       }

       $(this).val(inputValue);
    });
}


function changeClassAndSmallText(inputObj, inputClass, textObj, textClass, Msg) {
    inputObj.attr("class", inputClass);

    textObj.prop("disabled", true);
    textObj.attr("class", textClass);
    textObj.text(Msg);
}


function isPossibleLength(inputObj, length) {
    var inputValue =  inputObj.val();

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
