
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function PlaySound() {
    var sound = document.getElementById("audio");
    sound.play()
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

