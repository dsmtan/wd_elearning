window.addEventListener("DOMContentLoaded", init);


function init() {
    fetch("assets/login_robot.svg")
        .then((response) => response.text())
        .then((svgdata) => {
            document
                .querySelector("#i_logo")
                .insertAdjacentHTML("afterbegin", svgdata);
            blinkRobot();
        });
}

function blinkRobot() {
    let tlBlink = new TimelineMax({ repeat: -1, repeatDelay: 3 });
    tlBlink.add("close");

    tlBlink.fromTo('#eyes', 0.1,
        { scaleY: 1, transformOrigin: "center", },
        { scaleY: 0 }, "close");

    tlBlink.add("open");

    tlBlink.fromTo('#eyes', 0.1,
        { scaleY: 0, transformOrigin: "center", },
        { scaleY: 1, }, "open");
    return tlBlink;
}