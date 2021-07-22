// Email
const emailRegex = /^[a-zA-Z](?:[a-zA-Z0-9]|(?:[-_.][a-zA-Z0-9]+))+@[a-zA-Z]{2,}\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})*/;
const emailKeyCodeSet = new Set();

// Password
const passwordRegex = /[a-zA-Z0-9]+[!@#$%^&*()]+(?:[a-zA-Z0-9]+[!@#$%^&*()]*)*/;
const passwordKeyCodeSet = new Set();

// Name
const nameRegex = /[a-zA-Z가-힣]{2,20}/;
const nameKeyCodeSet = new Set();

// Tel
const telRegex = /^01[016-9]-\d{3,4}-\d{4}/;
const telKeyCodeSet = new Set();

// Birth
const birthRegex = /^[a-zA-Z](?:[a-zA-Z0-9]|(?:[-_.][a-zA-Z0-9]+))+@[a-zA-Z]{2,}\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})*/;
const birthKeyCodeSet = new Set();




// Keycode Set 생성(
function makeKeycodeSet() {
    // !
    passwordKeyCodeSet.add(33)

    // #
    passwordKeyCodeSet.add(35);

    // $
    passwordKeyCodeSet.add(36);

    // %
    passwordKeyCodeSet.add(37);

    // &
    passwordKeyCodeSet.add(38);

    // (
    passwordKeyCodeSet.add(40);

    // )
    passwordKeyCodeSet.add(41);

    // *
    passwordKeyCodeSet.add(42);

    // -
    emailKeyCodeSet.add(45);
    telKeyCodeSet.add(45);

    // .
    emailKeyCodeSet.add(46);

    // 0 ~ 9
    for (let i = 48; i <= 57; ++i) {
        emailKeyCodeSet.add(i);
        passwordKeyCodeSet.add(i);
        telKeyCodeSet.add(i);
    }

    // @
    emailKeyCodeSet.add(64);
    passwordKeyCodeSet.add(64);

    // A ~ Z
    for (let i = 65; i <= 90; ++i) {
        emailKeyCodeSet.add(i);
        passwordKeyCodeSet.add(i);
        nameKeyCodeSet.add(i);
    }

    // ^
    passwordKeyCodeSet.add(94);

    // _
    emailKeyCodeSet.add(95);

    // a ~ z
    for (let i = 97; i <= 122; ++i) {
        emailKeyCodeSet.add(i);
        passwordKeyCodeSet.add(i);
        nameKeyCodeSet.add(i);
    }
}
