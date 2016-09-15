<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;

/*load head-utils.php*/
require_once("../php/partials/head-utils.php");
?>

</head>
<body class="sfooter">
	<div class="sfooter-content">
		<!-- begin header and nav -->
		<?php
		/*load header.php*/
		require_once("../php/partials/header.php");
		?>


		<!-- welcome section -->
		<section id="welcome">
			<div class="container">
				<div class="jumbotron text-center">
					<h1>Online Portfolio</h1>
					<p>This Portfolio section is currently under construction. </p>
				</div>
			</div>
		</section> <!--welcome-->


		<!-- image thumbnail section -->
		<!--<section id="thumbnails" class="p-x-10">-->


		<!--</section>thumbnails-->
	</div><!--/.sfooter-content-->

	<!--begin footer -->
	<?php
	/*load footer.php*/
	require_once("../php/partials/footer.php");
	?>

</body>
</html>