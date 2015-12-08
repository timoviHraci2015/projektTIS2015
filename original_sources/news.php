
<div Id="content">
<H2>Novinky</H2>



<UL>
<P>
<LI><FONT Color="red"><B><A HREF="./Press/">Press kit</A></B></FONT>
<UL>
 <LI><A HREF="./Press/TlacovaSpravaIstrobot2012Vysledky.doc">Tlačová správa</A> (.doc, 40 kB)
 <LI><A HREF="./Press/">Fotografie</A>
</UL>


			<?php
				openMySQL($host, $user, $passwd, $db);	
				$sql_stats = mysql_query("SELECT stats FROM competition_year WHERE id_cyear = 1");
				$item = mysql_fetch_object($sql_stats);
				$stats = $item->stats;
				
				if ($stats == 1){
					echo "<P><LI><span style=\"color: red\"><b>Podrobné výsledky</b></span><br>";
					echo "Pozrite si kompletnú <a href=\"index.php?page=stats\">výsledkovú listinu</a> s časmi, bodmi a odkazmi...</LI><br>";
				}
			?>



<P>
<LI><FONT Color="red"><B>Fotografie</B></FONT>
<UL>
  <LI><A HREF="./Press/">Výber fotografií pre tlač</A> (robotika.sk)
  <LI><A HREF="https://www.facebook.com/media/set/?set=a.4659854370699.1073741828.1123607406&type=1&l=fe0b39df6a" Target="_blank">Fotografie Robotic Group of Trstená</A>  (facebook.com)
  <LI><A HREF="./fotoZJ">Fotky Zoltána Janíka</A> 
  <LI><A HREF="./fotoZJ2">Robotic Showroom</A>
  <P>
  <LI>pošlite a pribudnú aj ďalšie...
</UL>

<P>
<LI><FONT Color="red"><B>Videá</B></FONT>
<P>
<UL>
 <LI> <A HREF="http://www.youtube.com/results?search_query=istrobot+2013" target="_blank">Videá účastníkov na YouTube</A> (tag: Istrobot 2013)
<!--
 <P>
 <LI> Videostream <A HREF="./video/RECORD-[2012-04-21]_[10-32-33].mpg">part 1</A> (.mpg, 703 MB!, 640x360, 45 min od 10:30 do 11:15)
 <LI> Videostream <A HREF="./video/RECORD-[2012-04-21]_[11-32-02].mpg">part 2</A> (.mpg, 754 MB!, 640x360, 48 min od 11:30 do 12:18)
 <LI> Videostream <A HREF="./video/RECORD-[2012-04-21]_[14-00-35].mpg">part 3</A> (.mpg, 729 MB!, 640x360, 47 min od 14:00 do 14:47)
 <LI> Videostream <A HREF="./video/RECORD-[2012-04-21]_[14-51-19].mpg">part 4</A> (.mpg, 255 MB!, 640x360, 16 min od 14:51 do 15:10)
 <LI> Videostream <A HREF="./video/RECORD-[2012-04-21]_[15-11-36].mpg">part 5</A> (.mpg, 115 MB!, 640x360, 07 min od 15:11 do 15:18)
 <LI> Videostream <A HREF="./video/RECORD-[2012-04-21]_[15-19-20].mpg">part 6</A> (.mpg, 986 MB!, 640x360, 71 min od 15:19 do 16:30)
-->
</UL>

<P><BR>
<LI><B>Mediálna odozva</B>
<P>
<UL>
 <LI><A HREF="http://magazin.atlas.sk/techmag/video-do-bratislavy-mieria-roboti/811741.html" target="_blank">Do Bratislavy mieria roboty!</A> (TechMag, atlas.sk, 17. 4. 2013)
<!--
<P> Po akcii: <P>
 <LI> <A HREF="http://video.sita.sk/videoservis/istrobot-2012/27342-play.html">Istrobot 2012</A> (L. Krajčovič, videoservis SITA, 21. 4. 2012)
 <LI> <A HREF="http://www.stv.sk/online/archiv/spravy-stv">Správy STV</A> (nájdite si v archíve 21. 4. 2012, cca 33. min)
 <LI> <A HREF="http://tivi.azet.sk/video/1257764/preteky-robotov-v-bratislave-sily-si-zmerali-nase-i-zahranicne-vytvory.html">Preteky robotov v Bratislave: Sily si zmerali nae i zahraničné výtvory</A> (23. 4., 8:00, tivi.sk)
-->
</UL>





<P><BR>
<A NAME="results"></A>
<LI><FONT Color="red"><B>V Ý S L E D K Y</B></FONT><BR>
    <B>Stopár</B><BR>
     <OL>
      <LI>1. Robot <B>Lenčo</B> (<I>Andrej Lenčucha</I>) z FIIT STU   <IMG Alt="" Src="./images/Nula.gif">
      <LI>2. Robot <B>Nite 3</B> (<I>Lukáš Pariža</I>) z   <IMG Alt="" Src="./images/FEIt.gif">
      <LI>3. Robot <B>Rafo</B> (<I>Rafael Gajanec</I>) z   Trstenej  <IMG Alt="" Src="./images/Nula.gif">
    </OL>
    <P>
    <B>Myš v bludisku</B><BR>
     <OL>	
      <LI>1. Robot <B>Nite 3</B> (<I>Lukáš Pariža</I>) z   <IMG Alt="" Src="./images/FEIt.gif">
      <LI>2. Robot <B>roXor</B> (<I>Ján Hudec</I>) z   <IMG Alt="" Src="./images/FEIt.gif">
      <LI>3. Robot <B>Missile 3</B> (<I>Ján Hudec</I>) z   <IMG Alt="" Src="./images/FEIt.gif">
     </OL>
    <P>
    <B>V sklade kečupu</B><BR>
     <OL>
      <LI>1. Robot <B>VETERrobot</B> (<I>VeterRobot Team</I>) zo ZŠ Veternicová <IMG Src="./images/Lego.gif">
      <LI>1. Robot <B>Wamber</B> (<I>M. Moravčík, A. Koval, B. Vida, B. Cuc</I>) z Bratislavy <IMG Src="./images/Lego.gif">
      <LI>3. Robot <B>ARMtank</B> (<I>Jan Kučera </I>) z planety Robozor <IMG Src="./images/Cech.gif">
     </OL>
    <P>
    <B>Voľná jazda</B><BR>
     <OL>
      <LI>1. Robot <B>Mouse Pal</B>   (<I>Igor Zubrycki, Krzysztof Choja</I>) Łódź             <IMG Src="./images/Pols.gif">
      <LI>2. Robot <B>OmnIVOice</B>   (<I>Adam Gajda, Michał Maciejewski</I>) Łódź         <IMG Alt="" Src="./images/Pols.gif">
      <LI>3. Robot <B>Thunderbolt</B> (<I>Dawid Harazim, Paweł Sekuła</I>) z Rybnika  <IMG Alt="" Src="./images/Pols.gif">
     </OL>



<P>
<LI><FONT Color="red"><B>V4 Workshop</B></FONT><BR>
V prípade záujmu sa môžete zúčastniť aj robotického workshopu
pre účastníkov z krajín V4. V nedeľu je na programe reprezentácia
objektov a vybrané témy z umelej inteligencie. Začiatok 9:00, podrobný 
program <A HREF="https://docs.google.com/spreadsheet/ccc?key=0AhS3f3dCsrEvdDl2RjdVbEpEMDIzVHR6VkZaTTZNM0E#gid=0">na tomto odkaze</A>.


<P>
<LI><FONT Color="red"><B>20. 4. 2013 Istrobot on-line</B></FONT><BR>
Od 10:00 sledujte <B><A HREF="http://www.mc2.sk/" Target="_blank">ISTROBOT on-line: Prenos zabezpečuje televízia mc2.</A></B></FONT>
<BR>&nbsp;<BR>
<CENTER>
<A HREF="http://www.mc2.sk/" Target="_blank"><IMG Src="./images/IstrobotLiveSnapshot2011.png" Width=250 Height=152 Alt="Televízia mc2" Border=0></A>
</CENTER><BR>&nbsp;<BR>


<P>
<LI><FONT Color="red"><B>Diváci</B></FONT><BR>
Srdečne pozývame najširšiu verejnosť pozrieť sa
na súťažiacich robotov. Dopoludňajšia časť je voľnejšia, 
bez pevného harmonogramu, popoludní budeme priebeh súťaže
aj moderovať. Vstup je voľný. 


<P>
<LI><FONT Color="red"><B>&nbsp;&nbsp;&nbsp;&nbsp;  P R O G R A M  &nbsp;&nbsp;  20. 4. </B></FONT> 
<PRE>
09:00  Prezentácia, zapisovanie robotov na štart.	
09:30  Prvé kolá kategórie Stopár 
10:00  Kvalifikácia kategórie Myš v bludisku
10:00  Výstava robotov kategórie Voľná jazda.
11:00  Kvalifikácia kategórie Sklad kečupu

12:00  Obed. Prestávka.	

14:00  Slávnostné otvorenie súťaže.	

14:05  Kategória Stopár - finále.
14:30  Kategória Myš v bludisku. 	
15:00  Kategória Sklad kečupu
15:30  Kategória Voľná jazda.	

16:00  Slávnostné odovzdávanie cien.

18:00  Posedenie v pizzerii pre účastníkov.</PRE>

<P>
V prestávkach medzi jednotlivými kategóriami
ďalej uvidíte:
<P Align="center">
<A HREF="./images/Robot01L.jpg"><IMG Src="./images/Robot01.jpg" Width=250 Height=161 Alt="Mecano Robot" Border=0></A>
<A HREF="./images/Robot04L.jpg"><IMG Src="./images/Robot04.jpg" Width=250 Height=161 Alt="Freescale Cup Winner" Border=0></A>
<BR>
<A HREF="./images/Robot02L.jpg"><IMG Src="./images/Robot02.jpg" Width=250 Height=174 Alt="Hexapod design" Border=0></A>
<A HREF="./images/Robot03L.jpg"><IMG Src="./images/Robot03.jpg" Width=250 Height=174 Alt="3D Printer" Border=0></A>
<P>
<UL>
 <LI>   Víťazov <A HREF="https://community.freescale.com/groups/tfc-emea">Freescale Cup</A> regiónu EMEA naživo! (<I>Marek Lászlo, Norbert Gál, Róbert Nehánszki</I>)

 <LI>   Prezentáciu  <A HREF="http://malylubo.sk/feistu/robotics/robotics-design/">dizajnérskych úprav našich robotov</A> (FA STU)

 <LI>   Mobilný <A HREF="https://sweb.mtf.stuba.sk/monitoring/clanky/1341822540_Grafika1.pdf">Mecanum Robot</A> (<I>Filip Tóth, Pavol Krasňanský</I>)

 <LI>	Mobilný <a href="https://kar6server.kar.elf.stuba.sk/cgi-bin/twiki/view/OutdoorMobileRobot/WebHome">Robot MRVK-01</a>

 <LI>	Mobilný <a href="https://kar6server.kar.elf.stuba.sk/cgi-bin/twiki/view/IndoorMobileRobots/WebHome">Robot Black Metal</a>

 <LI>   Domácu 3D tlačiareň <A HREF="http://www.reprap.org/wiki/Prusa">RepRap Prúša Mendel Iteration 2</A> (<I><A HREF="http://andrejrobotika.blogspot.sk/">Andrej Paulíny</A></I>) 

 <LI>   Informáciu o <A HREF="http://www.fll.sk/">súťaži First Lego League</A>

</UL>

<P>
<LI><FONT Color="red"><B>Odborná porota</B></FONT> 
     <UL>
     <LI> prof. Ing. Peter Hubinský, PhD (URPI FEI STU) - predseda poroty
     <LI> RNDr. Andrej Lúčny, PhD. (Robotika.SK a MicroStep-MIS) - Stopár
     <LI> Ing. Juraj Slačka (FEI STU) - Myš v bludisku
     <LI> Ing. Martin Dekan  (URPI FEI STU) - Sklad kečupu
     <LI> Ing. Jozef Rodina  (URPI FEI STU) - Voľná jazda
     </UL>

<P>
<LI><FONT Color="red"><B>Ubytovanie</B></FONT><BR>
Rezerváciu ani žiaden iný ubytovací servis pre súťažiacich 
nezabezpečujeme.
Môžeme odporučiť <A HREF="http://www.ubytovanieszu.sk/">ubytovňu 
SZÚ na Kramároch</A>, ktorá má dostatočnú kapacitu (hlavne cez 
víkendy) a je aj ľahko dostupná MHD z miesta súťaže. <BR>





<P>
<LI><FONT Color="red"><B>Pizza&Kofola</B></FONT><BR>
Po skončení zápolenia pozývame súťažiacich na posedenie
pri kofole a pizze. <BR>
<A HREF="http://doodle.com/prpqw7xg92m7myr7">Objednajte si vopred...</A>

<P>
<LI><FONT Color="red"><B>Ako sa tam dostať?</B></FONT><BR>

<iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&amp;t=h&amp;hl=sk&amp;source=embed&amp;msa=0&amp;msid=108286794285868100190.000468213a6163e2e668b&amp;ll=48.152402,17.074041&amp;spn=0.008589,0.012875&amp;z=15&amp;output=embed"></iframe><br /><small>Zobraziť <a href="http://maps.google.com/maps/ms?ie=UTF8&amp;t=h&amp;hl=sk&amp;source=embed&amp;msa=0&amp;msid=108286794285868100190.000468213a6163e2e668b&amp;ll=48.152402,17.074041&amp;spn=0.008589,0.012875&amp;z=15" style="color:#0000FF;text-align:left">Istrobot 2013</a> na väčšej mape</small>
<P>
<A HREF="http://www.urpi.fei.stuba.sk/index.php?option=com_content&view=article&id=5&Itemid=29&lang=sk"> Tu je popis...</A>
<P>
Najbližšie zastávky MHD: Botanická záhrada (južne od školy, električky a autobusy), 
ZOO (severovýchodne od školy, autobusy). 



<P>
<LI><B>Strava</B><BR>
   V sobotu od cca 8:00 do 16:00 bude na škole otvorený bufet s ponukou
   studených jedál a nápojov. Okrem toho sú na chodbách
   automaty na kávu a nápoje. Súťažiaci budú mať zabezpečené aj nápoje
   (minerálka). 


<P>
<LI><B>Poster Evolution</B><BR>Pozrite si, ako vznikal plagát na tento ročník súťaže:
<P Align="center">
<A HREF="http://www.youtube.com/watch?v=vZFKrm4XfTw" target="_blank"><IMG Src="./images/PosterEvolutionYouTube.png" Width=320 Height=192 Alt="[Click to see video...]" Border=0></A>

<P>
<LI><FONT Color="red"><B>Testovanie</B></FONT> 
    <UL>
    <LI><FONT Color="green"><B>&nbsp;8. apríla</B></FONT>  
    <LI><FONT Color="green"><B>15. apríla</B></FONT>  
    </UL>

<P>
Testovací deň sa uskutoční len v prípade záujmu v horeuvedených 
termínoch od 15:00 do cca 18:00 (podľa záujmu aj dlhšie) na 
Fakulte elektrotechniky a informatiky STU (Bratislava, Mlynská 
dolina)  blok D, 7. poschodie. 
<BR>
Bude k dispozícii bludisko, čiara na stopára a sklad kečupov.
Ak aj nemáte čo testovať, môžete si prísť vyjasniť nejasnosti 
v pravidlách, pozrieť konkurenciu.
<BR>
Ak chcete prísť, napíšte nám (<A HREF="mailto:balogh@elf.stuba.sk">balogh@elf.stuba.sk</A>).



<LI> O aké ceny súťažíte? Už teraz sa môžete tešiť na</P>
<P Align="center">
<A HREF="http://www.freescale.com/webapp/sps/site/prod_summary.jsp?code=FRDM-KL05Z" Target="_blank">
<IMG Src="./images/FreedomBoard.jpg" Alt="[Freedom board Kit]" Border=0 Width=365 Height=255></BR>
<FONT Size=1> Freedom Development Platform for the Kinetis</FONT></A>
</P>

<P> Pre víťazov jednotlivých kategórií máme pripravené bezdrôtové vývojové kity  </P>
<P Align="center">
<A HREF="http://www.iqrf.org/weben/index.php?sekce=products&id=ds-start-03e&ot=development-tools&ot2=development-sets" Target="_blank">
<IMG Src="./images/IQRF-kit.png" Alt="[IQRF Kit]" Border=0 Width=444 Height=360></BR>
<FONT Size=1>IQRF Development set</FONT></A>
</P>
<P> Ďalšia cena čaká na všetkých úspešných konštruktérov v kategórii Sklad kečupu  </P>

			<P Align="center">
				<A HREF="http://www.freescale.com/webapp/sps/site/prod_summary.jsp?code=USBSPYDER08&fpsp=1&tab=Documentation_Tab" Target="_blank"><IMG Src="./images/SpyderKit.jpg" Alt="[Spyder Kit]" Border=0 Width=444 Height=360></BR>
				<FONT Size=1>Freescale Spyder vývojový kit.</FONT> </A>
			</P>
			<LI>
				<span class="highlight_text"><B>Spustené prihlasovanie</B></span> <span class="date_text">(15. 9. 2012)</span></br>
				Istrobot 2013 sa uskutoční na FEI STU v Bratislave <B>20. 4. 2013</B>.
				Uzávierka prihlášok je <S><B>1. apríla 2013</B></S> <B>7. apríla 2013</B>. Nezabudnite vyplniť prihlášku včas!
			</LI>

		</UL>


		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/sk_SK/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<P Align="center">
			<UL>
			<div class="fb-comments" data-href="http://robotika.sk/contest/2013/index.php" data-num-posts="4" data-width="470"></div>
			</BR></BR></BR>
			</UL>
		</P>

		<P>
			<A NAME="pravidla"></A>
			<H2>Kategórie</H2>
			<P>
				<A HREF="index.php?page=rules&type=follower"><IMG Src="images/stopar.jpg" Width=150 Height=105 Align="right" Alt="Stopar" Border=0></A>
				<H3><A href="index.php?page=rules&type=follower">Stopár</A></H3>
				Robot - stopár má čo najrýchlejšie prejsť zadanú dráhu a zdolať všetky jej nástrahy.
				Na dráhe sú umiestnené rozličné prekážky, napríklad tunel, prerušenie čiary alebo tehlička, ktorú treba obísť.</BR>
				<A href="index.php?page=rules&type=follower">Podrobnosti...</A>
				</BR></BR>
			</P>

			<P>
				<A HREF="index.php?page=rules&type=umouse"><IMG Src="images/umouse.jpg" Width=150 Height=105 Align="right" Alt="Micromouse" Border=0></A>
				<H3><A HREF="index.php?page=rules&type=umouse">Myš v bludisku</A></H3>
				Autonómny robot - myš má čo najrýchlejšie nájsť cestu bludiskom. 
				Pri hľadaní cesty bludiskom sa dá použiť pravidlo pravej, resp. ľavej ruky, ale takáto cesta nebude najkratšia.</BR>
				<A href="index.php?page=rules&type=umouse">Podrobnosti...</A>
				</BR></BR>
			</P>

			<P>
				<A HREF="index.php?page=rules&type=ketchup"><IMG Src="images/ketchup.jpg" Width=150 Height=105 Align="right" Alt="Ketchup" Border=0></A>
				<H3><A href="index.php?page=rules&type=ketchup">V sklade kečupu</A></H3>
				V tejto kategórii je úlohou zostrojiť robota, ktorý dokáže správne usporiadať konzervy s paradajkovým pretlakom v sklade. Súťaží vždy dvojica robotov, 
				vyhráva ten, ktorý rýchlejšie a dokonalejšie splní úlohu.  </BR>
				<A href="index.php?page=rules&type=ketchup">Podrobnosti...</A>
				</BR></BR>
			</P>

			<P>
				<A href="index.php?page=rules&type=freestyle"><IMG Src="images/freestyle.jpg" Width=150 Height=105 Align="right" Alt="Volna jazda" Border=0></A>
				<H3><A href="index.php?page=rules&type=freestyle">Voľná jazda</A></H3>
				Táto kategória je určená na predvádzanie výrobkov, ktoré nespadajú do prvých troch kategórií. 
				Každý súťažiaci môže predviesť všetko, čo jeho robot dokáže. O víťazovi rozhodne porota na základe prezentácie robota</BR>
				<A href="index.php?page=rules&type=freestyle">Podrobnosti...</A>
				</BR></BR></BR>
			</P>
			
			<P>
				<H3><A href="index.php?page=rules&type=common">Spoločné pravidlá</A></H3>
				Okrem toho platia pre všetky kategórie spoločné pravidlá týkajúce sa hlavne bezpečnosti a použitých materiálov. </BR>

				<A href="index.php?page=rules&type=common">Podrobnosti...</A>
				</BR></BR></BR>
			</P>
		
		</P>
		
		<P>
			<A NAME="prihlaska"></A>
			<H2>Prihláška</H2>
			Uzávierka prihlášok je <S>1. apríla</S> <B>7. apríla 2013</B>. Pred vyplnením si prečítajte aj organizačné pokyny. </br>

			Vyplniť <A HREF="index.php?page=logme">prihlášku...</A>
		</P>	
		<P>
			<A NAME="reklama"></A>
			<H2>Propagácia</H2>
			<span class="highlight_text"><B>Press</B></span></br>
			Stiahnite si <A HREF="http://www.robotika.sk/contest/2012/Press/">fotky z minulého ročníka.</A></br><br/>
			<span class="highlight_text"><B>Download</B></span></BR>
			<P Align="center">
				<A HREF="PosterIstrobot2013.pdf"><IMG Src="images/PosterNahlad.png" Width=376 Height=532 Alt="[ ISTROBOT 2013 ]" Border=0></A></BR>
				<A HREF="PosterIstrobot2013.pdf">Plagát k súťaži [.pdf, 2,5 MB]</A>
			<P Align="center">
				<A HREF="LetakIstrobot2013.pdf"><IMG Src="images/LetacikNahlad.png" Width=376 Height=473 Alt="[ ISTROBOT 2013 ]" Border=0></A></BR>
				<A HREF="LetakIstrobot2013.pdf">Letáčik k súťaži [.pdf, 1,5 MB]</A>
			</P>		
		</P>
	</div>