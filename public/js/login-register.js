window.onload = function() {
    var elements = document.querySelectorAll("input[type='password'][data-eye]");
    Array.prototype.forEach.call(elements, function(element, i) {
        var newDiv = document.createElement('div');
        newDiv.style.position = "relative";
        wrapAll([element], newDiv);

        element.style.paddingRight = "60px";

        var newDiv2 = document.createElement('div');
        newDiv2.innerHTML = "Show";
        newDiv2.className = "btn btn-primary btn-sm";
        newDiv2.id = "passeye-toggle-"+i;
        newDiv2.style.position = "absolute";
        newDiv2.style.right = "10px";
        newDiv2.style.top = "50%";
        newDiv2.style.transform = "translate(0,-50%)";
        newDiv2.style.webkitTransform = "translate(0,-50%)";
        newDiv2.style.OTransform = "translate(0,-50%)";
        newDiv2.style.padding = "2px 7px";
        newDiv2.style.fontSize = "12px";
        newDiv2.style.cursor = "pointer";
        element.insertAdjacentHTML('afterend', nodeToString(newDiv2));

        /*var newInput = document.createElement('input');
        newInput.type = "hidden";
        newInput.id = "passeye-"+i;
        element.insertAdjacentHTML('afterend', nodeToString(newInput));*/

       /* element.addEventListener("keyup paste", function() {
            document.getElementById("passeye-"+i).value = element.value;
        });*/
        var el = document.getElementById("passeye-toggle-"+i);
        el.addEventListener("click", function() {
            if (element.classList.contains('show')) {
                element.type = "password";
                element.classList.remove("show");
                el.classList.remove("btn-outline-primary");
            } else {
                element.type = "text";
               /* element.value = document.getElementById("passeye-"+i).value;*/
                element.classList.add("show");
                el.classList.add("btn-outline-primary");
            }
        });
    });
};



// Wrap wrapper around nodes
// Just pass a collection of nodes, and a wrapper element
function wrapAll(nodes, wrapper) {
    // Cache the current parent and previous sibling of the first node.
    var parent = nodes[0].parentNode;
    var previousSibling = nodes[0].previousSibling;

    // Place each node in wrapper.
    //  - If nodes is an array, we must increment the index we grab from
    //    after each loop.
    //  - If nodes is a NodeList, each node is automatically removed from
    //    the NodeList when it is removed from its parent with appendChild.
    for (var i = 0; nodes.length - i; wrapper.firstChild === nodes[0] && i++) {
        wrapper.appendChild(nodes[i]);
    }

    // Place the wrapper just after the cached previousSibling,
    // or if that is null, just before the first child.
    var nextSibling = previousSibling ? previousSibling.nextSibling : parent.firstChild;
    parent.insertBefore(wrapper, nextSibling);

    return wrapper;
}


function nodeToString ( node ) {
    var tmpNode = document.createElement( "div" );
    tmpNode.appendChild( node.cloneNode( true ) );
    var str = tmpNode.innerHTML;
    tmpNode = node = null; // prevent memory leaks in IE
    return str;
}