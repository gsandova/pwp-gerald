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









		<!-- image thumbnail section -->
		<!--<section id="thumbnails" class="p-x-10">-->

		<div class="container pad">





			<?php
			/*load resume.php*/
			require_once(dirname(__DIR__) . "/php/partials/resume.php");
			?>










		</div><!--container pad -->
		<!--</section>thumbnails-->
	</div><!--/.sfooter-content-->

	<!--begin footer -->
	<?php
	/*load footer.php*/
	require_once("../php/partials/footer.php");
	?>

</body>
</html>