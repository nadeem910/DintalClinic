<div class="row">
     <h1> שלום <span class="usernamed"><?php echo($_SESSION['username']); ?></span></h1>
	<button type="button" class="btn btn-primary updateUser" data-toggle="modal" data-target="#addModal">עדכון פרטים</button>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">עדכון משתמש</h4>
      </div>
      <div class="modal-body">
			שם משתמש:<br>
			 <input type="text" class="username" value="<?php echo($_SESSION['username']); ?>" required>
			 <br>	
			 
			סיסמה נוכחית:<br>
			 <input type="password" class="password" value="" required>
			 <br>	

			 סיסמה חדשה:<br>          
			 <input type="password" class="newpassword" >
          <p>השאר ריק במידה ואתה לא משנה את הסיסמה</p>
			 <br>
			 
			
			 
			<button type="button" class="btn btn-primary updateuser">עדכן</button><br>
			<p class="bg-danger addErr" style="display:none"></p>
          <p class="bg-info addSuc" style="display:none"></p>
      </div>     
    </div>
  </div>
</div>
<script src="js/user.js"></script>
