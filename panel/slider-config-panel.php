<?php
session_start();

if( !isset($_SESSION[user_name]) ){
    header("location:../login/");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Upload Files using XMLHttpRequest - Minimal</title>

    <style>
        @font-face {
            font-family: "IRANSans-Bold";
            src: url("fonts/IRANSans-Bold.woff") format("woff");
        }

        body {
            padding: 20px;
            background-color: #333333;
            background-image: url("resource/bg27.png");
            color: black;
            min-width: 530px;
            font-family: IRANSans-Bold;
        }

        table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 460px;
            overflow: hidden;
        }

            table td {
                border-top: solid 1px;
                border-bottom: solid 2px;
                border-right: none;
                border-left: none;
                width: 300px;
                word-wrap: break-word;
                direction: ltr;
                text-align: center;
            }

        td.container > div {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        td.container {
            height: 30px;
        }

        table thead tr {
            background-color: #F8E0CB;
        }

        #builder {
            font-family: IRANSans-Bold;
            background-color: #CBDCED;
            width: 100%;
            overflow-x: hidden;
            overflow-y: auto;
        }


        .fixed-table-container {
            width: 760px;
            height: 400px;
            border: 1px solid black;
            margin: 0px auto;
            background-color: white;
            /* above is decorative or flexible */
            /* position: relative;  could be absolute or relative */
            /* padding-top: 30px;  height of header */
            border-radius: 0px;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .button-container {
            margin: 0px auto;
            width: auto;
            border: solid;
            border-width: 5px;
            border-color: #F0F0F0;
            margin-top: 10px;
            padding: 2px;
            display: inline-block;
            overflow: auto;
            white-space: nowrap;
            float: right;
            background-color: white;
            margin-right: 10px;
        }

        .wrapper {
            margin: 0 auto;
            width: 760px;
            border: none;
        }
    </style>

    <script type="text/javascript">


        var name1;
        var selectedRow;
        var selectedRowIndex;
        var state;
        var xmlhttp;
        var current_sent_index;
        var maxCountRows;
        var _FileName = "-";
        var _SelectedIndex = -1;


        function fileSelected() {
            var file = document.getElementById('fileToUpload').files[0];
            if (file) {
                var fileSize = 0;
                if (file.size > 1024 * 1024)
                    fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                else
                    fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';

                document.getElementById('fileName').innerHTML = 'Name: ' + file.name;
                document.getElementById('fileSize').innerHTML = 'Size: ' + fileSize;
                document.getElementById('fileType').innerHTML = 'Type: ' + file.type;
            }
        }

        function uploadFile() {
            document.getElementById("message").innerHTML = "Uploading ...";
            var fd = new FormData();
            fd.append("fileToUpload", document.getElementById('fileToUpload').files[0]);
            fd.append("destination", "slider");
            var xhr = new XMLHttpRequest();
            xhr.upload.addEventListener("progress", uploadProgress, false);
            xhr.addEventListener("load", uploadComplete, false);
            xhr.addEventListener("error", uploadFailed, false);
            xhr.addEventListener("abort", uploadCanceled, false);
            xhr.open("POST", "uploader.php");
            xhr.send(fd);
        }

        function uploadProgress(evt) {
            if (evt.lengthComputable) {
                var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                document.getElementById('progressNumber').innerHTML = percentComplete.toString() + '%';
            }
            else {
                document.getElementById('progressNumber').innerHTML = 'unable to compute';
            }
        }

        function uploadComplete(evt) {
            /* This event is raised when the server send back a response */
            UpdateTableByServer();
            document.getElementById("message").innerHTML = evt.target.responseText;
            //alert(evt.target.responseText);


        }

        function uploadFailed(evt) {
            alert("There was an error attempting to upload the file.");
        }

        function uploadCanceled(evt) {
            alert("The upload has been canceled by the user or the browser dropped the connection.");
        }

        /*================================================*/
        function enumerate() {
            //Get list of rows in the table
            var table = document.getElementById("builder");
            //var table = document.getElementsByClassName("builder");
            var rows = table.getElementsByTagName("tr");

            //Row callback; reset the previously selected row and select the new one
            function SelectRow(row) {
                if (selectedRow !== undefined) {
                    selectedRow.style.background = "#CBDCED";
                }
                selectedRow = row;
                selectedRowIndex = row.rowIndex;

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
        /*================================================*/

        window.onload = function () {
            enumerate();
            createAjaxObject();
        }

        /*================================================*/
        function addTableRow() {
            var table = document.getElementById("builder");
            var row = table.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            cell1.innerHTML = document.getElementsByName("LinkIndex")[0].value;
            cell2.innerHTML = document.getElementsByName("MotherLink")[0].value;
            cell3.innerHTML = document.getElementById("PageLink").value;
            cell4.innerHTML = document.getElementsByName("PageTitle")[0].value;
            enumerate();
        }
        function DeleteTableRow() {
            if (selectedRow.rowIndex == -1)
                return;

            document.getElementById("builder").deleteRow(selectedRow.rowIndex);
            enumerate();
        }

        function DeleteTableRowByIndex(TableIndex) {
            if (TableIndex == -1)
                return;

            document.getElementById("builder").deleteRow(TableIndex);
            enumerate();
        }


        /*================================================*/

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
                //alert(xmlhttp.readyState + "    "+xmlhttp.status );
                //document.getElementById("message").innerHTML= xmlhttp.responseText;
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var str = xmlhttp.responseText;
                    var arr = JSON.parse(str);

                    //alert(arr[0] +"-------"+ arr[1]);
                    //return;

                    //alert(str);
                    //alert(arr[1]);

                    if (arr[1] == "ConfirmDelete") {
                        document.getElementById("message").innerHTML = arr[0];
                        DeleteTableRowByIndex(arr[2]);
                        return;
                    }

                    if (arr[1] == "ConfirmView") {
                        document.getElementById("message").innerHTML = arr[0];
                        return;
                    }

                    if (arr[1] == "ConfirmUpdateTable") {
                        //alert(arr[1]);
                        //document.getElementById("message").innerHTML= arr[0];
                        document.getElementById("info-table").innerHTML = arr[2];
                        enumerate();
                        return;
                    }

                }
            }

        }

        function sendAjaxCommand(command) {
            try {
                var params = "";
                lastCommand = command;

                var table = document.getElementById("builder");
                var rows = table.getElementsByTagName("tr");


                if (selectedRow !== undefined)
                    if (rows[selectedRow.rowIndex] !== undefined) {
                        _FileName = rows[selectedRow.rowIndex].cells[4].children[0].innerHTML;
                        _SelectedIndex = selectedRow.rowIndex;
                    }
                    else {
                        _SelectedIndex = -1;
                        _FileName = "-";
                    }

                params = "command=" + command + "&FileName=" + _FileName + "&SelectedIndex=" + _SelectedIndex + "&destination=" + "slider";

                if (!xmlhttp)
                    createAjaxObject();

                xmlhttp.open('POST', 'uploader.php', true);
                xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                xmlhttp.setRequestHeader('Content-length', params.length);
                xmlhttp.setRequestHeader('Connection', 'close');
                xmlhttp.send(params);
                //alert(params);
            }
            catch (err)
            { alert(err); }
        }

        /*================================================*/

        function deleteCommand() {
            if (confirm("Are sure for delete ?") == true)
                sendAjaxCommand("Delete");
            else
                return;
        }

        function viewCommand() {
            //sendAjaxCommand("Edit");
            UpdateTableByServer();
        }

        function UpdateTableByServer() {
            sendAjaxCommand("UpdateTable");
        }

</script>
</head>

<body>




    <div class="wrapper">
        <div class="fixed-table-container">
            <table id="builder" cellspacing="0">

                <col width="40">
                <col width="40">
                <col width="50">
                <col width="40">
                <col width="120">
                <col width="20">

                <thead>
                    <tr>
                        <th scope="col">آدرس</th>
                        <th scope="col">ابعاد</th>
                        <th scope="col">حجم</th>
                        <th scope="col">نوع</th>
                        <th scope="col">نام فایل</th>
                        <th scope="col">ردیف</th>
                    </tr>
                </thead>
                <tbody id="info-table">
                    <?php
                    include 'uploader.php'; list_files(1,'slider'); ?>
                </tbody>
            </table>
        </div>



        <div class="button-container">
            <input type="button" onclick="deleteCommand()" value="DELETE" />
        </div>

        <div class="button-container">
            <form id="form1" enctype="multipart/form-data" method="post" action="uploader.php">
                <div class="row">
                    <label for="fileToUpload">Select a File to Upload</label><br />
                    <input type="file" name="fileToUpload" id="fileToUpload" onchange="fileSelected();" />
                    <input type="button" onclick="uploadFile()" value="Upload" />
                </div>
                <div class="row">
                </div>
                <div id="fileName"></div>
                <div id="fileSize"></div>
                <div id="fileType"></div>
                <div id="progressNumber"></div>

            </form>
        </div>
    </div>

    <div class="button-container">
        <div id="message">System Message</div>
    </div>



</body>
</html>


