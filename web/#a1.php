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
        $(document)
            .ready(function(){
                $("#sendFields")
                    .click(function(){
                        $.ajax({
                            url: "getLoggerJSON.php",
                            success: function(result){
                                $("#result").html(result);
                            },
                            error: function(result){
                                alert(result);
                            }
                        });
                    });
            });
    </script>
</head>
<body>
<p>Eingabe:</p>
<textarea id="eingabeId" >eineId</textarea>
<textarea id="eingabeMsg" >hallo jan</textarea>
<br/>
<button id="sendFields" >senden feld</button>
<!--
<button onclick="log('otto', 'standard');">senden standard</button>
<button onclick="resetlog(); document.getElementById('Comment').innerHTML='';">reset</button>
-->

<br />
<p>Ausgabe:</p>

<div id="result"><h2>Responses</h2></div>

<!--
<button onclick="getLog();">lesen</button>
-->

<script type="application/javascript">
    // setInterval(function(){getLog();}, 1000);
</script>

</body>
</html>


