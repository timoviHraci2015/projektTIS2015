<?php
	//NEW USER CONFIRM
		if (isset($_POST['ok']) && !isset($_POST['logged']) && empty($_SESSION['a_id'])) {	
			
			//echo "robot_id:".$_SESSION['robot_id'];
			foreach($_SESSION['categ_list'] as $categ) {
				mysql_query("UPDATE category_tag SET year = '".$_SESSION['year']."', reg_date = '".date("Y-m-d H:i:s")."' WHERE id_robot = '".$_SESSION['robot_id']."'  AND year = 0");
			}				
			
			@sendmailAdmin($_SESSION['author_id']);		
			
			//nulovanie premennych z prihlas.php*
			$_SESSION['categ_list'] = "";
			$_SESSION['author'] = "";
			$_SESSION['author_id'] =  "";
			$_SESSION['robot_id'] = "";
			$_SESSION['categ_list'] = "";
			$_SESSION['subnames'] = "";
			
			redir("index.php?page=notice&action=new");
	//EXIST USER CONFIRM	
		} elseif (isset($_POST['ok']) && !empty($_SESSION['a_id'] )) {
			//echo "LOGGED".$_POST['a_id'];
			
			$sql4 = mysql_query("SELECT id_robot FROM robot WHERE id_author = '".$_POST['a_id']."' AND `show` = 1");	
			while ($robot = mysql_fetch_object($sql4)) {
				//echo "robot: ".$robot->id_robot;
				mysql_query("UPDATE category_tag SET year = '".$_SESSION['year']."', reg_date = '".date("Y-m-d H:i:s")."' WHERE id_robot = '".$robot->id_robot."' AND (`year` = 0 OR `year` = '".$_SESSION['year']."')" );
			}

			@sendmailAdmin($_SESSION['a_id']);
			
			//nulovanie premennych z prihlas.php*
			$_SESSION['category'] = "";
			//$_SESSION['robot'] = "";
			$_SESSION['author'] = "";
			$_SESSION['a_id'] =  "";
			$_SESSION['r_id'] = "";
			$_SESSION['categ_list'] = "";
			$_SESSION['subnames'] = "";
			
			redir("index.php?page=notice&action=exist");
		}
?>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
	<script type="text/javascript">
		 
		$(document).ready(function(){
		 
				$(".slidingDiv").hide();
				$(".show_hide").show();
		 
			$('.show_hide').click(function(){
			$(".slidingDiv").slideToggle();
			});
		 
		});
 
	</script>
	<div Id="content">
		<div style="text-align: center;">
				<i>&nbsp1. Participant registration ----> 2. Robot/robotos registration ----> </i><b>3. Confirmation, end</b>
				<br/><br/>
			</div>
		<h3>You have successfully registered robot/robots to the competition Istrobot <?php echo $_SESSION['year'];?></h3>
		<?php
			//exist user confirm
			if (!empty($_SESSION['a_id'])){
				//echo "EXIST USER rulez, ID->: ".$_SESSION['a_id'];
				$a_id = $_SESSION['a_id'];
				$wim = 1;
			} else {
			//new user confirm
				//echo "NEW USER rulez, ID->:".$_SESSION['author_id'];
				//pomocna pre rozlisenie upravy udajov robota od pridavanim noveho robota
				$a_id = $_SESSION['author_id'];
				$wim = 0;
			}
			
			$i=1;
			$sql = mysql_query("SELECT id_category, name FROM category");
			while ($category = mysql_fetch_object($sql)) {
				$cat_name[$i] = $category->name;
				$cat_id[$i] = $category->id_category;
				$i++;
			}
		// $i-poc kategorii, $j-premenna pre kazdu kategoriu, $k-premenna pre kazdeho robota danej kategorie	
			for ($j=1; $j<$i; $j++){
				// VYPIS ROBOTOV ID CATEGORY = $cat_id[$j]
				$sql = mysql_query("SELECT author.name_surname, author.state, author.town, robot.name, robot.subauthor FROM author INNER JOIN robot ON author.id_author = robot.id_author JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = '".$cat_id[$j]."' AND robot.show = 1 AND author.id_author ='".$a_id."'") or die(mysql_error());
				$k=1;
				if (mysql_num_rows($sql) != 0){					
					echo "<h3>".$cat_name[$j].":</h3>";
					while ($data = mysql_fetch_object($sql)) {
						if ($data->state == "SR"){
							if ($data->subauthor == ""){
								echo "&nbsp &nbsp &nbsp".$k.". Robot <b>".$data->name."</b> (".$data->name_surname.", ".$data->town.")<br/>";
							} else {
								echo "&nbsp &nbsp &nbsp".$k.". Robot <b>".$data->name."</b> (".$data->name_surname.", ".$data->subauthor.", ".$data->town.")<br/>";
							}							
						} else {
							if ($data->subauthor == ""){
								echo "&nbsp &nbsp &nbsp".$k.". Robot <b>".$data->name."</b> (".$data->name_surname.", ".$data->state.")<br/>";
							} else {
								echo "&nbsp &nbsp &nbsp".$k.". Robot <b>".$data->name."</b> (".$data->name_surname.", ".$data->subauthor.", ".$data->state.")<br/>";
							}
						}
						$k++;
					}	
				}
			}	
		if ($wim == 1){
			echo "<div style=\"text-align: right;\">";
			echo "<form name=\"myform\" action=\"index.php?page=lor\" method = \"POST\">";
			echo "<input type=\"Submit\" name = \"edit\" value=\"Edit\">";
			echo "</form>";
			echo "</div>";
		} elseif ($wim == 0)  {
			echo "<div style=\"text-align: right;\">";
			echo "<form name=\"myform\" action=\"index.php?page=login2&renew\" method = \"POST\">";
			echo "<input type=\"Submit\" name = \"edit\" value=\"Edit\">";
			echo "</form>";
			echo "</div>";
		}		
		?>
		<br/>
		<br/>
		<table style="border: 1px solid red;">
			<tr id="state"><td><b>I am familiar with <a href="#rules" class="show_hide">Competition rules</a> and sign the robot (robots) to competition Istrobot <?php echo $_SESSION['year'];?>.</b></td></tr>
			<tr><td style="text-align:right;">
				<form name="myform" method = "POST">
						<input type="hidden" Name="a_id" Size="30" value="<?php echo $a_id; ?>">
						<input type="Submit" name = "ok" value="OK">
				</form>
			</td></tr>
		</table>
		<div id="rules" class="slidingDiv"> 
			<H2>Spoločné pravidlá pre všetky kategórie</H2>
			<h3>Bezpečnosť</H3>
			<i>Tri zákony robotiky:</i>
			<OL type="1">
			 <LI> <b>Robot nesmie ublížit cloveku</b> alebo svojou necinnostou
				  dopustit, aby bolo cloveku ublížené.

			 <LI> <b>Robot musí poslúchnut príkaz cloveka</b>, s&nbsp;výnimkou
					 prípadov, ked je taký príkaz v&nbsp;rozpore s&nbsp;prvým
					 zákonom.

			 <LI> <b>Robot musí chránit sám seba pred znicením</b>,
						  s&nbsp;výnimkou prípadov, ked je to v&nbsp;rozpore s&nbsp;prvým
						  a druhým zákonom.
			</OL>

			<span Align="right">
			Isaac Asimov: The Complete Robot, Nightfall Inc., 1982.</span>

			V prípade, že zariadenie nebude splnat základné bezpecnostné
			predpisy, porota ho <B>nesmie</B> pripustit k&nbsp;sútaži a nesmie dovolit
			jeho prevádzkovanie.

			Každý robot, ktorý by mohol ohrozit úcastníkov, divákov, alebo
			zariadenie, bude vypnutý.
			
			<br/>
			<H3>Konštrukcia a materiály</H3>

			Na konštrukciu robota sa nekladú žiadne obmedzenia. Jedinou 
			požiadavkou je to, aby robot bol výrobkom sútažiaceho (sútažiacich). 
			To nevylucuje komercné stavebnice (LEGO, Fischertechnik), iba
			hotové výrobky s programom od výrobcu.

			<H3>Elektronika a senzorika</H3>

			Žiadna cast robota nesmie pracovat s&nbsp;väcším napätím ako je 24&nbsp;V.
			Celková spotreba by nemala byt viac ako 20&nbsp;A. Výnimky z&nbsp;tohto
			pravidla schvaluje porota. Všetky riadiace obvody musia byt
			súcastou robota, nie je možné riadit jeho pohyb napríklad
			z&nbsp;externého PC pripojeného ci už káblom, alebo bezdrôtovo.

			Na použité elektronické súciastky a napájacie zdroje nie je 
			kladené žiadne obmedzenie.


			Rovnako nie sú kladené žiadne obmedzenia na typ, pocet a rozmery
			použitých snímacov, ak neporušujú iné pravidlá.

			Sútažiaci nesmú použit na zlepšenie navigácie robota žiadne pomôcky,
			ktoré nie sú pevnou súcastou robota (nálepky, znacky, zrkadielka,...).

			<H3>Porota</H3>

			Nad priebehom sútaže a dodržiavaním pravidiel bdie porota.

			Porota je najmenej trojclenná, skladá sa zo zástupcov fakulty,
			študentov, odborníkov a sponzorov.

			Výroky poroty sú záväzné vo všetkých sporných bodoch i v&nbsp;otázkach
			výkladu pravidiel.

			<H3>Diskvalifikácia</H3>

			Vo všeobecnosti platí, že pri každom porušení pravidiel je robot
			zo sútaže vylúcený. To platí najmä v týchto situáciach:

			<UL>
				 <LI> nebezpecné správanie, ohrozenie bezpecnosti,
				 <LI> poškodenie dráhy,
				 <LI> ak sa robot pocas jazdy rozpadne.
			</UL>

			Úcastníkom sa zakazuje používat akékolvek zariadenie, ktorých cielom je
			rušenie iných robotov (svetelný blesk, rádiový, ultrazvukový, alebo  
			infracervený rušic). V prípade, že sa preukáže zámerné použitie takéhoto 
			zariadenia sútažiacim, bude okamžite zo sútaže diskvalifikovaný. 

			<H3>Klimatické podmienky</H3>

			Sútaž bude prebiehat v bežných klimatických podmienkach
			(T = 270 - 310&nbsp;K, <I>p</I> = 90 - 120&nbsp;kPa, 0 - 90% RH).

			Skutocnú úroven osvetlenia scény nie je možné vopred urcit.
			Pred sútažou bude vyhradený cas, ktorý môžu sútažiaci
			využit na optimálne nastavenie citlivosti snímacov.
			Organizátor nemôže zarucit, že diváci nebudú vrhat tiene.

			<B>Upozornenie:</B><br/>
			Konštruktéri si musia uvedomit, že moderné filmové a fotografické
			prístroje používajú zábleskové zariadenia a infracervené
			vysielace na zaostrovanie. Pretože priebeh sútaže bude
			zaznamenávaný, pri konštrukcii treba pocítat aj s takýmito
			poruchovými signálmi.

			<H3>Dokumentácia</H3>

			Každý sútažiaci musí pred sútažou poskytnút strucnú dokumetáciu 
			popisujúcu elektroniku, koštrukciu a riadiaci algoritmus. 
			Minimum informácii predpisuje formulár, ktorý treba vyplnit vopred, 
			pri registrácii cez internet. Bez vyplnených údajov nemusí porota 
			sútažiaceho pripustit k sútaži.
			<br/>		
			<a href="#state" class="show_hide">Hide</a>
		</div>
	</div>