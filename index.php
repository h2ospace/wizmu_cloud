<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie | Upload</title>
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="./asset/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous" />
    <link rel="stylesheet" href="./asset/css/fontawesome.css">
    <link rel="shortcut icon" href="./asset/icon/upload.svg">
    <script src="./asset/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="./asset/js/bootstrap.bundle.min.js"></script>
    <script src="./asset/js/jquery.form.min.js"></script>
    <script src="./asset/js/upload.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="upload">
        <div>
            <div class="title">動画ファイル</div>
            <p id="msg" style="display:none"></p>
            <p class="result"></p>
        </div>
        <div>
            <div class="icon_movie">
                <i class="fas fa-photo-video fa-2xl"></i>
               <p> *.MP4, *.MOV' 動画ファイルをアップロードできます。</p>
            </div>
            <div class="loading_status">
                <div class="progress_1 progress progress_per">
                    <div class="progress-bar_1 progress-bar"></div>
                </div>
                <div class="progress_2 progress progress_per">
                    <div class="progress-bar_2 progress-bar"></div>
                </div>
                <div class="spinner-border text-warning status"></div>
            </div>
            <div class="up_form">
                <form class="upload_frm" action="upload.php" method="post">
                    <div>
                        <input type="reset" class="reset">
                        <div class="btn_grp">
                            <input type="submit" id="upload" class="upload_btn btn btn-success " value="アップロード" />
                            <span class="spinner-grow spinner-grow-sm loading_icon"></span>
                            <i class="fas fa-upload upload_icon"></i>
                        </div>
                    </div>
                    <div class="file_choose">
                        <input type="file" name="file" id="movie" class="form-input" />
                        <label for="movie">
                            <div class="file_trigger">
                                <span class="">ファイル選択</span>
                                <p class="file_name "></p>
                            </div>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>