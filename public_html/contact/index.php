<?php
	/*grab current directory*/
	$CURRENT_DIR = __DIR__;

	/*load head-utils.php*/
	require_once(dirname(__DIR__) . "/php/partials/head-utils.php");
?>


<body class="sfooter">
	<div class="sfooter-content">
		<!-- begin header and nav -->
		<?php
		/*load header.php*/
		require_once(dirname(__DIR__) . "/php/partials/header.php");
		?>


		<div class="container pad">
			<!-- contact form -->
			<?php
			/*load contact-form.php*/
			require_once(dirname(__DIR__) . "/php/partials/contact-form.php");
			?>


		</div>















	</div><!--/.sfooter-content-->
	<!--begin footer -->
	<?php require_once(dirname(__DIR__) . "/php/partials/footer.php"); ?>

</body>
</html>