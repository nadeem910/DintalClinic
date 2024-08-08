<div class="row">
	<button type="button" class="btn btn-primary addDoctor" data-toggle="modal" data-target="#addModal">הוספת רופא</button>
	<input type="text" placeholder="חפש רופא" id="search_doctor">
	
	
</div>

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered doctorsList">
		</table>
	</div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">הוספת רופא</h4>
      </div>
      <div class="modal-body">
			שם מלא:<br>
			 <input type="text" class="addFullname" value="" required>
			 <br>			          
		 
			דואר אלקטרוני:<br>
			<input type="email" class="addEmail" value="" required>  <br>  

			טלפון:<br>
			<input type="text" class="addPhone" value="" required>   <br> 
		
			<button type="button" class="btn btn-primary addBtn">הוסף רופא</button>
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
        <h4 class="modal-title" id="myModalLabel">עדכון רופא</h4>
      </div>
      <div class="modal-body">
			<div class="updateInfo">
			</div>
		
			<button type="button" class="btn btn-primary updateBtn">עדכון רופא</button>
			<p class="bg-danger updateErr" style="display:none"></p>
      </div>     
    </div>
  </div>
</div>
<script src="js/doctors.js"></script>