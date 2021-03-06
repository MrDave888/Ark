/* Original code taken from https://jsfiddle.net/Daniel_Hug/pvk6p/ and altered for this app */

var seconds = 0, minutes = 0, hours = 0,
    t;

function add() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }

    document.getElementsByClassName('loader')[0].innerHTML = "<p>"+(hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds)+"</p>";

    timer();
}
function timer() {
    t = setTimeout(add, 1000);
}
timer();


/* Start button */
document.getElementsByClassName('start').onclick = timer;

/* Stop button */
document.getElementsByClassName('pause').onclick = function() {
    clearTimeout(t);
}

/* Clear button */
document.getElementsByClassName('stop').onclick = function() {
    document.getElementsByClassName('loader')[0].textContent = "00:00:00";
    seconds = 0; minutes = 0; hours = 0;
}
