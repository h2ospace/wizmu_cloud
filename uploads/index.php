<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    
    <link rel="stylesheet" href="./asset/bootstrap.min.css">
    <link rel="stylesheet" href="./asset/style.css">
    <link rel="stylesheet" href="./asset/fontawesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />
    <script src="./asset/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="./asset/upload.js" crossorigin="anonymous"></script>
</head>
<body>
    
<form class="upload_frm">
    <dl>
        <dt class="title">動画ファイル</dt>
        <dd><input type="file" name="file" id="movie" class="form-input"></dd>
        
    </dl>
    <p id="msg"></p>
    <button type="button" id="upload" class="upload_btn btn btn-success ">アップロード<i class="fas fa-upload "></i></button>
</form>
</body>
<script>
   
  

    // $('#upload').on('click', function(){
    //     let name = $('.file_name').val();
    //     $.ajax({
    //        url : 'upload.php',
    //        method : 'post',
    //        data : {name},
    //        dataType : 'json',
    //        success : function(res){
    //            $('#msg').html(res);
    //        }
    //     });
    // });
    
</Script>

</html>
