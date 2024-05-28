function move_bottom () {
    let src = document.getElementById("users");
    let src2 = document.getElementById("user_management");

    src2.removeAttribute("class");
    src.setAttribute("onclick", "move_top()");
}

function move_top () {
    let src = document.getElementById("users");
    let src2 = document.getElementById("user_management");

    src2.setAttribute("class", "no_display");
    src.setAttribute("onclick", "move_bottom()");
}