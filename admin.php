	<?php require_once "includes/header.php"; ?>
	</head>
	<body>
		<div class="wrapper">
			<div class="row upper">
				<div class="col-md-offset-5 col-md-7">
					<img src="images/logo.png">
					
					<h1 class="mainTitle">מרכז טיפול השן</h1>
				</div>
			</div>
			
			<div class="row login_txt_row">
				<div class="col-md-offset-7 col-md-5 subtitle_row">
					<p class="subTitle">כניסה למערכת ניהול</p>
				</div>
			</div>	
			
			<div class="row admin_login_row">
				 
                 <input type="text" id="admin_username" class="inputs" placeholder="שם משתמש">
                 
                 <input type="password" id="admin_password" class="inputs" placeholder="סיסמה">
				                                
                 <input type="button" class="btn btn-primary loginAdmin" value="כניסה">
				 <div class="alert alert-danger errAdmin" role="alert" style="display:none"></div>
			</div>
			<script src="js/admin.js"></script>
			
	<?php require_once "includes/footer.php"; ?>