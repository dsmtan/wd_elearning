window.addEventListener("DOMContentLoaded", init);


function init() {
    fetch("assets/robot_happy.svg")
        .then(response => response.text())
        .then(svgdata => {
            document.querySelector("#i_robot_happy").insertAdjacentHTML("afterbegin", svgdata);
            happyRobot();
        });
    fetch("assets/robot_sad.svg")
        .then(response => response.text())
        .then(svgdata => {
            document.querySelector("#i_robot_sad").insertAdjacentHTML("afterbegin", svgdata);
            sadRobot();
        });

}


function happyRobot() {

    let tlHappy = new TimelineMax({ repeat: -1 });
    tlHappy.add("close");

    tlHappy.fromTo('#eyes', 0.1,
        { scaleY: 1, transformOrigin: "center", },
        { scaleY: 0 }, "close");

    tlHappy.add("open");

    tlHappy.fromTo('#eyes', 0.1,
        { scaleY: 0, transformOrigin: "center", },
        { scaleY: 1, }, "open");


    //////////////////////////////



    tlHappy.add("prepare");

    tlHappy.to("#robot", 0.2,
        { scaleX: 1.1, scaleY: 0.9, transformOrigin: "bottom", },
        "prepare");
    tlHappy.to("#shadow", 0.2,
        { scaleX: 1.2, scaleY: 0.9, transformOrigin: "bottom", },
        "prepare");

    tlHappy.add("jumpUp");

    tlHappy.to("#robot", 0.2,
        { scaleX: 1, scaleY: 1, transformOrigin: "bottom", },
        "jumpUp");
    tlHappy.to('#left-eye', 0.1,
        { scaleX: 0.5, transformOrigin: "center", }, "jumpUp");
    tlHappy.to('#right-eye', 0.1,
        { scaleX: 0.5, transformOrigin: "center", }, "jumpUp");


    tlHappy.to("#robot", 0.2,
        { y: -100, scaleY: 1.05 },
        "jumpUp");
    tlHappy.to("#shadow", 0.2,
        { scaleX: 0.7, transformOrigin: "center", },
        "jumpUp");


    tlHappy.add("prepareDown");

    tlHappy.to("#robot", 0.2,
        { y: -100, scaleY: 0.9, scaleX: 1.1, transformOrigin: "top", },
        "prepareDown");

    tlHappy.add("down");

    tlHappy.to("#robot", 0.2,
        { y: 0, scaleY: 1.05 },
        "down");

    tlHappy.add("flat");

    tlHappy.to("#robot", 0.1,
        { scaleX: 1.1, scaleY: 0.9, transformOrigin: "bottom", },
        "flat");
    tlHappy.to("#shadow", 0.1,
        { scaleX: 1.1, scaleY: 0.9, transformOrigin: "bottom", },
        "flat");
}

function sadRobot() {
    let tlSad = new TimelineMax({ repeat: -1, repeatDelay: 0.5 });

    tlSad.add("close");

    tlSad.fromTo('#eyes', 0.1,
        { scaleY: 1, transformOrigin: "center", },
        { scaleY: 0 }, "close");

    tlSad.add("open");

    tlSad.fromTo('#eyes', 0.1,
        { scaleY: 0, transformOrigin: "center", },
        { scaleY: 1, }, "open");

    tlSad.add("eyesDown");

    tlSad.to('#eyes', 1,
        { y: 25, scale: 0.9 }, "eyesDown");

    tlSad.to('#left-eye', 0.7,
        { scaleY: 0.6, x: 1, }, "eyesDown");
    tlSad.to('#right-eye', 0.7,
        { scaleY: 0.6, x: -1, }, "eyesDown");


    tlSad.add("blinkDownClose");

    tlSad.fromTo('#eyes', 0.1,
        { scaleY: 1, transformOrigin: "center", },
        { scaleY: 0 }, "blinkDownClose");

    tlSad.add("blinkDownOpen");

    tlSad.fromTo('#eyes', 0.1,
        { scaleY: 0, transformOrigin: "center", },
        { scaleY: 1, }, "blinkDownOpen");


    tlSad.add("eyesLeft");

    tlSad.to('#eyes', 1,
        { y: 18, x: -13 }, "eyesLeft");

    tlSad.to('#right-eye', 0.7,
        { x: -9, }, "eyesLeft");


    tlSad.add("normal");

    tlSad.to('#eyes', 1,
        { y: 0, x: 0, scale: 1 }, "normal");

    tlSad.to('#left-eye', 0.7,
        { scaleY: 1, x: 0, }, "normal");

    tlSad.to('#right-eye', 0.7,
        { scaleY: 1, x: 0, }, "normal");

}

