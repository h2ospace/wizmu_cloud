<!-- html part to view stream video -->
<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stream | Video</title>
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="./asset/css/fontawesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous" />
    <link rel="stylesheet" href="./asset/css/style.css">
    <link rel="shortcut icon" href="./asset/icon/video.svg">
    <script src="./asset/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="./asset/js/bootstrap.bundle.min.js"></script>
    <script src="./asset/js/upload.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #333;
            transition: background-color 2s;
        }
    </style>
</head>

<body>
    <!-- uploading php code part -->
    <?php
    set_time_limit(0);

    session_start();
    if (!isset($_SESSION['file_path'])) {
        header('location: index.php');
    }
    class Account
    {
        public $result;
        public $mail        = 'makoto.taniguchi@gmail.com';
        public $auth_key    = 'f367cc488501aa2016e896e81e51ab566d1b2';
        public $url         = 'https://api.cloudflare.com/client/v4/user';
        public $account_id  = '8a2586edee8274d81dda152d1939c652';
        public $stream_url;

        public function get_account_id()

        {
            $mail       = $this->mail;
            $auth_key   = $this->auth_key;
            $url        = $this->url;

            $ch         = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            $headers = array();
            $headers[] = 'X-Auth-Email: ' . $mail;
            $headers[] = 'X-Auth-Key: ' . $auth_key;
            $headers[] = 'Content-Type: application/json';

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }

            curl_close($ch);

            $array      = json_decode($result);
            $id         = $array->result->id;
            $success    = $array->success;
            if (isset($id)) {
                return array('id' => $id, 'success' => $success);
            } else {
                echo 'error';
            }
        }

        public function get()
        {
            $id = $this->get_account_id();
            return $id['id'];
        }

        public function upload_video()
        {
            $path       = isset($_SESSION['file_path']) ? $_SESSION['file_path'] : "";
            $file_name  = isset($_SESSION['file_name']) ? $_SESSION['file_name'] : "";
            $id         = $this->account_id;
            $auth_mail  = $this->mail;
            $auth       = $this->auth_key;

            $curl       = curl_init();
            

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.cloudflare.com/client/v4/accounts/' . $id . '/stream',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('file' => new CURLFILE($path, "", $file_name)),
                CURLOPT_HTTPHEADER => array(
                    "X-Auth-Email: " . $auth_mail,
                    "X-Auth-Key: " . $auth,
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $array = json_decode($response);
            $uid = $array->result->uid;
            return $uid;
        }
    }
    $result = new Account;
    $video_id = $result->upload_video();
    $verify_id = $result->get();

    if (isset($video_id) and isset($verify_id)) {
    ?>
        <script>
            function play() {
                let src = "http://iframe.cloudflarestream.com/<?= $video_id ?>";
                let auto = 'css-14ogxpa';
                $('.frame').attr('src', src);
                $('.css-14ogxpa').attr('autoplay', true);
            }
            setTimeout(play, 10000);
        </script>
        <div class="stream_loading container">
            <div class="spinner-border text-secondary done_load"></div>
            <div class="progress done_progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated done_progress_per" ></div>
            </div>
            <div class="close"><i class="far fa-times-circle fa-3x close_btn"></i></div>
        </div>
        <iframe src="" class="frame" allow="accelerometer; gyroscope;autoplay; encrypted-media; picture-in-picture;" allowfullscreen="true">
        </iframe>
    <?php
    } else {
    ?>
        <script>
            alert('ストリームエラー');
            location.href = 'index.php';
        </script>
    <?php
    }
    ?>
</body>
<script>
    function load_stream(){
        $('body').css('background-color','#FFF');
        $('.done_progress').hide();
        $('.done_load').hide();
    }
    var per = 0;        
    let per_show = setInterval(progress, 100);
    function progress(){
        ++per;
        $('.done_progress_per').css('width', per*1+"%");
        if(per == 100){
            clearInterval(per_show);
        }
    }
    setTimeout(load_stream, 10000);
</script>

</html>
<?php
session_destroy();
?>