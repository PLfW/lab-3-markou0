<div id="data_ops" class="btn-group">
 <button name="createRec" type="button" class="btn btn-primary" data-toggle="modal" data-target="#editRec"><span class="glyphicon glyphicon-plus-sign"></span> Create Product</button>
  <button type="button" class="btn btn-primary">Create Product Type</button>
  <button type="button" class="btn btn-primary">Create Location</button>
  <button type="button" class="btn btn-primary">Create Location Type</button>
</div>
<div class="panel panel-default">
			<div class="panel-heading">Frequently Searched Products</div>
			<div name="products" class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Operations</th>
							<th>Name</th>
							<th>Description</th>
							<th>Type</th>
							<th>Location Type</th>
							<th>Location</th>
							<th>Code</th>
							<th>Price</th>
							<th>Amont</th>
							<th>Date Created</th>
							<th>Added By</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($params["popular_products"] as $key => $value) {
			echo "<tr>".Product::to_html($value)."</tr>";
		} ?>
					</tbody>
				</table>
			</div>
		</div>