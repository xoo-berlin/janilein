<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso8859-15">
    <title>Ajax Hello</title>
    <!--
    <link rel="stylesheet" type="text/css" href="../resources/Ajax.css">
    <script type="text/javascript" src="../resources/Ajax.js"></script>
    <script type="text/javascript" src="../resources/Writer.js"></script>
    -->

    <script type="text/javascript" src="../resources/jquery-1.11.3.min.js"></script>

    <script>
        // buttons
        $(document).ready(
            function() {
                $("#sendFields")
                    .click(
                    function () {
                        $.ajax({
                            type: "POST",
                            url: "sendMessage.php",
                            data: {id: $("#eingabeMsg").val(), msg: $("#eingabeId").val()},
                            success: function (data) {
                                console.log("send data for sendFields");
                            }
                        });
                    })
            });

        $(document).ready(
            function() {
                $("#sendDefault")
                    .click(
                    function () {
                        $.ajax({
                            type: "POST",
                            url: "sendMessage.php",
                            data: {id: "otto", msg: "eine nachricht"},
                            success: function (data) {
                                console.log("send data for sendDefault");
                            }
                        });
                    })
            });

        $(document).ready(
            function() {
                $("#btnReset")
                    .click(
                    function () {
                        $.ajax({
                            type: "POST",
                            url: "resetlog.php",
                            data: {},
                            success: function (data) {
                                console.log("send data for sendDefault");
                            }
                        });
                    })
            });

        function readLog(){
            $.ajax({
                url: "getLoggerJSON.php",
                success: function(result){

                    console.log(result);

                    if( result != null && result.length > 0) {
                        var parse = JSON.parse(result);

                        var i;
                        var content = '';
                        for (i = 0; i < parse.length; i++) {
                            content += parse[i].id + ":" + parse[i].message;
                            content += '<br />'
                        }
                    }

                    $("#result").html(content);
                },
                error: function(result){
                    alert(result);
                }
            });
        }

        // polling
        setInterval(readLog, 1000);
    </script>
</head>
<body>
<p>Eingabe:</p>
<label for="eingabeId" >ID:</label>
<input type="text" id="eingabeId" value="eineId" />
<label for="eingabeMsg" >Msg:</label>
<input type="text" id="eingabeMsg" value="hallo jan" />
<br/>
<button id="sendFields" >senden feld</button>
<button id="sendDefault" >senden default</button>

<button id="btnReset" >reset</button>

<br />
<p>Ausgabe:</p>

<div id="result"><h2>Responses</h2></div>

<!--
<button onclick="getLog();">lesen</button>
-->


</body>
</html>


