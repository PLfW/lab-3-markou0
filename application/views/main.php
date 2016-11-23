<div class="panel panel-default">
			<div class="panel-heading">Frequently Searched Products</div>
			<div name="products" class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th id="th1">Operation</th>
							<th>Name</th>
							<th>Description</th>
							<th>Type</th>
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