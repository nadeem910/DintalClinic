			<div class="row footer_row">
				<p class="footer">
					Copyright © 2018 All Rights Reserved
					<?php
					if(basename($_SERVER['PHP_SELF'])!='admin.php')
					{
					?>
					<a href="admin.php">ניהול המרפאה</a>
					<?php
					}
					else
					{
					?>
					<a href="index.php">עמוד הבית</a>					
					<?php
					}
					?>
				</p> 
			</div>
		</div>
	</body>
</html>