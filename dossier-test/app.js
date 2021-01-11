


var xhttp = new XMLHttpRequest();

// GET

var button = document.getElementById("buttonID");

button.addEventListener("click", function (e) {
    e.preventDefault();

    xhttp.onreadystatechange = function () {

        if (xhttp.readyState == 4 && xhttp.status == 200) {

            var result = document.getElementById("divID");

            result.innerHTML = xhttp.response;
        }
    };

    xhttp.open("GET", 'demo.php', true);

    xhttp.send();
})

// POST

var button2 = document.getElementById("buttonIdPost");

button2.addEventListener("click", function (e) {
    e.preventDefault();

    xhttp.onreadystatechange = function () {

        if (xhttp.readyState == 4 && xhttp.status == 200) {

            /* var pPOST = document.getElementById("pPOST"); */

            console.log(xhttp.response);
        }
    };

    xhttp.open("POST", 'demo-post.php', true);
    xhttp.responseType = "json";
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("pseudo=Heraclys&age=18");
})