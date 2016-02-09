<?php
	require_once("modules/CompetitionsResults.php");
?>

<div Id="content">
	<ul class="results_list">
		<li><a href="index.php?page=results&year=2014">2014</a></li>
		<li><a href="index.php?page=results&year=2013">2013</a></li>
		<li><a href="index.php?page=results&year=2012">2012</a></li>
	</ul>

<?php
	openMySQL($host, $user, $passwd, $db);

	$competitionViewer = new CompetitionsResults();
	$competitions = $competitionViewer->getAllInThisYear();

	if(count($competitions) > 0) {
		foreach($competitions as $competition) {
			$competitionViewer->generateViewForCompetition($competition);
		}
	} else {
		echo "<p>Nepodarilo sa nacitat vysledky pre dany rok</p>";
	}

	
?>

</div>