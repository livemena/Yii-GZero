<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Update</h4>
</div>
<form class="form-horizontal modal-body" role="form">
  <div class="form-group">
	<label for="english" class="col-sm-2 control-label">Key</label>
	<div class="col-sm-10">
	  <pre><?php if($source->message){echo $source->message;}; ?></pre>
	  <input type="hidden" id="sourceId" value="<?php if($source->id){echo $source->id;}; ?>" />
	</div>
  </div>
  <div class="form-group">
	<label for="english" class="col-sm-2 control-label">English</label>
	<div class="col-sm-10">
	  <input type="text" class="form-control" id="msgEn" name="msgEn" placeholder="English" value="<?php if(isset($msgEn->translation)){echo $msgEn->translation;}; ?>">
	</div>
  </div>
  <div class="form-group">
	<label for="arabic" class="col-sm-2 control-label">Arabic</label>
	<div class="col-sm-10">
	  <input type="text" class="form-control rtl-text" id="msgAr" name="msgAr" placeholder="عربي" value="<?php if(isset($msgAr->translation)){echo $msgAr->translation;}; ?>">
	</div>
  </div>
</form>
<div class="modal-footer">
	<button id="save" type="submit" class="btn btn-primary">Save</button>
</div>