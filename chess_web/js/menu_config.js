function show_config()
{
    let src = document.getElementById("config");
    let element = document.getElementById("config_menu");
    let element_text = document.getElementById("config_list");

    element.removeAttribute("class");
    src.setAttribute("class", "rotate");
    src.setAttribute("onclick", "hide_config()");
    element_text.removeAttribute("class");
}

function hide_config()
{
    let src = document.getElementById("config");
    let element = document.getElementById("config_menu");
    let element_text = document.getElementById("config_list");

    element.setAttribute("class", "config_hide");
    src.removeAttribute("class");
    src.setAttribute("onclick", "show_config()");
    element_text.setAttribute("class", "hide_list");
}