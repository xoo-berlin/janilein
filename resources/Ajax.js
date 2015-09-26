function processReady(text) {
    console.log(text);

    if( text != null && text.length > 0) {
        var parse = JSON.parse(text);

        var i;
        var content = '';
        for (i = 0; i < parse.length; i++) {
            var rowContent = parse[i].id + ":" + parse[i].message;
            // content += rowContent;
            write2console(rowContent);
        }
    }
}

function resetlog() {
    var ax= new Ajax('resetlog.php', processReady);
    try {
        $params = "";
        ax.send($params);
    } catch (err) {
        alert(err);
    }
}

function log($id, $msg) {
    var ax= new Ajax('logger.php', processReady);
    try {
        $params = "msg=" + escape($msg) + "&id=" + escape($id);
        console.log("sende params: " + $params );
        ax.send($params);
    } catch (err) {
        alert(err);
    }
}

function sendMessage($id, $msg) {
    var ax= new Ajax('sendMessage.php', processReady);
    try {
        $params = "msg=" + escape($msg) + "&id=" + escape($id);
        console.log("sende params: " + $params );
        ax.send($params);
    } catch (err) {
        alert(err);
    }
}

function getLog() {
    var ax= new Ajax('getLoggerJSON.php?new',processReady);
    try {
        $params = "";
        console.log("sende params: " + $params );
        ax.send($params);
    } catch (err) {
        alert(err);
    }
}

function Ajax(url,callBack) {
    var here= this;
    this.url= url;
    this.method= "POST";
    this.callback= callBack;
    this.request = this.getHTTPRequest();	  // Objekt generieren
    if (this.request === null) {
        throw "cant create XMLHttpRequest-Object";
    }
    this.request.onreadystatechange = function(){
        here.processChange.call(here);
    };
}
Ajax.prototype.STATE_UNINITIALIZED = 0;
Ajax.prototype.STATE_LOADING = 1;
Ajax.prototype.STATE_LOADED = 2;
Ajax.prototype.STATE_INTERACTIVE = 3;
Ajax.prototype.STATE_COMPLETE = 4;   //"Konstanten" definieren

Ajax.prototype.getHTTPRequest= function() {
    var req = null;
    if (typeof XMLHttpRequest !== "undefined") {
        req = new XMLHttpRequest(); // Mozilla und Co.
    } else {
        if (typeof ActiveXObject !== "undefined") {
            req = new ActiveXObject("Microsoft.XMLHTTP");
            if (!req) {
                req = new ActiveXObject("Msxml2.XMLHTTP");
            }
        }
    }
    return req;
};
Ajax.prototype.send= function(msg) {
    this.sendRequest(this.url, msg, this.method,false);
};
Ajax.prototype.processChange= function() {
    if (this.request.readyState === this.STATE_COMPLETE) {
        if (this.request.status === 200) {
            this.callback(this.request.responseText);
        } else {
            throw "wrong request.status: " + this.request.status;
        }
    }
};
Ajax.prototype.sendRequest= function(url, params, method, async){
    var state= this.request.readyState;
    if (arguments.length < 3) {
        method = "POST";
    }
    if (arguments.length < 4) {
        async= true;
    }
    if ((state !== this.STATE_COMPLETE)&&(state!== this.STATE_UNINITIALIZED)){
        throw "XMLHttpRequest-Object isnt ready for new request";
    }
    this.request.open(method, url, async);
    this.request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    this.request.setRequestHeader("x_requested_with", "1");
    if (params !== null) {
        this.request.send(params);
    } else {
        this.request.send();
    }
};  



