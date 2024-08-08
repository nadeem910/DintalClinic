	<?php require_once "includes/header.php"; ?>
		<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	</head>
	
	<body>
		<div class="wrapper">
			<div class="row upper">
				<div class="col-md-3" style="margin-bottom:7px">
					<a href="https://www.facebook.com/hamdan.yosif"><img src="images/social.png"></a>
					<a href="tel:0525289363">0525289363 <span class="glyphicon glyphicon-phone"></span></a>
				</div>
			
				<div class="col-md-offset-2 col-md-7">
					<img src="images/logo.png">
					
					<h1 class="mainTitle">מרכז טיפול השן</h1>
				</div>
			</div>
			
			<div class="row welcome">
				<p>ברוכים הבאים למרכז טיפול השן בהנהלת ד''ר יוסף חמדאן  </p>
			</div>
			
<div class="row img_row">			
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height:358px;overflow-y:hidden">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="images/img77.jpg" alt="מרכז טיפול השן">
				<div class="carousel-caption">
			</div>
				</div>
			<div class="item">
				<img src="images/img7.png" alt="מרכז טיפול השן">
				<div class="carousel-caption">
				</div>
			</div>
			
			<div class="item">
				<img src="images/img12.png" alt="מרכז טיפול השן">
				<div class="carousel-caption">
				</div>
			</div>
			
		</div>

            <!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
				
</div>
			
			<div class="row">
				<div class="col-md-offset-7 col-md-5 subtitle_row">
					<p class="subTitle">הטיפולים שהמרפאה מציעה:</p>
					<p class="titleHint">לחץ על הטיפול למידיע נוסף</p>      
				</div>
			</div>
			
			<div class="row treatments">
			</div>
			
			<div class="row about_us">
				<h2>אודות</h2>
				<p>
				<h4>
					 ד"ר יוסף חמדאן הוא רופא שיניים מנוסה ומקצועי, המציע מגוון טיפולי שיניים במרפאה פרטית ביאנוח.
                <br>
טיפול שיניים הוא עניין חשוב מאין כמוהו, ולכן מומלץ למצוא רופא שיניים שאתם יכולים לסמוך עליו בעיניים עצומות.<br> 
מישהו שייתן לכם את התחושה של הביטחון, את הרוגע והשלווה, ושיאפשר לכם לדעת שאתם נמצאים בידיים טובות.<br>
ובדיוק כאן ד"ר יוסף נכנס לתמונה, רופא אדיב ומקצועי, בעל ותק, ניסיון ומוניטין של עשרות שנים בתחום רפואת השיניים, ובביצוע טיפולים שיניים בהרדמה, במידת הצורך.<br>
עם ד"ר יוסף החיוך יחזור אל השפתיים שלכם.<br><br>

הזמינו תור או צרו קשר לבירורים!
</h4>
			</div>
			
			<div class="row contact_row">
				<div class="col-md-6">
						<h3 class="info">לביטול תור : </h3>
				
					 דואר אלקטרוני:<br>
					<input type="email" id="del_email" value="" required>  <br><br>
					<select id="del_datetime" style="display:none"> 
					</select>				
					<br><br>  
					<input type="button"  class="btn btn-danger" id="delTreatment" value="ביטול">	
					<img class="loading2" src="images/load.gif" style="display:none">
								
				</div>
				<div class="col-md-6">
					<h3 class="info">לקביעת תור נא למלא את הפרטים הבאים : </h3>
					
					 שם פרטי:<br>
					 <input type="text" id="firstname" value="" required>
					 <br>
					 שם משפחה:<br>
					 <input type="text" id="lastname" value="" required><br>             
				 
					דואר אלקטרוני:<br>
					<input type="email" id="email" value="" required>  <br>  

					טלפון:<br>
					<input type="text" id="phone" maxlength="10" value="" required>   <br> 
				   
					טיפול:<br>
					<select id="treatmentList">
					  
					</select>
					<br>  

					חברת ביטוח:<br>
					<select id="bituahList">
					  
					</select>
					<br>  				
					<br> 
				
					<input size="16" type="text" id="datetime" readonly class="form_datetime">   
					<span id="calendar" class="glyphicon glyphicon-calendar"></span><br><br>  
								
					<input type="button"  class="btn btn-primary" id="sendClient" value="שלח">
					<img class="loading" src="images/load.gif" style="display:none">
					<div class="alert alert-danger signErr" style="display:none" role="alert"></div>
				</div>
			</div>
			
			<div class="row contact_row">
				<div class="col-md-6">
						<div class="embed-responsive embed-responsive-4by3">
					  <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/R_C8lg2sanQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
				</div>
				
				<div class="col-md-6">
					<h3 class="info">טופס שביעות רצון : </h3>
					 שם פרטי:<br>
					 <input type="text" id="contactFname" value="" required>
					 <br>
					 שם משפחה:<br>
					 <input type="text" id="contactLname" value="" required><br>   
						הערות/המלצות לשיפור <br>
					<textarea id="suggestionsText"></textarea>
					<br><br><div class="alert alert-danger suggErr" style="display:none" role="alert"></div>
					<input type="button"  class="btn btn-primary" id="sendSuggestion" value="שלח המלצה">
				</div>
			</div>
			
			<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
			<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
			<script type="text/javascript">

			</script>
			
			<div class="modal fade" id="treatmentInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					
				  </div>
				  <div class="modal-body treatmentInfoModal">
					
				  </div>				  
				</div>
			  </div>
			</div>
			
			<script src="js/index.js"></script>
			<?php require_once "includes/footer.php"; ?>