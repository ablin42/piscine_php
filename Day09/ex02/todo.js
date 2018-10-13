function createDiv() {
    var content = prompt("Your to-do", "Ex: What you won't do");
    var nbelem = getLastid();

    if (content != null && content != "")
    {
        var div = document.createElement("div");
        div.style.height = "40px";
        div.style.minWidth = "100px";
        div.style.padding = "25px 10px 0px 10px";
        div.style.margin = "5px";
        div.style.background = "#4e4e4e";
        div.style.border = "2px solid orange";
        div.style.color = "white";
        div.className = "todo_" + nbelem;
        div.innerHTML = content;
        div.onclick = function(){
            var ans = prompt("Are you sure you want to delete that to-do?", "Y/N");
            if (ans === "Y" || ans === "y" || ans === "yes" || ans === "Yes" || ans === "YES") {
                delCookie(div.className, div.innerHTML);
                this.parentElement.removeChild(this);
            }
        };
        setCookie(div.className, div.innerHTML, 10800000);
        document.getElementById("ft_list").insertBefore(div, document.getElementById("ft_list").childNodes[0]);
    }
}

function getLastid()
{
    var i = 0;
    var cname = "todo_" + i;
    var lastid = 0;
    while (i < 500)
    {
        if (getCookie(cname) != "")
            lastid = i;
        i++;
        cname = "todo_" + i;
    }
    lastid++;
    return lastid;
}

function loadDiv(content, cname) {

    if (content != null && content != "")
    {
        var div = document.createElement("div");
        div.style.height = "40px";
        div.style.minWidth = "100px";
        div.style.padding = "25px 10px 0px 10px";
        div.style.margin = "5px";
        div.style.background = "#4e4e4e";
        div.style.border = "2px solid orange";
        div.style.color = "white";
        div.className = cname;
        div.innerHTML = content;
        div.onclick = function(){
            var ans = prompt("Are you sure you want to delete that to-do?", "Y/N");
            if (ans === "Y" || ans === "y" || ans === "yes" || ans === "Yes" || ans === "YES") {
                delCookie(div.className, div.innerHTML);
                this.parentElement.removeChild(this);
            }
        };
        document.getElementById("ft_list").insertBefore(div, document.getElementById("ft_list").childNodes[0]);
    }
}

function setCookie(cname, cvalue, time) {
    var d = new Date();
    d.setTime(d.getTime() + time);
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function delCookie(cname, cvalue) {
    var d = new Date();
    d.setTime(d.getTime() - (1000*60*60*24));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');

    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}
