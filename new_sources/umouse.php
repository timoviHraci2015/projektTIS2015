
<DIV Id="content">

	<IMG SRC="./images/umouse.gif" Align="right" Width=300 Height=192 Alt="">
	<H2>Pravidlá kategórie </br> </br> Myš v bludisku</H2>
	</br>
	<H3>Súťažná úloha</H3>

	<P>
		Navrhnúť a zostrojiť mikropočítačom riadeného autonómneho mobilného robota (myš), 
		ktorý dokáže prejsť zadaným bludiskom do cieľa v čo najkratšom čase. 
	</P>

	<H3>Bludisko</H3>

	<P>
		Bludisko pozostáva zo siete (max. 16 × 16) základných štvorcov s rozmermi 18 × 18 cm. 
		Steny bludiska sú 5 cm vysoké a 1,2 cm hrubé (+/-5%). 
		Chodbičky sú teda široké 16,8 cm. Vonkajšia stena uzatvára celé bludisko. 
	</P>

	<P>
		Steny bludiska sú zboku biele, horná strana steny je červená. Podlaha bludiska bude z dreva alebo podobného materiálu, 
		natretá čiernou matnou farbou. Povrch hornej a bočných stien bludiska by mal odrážať infračervené svetlo a povrch podlahy by ho mal pohlcovať. 
	</P>
	
	<P>
		Štart bludiska bude v jednom zo štyroch rohov. V strede bludiska je otvorená časť, tvorená štyrmi jednotkovými štvorčekmi. 
		Tento centrálny štvorec je cieľom. Vchod do tohto štvorca je len jeden. Je možné, že do cieľa povedie viac ako jedna cesta 
		a treba s tým počítať (viď. <A Name="priklady"></A><A HREF="index.php?page=rules&type=example">príklady</A>).
	</P>
	
	<P>
		Rohy jednotkového štvorčeka tvoria tzv. mrežové body. Bludisko bude vytvorené tak, že s výnimkou cieľa bude z každého mrežového
		bodu vychádzať aspoň jedna stena. 
	</P>
	
	<P>
		V bludisku sa dá použiť pravidlo pravej (alebo ľavej) ruky. Oba smery nemusia byť (a zrejme ani nebudú) rovnocenné. Určite to však nebude najkratšia cesta do cieľa. 
		Zámerom tohoto zjednodušenia je umožniť účasť aj začiatočníkom, ktorí obvykle potrebujú sústrediť pozornosť viac na konštrukciu robota ako na algoritmus.
	</P>
	
	<P>
		Celkové rozmery bludiska budú dodržané s presnosťou 5% alebo 2 cm (menšia z oboch hodnôt). Spoje na podlahe by nemali vytvárať schodíky vyššie než 1 mm. 
		Zmeny sklonu by nemali byť väčšie ako 4 stupne. Medzery medzi súvisiacimi stenami by nemali byť väčšie ako 2 mm. 
	</P>
	
	<P>
		Na súťaži bude pravdepodobne použité len bludisko v sieti 9 x 9 základných štvorcov, štart bude v ľavom spodnom rohu, cieľ v pravých horných štyroch štvorcoch. 
		Použitie väčšieho bludiska však nie je vylúčené. 
	</P>



	<H3>Robot - myš</H3>

	<p>
		Myš musí byť autonómna. Nesmie používať zdroj energie využívajúci spaľovací proces. 
	</p>
	
	<p>
		Dĺžka a šírka myši nesmie prekročiť 25 cm. Ak myš mení počas činnosti svoje rozmery, v žiadnom okamihu nesmie prekročiť 25×25 cm. 
		Výška nie je obmedzená. Uvedomte si aj rozmery bludiska a miesto potrebné na otáčanie. 
	</p>
	
	<p>
		Myš nesmie počas cesty bludiskom nikde nič odložiť ani stratiť.
	</p>
	
	<p>
		Myš nesmie skákať, prekračovať alebo loziť po stenách, ryť alebo kresliť, poškodiť alebo zničiť bludisko (prosím, žiadne buldozéry!). 
	</p>

	<H3>Činnosť robota</H3>

	<p>
		Základnou úlohou je prejsť zo štartovacieho štvorčeka do cieľového. Takúto cestu nazveme 'pokus' a čas, ktorý zaberie, nazveme 'čas pokusu'. Cesta späť z 
		cieľového štvorca do štartovacieho sa nepovažuje za pokus. Meria sa aj celkový čas strávený v bludisku, ktorý je pre každého súťažiaceho obmedzený na 5 minút. 
	</p>
	
	<p>
		Ak bude myš počas jazdy bludiskom vyžadovať zásah súťažiaceho, bude považovaná za 'dotknutú' a jej čas pokusu bude potrestaný troma sekundami naviac.
	</p>
	
	<P>
		Hodnotí sa najkratší čas pokusu zo všetkých, ktoré daná myš dosiahne. 
	</P>
	
	<p>
		Keď myš dosiahne stred bludiska (cieľ), môže ju súťažiaci zdvihnúť a reštartovať, alebo sa môže samostatne vrátiť na štart. Zdvihnutie je samozrejme považované za dotyk a súťažiaci 
		dostane trojsekundovú pokutu (platnú aj pre všetky ďalšie pokusy). Po dosiahnutí cieľa môže myš samostatne pokračovať v skúmaní bludiska a hľadať optimálnu trasu. 
	</p>
	
	<p>
		úťažiaci nesmie mať pri aktivácii myši možnosť voliť ani ovplyvniť stratégiu. 
		Po odkrytí bludiska ani pri reštarte súťažiaci nesmie vložiť myši žiadnu informáciu. 
	</p>
	
	<p>
		Čas pokusu bude meraný od okamihu, keď myš opustí štartovací štvorček, po okamih, keď vojde do cieľového štvorca. 
		Celkový čas v bludisku bude meraný od okamihu aktivovania myši. 
		Myš sa nemusí začať hneď po aktivácii pohybovať, ale musí byť položená do štarovacieho štvorca pripravená na pokus. 
		Ak sa myš vráti na štart bez dosiahnutia cieľa, tento pokus sa zastaví a po opätovnom štarte začne meranie ďalšieho pokusu. 
	</p>
	
	<p>
		Čas potrebný na prieskum bludiska bude meraný buď ručne organizátorom, alebo infračervenými senzormi na štarte a v cieli. 
		Infračervený lúč bude vodorovný, na hranici medzi prvým a druhým štvorčekom a pri vchode do cieľového štvorca cca 10 mm nad podlahou. 
	</p>
	
	<p>
		Ak myš prestane správne fungovať, môže súťažiaci požiadať porotu o možnosť zrušiť pokus a reštarovať myš 
		(nie však v prípade, že spravila iba nesprávny obrat, alebo sa vydala nesprávnou cestou). 
		Myš je samozrejme považovaná za 'dotknutú' a dostane trojsekundovú pokutu (platnú pre všetky ďalšie pokusy). 
	</p>
	
	<p>
		Ak súťažiaci počas súťaže vymení ľubovoľnú časť myši (batéria, EPROM,...) 
		alebo ak urobí inú podstatnú úpravu, musí vymazať všetky informácie o bludisku, ktoré dovtedy myš nazbierala. 
		Malé úpravy (nastavenie citlivosti snímačov) sú povolené pod dohľadom poroty. Úpravy rýchlosti alebo stratégie sú bez vymazania informácie o bludisku zakázané. 
	</p>
	
	<p>
		Žiadna časť myši (okrem batérií) nesmie byť prenesená na inú myš. 
		Napríklad, ak použijete jedno šasi a dva rôzne riadiace obvody, potom sa považujú oba za jednu myš a nesmú prekročiť 5 minútový čas bludiska. 
		Pred výmenou riadiacej jednotky samozrejme treba vymazať pamäť. 
		Myš nemôže byť počas súťaže odľahčovaná, napr. odstránením nepotrebných senzorov po preskúmaní bludiska. 
	</p>
	
	<p>
		Medzi dokončeným pokusom a štartom ďalšieho pokusu musí myš ostať aspoň 1 sekundu na štartovacom poli. 
		Počas tejto sekundy nesmie zakrývať infrasenzor časomiery. 

	<H3>Poradie účastníkov</H3>

	<p>
		Poradie bude stanovené tesne pred súťažou. Účastníci musia absolvovať predpísanú dráhu v stanovenom poradí. 
		Ak sa súťažiaci nedostaví do 1 minúty po výzve na štart, stráca právo absolvovať súťaž. 
		V prípade, že sa prihlási veľa súťažiacich, porota môže vyhlásiť kvalifikačný turnaj. 
	</p>

	<H3>Časové limity</H3>

	<p>
		Každá súťažiaca myš môže stráviť v bludisku najviac 5 minút, počas nich môže absolvovať najviac 10 pokusov. 
	</p>

	<H3>Hodnotenie a ceny</H3>

	<p>
		Víťazom sa stane robot s najnižším dosiahnutým súťažným časom. 
		Ak počas súťaže nedosiahne stred bludiska žiadna myš, 
		porota určí víťaza na základe celkovej úspešnosti - napr. ako blízko k cieľu sa podarilo dostať, či bol pohyb po bludisku koordinovaný, alebo len náhodný, a pod. 
	</p>

	<P>
		Okrem toho môže porota udeliť ďalšie ceny podľa vlastého uváženia - napr. za najobjavnejšiu konštrukciu, najelegantnejšiu konštrukciu a pod. 
	</P>

	</br>
	
	<font size="-2">
		Tieto propozície sú vypracované na základe pravidiel súťaží "IEE Micromouse Contest", ktoré prebiehajú po celom svete.
	</font>
	</br>
	</br>
	<FONT Size="+1">
		A samozrejme platia tiež všetky 
		<A HREF="index.php?page=rules&type=common">spoločné pravidlá</A>.
	</FONT>
	</br></br>
</DIV>

