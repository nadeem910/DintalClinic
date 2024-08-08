<?php
require_once "includes/panel_header.php"; 
?>
<body>
	<div class="wrapper" style="width:68%">
		<div class="row upper">			
			<div class="col-md-offset-7 col-md-5">
				<img src="images/logo.png">
				
				<h1 class="mainTitle">מרכז טיפול השן</h1>
			</div>
		</div>

		<div class="row nav_row">
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>     
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
				  <ul class="nav navbar-nav navbar-right">
					<li><a href="panel.php?logout=1">יציאה</a></li>
                      <li><a href="panel.php?p=user">משתמש</a></li>
					<li><a href="panel.php?p=history">דו"ח הטיפולים</a></li>
					<li><a href="panel.php?p=suggestions">הערות והמלצות</a></li>
					<li><a href="panel.php?p=scheduler">תורים פעילים</a></li>
					<li><a href="panel.php?p=clients">ניהול לקוחות</a></li>
					<li><a href="panel.php?p=doctors">ניהול רופאים</a></li>
					<li><a href="panel.php?p=treatments">ניהול סוגי טיפולים</a></li>
					<li><a href="panel.php?p=bituah">ניהול חברות ביטוח</a></li>						
				  </ul>
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</div>		
<?php
require_once "includes/panel_main.php"; 
require_once "includes/footer.php"; 
?>
