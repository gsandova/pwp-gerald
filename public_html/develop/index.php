<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;

/*load head-utils.php*/
//require_once("../php/partials/head-utils.php");

// Initialize your autoloader (this example is using composer)
require '../../vendor/autoload.php';
// Instantiate the Highlighter.
$hl = new Highlight\Highlighter();
// Highlight some code.
$r = $hl->highlight("cpp", file_get_contents("../documentation/binary.cpp"));


/*load head-utils.php
require_once("../php/partials/head-utils.php");
*/
?>

<head>
	<!-- Link to the stylesheets: -->
	<link rel="stylesheet" type="text/css" href="../css/custom-cpp.css">
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



		<pre class="hljs <?=$r->language?>"><?=$r->value?></pre>





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