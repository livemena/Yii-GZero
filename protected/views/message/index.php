<?php
/* @var $this MessageController */

$this->breadcrumbs=array(
	'Message',
);
?>
<div class="page-header">
  <h1>Messages</h1>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Find a word <a href="" class="btn btn-success btn-xs">Create</a></div>
  <div class="panel-body">
    <div id="wordFinder">
		<div class="form-group">
			<div id="ajaxFind" class="input-group">
			  <input type="text" class="form-control">
			  <span class="input-group-btn">
				<button class="btn btn-primary" type="button">Search</button>
			  </span>
			</div>
		</div>
	</div>
	
	<hr>
	
	<div id="results"></div>
	
	<table class="table table-striped">
      <thead>
        <tr>
          <th>English</th>
          <th>Arabic</th>
          <th>Embed</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
      </tbody>
    </table>
	
  </div>
</div>
