function createDiv() {
    var content = prompt("Your to-do", "Ex: What you won't do");
    var nbelem = document.getElementById("ft_list").childElementCount;

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
            this.parentElement.removeChild(this);
    };
        document.getElementById("ft_list").insertBefore(div, document.getElementById("ft_list").childNodes[0]);
    }
}