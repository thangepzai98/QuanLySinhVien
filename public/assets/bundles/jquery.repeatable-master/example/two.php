<?php

require_once("Repopulator.php");

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dynamic Form Groups</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/styles.css" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="../jquery.repeatable.js"></script>

    </head>
    <body>

    	<div class="container">

    		<div class="page-header">
		    	<h1>Two repeatable</h1>
		    </div>

			<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

				<fieldset class="todos">

					<legend>To Do List</legend>

					<div class="repeatable"><?php Repopulator::repopulate("todos", $_POST); ?></div>
					
					<div class="form-group">
						<input type="button" value="Add Todo Item" class="btn btn-default add" />
					</div>

				</fieldset>

				<fieldset class="people">

					<legend>People</legend>

					<div class="repeatable"><?php Repopulator::repopulate("people", $_POST); ?></div>
					
					<div class="form-group">
						<input type="button" value="Add Person" class="btn btn-default add" />
					</div>

				</fieldset>
				
				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-primary" />
				</div>

			</form>

		</div>

		<script type="text/template" id="todos">
		<?php echo Repopulator::$templates["todos"]; ?>
		</script>

		<script type="text/template" id="people">
		<?php echo Repopulator::$templates["people"]; ?>
		</script>

		<script>
		$(function() {
			$(".todos .repeatable").repeatable({
				addTrigger: ".todos .add",
				deleteTrigger: ".todos .add",
				template: "#todos",
				startWith: 1,
				max: 5
			});

			$(".people .repeatable").repeatable({
				addTrigger: ".people .add",
				deleteTrigger: ".people .add",
				template: "#people",
				startWith: 1,
				max: 3
			});
		});
		</script>

    </body>
</html>