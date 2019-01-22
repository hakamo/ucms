<?php
session_start();

if( !isset($_SESSION[user_name]) ){
    header("location:../login/");
}

?>

<!DOCTYPE html>
<html lang="fa-IR">

<head>
    <meta charset="utf-8">
    <title>Control Panel</title>

    <style>
        @font-face {
            font-family: "IRANSans-Bold";
            src: url("../fonts/IRANSans-Bold.woff") format("woff");
        }

        body {
            margin: 0;
            padding: 0;
            direction: rtl;
            line-height: 170%;
            direction: rtl;
            font-size: 10pt;
            margin: 0;
            padding: 0;
            display: block;
            position: relative;
            background-color: #d7d7d7;
            font-family: IRANSans-Bold;
            /*background-image: url("../resource/body-bg23.png");*/
            height: 700px;
        }

        html {
            overflow-y: hidden;
        }

        A:hover {
            color: red;
        }

        A {
            color: #D6D6D6;
            text-decoration: none;
        }



        .notfication-bar {
            width: 900px;
            height: 40px;
            clear: both;
            padding-left: 0px;
            padding-right: 0px;
            background-color: #a0aFaF;
            margin-left: 0px;
            margin-right: 0px;
            border-radius: 4px;
        }

        #wrapper {
            margin: 0px auto;
            padding: 0px;
            width: 1100px;
            height: 730px;
            box-shadow: 0px 1px 13px #999;
            background-color: #FFFFFF;
            margin-bottom: 10px;
            padding-bottom: 10px;
            margin-top: 10px;
            border-radius: 10px;
            /*background-image: url("../resource/index.svg");*/
        }

        .content {
            background-color: #F0F0F0;
            width: 980px;
            height: 100%;
            min-height: 30%;
            margin-top: 10px;
            border-radius: 10px;
            padding: 5px;
        }

        button {
            font-family: IRANSans-Bold;
            margin-left: 5px;
            width: 140px;
            float: left;
            margin: 3px;
        }

        .fluidMedia {
            position: relative;
            padding-bottom: 76.25%; /* proportion value to aspect ratio 16:9 (9 / 16 = 0.5625 or 56.25%) */
            padding-top: 30px;
            height: 0;
            overflow: hidden;
            width: 1050px;
            margin-top: 10px;
        }

            .fluidMedia iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 680px;
                border-radius: 15px;
                overflow-y: hidden;
            }

        * CSSTerm.com CSS Horizontal menu text only */ .navigation ul, .navigation li {
            list-style-type: none;
            display: inline;
            margin: 0px 10px;
        }

        .navigation a:link, .navigation a:visited, .navigation a:active {
            font-size: 15px;
            color: #5D7393;
            border-bottom: 3px #5D7393 solid;
            padding: 5px 5px 5px 5px;
            text-decoration: none;
        }

        .navigation a:hover {
            border-bottom: 5px solid #F9F044;
            color: #000;
        }
    </style>

    <script type="text/javascript">
        /* free code from dyn-web.com */

        function getDocHeight(doc) {
            doc = doc || document;
            // from http://stackoverflow.com/questions/1145850/get-height-of-entire-document-with-javascript
            var body = doc.body, html = doc.documentElement;
            var height = Math.max(body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight);
            return height;
        }

        function setIframeHeight(id) {
            var ifrm = document.getElementById(id);
            var doc = ifrm.contentDocument ? ifrm.contentDocument : ifrm.contentWindow.document;
            ifrm.style.visibility = 'hidden';
            ifrm.style.height = "10px"; // reset to minimal height in case going from longer to shorter doc
            ifrm.style.height = getDocHeight(doc) + "px";
            ifrm.style.visibility = 'visible';
        }

        window.onload = function () {
            document.getElementsByName("frms")[0].src = "../panel/default-panel.htm";
            document.getElementById("closeLink").addEventListener("click", system_logout);
        }

        function system_logout() {
            window.location.assign("../login/logout.php");
        }

    </script>


    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

            li a {
                display: inline-block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

                li a:hover {
                    background-color: #111;
                }
    </style>

</head>

<body>

    <div id="wrapper">


        <div>


            <ul>
                <li><a href="<?php   echo "http://".$_SERVER['HTTP_HOST'] ?>" target="_new" ><span>مشاهده سایت</span> </a></li>
                <li><a href="pagebuilderpanel.php" target="frms"><span>مدیریت صفحات</span> </a></li>
                <li><a href="menubuilder.php" target="frms"><span>مدیریت منو اصلی</span> </a></li>
                <li><a href="panel/product.php" target="frms"><span>محصولات</span> </a></li>
                <li><a href="fileuploader.php" target="frms"><span>مدیریت فایل کاربر</span> </a></li>
                <li><a href="slider-config-panel.php" target="frms"><span>مدیریت اسلاید تصاویر</span> </a></li>
                <li><a href="#" id="closeLink">خروج از سیستم</a></li>
            </ul>


        </div>



        <center>
<div class="fluidMedia">
<iframe name="frms" src="" frameborder="0" > </iframe>
</div>
</center>


    </div>
</body>

</html>
