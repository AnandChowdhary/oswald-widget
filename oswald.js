var oswald = function() {
    var oswaldLinks = [].slice.call(document.querySelectorAll("[data-oswald], .oswald-service"));
    oswaldLinks.forEach(function(item) {
        if (item.classList) {
            item.classList.add("oswald-off");
        } else {
            item.className += " oswald-off";
        }
        addEventListener(item, "click", function(e) {
            oswald.call(item);
            e.preventDefault();
        });
    });
}

var global_clientID = "";
oswald.unqiueID = function() {
    var characters = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "-", "_"];
    var temp_id = "";
    for (i = 0; i < 16; i++) {
        temp_id += characters[Math.floor(Math.random() * characters.length)];
    }
    return temp_id;
}

oswald.called = 0;
oswald.call = function(item) {

    if (oswald.called == 0) {

        // Generate new client ID
        global_clientID = oswald.unqiueID();
        oswald.called++;

        // Add client and related elements to body
        var documentHead = document.head || document.querySelector("head");
        var documentBody = document.body || document.querySelector("body");
        var oswaldStyles = document.createElement("style");

        // Add CSS to header
        oswaldStyles.setAttribute("type", "text/css");
        oswaldStyles.innerHTML = ".o" + global_clientID + "{z-index:999999;position:absolute;background:whitesmoke;padding:20px;width:300px;max-width:100%;height:200px;border-radius:3px;overflow:auto}.o" + global_clientID + "triangle{content:'';width:0;height:0;border-top: 7px solid transparent;border-bottom: 7px solid transparent;border-right: 10px solid whitesmoke;position:absolute;z-index:999999}.oswald-cross-btn{position:absolute;right:20px;top:15px;font-size:150%;cursor:pointer}.o" + global_clientID + "bg{position:fixed;left:0;right:0;top:0;bottom:0;z-index:999998;background:rgba(0,0,0,0.5)}.o" + global_clientID + "::-webkit-scrollbar{width:15px;border-radius:3px}.o" + global_clientID + "::-webkit-scrollbar-track{}.o" + global_clientID + "::-webkit-scrollbar-thumb{background:#aaa;border:5px solid whitesmoke;border-radius:3px}";
        documentHead.appendChild(oswaldStyles);

        // Create lightbox background layer
        var oswaldBackground = document.createElement("div");
        if (oswaldBackground.classList) {
            oswaldBackground.classList.add("o" + global_clientID + "bg");
        } else {
            oswaldBackground.className += " " + ("o" + global_clientID + "bg");
        }

        // Add client UI
        var oswaldClient = document.createElement("div");
        if (oswaldClient.classList) {
            oswaldClient.classList.add("o" + global_clientID);
        } else {
            oswaldClient.className += " " + ("o" + global_clientID);
        }

        // Add client UI elements
        var oswaldClientTriangle = document.createElement("div");
        if (oswaldClientTriangle.classList) {
            oswaldClientTriangle.classList.add("o" + global_clientID + "triangle");
        } else {
            oswaldClientTriangle.className += " " + ("o" + global_clientID + "triangle");
        }

        // Add client preloader
        var oswaldLoad = document.createElement("div");
        if (oswaldLoad.classList) {
            oswaldLoad.classList.add("oswald-loading");
        } else {
            oswaldLoad.className += " " + ("oswald-loading");
        }

        // Add click functionality on lightbox
        addEventListener(oswaldBackground, "click", function() {
            document.querySelector(".o" + global_clientID).style.display = "none";
            document.querySelector(".o" + global_clientID + "bg").style.display = "none";
            document.querySelector(".o" + global_clientID + "triangle").style.display = "none";
        });

        // Add positioning to client UI
        oswaldClient.style.left = item.offsetLeft + item.offsetWidth + 20;
        oswaldClient.style.top = item.offsetTop - 16;

        // Add positioning to client UI elements
        oswaldClientTriangle.style.left = item.offsetLeft + item.offsetWidth + 10;
        oswaldClientTriangle.style.top = item.offsetTop;

        oswaldLoad.innerHTML = "Loading...";
        documentBody.appendChild(oswaldClient);
        documentBody.appendChild(oswaldClientTriangle);
        documentBody.appendChild(oswaldBackground);
        oswaldClient.appendChild(oswaldLoad);

        // Call Oswald server
        var request = new XMLHttpRequest();
        var requestURL = "includes/methods.php?oswald_uniqueID=" + global_clientID;
        request.open("GET", requestURL, true);
        request.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status >= 200 && this.status < 400) {
                    var data = JSON.parse(this.responseText);
                    oswaldStyles.innerHTML += data[1];
                    setTimeout(function() {
                        oswaldLoad.innerHTML = data[3] + data[2];
                    }, 1000);
                } else {
                    errorlog("Error: Communication with Oswald server failed");
                }
            }
        };
        request.send();
        request = null;

    } else {

        document.querySelector(".o" + global_clientID).style.display = "";
        document.querySelector(".o" + global_clientID + "triangle").style.display = "";
        document.querySelector(".o" + global_clientID + "bg").style.display = "";

    }

}

var errorlog = function(content) {
    console.log(content);
}

// Document ready state IE8+
var ready = function(fn) {
    if (document.readyState != "loading") {
        fn();
    } else if (document.addEventListener) {
        document.addEventListener("DOMContentLoaded", fn);
    } else {
        document.attachEvent("onreadystatechange", function() {
            if (document.readyState != "loading")
                fn();
        });
    }
};
// Adding event listeners IE8+
var addEventListener = function(el, eventName, handler) {
    if (el.addEventListener) {
        el.addEventListener(eventName, handler);
    } else {
        el.attachEvent("on" + eventName, function() {
            handler.call(el);
        });
    }
};

// Execute Oswald
ready(oswald);
