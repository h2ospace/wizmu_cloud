<?php
set_time_limit(0);
define('PATH', 'uploads/');

if (isset($_FILES['file']['name'])) {
	
	if (0 < $_FILES['file']['error']) {
		$result_err = array(
			'html' => '<span style="color:red;">Error during file upload ' . $_FILES['file']['error'] . '</span>',
			'success' => '0'
		);
		echo json_encode($result_err);
	} else {
		if (file_exists(PATH . $_FILES['file']['name'])) {
			$result_exist = array(
				'html' => '<span style="color:red;">File already exists at uploads/' . $_FILES['file']['name'] . '</span>',
				'success' => '1'
			);
			echo json_encode($result_exist);
		} else {
			move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
			$result_success = array(
				'html' => '<span style="color:green;">File successfully uploaded to local server uploads/' . $_FILES['file']['name'] . '</span>',
				'success' => '2'
			);
			//sending file_info by session.
			//if uploading success to local_server, session_start.
			session_start();
				$_SESSION['file_path'] = PATH.$_FILES['file']['name'];
				$_SESSION['file_name'] = $_FILES['file']['name'];
				echo json_encode($result_success);
			}
		}
	} else {
		echo json_encode('<span style="color:red;">Please choose a file</span>');
	}
?>
