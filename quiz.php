<?php
session_start();
include("include/util.php");
$num = glob(quizdbpath() . "*");
shuffle($num);
?>
<html>
<head>
	<title>QuizzMe  --  Quiz</title>
	<meta charset="utf-8" />
	<link href="css/main.css" type="text/css" rel="stylesheet" />
	<link href="css/form.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="js/quiz.js"></script>
	<script type="text/javascript" src="js/simpleajax.js"></script>
</head>

<body>
	
	<div id="top_banner">
		<form method="post" action="sign_in_form.php">
			<div>
				<span class="left">
					<span id="logo">Quiz</span>
					<?php  
					if(isset($_SESSION["login"]))
						print "for " . get_name($_SESSION["login"]);
					?>
				</span>
			</div>
		</form>
	</div>
	<div class="form_style" id="0">
		<?php  
		if(isset($_SESSION["login"])){?>
		<form class="form_style" action="my.php">
		<?php }
		else {?>
		<form class="form_style" action="home.php">
		<?php }?>
			<div>Ready for your quiz?</div>
			<div class="submit">
				<input id="start" class="button" type="submit" value="Start Now!" />
				<input id="quit" class="button" type="submit" value="Quit!" />
			</div>
		</form>
	</div>
	<?php
	for($i=1; $i<=10; $i++){
		$quiz = file($num[$i-1], FILE_IGNORE_NEW_LINES);
		?>
		<div class="form_style" id="<?= $i?>">
			<form class="form_style">
				<div>Quiz #<?= $i?></div>
				<div class="countdown"></div>
				<div><?= quiz_content($quiz);?></div>
				<div>Difficulty: <?= quiz_difficulty($quiz);?> /10</div>
				<div>Domain: <?= quiz_domain($quiz);?></div>
				<input type="hidden" name="id" value="<?= $num[$i-1]?>"/>
				<label><input type="checkbox" name="choice" value="A" /><?= quiz_choicesA($quiz);?></label><br />
				<label><input type="checkbox" name="choice" value="B" /><?= quiz_choicesB($quiz);?></label><br />
				<label><input type="checkbox" name="choice" value="C" /><?= quiz_choicesC($quiz);?></label><br />
				<label><input type="checkbox" name="choice" value="D" /><?= quiz_choicesD($quiz);?></label><br />

				<div class="submit">
					<input class="button checkAnswer" type="submit" value="Submit" />
				</div>
			</form>
		</div>
		<?php
	}
	?>
	<div class="form_style" id="result">
		<form class="form_style">
			<div>Result</div>
			<div id="score"></div>
			<div class="submit">
				<input id="quiz" class="button" type="submit" value="Start Another Quiz" />
				<?php  
				if(isset($_SESSION["login"])){?>
				<input id="myHome" class="button" type="submit" value="Back To My Home" />
				<?php }
				else {?>
				<input id="main" class="button" type="submit" value="Back To Home" />
				<?php }?>
			</div>
		</form>
	</div>
	<div class="buttons">
		<button name="1" disabled="disabled">1</button>
		<button name="2" disabled="disabled">2</button>
		<button name="3" disabled="disabled">3</button>
		<button name="4" disabled="disabled">4</button>
		<button name="5" disabled="disabled">5</button>
		<button name="6" disabled="disabled">6</button>
		<button name="7" disabled="disabled">7</button>
		<button name="8" disabled="disabled">8</button>
		<button name="9" disabled="disabled">9</button>
		<button name="10" disabled="disabled">10</button>
	</div>
</body>
</html>
