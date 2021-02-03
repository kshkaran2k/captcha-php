<html>

<head>
    <meta charset="utf-8">
    <meta name="author" content="kshkaran2k">
    <meta name="description" content="Captcha Example">
    <title>Captcha Example</title>
</head>

<body onload='new_captcha()'>

<div id='div_captcha'>
    <img id='img_captcha' src=''>
</div>
<button onclick='new_captcha()'>New Captcha</button>
<form method = "POST">
    <div>
        <input type="text" placeholder = "Enter The Captcha" name="input_captcha"/>
    </div>
    <div>
        <input type="submit" name="validate" formaction="validate.php" value = "Validate"/>
    </div>
</form>

<?php
    session_start();
?>


<script>
function new_captcha(){
    var url = "assets/captcha_generator.php"
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            res = this.responseText;
            res_json = JSON.parse(res);
            if (res!=1){
                document.getElementById('img_captcha').src = "assets/captcha_img/"+res_json.result;
            }
        }
    };
    xhttp.open("POST", url, true);
    xhttp.send();
}

</script>


</body>


</html>
