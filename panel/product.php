<?php
session_start();

if( !isset($_SESSION[user_name]) ){
    header("location:../login/");
}

include '../dal.php';

GetConnection();

if(isset($_POST["command"]) && isset($_POST["Arg1"]) && isset($_POST["Arg2"]) && isset($_POST["Arg3"]) && isset($_POST["Arg4"]) && isset($_POST["Arg5"]) )
{	
    $val1 = $_POST["Arg1"];
    $val2 = $_POST["Arg2"];
    $val3 = $_POST["Arg3"];
    $val4 = $_POST["Arg4"];
    if($_POST["command"] == "Add")
    {									
        $iquery = "INSERT INTO cms_products (product_title,product_description,product_page_url,product_picture_url) VALUES ('$val1','$val2','$val3','$val4')";
        
        $result = mysql_query($iquery);	
		
        if ( $result === false ){	
            echo("error");
            exit;
        }		
        $answer = array( "ConfirmAdd",retrieveProductRecords(2));
        echo json_encode($answer);									 		
        exit;	
    }
    if($_POST["command"] == "Delete")
    {	
        $rowIndex =  $_POST["Arg1"];
        $iquery = "DELETE FROM cms_products WHERE  id = $rowIndex "; 
        $result = mysql_query($iquery);	
		
        if ( $result === false ){	
            echo("error");
            exit;
        }	
        $answer = array( "ConfirmDelete",retrieveProductRecords(2));
        echo json_encode($answer);									 		
        exit;	
    }	
    if($_POST["command"] == "Edit")
    {	
        $rowIndex =  $_POST["Arg5"];
        $iquery = "UPDATE cms_products SET product_title= '$val1',product_description = '$val2',product_page_url = '$val3',product_picture_url = '$val4'    WHERE  id = '$rowIndex' ";			
        
        $result = mysql_query($iquery);	
		
        if ( $result === false ){	
            echo("error");
            exit;
        }	
        
        $answer = array( "ConfirmEdit",retrieveProductRecords(2));
        echo json_encode($answer);									 		
        exit;	
    }			
}

function retrieveProductRecords($arg)
{	
	$result = mysql_query("select * from cms_products ORDER BY id ");   
    
    $outputString = "";  
    $index = 0;
    
    while ($row = mysql_fetch_assoc($result, MYSQL_NUM)) 
    {        
        $outputString .= "\r\n" . "<tr>" 
        . "\r\n" . "<td>" . "$row[4]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[3]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[2]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[1]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . ++$index  . "</td>" . "\r\n" 
        . "\r\n" . "<td style=display:none;>" . "$row[0]" . "</td>" . "\r\n" 
        . "</tr>" . "\r\n" ;      		
	}
	if($arg == 1)
		echo $outputString;
	if($arg == 2)	
		return $outputString;
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>محصولات</title>

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
                //width:300px;
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

        .caption-table {
            margin: 0px auto;
            width: 300px;
            text-align: center;
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
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 1002;
            overflow: auto;
            width: 500px;
            height: 300px;
            margin-left: 100px;
            margin-top: 100px;
            border: 5px solid #09F;
            display: none;
            background: #fff;
            border: 5px solid #09F;
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


        //=========================overlay
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
            document.getElementsByName("TextBox4")[0].value = "";
            document.getElementsByName("TextBox3")[0].value = "";
            document.getElementsByName("TextBox2")[0].value = "";
            document.getElementsByName("TextBox1")[0].value = "";
        }

        function fill_overlay() {
            document.getElementsByName("TextBox4")[0].value = selectedRow.cells[0].innerHTML;
            document.getElementsByName("TextBox3")[0].value = selectedRow.cells[1].innerHTML;
            document.getElementsByName("TextBox2")[0].value = selectedRow.cells[2].innerHTML;
            document.getElementsByName("TextBox1")[0].value = selectedRow.cells[3].innerHTML;
        }


        /*================================================*/
        function enumerate() {
            //Get list of rows in the table
            var table = document.getElementById("info-table");
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
            for (var i = 0; i <= rows.length; i++) {
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
            cell1.innerHTML = document.getElementsByName("TextBox4")[0].value;
            cell2.innerHTML = document.getElementsByName("TextBox3")[0].value;
            cell3.innerHTML = document.getElementByName("TextBox2")[0].value;
            cell4.innerHTML = document.getElementsByName("TextBox1")[0].value;
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
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var str = xmlhttp.responseText;

                    //alert(str);

                    var arr = JSON.parse(str);

                    //alert(arr[0] +"-------"+ arr[1]);
                    //return;


                    //alert(arr[1]);

                    if (arr[0] == "ConfirmAdd") {
                        doOverlayClose();
                        document.getElementById("info-table").innerHTML = arr[1];
                        enumerate();
                        return;
                    }

                    if (arr[0] == "ConfirmDelete") {
                        document.getElementById("info-table").innerHTML = arr[1];
                        enumerate();
                        return;
                    }

                    if (arr[0] == "ConfirmEdit") {
                        doOverlayClose();
                        document.getElementById("info-table").innerHTML = arr[1];
                        enumerate();
                        return;
                    }
                }
            }

        }

        function sendAjaxCommand(command) {
            try {
                var params = "";

                var table = document.getElementById('info-table');
                var rows = table.getElementsByTagName('tr');

                var txt5 = "";
                var txt4 = document.getElementsByName('TextBox4')[0].value;
                var txt3 = document.getElementsByName('TextBox3')[0].value;
                var txt2 = document.getElementsByName('TextBox2')[0].value;
                var txt1 = document.getElementsByName('TextBox1')[0].value;

                if (command == "Delete") {
                    txt1 = rows[selectedRowIndex - 1].cells[5].innerHTML;
                }

                if (command == "Edit") {
                    txt5 = rows[selectedRowIndex - 1].cells[5].innerHTML;
                }


                params = "command=" + command + "&Arg1=" + txt1 + "&Arg2=" + txt2 + "&Arg3=" + txt3 + "&Arg4=" + txt4 + "&Arg5=" + txt5;

                if (!xmlhttp)
                    createAjaxObject();

                xmlhttp.open('POST', 'product.php', true);
                xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                xmlhttp.setRequestHeader('Content-length', params.length);
                xmlhttp.setRequestHeader('Connection', 'close');
                xmlhttp.send(params);
                alert(params);
            }
            catch (err)
            { alert(err); }
        }

        /*================================================*/

        var reason = "";

        function deleteCommand() {
            if (confirm("آیا از حذف آیتم انتخاب شده اطمینان دارید ؟") == true)
                sendAjaxCommand("Delete");
            else
                return;
        }

        function editCommand() {
            if (selectedRow == undefined) {
                alert('لطفا یک سطر را انتخاب کنید');
                return;
            }

            fill_overlay();
            reason = 'Edit';
            overlayShow();
        }

        function addCommand() {
            overlayReset();
            reason = 'Add';
            overlayShow();
        }

        function overlayOkCommand() {
            if (reason == 'Add')
                sendAjaxCommand("Add");
            if (reason == 'Edit')
                sendAjaxCommand("Edit");
        }

    </script>
</head>

<body>


    <div class="bgCover"></div>

    <div class="overlayBox">
        <div class="overlayContent">
            <a href="#" id="closeLink">Close</a>
            <table class="full-width-table">
                <tr>
                    <td>
                        <input type="text" name="TextBox1" value=""></td>
                    <td>عنوان محصول :</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="TextBox2" value=""></td>
                    <td>توضیح محصول :</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="TextBox3" value=""></td>
                    <td>لینک به صفحه محصول :</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="TextBox4" value=""></td>
                    <td>تصویر محصول</td>
                </tr>
            </table>
            <div class="button-container">
                <div class="float-right">
                    <button type="button" onclick="overlayOkCommand()">تائید</button>
                </div>
            </div>
        </div>
    </div>




    <div class="wrapper">

        <div class="caption-table">
            <h1>محصولات</h1>
        </div>

        <div class="fixed-table-container">
            <table id="builder" cellspacing="0">

                <col width="150">
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="120">

                <thead>
                    <tr>
                        <th scope="col">عکس محصول</th>
                        <th scope="col">صفحه محصول</th>
                        <th scope="col">توضیح محصول</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">ردیف</th>
                    </tr>
                </thead>
                <tbody id="info-table">

                    <?php
                    retrieveProductRecords(1);
                    ?>

                </tbody>
            </table>
        </div>



        <div class="button-container">
            <input type="button" onclick="addCommand()" value="اظافه" />
            <input type="button" onclick="deleteCommand()" value="حذف" />
            <input type="button" onclick="editCommand()" value="ویرایش" />
        </div>
</body>
</html>


