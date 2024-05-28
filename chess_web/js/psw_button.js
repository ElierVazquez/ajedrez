function show() {
    let src = document.getElementById("psw_button");
    let src2 = document.getElementById("user_psw");

    src.setAttribute("src", "../../img/hide.svg");
    src2.setAttribute("type", "text");
    src.setAttribute("onclick", "hide()");
}

function hide() {
    let src = document.getElementById("psw_button");
    let src2 = document.getElementById("user_psw");

    src.setAttribute("src", "../../img/show.svg");
    src2.setAttribute("type", "password");
    src.setAttribute("onclick", "show()");
}