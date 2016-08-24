var oswald = function() {

    var oswaldLinks = [].slice.call(document.querySelectorAll("[data-oswald], .oswald-service"));
    oswaldLinks.forEach(function(item) {
        addEventListener(item, "click", function(e) {
            oswald.call(item);
            e.preventDefault();
        });
    });

}

oswald.called = 0;
var oswald_uniqueID = 0;
oswald.call = function(item) {
    if (oswald.called == 0) {
        oswald_uniqueID = parseInt(Math.random() * 10**10);
        oswald.called++;
        // Add client to body
        var documentHead = document.head || document.querySelector("head");
        var documentBody = document.body || document.querySelector("body");
        var oswaldStyles = document.createElement("style");
        oswaldStyles.setAttribute("type", "text/css");
        oswaldStyles.innerHTML = ".o" + oswald_uniqueID + "{z-index:999999;position:absolute;background:whitesmoke;padding:20px;width:300px;max-width:100%;height:200px;border-radius:3px;overflow:auto}.o" + oswald_uniqueID + "triangle{content:'';width:0;height:0;border-top: 7px solid transparent;border-bottom: 7px solid transparent;border-right: 10px solid whitesmoke;position:absolute;z-index:999999}.oswald-cross-btn{position:absolute;right:20px;top:15px;font-size:150%;cursor:pointer}.o" + oswald_uniqueID + "bg{position:fixed;left:0;right:0;top:0;bottom:0;z-index:999998;background:rgba(0,0,0,0.5)}.o" + oswald_uniqueID + "::-webkit-scrollbar{width:15px;border-radius:3px}.o" + oswald_uniqueID + "::-webkit-scrollbar-track{}.o" + oswald_uniqueID + "::-webkit-scrollbar-thumb{background:#aaa;border:5px solid whitesmoke;border-radius:3px}";
        documentHead.appendChild(oswaldStyles);
        var oswaldBackground = document.createElement("div");
        if (oswaldBackground.classList) {
            oswaldBackground.classList.add("o" + oswald_uniqueID + "bg");
        } else {
            oswaldBackground.className += " " + ("o" + oswald_uniqueID + "bg");
        }
        addEventListener(oswaldBackground, "click", function() {
            document.querySelector(".o" + oswald_uniqueID).style.display = "none";
            document.querySelector(".o" + oswald_uniqueID + "bg").style.display = "none";
            document.querySelector(".o" + oswald_uniqueID + "triangle").style.display = "none";
        });
        var oswaldClient = document.createElement("div");
        if (oswaldClient.classList) {
            oswaldClient.classList.add("o" + oswald_uniqueID);
        } else {
            oswaldClient.className += " " + ("o" + oswald_uniqueID);
        }
        var oswaldClientTriangle = document.createElement("div");
        var oswaldClientTriangle = document.createElement("div");
        if (oswaldClientTriangle.classList) {
            oswaldClientTriangle.classList.add("o" + oswald_uniqueID + "triangle");
        } else {
            oswaldClientTriangle.className += " " + ("o" + oswald_uniqueID + "triangle");
        }
        oswaldClient.style.left = item.offsetLeft + item.offsetWidth + 20;
        oswaldClient.style.top = item.offsetTop - 16;
        oswaldClientTriangle.style.left = item.offsetLeft + item.offsetWidth + 10;
        oswaldClientTriangle.style.top = item.offsetTop;
        var oswaldLoad = document.createElement("div");
        documentBody.appendChild(oswaldClient);
        documentBody.appendChild(oswaldClientTriangle);
        documentBody.appendChild(oswaldBackground);
        if (oswaldLoad.classList) {
            oswaldLoad.classList.add("oswald-loading");
        } else {
            oswaldLoad.className += " " + ("oswald-loading");
        }
        oswaldLoad.innerHTML = "Loading...";
        oswaldClient.appendChild(oswaldLoad);
        // Call Oswald server
        var request = new XMLHttpRequest();
        request.open("GET", "includes/methods.php?oswald_uniqueID=" + oswald_uniqueID, true);
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
        document.querySelector(".o" + oswald_uniqueID).style.display = "";
        document.querySelector(".o" + oswald_uniqueID + "triangle").style.display = "";
        document.querySelector(".o" + oswald_uniqueID + "bg").style.display = "";
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
