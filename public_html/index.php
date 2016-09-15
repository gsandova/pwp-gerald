<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;

/*load head-utils.php*/
require_once("php/partials/head-utils.php");
?>

</head>
<body class="sfooter">
	<div class="sfooter-content">
		<!-- begin header and nav -->
		<?php
		/*load header.php*/
		require_once("php/partials/header.php");
		?>


		<!-- welcome section -->
		<section id="welcome">
			<div class="container">
				<div class="jumbotron text-center">
					<h1>Online Resume & Portfolio</h1>
					<p>I am a Software Engineer with a BS in Electrical Engineering. </p>
					<p>I have a very diverse technical background and a lot of experience in the Aerospace Industry.</p>

					<!--
					<p>This is an interactive resume that will give you a brief summary of my qualifications or, if so
						desired, a more detailed account</p>
						-->
				</div>
			</div>
		</section> <!--welcome-->


		<!-- image thumbnail section -->
		<!--<section id="thumbnails" class="p-x-10">-->

		<div class="container">

			<div class="col-md-6 col-sm-12">

				<img src="images/Sandoval.png" alt="Sandoval"
					  class="img-responsive img-circle img-thumbnail center-block img-bot-margin">
				<a href="http://lmgtfy.com/?q=find+stupid+people+for+sales+positions">
					<div class="well">
						<h2 class="text-center"> Click Here</h2>
						<p>If you represent State Farm, Farmers, or any other financial or insurance organization and you're
							looking to expand your local sales office</p>

					</div>
				</a>
			</div>


			<div class="col-md-6 col-sm-12">
				<img src="images/Sandoval.png" alt="Sandoval"
					  class="img-responsive img-circle img-thumbnail center-block img-bot-margin">
				<a href="<?php echo $PREFIX;?>resume/">
					<div class="well">
						<h2 class="text-center"> Click Here</h2>
						<p>if you're specifically looking for a high technical individual to work in your technology based
							company</p>

					</div>
			</div>


		</div><!--container-->
		<!--</section>thumbnails-->
	</div><!--/.sfooter-content-->

	<!--begin footer -->
	<?php
	/*load footer.php*/
	require_once("php/partials/footer.php");
	?>

</body>
</html>