<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Document</title>
</head>
<body>
	<form action="dashboard.php" method="POST">
		<input type="hidden" name="logout" value="true">
		<button>Log Out</button>
	</form>
	<div>
			<?php
				require_once('conn.php');

				// var_dump($_COOKIE['userData']);
				
				$sql = $conn->prepare("SELECT * FROM visitors
					ORDER BY id DESC");
				$sql->execute();
				$data = $sql->fetchAll(PDO::FETCH_ASSOC);
				// var_dump($data);
				$cities = array_map(function($every) {
					return array_filter($every, function ($k) {
				 		return $k == "city";
					}, ARRAY_FILTER_USE_KEY);
				}, $data);
				$oneLevelCities = [];
				foreach ($cities as $subArray) {
				    foreach ($subArray as $value) {
				        $oneLevelCities[] = $value;
				    }
				}
				$cityAndCount = array_count_values($oneLevelCities);
				print_r($cityAndCount);
				
			?>
	</div>
	<input type="hidden" class="cityData" data-city='<?php print(json_encode($cityAndCount)); ?>' >

	<div>
		<h4>Unique visitors <span>( <?php print(count($data)); ?> )</span></h4>
		<?php foreach($data as $each): ?>
			<span> <b><?php print_r($each['ip']); ?> </b></span> <s>-|-</s> <span> <b><?php print_r($each['visit_time']); ?> </b></span> <s>-|-</s> <span> <b><?php print_r($each['device']); ?> </b></span> <br>
		<?php endforeach; ?>
	</div>
	<canvas width="800" height="800" id="can">
    	Sorry, canvas not supported
    </canvas>

	<script type="text/javascript" src="utils.js"></script>
	<script type="text/javascript" src="piechart.js"></script>
	<script type="text/javascript" src="setup_chart.js"></script>
</body>
</html>