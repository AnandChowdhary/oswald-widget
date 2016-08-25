var oswald = function() {
    var oswaldLinks = [].slice.call(document.querySelectorAll("[data-oswald], .oswald-service"));
    oswaldLinks.forEach(function(item) {
        addEventListener(item, "click", function(e) {
            oswald.call(item);
            e.preventDefault();
        });
    });
}

var global_clientID = "";
oswald.unqiueID = function() {
    return Math.random().toString(36).slice(2);
}

var oswaldCSS = document.createElement("style");
oswaldCSS.setAttribute("id", global_clientID + "css");
oswaldCSS.setAttribute("type", "text/css");
var documentHead = document.head || document.querySelector("head");
documentHead.appendChild(oswaldCSS);

oswald.mode = "";
oswald.css = function(css, mode, button) {

    // Add custom CSS
    oswaldCSS.innerHTML = css;
    oswald.mode = mode;

    // Add active state to button
    var oswaldButtons = [].slice.call(document.querySelectorAll(".oswald-button"));
    oswaldButtons.forEach(function(item) {
        if (item.classList) {
            item.classList.remove("oswald-button-active");
        } else {
            item.className = item.className.replace(new RegExp('(^|\\b)' + "oswald-button-active".split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        }
    });
    if (document.querySelector("[data-button-id='" + button + "']").classList) {
        document.querySelector("[data-button-id='" + button + "']").classList.add("oswald-button-active");
    } else {
        document.querySelector("[data-button-id='" + button + "']").className += " oswald-button-active";
    }

    // Add analytics
    var request = new XMLHttpRequest();
    request.open("GET", "includes/analytics.php?client_id=" + encodeURI(global_clientID) + "&event_info=" + encodeURI(mode), true);
    //request.open("GET", "https://oswald.foundation/developers/includes/analytics.php?client_id=" + encodeURI(global_clientID) + "&event_info=" + encodeURI(mode), true);
    request.onreadystatechange = function() {
        if (this.readyState === 4) {
            if (this.status >= 200 && this.status < 400) {
                var data = this.responseText;
                if (data == "Error") {
                    errorlog("Error: Analytics request failed");
                }
            } else {
                errorlog("Error: Analytics request failed");
            }
        }
    };
    request.send();
    request = null;

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

        // Add global CSS
        oswaldStyles.setAttribute("type", "text/css");
        oswaldStyles.innerHTML = ".o" + global_clientID + "{z-index:999999;text-align:center;position:absolute;background:#fff;padding:30px;box-sizing:border-box;width:300px;max-width:100%;height:300px;border-radius:3px;overflow:auto}.o" + global_clientID + "triangle{content:'';width:0;height:0;border-top: 7px solid transparent;border-bottom: 7px solid transparent;border-right: 10px solid #fff;position:absolute;z-index:999999}.oswald-cross-btn{position:absolute;right:20px;top:15px;font-size:150%;cursor:pointer}.o" + global_clientID + "bg{position:fixed;left:0;right:0;top:0;bottom:0;z-index:999998;background:rgba(0,0,0,0.5)}.o" + global_clientID + "::-webkit-scrollbar{width:10px;border-radius:3px}.o" + global_clientID + "::-webkit-scrollbar-track{}.o" + global_clientID + "::-webkit-scrollbar-thumb{background:#aaa;border:5px solid whitesmoke;border-left:0;border-radius:3px}";
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
        //var requestURL = "https://oswald.foundation/developers/includes/methods.php?oswald_uniqueID=" + global_clientID;
        request.open("GET", requestURL, true);
        request.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status >= 200 && this.status < 400) {
                    var data = JSON.parse(this.responseText);
                    oswaldStyles.innerHTML += data[1];
                    var oswaldCategories = "";
                    var oswaldCategories_a = [], oswaldCategories_b = [];
                    // Add Accessibility options
                    Object.keys(data[4]).forEach(function(item) {
                        oswaldCategories_a.push(item);
                    });
                    for (var key in data[4]) {
                        if (Object.prototype.hasOwnProperty.call(data[4], key)) {
                            oswaldCategories_b.push(data[4][key]);
                        }
                    }
                    for (i = 0; i < oswaldCategories_a.length; i++) {
                        oswaldCategories += "<button class='oswald-button' data-button-id='" + i + "' onclick='oswald.css(\"" + oswaldCategories_b[i] + "\", \"" + oswaldCategories_a[i] + "\", \"" + i + "\");'>" + oswaldCategories_a[i] + "</button>";
                    }
                    oswaldLoad.innerHTML = data[3] + oswaldCategories + data[2];
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

// http://tokenposts.blogspot.in/2012/04/javascript-objectkeys-browser.html
if (!Object.keys) Object.keys = function(o) {
    if (o !== Object(o))
        throw new TypeError("Object.keys called on a non-object");
    var k = [],
        p;
    for (p in o)
        if (Object.prototype.hasOwnProperty.call(o, p)) k.push(p);
    return k;
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
