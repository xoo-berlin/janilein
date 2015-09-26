function Writer(elem) {
    this.elem= elem;
    this.console= null;
    this.write = function(text) {
        if (this.console === null) {
            this.console = document.getElementById(this.elem);
            this.addNode(this.console, text);
        } else {
            this.addNode(this.console, text);
            // this.repNode(this.console, text);
        }
    };
    this.addNode= function(elem, text) {
        var newText = document.createTextNode(text);
        var br = document.createElement("br");
        elem.appendChild(newText);
        elem.appendChild(br);
    };
    this.repNode= function(elem, text) {   
        elem.firstChild.replaceData(0,text.length, text);
    };
}
function write2console(text) {
    if(write2console.wrt === undefined) {
        write2console.wrt= new Writer("Comment");
    }
    write2console.wrt.write(text);
}

