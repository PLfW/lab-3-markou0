<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="/css/style.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			
			$("button[data-target='#removeRec'],[data-target='#editRec']").click(function(){
				$("tr").removeClass("info");
				$(this).parents("tr").addClass("info");
				var col_names = $(this).parents("tr").children("td").map(function() {
				// alert($(this).attr("name"));
				$("[name='description']").attr("desc");
				$("input[name='"+$(this).attr("name")+"']").prop( 'value', $(this).html());	
				$("textarea[name='"+$(this).attr("name")+"']").html($(this).html());
				$("option").removeProp("selected");	
				$("option[value='"+$(this).html()+"']").prop('selected',true);
				return $(this).attr("name")+"vlue ="+$(this).html();
			});

				var productId = $(this).attr("name");
				$("[name='id']").attr( 'value', productId);
				});
				$("[data-dismiss='modal']").click(function(){
					$("tr").removeClass("info");
				});

			});
			</script>
	<!-- <style type="text/css">
		td{
		  max-width:3em; 
		  overflow:hidden;
		}
	</style> -->
</head>
<body>
	<header>
		<div id="header" class="page-header">
			<h1>Products Audit System</h1>
			<p>Generic Audit System</p> 
		</div>
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
					<a class="navbar-brand" href="#"><span class="glyphicon glyphicon-qrcode"></span></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Main <span class="sr-only">(current)</span></a></li>
						<li><a href="#">Products catalog</a></li>
					</ul>
					<form class="navbar-form navbar-left">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Login</a></li>
						<li><a href="#">Sign up</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acount <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">My page</a></li>
								<li><a href="#">Add product</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>
	<div class="container-fluid">
		<!-- Modals -->
		<div class="modal fade" id="removeRec" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Delete Record Confirm</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want delete this record?</p>
					</div>
					<div class="modal-footer">
						<form id="productRemoveForm" action="product/remove" method="post" class="form-horizontal">
							<input type="text" value="" class="" name="id" hidden>
						</form>
						<input type="submit" form="productRemoveForm" class="btn btn-default"/>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>

			</div>
		</div>

		<div class="modal fade" id="editRec" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Record</h4>
					</div>
					<div class="modal-body">
						<form name="productEdit" action="product/edit" method="post" class="form-horizontal">
							<input type="text" value="" class="" name="id">
							<div class="form-group">
								<label class="control-label col-sm-2" for="productName">Name:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="productDescr">Description:</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="5" name="description" id="productDescr" value="fg"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label  class="control-label col-sm-2" for="productType">Type:</label>
								<div class="col-sm-10">
									<select class="form-control" name="product_type" id="productType">
										<?php foreach ($params["product_types"] as $key => $value) {
											echo "<option value=".ProductType::to_html($value).">".ProductType::to_html($value)."</option>";
										} ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label  class="control-label col-sm-2" for="productLoc">Location:</label>
								<div class="col-sm-10">
									<select class="form-control" id="productLoc">
										<option>1</option>
										<option>2</option>
										<option value="3" id="op3">3</option>
										<option>4</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="productAmount">Amount:</label>
								<div class="col-sm-10">
									<input type="number" name="amount" id="productAmount" value="90" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="productPrice">Price:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" name="price" id="productPrice">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="productCode">Code:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="inventarisation_code" id="productCode">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="Submit" class="btn btn-warning">Submit</button>
									<button type="Reset" class="btn btn-warning">Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
		<?php include 'application/views/'.$content_view; ?>
	</div>
</div>
<footer class="footer navbar navbar-default">
	<div class="container-fluid">
		<p class="text-muted text-center">Author : Mark Kryzhnivskyy</p>
	</div>
</footer>
</body>
</html>



