<?php 
 require_once'products.php';
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Products View</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
  <style type="text/css">
  	.container {
  margin: auto;
  width: 60%;
 
  padding: 10px;
}
  </style>
</head>
<body>


	<div class="container">
		<?php 
		if($_SESSION['pass']) { ?>
	        <div class="alert alert-success" id="success">
        	<button type="button" class="close" data-dismiss="alert" onclick="reset();">X</button>        
            <strong><?php echo ($_SESSION['pass']);?></strong>        
            </div> 
            
        <?php }
        	elseif($_SESSION['error']){ ?>
        <div class="alert alert-danger" id="danger">
            <button type="button" class="close" data-dismiss="alert" onclick="reset();">X</button>        
            <strong><?php  echo ($_SESSION['error']); ?></strong>        
            </div> 
			<?php } ?>
		<h1 style="text-align: center">
			Product Management 
		</h1>			
		<div class="row">
		<!-- <div class="col-sm-6">
	<label>Search</label>
    <input type="text" id="rollNo"  placeholder="Search">
    </div> -->
    <div class="col-sm-12">
    	<input type="button" value="Add Product"  id="addProductBtn" class="btn-primary pull-right" data-toggle="modal" data-target="#addProduct" />
    </div>
    </div>
    <br>
		<table  class="table table-striped table-bordered" id="tableBody">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Image</th>
					<th>Price</th>
					<th>Description</th>
					<th>SKU</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody  id="innertableBody">
				 <?php 

				$getData=new DB_con();
  				$result=$getData->fetchdata();
  				$cnt=1;
             	while($rows=mysqli_fetch_assoc($result))
            	{
            	 ?>
             	<tr>
             	<td><?php echo $rows['name'];?></td>
                <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $rows['images'] ).' "  style="width:100px;"/>'; ?></td>
                <td><?php echo $rows['price'];?></td>
                <td><?php echo $rows['description'];?></td>
                <td><?php echo $rows['sku'];?></td>
                <td>
                	<form action="ajaxfile.php" method="post"><input type="hidden"  id="pid" value=<?php echo $rows['pid'] ;?>  /><input type="button" value="Edit"  id="viewData" onclick="return view(<?php echo $rows['pid'] ;?>);  " class="btn-primary" data-toggle="modal" data-target="#editModal"/>
                	<input type="button" value="Delete"  id="viewData" onclick="return deleteProduct(<?php echo $rows['pid'] ;?>);  " class="btn-primary"/></form></td>
             </tr>
              <?php
                }
             ?>
			</tbody>
		</table>


		<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	
        <form id="update_form" action="upload.php"  method="post" enctype="multipart/form-data">
        	<div class="row">
        		<input type="hidden" id="ppid" name="ppid"  class="form-control" required>	
        		<div class="col-sm-6">
        		<label>Product Name</label>
        		<br>
        		<input class="form-control" type="text" name="pname"  id="pname">
        		</div>
        		<div class="col-sm-6">
        		<label>Image</label>
        		<br>
        		<input class="form-control" type="file" name="pimage" id="pimage" >
        		</div>
        	</div>
        	<br>
        	<div class="row">
        		<div class="col-sm-4">
        		<label>Price</label>
        		<br>
        		<input class="form-control" type="number" name="pprice" id="pprice"  >
        		</div>
        		<div class="col-sm-4">
        		<label>Description</label>
        		<br>
        		<input class="form-control" type="text" name="pdesc" id="pdesc" >
        		</div>
        		<div class="col-sm-4">
        		<label>SKU</label>
        		<br>
        		<input class="form-control" type="text" name="psku" id="psku">
        		</div>
        	</div>

        	<div class="row">
        		<input type="hidden" value="2" name="type">
        		<button type="submit" class="btn btn-primary pull-right" id="updateProduct">Save changes</button>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
		
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><strong>Add Product</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="insertProduct.php" method="post" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-sm-6">
        		<label>Product Name</label>
        		<br>
        		<input class="form-control"  type="text" name="aname" id="aname">
        		</div>
        		<div class="col-sm-6">
        		<label>Image</label>
        		<br>
        		<input class="form-control" type="file" name="aimage" id="aimage" multiple>
        		</div>
        	</div>
        	<br>
        	<div class="row">
        		<div class="col-sm-4">
        		<label>Price</label>
        		<br>
        		<input class="form-control" type="number" name="aprice" id="aprice">
        		</div>
        		<div class="col-sm-4">
        		<label>Description</label>
        		<br>
        		<input class="form-control" type="text" name="adesc" id="adesc">
        		</div>
        		<div class="col-sm-4">
        		<label>SKU</label>
        		<br>
        		<input class="form-control" type="text" name="asku" id="asku">
        		</div>
        	</div>
        	<br>
        	<div class="row">
        		<div class="col-sm-6">	
        		</div>
        		<div class="col-sm-6" >	
        	 		<button type="submit" name="insertProduct" onsubmit="retrun saveProduct();"  class="btn btn-primary pull-right" style="margin-right: 18px;">Save Product</button>
        	 	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">

       
      </div>
    </div>
  </div>
</div>
	</div>

	</div>
	

<script type="text/javascript">
	function view(pid){
		document.getElementById('pname').value = '';
		document.getElementById('pprice').value = '';
		document.getElementById('pdesc').value = '';
		document.getElementById('psku').value = '';
		$.ajax({
			url:'viewProduct.php',
			type: 'post',
			data: {ids: pid},
			success: function(response){				
				var r=JSON.parse(response);
				$('#ppid').val($('#ppid').val()+pid);
				$('#pname').val($('#pname').val()+(r.data.name));
				$('#pprice').val($('#pprice').val()+(r.data.price));
				$('#pdesc').val($('#pdesc').val()+(r.data.description));
				$('#psku').val($('#psku').val()+(r.data.sku));
			}
		})

	}
	function deleteProduct(pid){
	var check = confirm('Do you want to delete the product?');

		if(check){
				$.ajax({
				url:'deleteProduct.php',
				type: 'post',
				data: {ids:pid},
				success: function(response){
				window.location.href ="productsView.php";
				return true;	
				}
			});
		}
		else{

		}
	}
	function saveProduct(){
		window.location.href ="productsView.php";
		return true;
	}

	function reset(){
	<?php 
	$_SESSION["error"]='';
	$_SESSION["pass"]='';
	?>
		
	}
	$(document).ready(function() {

		 // "bPaginate": false,
   //  "bLengthChange": false,
   //  "bFilter": true,
   //  "bInfo": false,
   //  "bAutoWidth": false
		 $('#tableBody').DataTable({
		 	 "lengthMenu": [[5, 15, 20, -1], [5, 15, 20, "All"]]
		 });
		document.getElementById('aname').value='';
		document.getElementById('aprice').value='';
		document.getElementById('adesc').value='';
		document.getElementById('asku').value='';
			$('#tableBody tbody').append("<tr></tr>");
                $("#rollNo").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#innertableBody tr").filter(function() {
                        $(this).toggle($(this).text()
                        .toLowerCase().indexOf(value) > -1)
                    });
                });
	});

	
</script>

</body>
</html>

