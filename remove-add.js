// Get all elements that have a style attribute
var elms = document.querySelectorAll("*[style]");

// Loop through them
Array.prototype.forEach.call(elms, function(elm) {
    // Get the color value
    var zindex = elm.style.zIndex || "";

    if(zindex == "9999999"){
        elm.remove();
        console.log("Hello FIND ------------------------------");
    }

    console.log(zindex);

})


