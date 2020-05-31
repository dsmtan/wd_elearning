window.addEventListener("DOMContentLoaded", init);

function init() {
    fetch("assets/background_path.svg")
        .then(response => response.text())
        .then(svgdata => {
            document.querySelector("#background_path").insertAdjacentHTML("afterbegin", svgdata);
        });
    fetch("assets/module1.svg")
        .then(response => response.text())
        .then(svgdata => {
            document.querySelector("#i_module1001").insertAdjacentHTML("beforeend", svgdata);
        });
    fetch("assets/module2.svg")
        .then(response => response.text())
        .then(svgdata => {
            document.querySelector("#i_module1002").insertAdjacentHTML("beforeend", svgdata);
        });
    fetch("assets/module3.svg")
        .then(response => response.text())
        .then(svgdata => {
            document.querySelector("#i_module1003").insertAdjacentHTML("beforeend", svgdata);
        });
    fetch("assets/module4.svg")
        .then(response => response.text())
        .then(svgdata => {
            document.querySelector("#i_module1004").insertAdjacentHTML("beforeend", svgdata);
        });
    fetch("assets/module5.svg")
        .then(response => response.text())
        .then(svgdata => {
            document.querySelector("#i_module1005").insertAdjacentHTML("beforeend", svgdata);
        });
    fetch("assets/module6.svg")
        .then(response => response.text())
        .then(svgdata => {
            document.querySelector("#i_module1006").insertAdjacentHTML("beforeend", svgdata);
        });

}

