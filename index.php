<?php include 'g.php'; ?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		<title>snippet-mediaviewer</title>
		<!--
		<link rel="stylesheet" href="/src/cl/style.css">
		-->
		<style>
			h1, hr {
				padding: 0;
				margin: 0;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Image (horizontal)</h1>
			<img src="https://cdn.mabgl.com/germany/demos/mv/imgh.png" class="g" width="400" alt="imgHorizontal">
			
			<br><br><hr><br>
			
			<h1>Image (vertical)</h1>
			<img src="https://cdn.mabgl.com/germany/demos/mv/imgv.png" class="g" width="400" alt="imgVertical">
			
			<br><br><hr><br>
			
			<h1>Video (horizontal)</h1>
			<img src="https://cdn.mabgl.com/germany/demos/mv/imgh.png" class="g v" data-src="https://cdn.mabgl.com/germany/demos/mv/vid1.mp4" width="400" alt="vidHorizontal">
			
			<br><br><hr><br>
			
			<h1>Video (vertical)</h1>
			<img src="https://cdn.mabgl.com/germany/demos/mv/imgv.png" class="g v" data-src="https://cdn.mabgl.com/germany/demos/mv/vidv.mp4" width="400" alt="vidVertical">
		</div>
	</body>
</html>
