<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso8859-15">
    <title>Ajax Hello</title>
    <link rel="stylesheet" type="text/css" href="../resources/Ajax.css">
    <script type="text/javascript" src="../resources/Ajax.js"></script>
    <script type="text/javascript" src="../resources/Writer.js"></script>
</head>
<body>
<p>Eingabe:</p>
<textarea id="eingabeId" >eineId</textarea>
<textarea id="eingabeMsg" >hallo jan</textarea>
<br/>
<button onclick="log(document.getElementById('eingabeId').value, document.getElementById('eingabeMsg').value);">senden feld</button>
<button onclick="log('otto', 'standard');">senden standard</button>
<button onclick="resetlog(); document.getElementById('Comment').innerHTML='';">reset</button>

<br />
<p>Ausgabe:</p>
<div id="Comment"></div>

<button onclick="getLog();">lesen</button>

<script type="application/javascript">
    setInterval(function(){getLog();}, 1000);
</script>

</body>
</html>
