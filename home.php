<?php include 'welcome.php';?>
<html>
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="css_style/style_home.css">
	</head>
	<body>
		<div class = "main">
		<div ><button id="btn" onclick="snapShot()" type="submit" class="click-camerabtn" name="submit" value="ok">Take Photo</button></div>
			<div class = "video">
				<video autoplay="true" id="videoElement"></video>
				<form method = "post" action= "upload.php" enctype="multipart/form-data">
					</br></br><span>Select image: <input type="file"  name="filename" size="40" onchange="loadFile(event)" accept="image/gif, image/jpeg, image/png"/>
						<input type="submit" name = "submit" value="upload"/></span>
				</form>
			</div>
		</div>
		<div class= "side">
			<img id="image" src="#" alt="image to be displayed" width="450" height="350">
			<canvas id="canv" width="450" height="350"></canvas>
		</div>
		<div class = "photo">
			<ul>
				<p><img id="selBtn1" onclick="popUp('selBtn1')" src="../images/bouncing-tennis.jpg" alt="bouncing-tennis" class="images"></p>
				<p><img id="selBtn2" onclick="popUp('selBtn2')" src="../images/add.jpg" alt="addidas-ball" class="images"></p>
				<p><img id="selBtn3" onclick="popUp('selBtn3')" src="../images/rugby.jpeg" alt="rugby-ball"class="images"></p>
				<p><img id="selBtn4" onclick="popUp('selBtn4')" src="../images/basketball.png" alt="basketball" class="images"></p>
				<p><img id="selBtn5" onclick="popUp('selBtn5')" src="../images/golf.jpg" alt="golf" class="images"></p>
				<p><img id="selBtn6" onclick="popUp('selBtn6')" src="../images/tenis.jpeg" alt="tennis" class="images"></p>
			</ul>
		</div>
		<script src="javascript/cam.js"></script>
	</body>
</html>
