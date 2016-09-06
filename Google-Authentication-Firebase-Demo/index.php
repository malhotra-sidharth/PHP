<?php 
// include header and destroySession.php
	include 'includes/destroySession.php';
	include 'includes/header.php';
 ?>
	<div class="container" style="margin-top: 10%;">
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<h3>Internship Demo Project <br/>by- Sidharth Malhotra </h3>
				<br/><br/>
				<button onclick="openPopUp()" class="btn btn-primary">Login With Google</button>
				<p id="logInMsg"></p>
			</div>
		</div>
	</div>


<?php 
	// include footer
	include 'includes/footer.php';
 ?>