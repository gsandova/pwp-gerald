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
$s = $hl->highlight("cpp", file_get_contents("../documentation/binary.h"));
$t = $hl->highlight("cpp", file_get_contents("../documentation/output.txt"));

/*load head-utils.php*/
require_once("../php/partials/head-utils.php");

?>
<!--
<head>
	<!-- Link to the stylesheets:
	<link rel="stylesheet" type="text/css" href="../css/hybrid.css">
</head>
-->

<body class="sfooter">
	<div class="sfooter-content">
		<!-- begin header and nav -->
		<?php
		/*load header.php*/
		require_once("../php/partials/header.php");
		?>


		<!-- welcome section
		<section id="welcome">
			<div class="container">
				<div class="jumbotron text-center">
					<h1>Online Portfolio</h1>
					<p>This Portfolio section is currently under construction. </p>
				</div>
			</div>
		</section> <!--welcome-->

		<div class="container pad">




			<div class="well">
				<h2 align="center">Programming Challenge:  </h2>
				<p>This is a programming challenge that I accepted.  I did not receive any compensation for this work nor was I asked to sign any kind of confidentiality agreement.  It utilizes C++ libraries.  You're welcome to download the 'tar' file, if you wish to run it yourself.</p>

			</div> <!-- class"well" -->


			<div class="well">
				<p>Binary file problem<br>
					===================<br>
					<br>
					Background:<br>
					-----------<br>
					<br>
					The binary file "00_LHZ.512.seed" has the following structure:<br>
<br>
					* Every 512 bytes represents a record<br>
					* Inside of each record, in the following order, there is:<br>
					- One header (48 bytes)<br>
					- One type "1000" blockette<br>
					- Possibly other blockettes of other types<br>
					- Time series data<br>
					<br>
					All blockette types have the following structure:<br>
					<br>
					* Blockette type (integer, 2 bytes)<br>
					* Next blockette's byte number (integer, 2 bytes)<br>
					* Other fields<br>
					<br>
					Where the next blockette's byte number is the index of the beginning of the next blockette. The number is local to the record. If the next blockett's byte number is 0, it means this is the last blockette of this record.<br>
					<br>
					We are interested in blockette type "310", specifically in the data fields  "calibration flags", "calibration duration" and "coupling".<br>
					<br>
					Blockette type "310" has the following structure:<br>
					<br>
					* Blockette type (integer, 2 bytes)<br>
					* Next blockette's byte number (integer, 2 bytes)<br>
					* Other fields (*, 11 bytes)<br>
					* Calibration flags (bitset, 1 byte), where:<br>
					- bit 2: calibration was automatic<br>
					- bit 4: peak-to-peak amplitude<br>
					- other<br>
					* Calibration duration (integer, 4 bytes)<br>
					* Other fields (*, 16 bytes)<br>
					* Calibration coupling (string, 12 bytes)<br>
					* Other fields<br>
					<br>
					Binary data in big endian format.<br>
					<br>
					Tasks:<br>
					------<br>
					Write a program in C++11, C++14 or Java, to read the file and print out in any order:<br>
					1) how many blockettes are in the file.<br>
					2) for every blockette type "310" found:<br>
					- calibration was automatic (example: true)<br>
					- peak-to-peak amplitude (example: true)<br>
					- calibration duration (example: 24000000)<br>
					- calibration coupling (example: resistive)</p>
			</div> <!-- class"well" -->


			<div class="row">
				<div class="col-xs-12 col-md-8 col-md-offset-2">
		<pre class="hljs <?=$r->language?>"><?=$r->value?></pre>
					</div>
			</div>


			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<pre class="hljs <?=$s->language?>"><?=$s->value?></pre>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<pre class="hljs <?=$t->language?>"><?=$t->value?></pre>
				</div>
			</div>

		</div>





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