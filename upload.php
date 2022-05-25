<?php
set_time_limit(0);
ini_set('post_max_size', 0);
define('PATH', 'uploads/');
if (isset($_FILES['file']['name'])) {
    $temp = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];
    $path = PATH . $_FILES['file']['name'];
    if (!file_exists($path)) {
        if (move_uploaded_file($temp, $path)) {
            session_start();
            $_SESSION['file_path'] = $path;
            $_SESSION['file_name'] = $file_name;
?>
            <span data-val = '1'></span>
            <script>
                location.href = "done.php";
                </script>
        <?php
        } else {
            ?>
            <span data-val = '2'></span>
        <?php
        }
    } else {
        ?>
            <span data-val = '3'></span>
    <?php
    }
} else {
    ?>
    <script>
        location.href = "index.php";
    </script>
<?php
}
?>