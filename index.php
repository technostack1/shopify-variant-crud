<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Shpoify Product List</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .btn {
        font-size: 0.65rem !important;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./dashboard/dashboard.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
    
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

<div class="container">
  <div class="row">

    <main class="">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Product List</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <!--
			<button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
			-->
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> &nbsp;
            <button type="button"  onclick="addVariant()" class=" btn btn-sm btn-outline-primary">Create Variant</button>

          </div>
        </div>
      </div>

<?php
 include("./function.php");

?>
      <div class="table-responsive">
        <table  id="datatable" class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Product Id</th>
              <th scope="col">Variant Id</th>
              <th scope="col">Vendor</th>
              <th scope="col">Product / Variant Title</th>
              <th scope="col">Price</th>
              <th scope="col">SKU</th>
              <th scope="col">Inventory_management</th>
              <th scope="col">Created_at</th>
              <th scope="col">Updated_at</th>
              <th scope="col">Action</th>
			  
            </tr>
          </thead>
          <tbody>

			<?php
			   if(count($productArray) > 0 ){
				   foreach($productArray as $pro){
					   $id = $pro["product_id"];
					   $vid = $pro["variant_id"];
             $title = $pro['title']. "/".$pro['v_title'];
					   
				   echo "<tr id='tr-$vid' >
							  <td>".$pro["product_id"]."</td>
							  <td>".$pro["variant_id"]."</td>
							  <td>".$pro['vendor']."</td>
							  <td>".$title."</td>
							  <td>".$pro['price']."</td>
							  <td>".$pro['sku']."</td>
							  <td>".$pro['fulfillment_service']."</td>
							  <td>".$pro['created_at']."</td>
							  <td>".$pro['updated_at']."</td>
							  <td>
                 <button onclick='editVariant($id,$vid)' title='Edit Variant' style='cursor:pointer'  class='btn btn-success btn-xs'>Edit</button>

                 <button onclick='exampleModalDel($id,$vid)'  title='Delete Variant' class='btn btn-danger'  style='cursor:pointer' class='glyphicon'>Del </button>
                 </td>
							  
							</tr>";
					   
				   }
			   }
			?>
            
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Variants</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
        
        <div class="mb-3 product-select ">
            <label for="recipient-name" class="col-form-label">Select Product:</label>
            <select id="proId" class="form-control"  >
          <option value="" >Select product</option>
          <?php
               foreach($mainProduct as $mp){
                  $v = $mp['product_id'];
                  echo "<option  value='$v' >".$mp['title']."</option>";
               }
          ?>
          </select>

          </div>


          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Variant SKU:</label>
            <input type="text" class="form-control" id="p_sku">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Variant Price:</label>
            <input type="text" class="form-control" id="p_price">
            <input type="hidden" class="form-control" id="action_type">
            <input type="hidden" class="form-control" id="product_id">
            <input type="hidden" class="form-control" id="variant_id">

          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Option 1:</label>
            <input type="text" class="form-control" id="option1">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Option 2:</label>
            <input type="text" class="form-control" id="option2">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Option 3:</label>
            <input type="text" class="form-control" id="option3">
          </div>

          <div class="errorShow" style="display:none">
          <div class="alert alert-danger">
             Indicates a dangerous or potentially negative action.</div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="submitAction()"  class="btn btn-primary btn-action ">Edit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalDel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <h2 for="recipient-name" class="col-form-label">Alert</h2>
          </div>
          <div class="errorShow" >
          <div class="">
            Are you sure you want to delete this variant?</div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" onclick="submitActionDel()"  class="btn btn-primary btn-action ">Yes</button>
      </div>
    </div>
  </div>
</div>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js" defer></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" defer></script>
  
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js" defer></script>

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js" defer></script>

     <script>
	 var dataArray = <?php echo json_encode($productArray); ?>;
   var deletePId = "";
   var deleteVId = "";

      function exampleModalDel(i,v){
        $("#exampleModalDel").modal("show");
        deletePId = i;
        deleteVId = v;

      }

      function submitActionDel(){
        let data = {product_id:deletePId,v_id:deleteVId,method:"DELETE"};
        $("#exampleModalDel").modal("hide");

        ajaxCall(data,"DELETE");
      }


	   function editVariant(i,v){
      $(".errorShow").css("display","none")
      $(".product-select").css("display","none")

      $("#exampleModalLabel").html("Edit Variant ID : "+v);
      $(".btn-action").html("Edit Variant");
      $("#exampleModal").modal("show");

			let rrr = dataArray.filter(r=> r.variant_id == v);

       let options = rrr[0].title.split("/");
       console.log("options",options);
        $("#p_price").val(rrr[0].price);
        $("#p_sku").val(rrr[0].sku);
        $("#action_type").val(1);
        $("#product_id").val(i);
        $("#variant_id").val(v);
        $("#option1").val(options[0].trim());
        $("#option2").val(options[1].trim());
        $("#option3").val(options[2].trim());

        
			
	   }

	  function addVariant(){
      $(".product-select").css("display","block")

      $(".errorShow").css("display","none")
		  $("#exampleModalLabel").html("Add Variant");
		   $(".btn-action").html("Add Variant");
       $("#exampleModal").modal("show");
       $("#p_title").val("");
        $("#p_price").val("");
        $("#p_sku").val("");
        $("#action_type").val(0);
        $("#variant_id").val("");

	   }

     function submitAction(){
      $(".errorShow").css("display","none")


       let price       = $("#p_price").val();
       let sku         = $("#p_sku").val();
       let action_type = $("#action_type").val();
       let product_ids  = $("#product_id").val();
       let variant_id  = $("#variant_id").val();
       let option1     = $("#option1").val();
       let option2     = $("#option2").val();
       let option3     = $("#option3").val();


        if(price.length === 0){
        $(".errorShow").css("display","block");
        $(".alert").html("Title required");

       }
       else if(sku.length === 0){
        $(".errorShow").css("display","block");
        $(".alert").html("Sku required");
       }
       else if(action_type == 0 && $("#proId").val() == ""){
        $(".errorShow").css("display","block");
        $(".alert").html("Please select product");

       }
       else {

        let method = (action_type == 1)? "PUT" : "POST";
        let product_id = (action_type == 1)? product_ids : $("#proId").val();

        let data = {option1,option2,option3,price,sku,method,product_id,variant_id};
        ajaxCall(data,method);


       }

        
     }

     function ajaxCall(data,m) {
		$.blockUI({
        message: '<p>Just a moment...</p>',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#b71f68',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });

		$.ajax({
			url: './action.php',
			type: 'POST',
			dataType: 'HTML',
			data: data,
			success: function (res) {
        console.log("res",res);
				$.unblockUI();
				var data = $.parseJSON(res);
        if(res){
                if(m == "DELETE"){

                   $("#tr-"+deleteVId).remove();
                   $.blockUI({
                 message: '<p>Successfully Deleted</p>',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#b71f68',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
           
          setTimeout(() => {
            $.unblockUI();

          }, 1500);

                }
                if(m === "PUT"){
                  $("#exampleModal").modal("hide");
                  location.reload();

                }
                if(m === "POST"){
                  $("#exampleModal").modal("hide");
                  location.reload();

                }

         }else{

         }

			},
			error: function (xhr, status, error) {
				$.unblockUI();
        console.log("error",error);
			}
		});
	}     
	 </script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="./dashboard/dashboard.js"></script>
      <script>
$(document).ready(function() {
    $('#datatable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );        
        </script>
  </body>
</html>
