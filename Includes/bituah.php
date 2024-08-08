<div class="row">
	<button type="button" class="btn btn-primary addDoctor" data-toggle="modal" data-target="#addModal">הוסף חברה</button>
	
	<input type="text" placeholder="חפש חברה" id="search_company">
</div>

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered CompaniesList">
		</table>
	</div>
</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">הוספת טיפול</h4>
      </div>
      <div class="modal-body">
			שם חברה:<br>
			 <input type="text" class="addCompanyName" value="" required>
			 <br>			          
		 
			טלפון:<br>
			 <input type="text" class="addPhone" required>
			 <br>
			 
			אימייל:<br>
			 <input type="text" class="addEmail" value="" required>
			 <br>	
			 
			<button type="button" class="btn btn-primary addBtn">הוסף חברה</button>
			<p class="bg-danger addErr" style="display:none"></p>
      </div>     
    </div>
  </div>
</div>


<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">עדכון חברה</h4>
      </div>
      <div class="modal-body">
			<div class="updateInfo">
			</div>
		
			<button type="button" class="btn btn-primary updateBtn">עדכון חברה</button>
			<p class="bg-danger updateErr" style="display:none"></p>
      </div>     
    </div>
  </div>
</div>
<script src="js/bituah.js"></script>