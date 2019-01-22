<?php
session_start();

if( !isset($_SESSION[user_name]) ){
    header("location:../login/");
}

include '../func.php';
include '../dal.php';
GetConnection();

?>
<!DOCTYPE HTML>

<html>

<head>
    <title>Untitled</title>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <style>
        @font-face {
            font-family: "IRANSans-Bold";
            src: url("../fonts/IRANSans-Bold.woff") format("woff");
        }



        body {
            padding: 20px;
            background-color: #333333;
            background-image: url("../resource/bg27.png");
            color: black;
            min-width: 530px;
            font-family: IRANSans-Bold;
            font-size: 16px;
        }

        html {
            height: 600px;
        }

        h2, h3 {
            width: 100%;
            text-align: center;
            margin: 1.5em 0 .5em 0;
        }

        p {
            width: 50%;
            margin: 10px auto;
        }

        a {
            color: black;
            text-decoration: underline;
        }

            a:hover {
                text-decoration: none;
                background-color: #D5ECFF;
            }

        td {
            border-bottom: 1px solid #ccc;
            padding: 5px;
            text-align: right; /* IE */
        }

            td + td {
                border-left: 1px solid #ccc;
            }

        th {
            padding: 0 5px;
            text-align: right; /* IE */
        }

        .header-background {
            border-bottom: 1px solid black;
        }

        /* above this is decorative, not part of the test */

        .fixed-table-container {
            width: 760px;
            height: 400px;
            border: 1px solid black;
            margin: 10px auto;
            background-color: white;
            /* above is decorative or flexible */
            position: relative; /* could be absolute or relative */
            padding-top: 30px; /* height of header */
            border-radius: 5px;
        }

        .fixed-table-container-inner {
            overflow-x: hidden;
            overflow-y: auto;
            height: 100%;
        }

        .header-background {
            background-color: #D5ECFF;
            height: 30px; /* height of header */
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            border-radius: 5px;
        }

        #builder {
            font-family: IRANSans-Bold;
            background-color: white;
            width: 100%;
            overflow-x: hidden;
            overflow-y: auto;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        table, td {
            border: 1px solid black;
            border-radius: 5px;
            -moz-border-radius: 5px;
            padding: 3px;
        }

        td, th {
            text-align: center;
        }


        .full-width-table {
            width: 100%;
            border: none;
        }

            .full-width-table td {
                border: solid;
                border-width: 1px;
                direction: rtl;
                text-align: right;
            }

        .float-right {
            float: right;
        }

        .th-inner {
            position: absolute;
            top: 0;
            line-height: 30px; /* height of header */
            text-align: right;
            border-left: 1px solid black;
            padding-left: 35px;
            margin-left: -5px;
            font-size: 15px;
        }

        .first .th-inner {
            border-left: none;
            padding-left: 35px;
        }

        /* extra-wrap */

        .extrawrap th {
            text-align: right;
        }

        .extra-wrap {
            width: 100%;
        }

        /* Zupa styles for centered headers */

        .zupa div.zupa1 {
            margin: 0 auto !important;
            width: 0 !important;
        }

        .zupa div.th-inner {
            width: 100%;
            margin-left: -50%;
            text-align: right;
            border: none;
        }

        /* for hidden header hack to calculate widths of dynamic content */

        .hidden-head {
            min-width: 530px; /* enough width to show all header text, or bad things happen */
        }

        .hidden-header .th-inner {
            position: static;
            overflow-y: hidden;
            height: 0;
            white-space: nowrap;
            padding-right: 5px;
        }

        /* for complex headers */

        .complex.fixed-table-container {
            padding-top: 60px; /* height of header */
            overflow-x: hidden; /* for border */
        }

        .complex .header-background {
            height: 60px;
        }

        .complex-top .th-inner {
            border-bottom: 1px solid black;
            width: 100%;
        }

        .complex-bottom .th-inner {
            top: 30px;
            width: 100%;
        }

        .complex-top .third .th-inner { /* double row cell */
            height: 60px;
            border-bottom: none;
            background-color: #D5ECFF;
        }

        /* for tableSorter headers */

        .fixed-table-container.sort-decoration {
            overflow-x: hidden;
            min-width: 530px; /* enough width to show arrows */
        }

        .sort-decoration .th-inner {
            width: 100%;
        }

        .header .th-inner {
            background-color: #D5ECFF;
        }

        .headerSortUp .th-inner, .headerSortDown .th-inner {
            background-color: #5DDFFD;
        }

        span.sortArrow {
            background: url(icons/bg.gif) 0 4px no-repeat transparent;
            padding: 1px 10px;
            line-height: 30px;
        }

        .headerSortUp span.sortArrow {
            background: url(icons/asc.gif) 0 7px no-repeat transparent;
        }

        .headerSortDown span.sortArrow {
            background: url(icons/desc.gif) 0 7px no-repeat transparent;
        }


        .button-container {
            margin: 0px auto;
            width: auto;
            border: solid;
            border-width: 1px;
            border-color: #F0F0F0;
            margin-top: 10px;
            padding: 2px;
            display: inline-block;
            overflow: auto;
            white-space: nowrap;
            float: right;
        }

        .cotainer {
            border: none;
            display: inline-block;
            overflow: auto;
            white-space: nowrap;
            border-radius: 5px;
        }

        #message-div {
            float: left;
            width: 350px;
            direction: rtl;
            padding-right: 20px;
            padding-top: 10px;
        }

        .caption-table {
            margin: 0px auto;
            width: 150px;
            text-align: center;
        }


        button {
            font-family: IRANSans-Bold;
            margin-left: 5px;
            width: 80px;
        }

        .cotainer-main {
            margin: 0px auto;
            width: 770px;
            border: solid;
            border-width: 1px;
            background-color: #CC9966;
            height: 600px;
            border-radius: 5px;
            background-image: url("../resource/body_bg.gif");
            box-shadow: 0 1px 4px rgba(0,0,0,.2);
        }


        /*------------------------------CSS for overlaybox------------------------------*/

        .bgCover {
            background: #000;
            position: absolute;
            left: 0;
            top: 0;
            display: none;
            overflow: hidden;
        }

        .overlayBox {
            border: 5px solid #09F;
            position: absolute;
            display: none;
            width: 500px;
            height: 320px;
            background: #fff;
            z-index: 10000;
        }

        .overlayContent {
            padding: 10px;
        }

        #closeLink {
            float: right;
            color: red;
        }

        a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="bgCover"></div>

    <div class="overlayBox">
        <div class="overlayContent">
            <a href="#" id="closeLink">Close</a>
            <table class="full-width-table">
                <tr>
                    <td>
                        <input type="text" name="Index" value=""></td>
                    <td>شناسه لينک:</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="PageTitle" value=""></td>
                    <td>عنوان لينک:</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="PageLink" value=""></td>
                    <td>لینک به صفحه:</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="MotherLink" value=""></td>
                    <td>لینک مادر: </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="LinkIndex" value=""></td>
                    <td>اندیس ترتیب:</td>
                </tr>
            </table>
            <div class="button-container">
                <div class="float-right">
                    <button type="button" onclick="overlayOkCommand()">تائید</button>
                </div>
            </div>
        </div>
    </div>




    <div class="cotainer-main">

        <div class="caption-table">
            <h1>منو ساز </h1>
        </div>

        <div class="fixed-table-container">
            <div class="header-background"></div>
            <div class="fixed-table-container-inner extrawrap">
                <table id="builder" cellspacing="0">
                    <col width="80">
                    <col width="80">
                    <col width="80">
                    <col width="80">
                    <col width="70">
                    <thead>
                        <tr>
                            <th class="first">
                                <div class="th-inner">اندیس ترتیب</div>
                            </th>
                            <th>
                                <div class="th-inner">لینک مادر</div>
                            </th>
                            <th>
                                <div class="th-inner">لینک به صفحه   </div>
                            </th>
                            <th>
                                <div class="th-inner">عنوان لینک</div>
                            </th>
                            <th>
                                <div class="th-inner">شناسه لینک</div>
                            </th>

                        </tr>
                    </thead>

                    <tbody id="MenuRecords">
                        <?php load_menu_records(); ?>
                    </tbody>

                </table>
            </div>

            <div class="cotainer">

                <div id="message-div"></div>

                <div class="button-container">
                    <button type="button" onclick="editCommand()">ویرایش</button>
                    <button type="button" onclick="deleteCommand()">حذف</button>
                    <button type="button" onclick="addCommand()">اظافه</button>
                </div>

            </div>
        </div>
    </div>

</body>

<script>
    var selectedRow;
    var state;
    var xmlhttp;
    var currentID;

    window.onload = function () {
        enumerate();
    }

    window.onresize = function () {
        if (isOpen == false) return;
        var x = document.getElementsByClassName("overlayBox");
        //var w = window.innerWidt || document.documentElement.clientWidth || document.body.clientWidth;
        //var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; 

        var w = document.documentElement.clientWidth;
        var h = document.documentElement.clientHeight;

        x[0].style.left = ((w - x[0].style.width) / 2) - 300 + 'px';
        x[0].style.top = ((h - x[0].style.height) / 2) - 300 + 'px';
        //x[0].style.left = "50%";
        //x[0].style.top = "50%";

        x[0].style.display = "block";
        document.getElementById("closeLink").addEventListener("click", doOverlayClose);

        var bg = document.getElementsByClassName("bgCover");
        //document.getElementById("builder").style.opacity = "0.8";
        bg[0].style.opacity = "0.8";
        bg[0].style.display = "block";
        bg[0].style.width = "1600px";//w +'px';
        bg[0].style.height = "900px";//h +'px'; 
        //bg[0].style.position = "absolute";	
        bg[0].style.zindex = 11000;
        bg[0].style.top = "0px";
        bg[0].style.left = "0px";

        document.getElementsByClassName("fixed-table-container")[0].style.opacity = "0.4";
    }

    function enumerate() {
        //Get list of rows in the table
        var table = document.getElementById("builder");
        //var table = document.getElementsByClassName("builder");
        var rows = table.getElementsByTagName("tr");

        //Row callback; reset the previously selected row and select the new one
        function SelectRow(row) {
            if (selectedRow !== undefined) {
                selectedRow.style.background = "white";
            }
            selectedRow = row;

            selectedRow.style.background = "#F0F0F0";
        }

        //Attach this callback to all rows
        for (var i = 1; i < rows.length; i++) {
            (function (idx) {
                addEvent(rows[idx], "click", function () {
                    SelectRow(rows[idx]);
                });
            })(i);
        }
    };

    function addEvent(element, evt, callback) {
        if (element.addEventListener) {
            element.addEventListener(evt, callback, false);
        } else if (element.attachEvent) {
            element.attachEvent("on" + evt, callback);
        } else {
            element["on" + evt] = callback;
        }
    }

    function doOverlayClose() {
        isOpen = false;
        document.getElementsByClassName("fixed-table-container")[0].style.opacity = "1";
        var x = document.getElementsByClassName("overlayBox");
        x[0].style.display = "none";

        var bg = document.getElementsByClassName("bgCover");

        bg[0].style.opacity = "0";
        bg[0].style.display = "none";
        //bg[0].style.width = w +'px';
        //bg[0].style.height = h +'px';     
    }

    function overlayShow() {
        isOpen = true;
        var x = document.getElementsByClassName("overlayBox");
        //var w = window.innerWidt || document.documentElement.clientWidth || document.body.clientWidth;
        //var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; 

        var w = document.documentElement.clientWidth;
        var h = document.documentElement.clientHeight;

        //x[0].style.left = ((w - x[0].style.width)/2)-300 +'px';
        //x[0].style.top  = ((h - x[0].style.height)/2)-300 +'px';
        //x[0].style.left = "50%";
        //x[0].style.top = "50%";

        x[0].style.left = ((w - 1000) / 2) + 'px';
        x[0].style.top = ((h - 650) / 2) + 'px';

        x[0].style.display = "block";
        document.getElementById("closeLink").addEventListener("click", doOverlayClose);

        var bg = document.getElementsByClassName("bgCover");
        //document.getElementById("builder").style.opacity = "0.5";
        bg[0].style.opacity = "0.5";
        bg[0].style.display = "block";
        bg[0].style.width = "100%";//w +'px';
        bg[0].style.height = "100%";//h +'px'; 
        //bg[0].style.position = "absolute";	
        bg[0].style.zindex = 11000;
        bg[0].style.top = "0px";
        bg[0].style.left = "0px";

        document.getElementsByClassName("fixed-table-container")[0].style.opacity = "0.4";
    }

    function overlayReset() {
        document.getElementsByName("PageTitle")[0].value = "";
        document.getElementsByName("PageLink")[0].value = "";
        document.getElementsByName("MotherLink")[0].value = "";
        document.getElementsByName("LinkIndex")[0].value = "";
    }

    function fill_overlay() {
        document.getElementsByName("Index")[0].value = selectedRow.cells[4].innerHTML;
        document.getElementsByName("PageTitle")[0].value = selectedRow.cells[3].innerHTML;
        document.getElementsByName("PageLink")[0].value = selectedRow.cells[2].innerHTML;;
        document.getElementsByName("MotherLink")[0].value = selectedRow.cells[1].innerHTML;
        document.getElementsByName("LinkIndex")[0].value = selectedRow.cells[0].innerHTML;
        currentID = selectedRow.cells[4].innerHTML;
    }

    function overlayOkCommand() {
        if (state == "add") {
            sendCommand();
            doOverlayClose();
        }

        if (state == "edit") {
            sendCommand();
            doOverlayClose();
        }
    }

    function addCommand() {
        state = "add";
        overlayShow();
        overlayReset();
    }

    function deleteCommand() {
        if (selectedRow == undefined) {
            alert("یک سطر را انتخاب کنید!")
            return;
        }

        if (confirm("آیا از حذف آیتم اطمینان دارید ؟") == true) {
            state = "delete";
            sendCommand();
        }
        else
            return;
    }

    function editCommand() {
        if (selectedRow == undefined) {
            alert("یک سطر را انتخاب کنید!")
            return;
        }

        state = "edit";
        fill_overlay();
        overlayShow();
    }

    function createAjaxObject() {

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

        xmlhttp.onreadystatechange = function () {
            //alert(xmlhttp.readyState +"    "+xmlhttp.status);
            //alert(xmlhttp.responseText);
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var str = xmlhttp.responseText;
                var arr = JSON.parse(str);

                if (arr[0] == "AddOK") {
                    document.getElementById("message-div").innerHTML = "Recored Added";
                    document.getElementById("MenuRecords").innerHTML = arr[1];
                    enumerate();
                    return;
                }
                if (arr[0] == "EditOK") {
                    document.getElementById("message-div").innerHTML = "Recored Edited";
                    document.getElementById("MenuRecords").innerHTML = arr[1];
                    enumerate();
                    return;
                }
                if (arr[0] == "DeleteOK") {
                    document.getElementById("message-div").innerHTML = "Recored Deleted";
                    document.getElementById("MenuRecords").innerHTML = arr[1];
                    enumerate();
                    return;
                }
                document.getElementById("message-div").innerHTML = arr[0];

            }
        };
    }

    function sendCommand() {
        document.getElementById("message-div").innerHTML = "Wait";

        var table = document.getElementById("builder");
        var rows = table.getElementsByTagName("tr");
        var _Command = state;
        var index;
        var params;
        var _PageTitle;
        var _PageLink;
        var _MotherLink;
        var _LinkIndex;

        if (state == "edit" || state == "add") {
            _PageTitle = document.getElementsByName("PageTitle")[0].value;
            _PageLink = document.getElementsByName("PageLink")[0].value;
            _MotherLink = document.getElementsByName("MotherLink")[0].value;
            _LinkIndex = document.getElementsByName("LinkIndex")[0].value;
            index = document.getElementsByName("Index")[0].value;
        }

        if (state == "delete")
            if (selectedRow.rowIndex != -1)
                index = selectedRow.cells[4].innerHTML;

        params = "PageTitle=" + _PageTitle + "&PageLink=" + _PageLink + "&MotherLink=" + _MotherLink + "&LinkIndex=" + _LinkIndex + "&Index=" + index + "&currentID=" + currentID + "&Command=" + _Command;

        if (!xmlhttp)
            createAjaxObject();

        xmlhttp.open('POST', 'update_menu_db.php', true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        //xmlhttp.setRequestHeader('Content-length', params.length);
        //xmlhttp.setRequestHeader('Connection', 'close');
        xmlhttp.send(params);
    }
</script>



</html>
