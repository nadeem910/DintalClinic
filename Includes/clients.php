<div class="row">
	<div class="col-md-12">		
		<input type="text" placeholder="חפש לקוח" id="search_client">
		
		<table class="table table-bordered ClientsList">
		</table>
	</div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">עדכון לקוח</h4>
      </div>
      <div class="modal-body">
			<div class="updateInfo">
			</div>
		
			<button type="button" class="btn btn-primary updateBtn">עדכון לקוח</button>
			<p class="bg-danger updateErr" style="display:none"></p>
      </div>     
    </div>
  </div>
</div>
<script src="js/clients.js"></script>