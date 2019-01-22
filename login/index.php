<?php

session_start();

include '../dal.php';

if(isset($_POST["captcha"]) && $_POST["captcha"]!="" && isset($_SESSION["code"]) && $_SESSION["code"]!="" )
{

    if(isset($_POST["captcha"]) && $_POST["captcha"]!="" && $_SESSION["code"]==$_POST["captcha"])
    {
        if(isset($_POST["username"])&&$_POST["username"]!="" && isset($_POST["password"])&&$_POST["password"]!="" )
        {
            $user = $_POST["username"];
            $pass = $_POST["password"];
            
            
            GetConnection();						

            
            //prevent sql injection
            $user = stripslashes($user);
            $pass = stripslashes($pass);
            $user = mysql_real_escape_string($user);
            $pass = mysql_real_escape_string($pass);
            
            
            $result = mysql_query("select * from cms_user WHERE user_login = '$user' AND user_pass =  '$pass' ");	
            
            //count result entries
            $num_rows = mysql_num_rows($result);		
            
            if($num_rows == 1)
            {
                echo "ورود موفق میباشد";
                //session_register("myuser1");
                //session_register($pass);

                $_SESSION["user_name"] = $user;

                
            }
            else
            {
                echo "نام کاربری یا کلمه عبور اشتباه است";
            }
            
            mysql_free_result($result);
            mysql_close();
        }else echo "user or pass post error";
    }else echo "کد امنیتی اشتباه است";

    exit();

}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>صفحه ورود به سیستم</title>
    <meta name="description" content="Login to control panel">


    <style>
        @charset "utf-8";

        @font-face {
            font-family: 'FontAwesome';
            font-style: normal;
            font-weight: normal;
            src: url('../fonts/fontawesome-webfont.woff?#');
            src: url('http://weloveiconfonts.com/api/fonts/fontawesome/fontawesome-webfont.eot?#iefix') format('eot'),
                 url('http://weloveiconfonts.com/api/fonts/fontawesome/fontawesome-webfont.woff') format('woff'), 
                 url('http://weloveiconfonts.com/api/fonts/fontawesome/fontawesome-webfont.ttf') format('truetype'),
                 url('http://weloveiconfonts.com/api/fonts/fontawesome/fontawesome-webfont.svg#FontAwesomeRegular') format('svg');
        }

        .fontawesome-lock:before {
            content: "\f023";
        }

        @font-face {
            font-family: "Droid Arabic Naskh";
            src: url("../fonts/DroidNaskh-Bold.eot?#iefix")  format("embedded-opentype"),
                 url("../fonts/DroidNaskh-Bold.woff2") format("x-woff2"), 
                 url("../fonts/DroidNaskh-Bold.woff") format("woff"), 
                 url("../fonts/DroidNaskh-Bold.ttf") format("truetype");
        }

        @font-face {
            font-family: "BYekan";
            src: url("../fonts/BYekan.eot?#") format("eot"), 
                 url("../fonts/BYekan.woff") format("woff"), 
                 url("../fonts/BYekan.ttf") format("truetype");
        }

        @font-face {
            font-family: "IRANSans-Bold";
            src: url("../fonts/IRANSans-Bold.woff") format("woff");
        }

        [class*="fontawesome-"]:before {
            font-family: 'FontAwesome', sans-serif;
            vertical-align: middle;
            font-size: 40px;
        }

        body {
            background-color: #C0C0C0;
            color: #000;
            font-family: IRANSans-Bold;
            font-size: 16px;
            line-height: 1.5em;
            direction: rtl;
        }

        input {
            border: none;
            font-family: inherit;
            font-size: inherit;
            font-weight: inherit;
            line-height: inherit;
            -webkit-appearance: none;
        }

        /* ---------- LOGIN ---------- */

        #login {
            margin: 50px auto;
            width: 400px;
            font-family: IRANSans-Bold;
        }

            #login h2 {
                background-color: #f95252;
                -webkit-border-radius: 20px 20px 0 0;
                -moz-border-radius: 20px 20px 0 0;
                border-radius: 20px 20px 0 0;
                color: #fff;
                font-size: 20px;
                padding: 20px 26px;
            }

                #login h2 span[class*="fontawesome-"] {
                    margin-right: 14px;
                }

            #login fieldset {
                background-color: #fff;
                -webkit-border-radius: 0 0 20px 20px;
                -moz-border-radius: 0 0 20px 20px;
                border-radius: 0 0 20px 20px;
                padding: 20px 26px;
            }

                #login fieldset p {
                    color: #777;
                    margin-bottom: 14px;
                }

                    #login fieldset p:last-child {
                        margin-bottom: 0;
                    }

                #login fieldset input {
                    -webkit-border-radius: 3px;
                    -moz-border-radius: 3px;
                    border-radius: 3px;
                }

                    #login fieldset input[type="text"], #login fieldset input[type="password"] {
                        background-color: #eee;
                        color: #777;
                        padding: 4px 10px;
                        width: 328px;
                    }

                    #login fieldset input[type="button"] {
                        background-color: #33cc77;
                        color: #fff;
                        display: block;
                        margin: 0 auto;
                        padding: 4px 0;
                        width: 100px;
                    }

                        #login fieldset input[type="button"]:hover {
                            background-color: #28ad63;
                        }



        #myDiv {
            padding: 4px 10px;
            width: 328px;
            margin-bottom: 15px;
        }

        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed,
        figure, figcaption, footer, header, hgroup,
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol, ul {
            list-style: none;
        }

        blockquote, q {
            quotes: none;
        }

            blockquote:before, blockquote:after,
            q:before, q:after {
                content: '';
                content: none;
            }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        p img {
            vertical-align: middle;
        }
    </style>

</head>
<body>
    <div id="login">
        <h2>

            <span class="fontawesome-lock"></span>

            ورود به سیستم

        </h2>
        <form name="loginForm" onsubmit="validate_form(this)" method="POST">
            <fieldset>
                <div id="myDiv"></div>
                <p>
                    <label for="username">نام کاربری :</label>
                </p>
                <p>
                    <input type="text" id="username" name="username" value="UserName" onblur="if(this.value=='')this.value='UserName'" onfocus="if(this.value=='UserName')this.value=''" onkeypress="searchKeyPress(event)">
                </p>
                <!-- JS because of IE support; better: placeholder="mail@address.com" -->
                <p>
                    <label for="password">کلمه عبور :</label>
                </p>
                <p>
                    <input type="password" id="password" value="password" onblur="if(this.value=='')this.value='password'" onfocus="if(this.value=='password')this.value=''" onkeypress="searchKeyPress(event)">
                </p>
                <!-- JS because of IE support; better: placeholder="password" -->
                <p>
                    <label for="password">کد امنیتی :</label>
                    <img id="captcha_image" src="/login/captcha.php" />
                </p>
                <p>
                    <input type="text" id="captcha" name="captcha" value="Security Code" onblur="if(this.value=='')this.value='Security Code'" onfocus="if(this.value=='Security Code')this.value=''" onkeypress="searchKeyPress(event)">
                </p>
                <!-- JS because of IE support; better: placeholder="password" -->
                <p>
                    <input type="button" onclick="validate_form(this)" value="ورود">
                </p>
            </fieldset>
        </form>

    </div>
    <!-- end login -->



    <script>

        function loadXMLDoc() {
            var xmlhttp;
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
                catch (e) {
                    try { xmlhttp = new XMLHttpRequest(); }
                    catch (e) { xmlhttp = false; }
                }
            }



            xmlhttp.onreadystatechange = function ()
                //xmlhttp.onload=function()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);

                    document.getElementById("myDiv").innerHTML = xmlhttp.responseText;

                    if ((xmlhttp.responseText == "نام کاربری یا کلمه عبور اشتباه است") || (xmlhttp.responseText == "کد امنیتی اشتباه است")) {
                        var logo = document.getElementById('captcha_image');
                        var img = new Image();
                        logo.src = "captcha.php?" + Math.random();
                    }
                    if ((xmlhttp.responseText == "ورود موفق میباشد")) {
                        window.location.assign("../panel/index.php")
                    }
                }
            }
            var username2 = document.getElementById("username").value;
            var password2 = document.getElementById("password").value;
            var captcha2 = document.getElementById("captcha").value;

            var params = "captcha=" + captcha2 + "&password=" + password2 + "&username=" + username2 + "&random=" + Math.random();

            xmlhttp.open('POST', '/login/index.php', true);
            //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            //xmlhttp.setRequestHeader('Content-length', params.length);
            //xmlhttp.setRequestHeader('Connection', 'close');
            xmlhttp.send(params);

        }


        function validate_form(thisform) {
            document.getElementById("myDiv").innerHTML = "";

            var x = document.forms["loginForm"]["username"];
            if (x.value == null || x.value == "" || x.value == "UserName") {
                document.getElementById("myDiv").innerHTML = "نام کاربری را وارد کنید";
                return false;
            }

            x = document.forms["loginForm"]["password"];
            if (x.value == null || x.value == "" || x.value == "password") {
                document.getElementById("myDiv").innerHTML = "کلمه عبور را وارد کنید";
                return false;
            }

            x = document.forms["loginForm"]["captcha"];
            if (x.value == null || x.value == "" || x.value == "Security Code") {
                document.getElementById("myDiv").innerHTML = "کد امنیتی را وارد کنید";
                document.getElementById("myDiv").setAttribute("style", "color : #33cc77");
                return false;
            }

            loadXMLDoc();
        }

        function searchKeyPress(e) {
            e = e || window.event;
            if (e.keyCode == 13) {
                //document.getElementById('btnSearch').click();
                validate_form(this);
            }
        }


    </script>


</body>

</html>
