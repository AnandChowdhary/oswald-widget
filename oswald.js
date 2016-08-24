var oswald = function() {

    var oswaldLinks = [].slice.call(document.querySelectorAll("[data-oswald], .oswald-service"));
    oswaldLinks.forEach(function(item) {
        addEventListener(item, "click", function(e) {
            oswald.call();
            e.preventDefault();
        });
    });

}

oswald.called = 0;
oswald.call = function() {
    if (oswald.called == 0) {
        // Call Oswald server
        var request = new XMLHttpRequest();
        request.open("GET", "includes/methods.php", true);
        request.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status >= 200 && this.status < 400) {
                    oswald.called++;
                    var info = this.responseText;
                    document.querySelector(".infolog").innerHTML += "<li>Received:" + info + "<li>";
                } else {
                    errorlog("Error: Communication with Oswald server failed");
                }
            }
        };
        request.send();
        request = null;
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
