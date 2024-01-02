<?php 
// header("Cache-Control: no-cache, must-revalidate");
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="style.css">
		<title>Document</title>
	</head>
	<body>
		<div class="task1">
			<h1>Task 1</h1>
			<input id="f" type="file" name="f" />
			<button type="button" class="upload_button" onclick="getFile()">Upload File</button>
			<div class="upload-progress">
				<progress value="0" min="0" max="100" style="visibility:hidden;height:0;width:0;"></progress>
			</div>
			<div class="divide-input"><input type="text" name="divide-symbol" maxlength="1" placeholder="divide strings by symbol"></div>
		<div class="file-content"></div>
		<span class="acceptance-info">Accepted file type is .txt and accepted file size <= 1kb</span>
	</div>
	<hr>
	<h2>Task2</h2>
	<p>Тип &nbsp; &nbsp;<select name="type_val"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></p>
	<p>&nbsp;</p>
	<p>Поле 1&nbsp; &nbsp;<input name="input_1" type="text"></p>
	<p>Поле 2&nbsp; &nbsp;<input name="input_2" type="text"></p>
	<p>&nbsp;</p>
	<p>Поле 3&nbsp; &nbsp;<input name="input_3" type="text"></p>
	<p>Поле 4&nbsp; &nbsp;<input name="input_4" type="text"></p>
	<p>Поле 5&nbsp; &nbsp;<input name="input_5" type="text"></p>
	<p>Поле 6&nbsp; &nbsp;<input name="input_6" type="text"></p>
	<p>Поле 7&nbsp; &nbsp;<input name="input_7" type="text"></p>
	<p><input name="button_12" type="button" value="Кнопка 1"></p>
	<p><input name="button_28" type="button" value="Кнопка 2"></p>
	<p><input name="button_88" type="button" value="Кнопка 4"></p>
	<p><input name="button_33" type="button" value="Кнопка 3"></p>
	<p><input name="button_1" type="button" value="Кнопка 8"></p>
	<hr>
	<h3>Task 3</h3>
	<a href="dashboard.php?login" data-ip="<?php echo getUserIP(); ?>" class="task3_link">View the visitor details</a>
	<script type="text/javascript" src="script.js" defer></script>
</body>
</html>