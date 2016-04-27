<?php 
	##################################### 
	#			STUDENT FUNCTION 		#
	#####################################

	function protect_page() {
		if (!initialize_token()) {
			header('Location: index.php');
			exit();
		}
	}

	function protect_page_profile() {
		if (!initialize_token()) {
			header('Location: login/index.php');
			exit();
		}
	}

	function revert_page_protection() {
		if (initialize_token()) {
			session_unset();
			session_destroy();
			header('Location: index.php');
			exit();
		}
	}

	##################################### 
	#	   ADMINISTRATOR FUNCTION 		#
	#####################################

	function revert_page_protection_admin() {
		if (initialize_token_admin()) {
			session_unset();
			session_destroy();
			header('Location: index.php');
			exit();
		}
	}

	function protect_page_profile_admin() {
		if (!initialize_token_admin()) {
			header('Location: admin/index.php');
			exit();
		}
	}

	##################################### 
	#	   		ROOT FUNCTION 	     	#
	#####################################

	function revert_page_protection_root() {
		if (initialize_token_root()) {
			session_unset();
			session_destroy();
			header('Location: root.php');
			exit();
		}
	}

	function protect_page_profile_root() {
		if (!initialize_token_root()) {
			header('Location: admin/index.php');
			exit();
		}
	}
?>