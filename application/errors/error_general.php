<?php

// fancy error page only works if we can load helpers
if (class_exists("CI_Controller") && !isset($GLOBALS["is_error_page"]) && isset(get_instance()->load)) {
	if (!isset($title)) {
		$title = "Error";
	}
	$GLOBALS["is_error_page"] = true;

	$CI =& get_instance();
	$CI->load->helper("filebin");
	$CI->load->helper("url");

	if ($CI->input->is_cli_request()) {
		$message = str_replace("</p>", "</p>\n", $message);
		$message = strip_tags($message);
		echo "$heading: $message\n";
		exit();
	}

	include APPPATH.'views/header.php';

	?>
		<div class="error">
			<h1><?php echo $heading; ?></h1>
			<?php echo $message; ?>
		</div>

	<?php
	include APPPATH.'views/footer.php';
} elseif (php_sapi_name() === 'cli' OR defined('STDIN')) {
	echo "# $heading\n";
	$msg = strip_tags(str_replace("<br>", "\n", $message));
	foreach (explode("\n", $msg) as $line) {
		echo "# $line\n";
	}
	exit(255);
} else {
	// default CI error page
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Error</title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p, div {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>
</body>
</html>
<?php
}
