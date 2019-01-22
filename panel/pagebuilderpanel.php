<?php
session_start();

if( !isset($_SESSION[user_name]) ){
    header("location:../login/");
}

include '../func.php';
include '../dal.php';
GetConnection();

?>

<html>

<head>
    <title>صفحه ساز سایت</title>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link rel="stylesheet" type="text/css" href="../css/pagebuilder-style.css">
    <script src="../component/ckeditor/ckeditor.js"></script>

    <style>

        @font-face {
            font-family : "IRANSans-Bold";
            src: url("../fonts/IRANSans-Bold.woff") format("woff");
        }

        body {
            padding: 20px;
            background-color: #333333;
            background-image: url("../resource/bg27.png");
            color: black;
            min-width: 530px;
            font-family : IRANSans-Bold ;
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
            text-align: left; /* IE */
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
    font-family : IRANSans-Bold ;
    background-color: white;
    width: 100%;
    overflow-x: hidden;
    overflow-y: auto;
}
        table {
            border-collapse: separate;
            border-spacing: 2px;
    
        }
        table, td  {
            border: 1px solid black;
            border-radius: 5px;
            -moz-border-radius: 5px;
            padding: 3px;
        }

        td , th
        {
            text-align: center;
        }


        .full-width-table
        {
            width: 100%;
            border: none;
        }
        .full-width-table  td
        {
            border: none;
            border-width : 1px;
            direction: rtl;
            text-align: right;
            width: auto;
            padding-right: 10px;
        }

        .float-right
        {
            float : right;
        }

        .th-inner {
            position: absolute;
            top: 0;
            line-height: 30px; /* height of header */
            text-align: right;
            border-left: 1px solid black;
            padding-left: 35px;
            margin-left: -5px;


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
            width: 100%
            }

        .complex-bottom .th-inner {
            top: 30px;
            width: 100%
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


        .button-container
        {
            margin : 0px auto;
            width: auto;
            border: solid;
            border-width: 1px;
            border-color : #F0F0F0;
            margin-top : 10px;
            padding : 2px;

            display: inline-block;
            overflow: auto;
            white-space: nowrap;
            float : right;
        }
        .cotainer
        {
            border: none;
            display: inline-block;
            overflow: auto;
            white-space: nowrap;
            border-radius: 5px;
        }
#message-div
        {
            float : left;
            width: 350px;
            direction : rtl;
            padding-right : 20px;
            padding-top : 10px;
        }
        .caption-table
        {
            margin : 0px auto;
            width: 300px;
            text-align: center;
        }


        button
        {
            font-family : IRANSans-Bold ;
            margin-left: 5px;
            width: 80px;
        }

        input[type=text]
        {
            font-family : IRANSans-Bold ;
            width: 100%;
        }
        textarea{
            font-family : IRANSans-Bold ;
            background-color: #99CC99;
        }

        .cotainer-main
        {
            margin : 0px auto;
            width: 770px;
            border: solid;
            border-width: 1px;
            background-color: #CC9966;
            height : 600px;
            border-radius: 5px;
            background-image: url("../resource/body_bg.gif");
            box-shadow : 0 1px 4px rgba(0,0,0,.2);
        }


        /*------------------------------CSS for overlaybox------------------------------*/

        .bgCover { background:#000; position:absolute; left:0; top:0; display:none; overflow:hidden }
        .overlayBox {
            border:5px solid #09F;
            position:absolute;
            display:none;
            width:990px;
            height:100%px;
            background:#fff;
            z-index: 10000;
            opacity: .9;
        }
        .overlayContent {
            padding:10px;
        }
#closeLink {
            float:right;
            color:red;
}
        a:hover { text-decoration:none; }


    </style>
</head>

<body>
    <div class="bgCover"></div>

    <div class="overlayBox">
        <div class="overlayContent">
            <a href="#" id="closeLink">Close</a>
            <table class="full-width-table">
                <tr>
                    <td align="center">
                        <div style="text-align: center">
                            <button type="button" class="inline" onclick="saveChanges()">ذخیره </button>
                            <button type="button" class="inline" onclick="doOverlayClose()">انصراف</button>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="PageID" value="" readonly></td>
                    <td>شناسه صفحه :</td>
                    <td>
                        <input type="text" name="PageTitle" value="" required></td>
                    <td>عنوان صفحه :</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td>
                        <div id="message" style="text-align: center">پیام سیستم</div>
                    </td>
                    <td>
                        <input type="text" name="PageSlug" value=""></td>
                    <td>SLUG :</td>
                    <td>
                        <input type="text" name="PermaLink" value="" readonly></td>
                    <td>لینک دائم :</td>
                </tr>
            </table>
            <div class="button-container">
                <textarea class="ckeditor" cols="180" id="editor1" name="editor1" rows="10">
<h1>تست فارسی نویسی SMD و THT</h1>
</textarea>
            </div>
        </div>
    </div>




    <div class="cotainer-main">

        <div class="caption-table">
            <h1>ساخت صفحه ها</h1>
        </div>

        <div class="fixed-table-container">
            <div class="header-background"></div>
            <div class="fixed-table-container-inner extrawrap">
                <table id="builder" cellspacing="0">
                    <col width="80">
                    <col width="80">
                    <col width="80">
                    <col width="80">

                    <thead>
                        <tr>
                            <th class="first">
                                <div class="th-inner">لینک دائم</div>
                            </th>
                            <th>
                                <div class="th-inner">slug</div>
                            </th>
                            <th>
                                <div class="th-inner">عنوان صفحه</div>
                            </th>
                            <th>
                                <div class="th-inner">ID</div>
                            </th>
                        </tr>
                    </thead>



                    <tbody>

                        <?php load_pageeditor_table(); ?>

                    </tbody>

                </table>

            </div>

            <div class="cotainer">

                <div id="message-div">پیام سیستم</div>

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
    var name1;
    var selectedRow;
    var state;
    var xmlhttp;
    var current_sent_index;
    var maxCountRows;

    var CurrentIndex;
    var lastCommand;
    var isAnswerReady;
    var reason = "none";




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

    function AddTableRow() {
        var table = document.getElementById("builder");
        var row = table.insertRow();

        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        var cell2 = row.insertCell(2);
        var cell3 = row.insertCell(3);
        var cell4 = row.insertCell(4);



        cell4.innerHTML = document.getElementsByName("PageID")[0].value;
        cell3.innerHTML = document.getElementsByName("PageTitle")[0].value;
        cell2.innerHTML = document.getElementsByName("PageSlug")[0].value;
        cell1.innerHTML = document.getElementsByName("PermaLink")[0].value;
        cell0.innerHTML = CKEDITOR.instances.editor1.getData();
        cell0.style.display = "none";


        enumerate();
    }

    function hideColumn() {
        //Get list of rows in the table
        var table = document.getElementById("builder");
        //var table = document.getElementsByClassName("builder");
        var rows = table.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) {
            rows[i].cells[0].style.display = "none";
        }
    }

    /*
    var option_box = " \
       <select>   \
            <option value=\"volvo\">Volvo</option>   \
            <option value=\"saab\">Saab</option>   \
            <option value=\"opel\">Opel</option> \
            <option value=\"audi\">Audi</option>  \
       </select> ";
    */

    function DeleteTableRow() {

        if (selectedRow.rowIndex == -1)
            return;

        //alert(selectedRow.rowIndex);
        document.getElementById("builder").deleteRow(selectedRow.rowIndex);
        enumerate();
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
        //x[0].style.left = "0%";
        //x[0].style.top = "0%";

        x[0].style.left = ((w - 1000) / 2) + 'px';
        x[0].style.top = ((h - 650) / 2) + 'px';
        x[0].style.display = "block";

        document.getElementById("closeLink").addEventListener("click", doOverlayClose);

        var bg = document.getElementsByClassName("bgCover");
        //document.getElementById("builder").style.opacity = "0.8";
        bg[0].style.opacity = "0.8";
        bg[0].style.display = "block";
        bg[0].style.width = "100%";//w +'px';
        bg[0].style.height = "100%";//h +'px';
        //bg[0].style.position = "absolute";	
        bg[0].style.zindex = 0;
        bg[0].style.top = "0px";
        bg[0].style.left = "0px";

        document.getElementsByClassName("fixed-table-container")[0].style.opacity = "0.4";


        if (reason == "newRecord") {
            sendAjaxCommand("LastIndex");
        }
    }

    function overlayReset() {
        document.getElementsByName("PageID")[0].value = "PageID";
        document.getElementsByName("PageTitle")[0].value = "PageTitle";
        document.getElementsByName("PageSlug")[0].value = "PageSlug";
        document.getElementsByName("PermaLink")[0].value = "PermaLink";
        CKEDITOR.instances.editor1.setData("");
    }

    function fill_overlay() {

        document.getElementsByName("PageID")[0].value = selectedRow.cells[4].innerHTML;
        document.getElementsByName("PageTitle")[0].value = selectedRow.cells[3].innerHTML;;
        document.getElementsByName("PageSlug")[0].value = selectedRow.cells[2].innerHTML;
        document.getElementsByName("PermaLink")[0].value = selectedRow.cells[1].innerHTML;
        //document.getElementsByName("editor1")[0].value = selectedRow.cells[0].innerHTML;
        var t = selectedRow.cells[0].innerHTML;
        CKEDITOR.instances.editor1.setData(t);
        CurrentIndex = selectedRow.cells[4].innerHTML;
    }

    function update_tableRow() {
        selectedRow.cells[4].innerHTML = document.getElementsByName("PageID")[0].value;
        selectedRow.cells[3].innerHTML = document.getElementsByName("PageTitle")[0].value;
        selectedRow.cells[2].innerHTML = document.getElementsByName("PageSlug")[0].value;
        selectedRow.cells[1].innerHTML = document.getElementsByName("PermaLink")[0].value;
        selectedRow.cells[0].innerHTML = CKEDITOR.instances.editor1.getData(); //document.getElementsByName("editor1")[0].value;
    }

    function overlayOkCommand() {
        if (state == "add") {
            myCreateFunction();
            doOverlayClose();
        }

        if (state == "edit") {
            update_tableRow();
            doOverlayClose();
        }
    }

    function update_menu_db() {
        createAjaxObject();
        send_row(0);
    }

    ///////////////////////////////////////////Ajax machine///////////////////////////////////
    function sendAjaxCommand(command) {
        var params = "";
        lastCommand = command;
        var _PageTitle = document.getElementsByName("PageTitle")[0].value;
        var _PageSlug = document.getElementsByName("PageSlug")[0].value;
        var _PageBody = encodeURIComponent(CKEDITOR.instances.editor1.getData());
        var _PageGUID = document.getElementsByName("PermaLink")[0].value;



        if (command == "LastIndex") {
            params = "command=" + command;
        }

        if (command == "Add") {
            params = "command=" + command + "&PageTitle=" + _PageTitle + "&PageSlug=" + _PageSlug + "&PageBody=" + _PageBody + "&PageGUID=" + _PageGUID;
        }

        if (command == "Edit") {
            var part1 = "command=" + command + "&CurrentIndex=" + CurrentIndex + "&PageTitle=" + _PageTitle + "&PageSlug=" + _PageSlug + "&PageGUID=" + _PageGUID;
            var part2 = "&PageBody=" + _PageBody;

            params = part1.concat(part2);

            //alert(params);

        }

        if (command == "Delete") {
            params = "command=" + command + "&CurrentIndex=" + selectedRow.cells[4].innerHTML;

            //alert(selectedRow.cells[4].innerHTML);
        }

        if (!xmlhttp)
            createAjaxObject();



        //params = encodeURIComponent(params);

        xmlhttp.open('POST', 'pagebuilder.php', true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xmlhttp.setRequestHeader('Content-length', params.length);
        xmlhttp.setRequestHeader('Connection', 'close');
        xmlhttp.send(params);

        document.getElementById("message-div").innerText = "در حال بروز رسانی";
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
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //alert(xmlhttp.responseText);
                if (lastCommand == "LastIndex") {
                    var str = xmlhttp.responseText;
                    var arr = JSON.parse(str);
                    document.getElementsByName("PageID")[0].value = arr[0];
                    document.getElementsByName("PermaLink")[0].value = arr[1];
                    CurrentIndex = xmlhttp.responseText;
                    lastCommand = "idle";
                    document.getElementById("message").innerHTML = "---";
                    //alert(arr[0]);
                    return;
                }

                if (xmlhttp.responseText == " AddOK") {
                    document.getElementById("message").innerHTML = "بروز رسانی انجام شد";
                    doOverlayClose();
                    AddTableRow();

                }

                //document.getElementById("message").innerHTML = xmlhttp.responseText;

                if (xmlhttp.responseText == " EditOK") {
                    //alert(xmlhttp.responseText); 	 
                    document.getElementById("message").innerHTML = "بروز رسانی انجام شد";
                    doOverlayClose();
                    update_tableRow();
                }

                if (xmlhttp.responseText == " DeleteOK") {
                    //document.getElementById("message-div").innerHTML = "حذف انجام شد";
                    //alert("حذف انجام شد");
                    DeleteTableRow();
                }

                //document.getElementById("message-div").innerHTML = xmlhttp.responseText; 
                //document.getElementById("message-div").innerText = ""; 	 	    
            }
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////

    /*///////////////////////////////////////////tempoarary///////////////////////////////////
        var table = document.getElementById("builder");
        var rows = table.getElementsByTagName("tr");
        current_sent_index = index;
        maxCountRows = rows.length;
        var _PageTitle   = rows[index].cells[3].innerHTML;
        var _PageLink    = rows[index].cells[2].innerHTML;
        var _MotherLink  = rows[index].cells[1].innerHTML;
        var _LinkIndex   = rows[index].cells[0].innerHTML;
        ------------------------------------------------------
    ////////////////////////////////////////////////////////////////////////////////////////*/

    ///////////////////////////////////////////////GUI Command////////////////////////////////

    function saveChanges() {
        if (reason == "newRecord") {
            sendAjaxCommand("Add");
        }

        if (reason == "editRecord") {
            sendAjaxCommand("Edit");
        }

    }
    function addCommand() {
        reason = "newRecord";
        overlayReset();
        overlayShow();

    }

    function deleteCommand() {
        if (confirm("Are sure for delete ?") == true) {
            //alert(selectedRow.cells[4].innerHTML);
            sendAjaxCommand("Delete");
        }
        else {
            return;
        }
    }

    function editCommand() {

        if (selectedRow == undefined) {
            alert("Select a row!")
            return;
        }

        reason = "editRecord";
        fill_overlay();
        overlayShow();
    }
    ///////////////////////////////////////////////GUI Command////////////////////////////////
    window.onload = function () {
        hideColumn();
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




</script>
</html>
