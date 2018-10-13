$(document).ready(function() {

    $('#button').click(function(){
        var content = prompt("Your to-do", "Ex: What you won't do");
        var nbelem = getLastid();
        var id_box = 'todo_' + nbelem;

        if (content != null && content != "") {
            jQuery('<div/>', {
                id: id_box,
                class: 'to_do_box',
                text: content,
                style: 'height: 40px;' +
                    'min-width: 100px;' +
                    'padding: 25px 10px 0px 10px;' +
                    'margin: 5px;' +
                    'background: #4e4e4e;' +
                    'border: 2px solid orange;' +
                    'color: white;}',
                 click: function(){
                     var ans = prompt("Are you sure you want to delete that to-do?", "Y/N");
                     if (ans === "Y" || ans === "y" || ans === "yes" || ans === "Yes" || ans === "YES") {
                         delCookie(id_box, content);
                         $('#' + id_box).remove();
                     }
                }
            }).prependTo('#ft_list');
            setCookie(id_box, content, 10800000);
        }
    });
});

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


function loadDiv (content, cname) {

    if (content != null && content != "") {
        jQuery('<div/>', {
            id: cname,
            class: 'to_do_box',
            text: content,
            style: 'height: 40px;' +
                'min-width: 100px;' +
                'padding: 25px 10px 0px 10px;' +
                'margin: 5px;' +
                'background: #4e4e4e;' +
                'border: 2px solid orange;' +
                'color: white;}',
            click: function(){
                var ans = prompt("Are you sure you want to delete that to-do?", "Y/N");
                if (ans === "Y" || ans === "y" || ans === "yes" || ans === "Yes" || ans === "YES") {
                    delCookie(cname, content);
                    $('#' + cname).remove();
                }
            }
        }).prependTo('#ft_list');
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