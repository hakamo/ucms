<?php
session_start();

if( !isset($_SESSION[user_name]) ){
    header("location:../login/");
}

include '../func.php';
include '../dal.php';
GetConnection();

?>

<!doctype html>
<html lang="fa">

<head>

    <?php include('../head_script.php') ?>

    <title>صفحه ساز سایت</title>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <script src="../component/ckeditor/ckeditor.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.1/bootstrap-table.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.1/bootstrap-table.min.js"></script>
    <!-- Latest compiled and minified Locales -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.13.1/locale/bootstrap-table-zh-CN.min.js"></script>


</head>

<body>

    <?php include('navbar.php') ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">


                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" name="PageID" value="" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 col-form-label">شناسه صفحه</label>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" name="PageTitle" value="" class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label">عنوان صفحه</label>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" id="message" value="" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 col-form-label">پیام سیستم</label>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" name="PageSlug" value="" class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label">SLUG</label>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" name="PermaLink" value="" class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label">لینک دائم</label>
                    </div>


                    <textarea class="ckeditor" id="editor1" name="editor1" rows="10">

                </textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">ذخیره</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container">

        <table
            id ="table"
            data-toggle="table"
            data-url="pagebuilder_controller.php?command=read"            
            class= "table-bordered">

            <thead class="thead-dark">
                <tr>
                    <th data-field="id">ID</th>
                    <th data-field="post_title">عنوان پست</th>
                    <th data-field="slug">slug</th>
                </tr>
            </thead>

        </table>

    </div>

</body>

<script>

    $('#table').bootstrapTable();




</script>

</html>
