 <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Warehouse
      
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Warehouse</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php if(in_array('createStore', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Warehouse</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  
                  <th>Warehouse</th>
                  <th>Image</th>
                  <th>Location</th>
                  <th>Status</th>
                  <?php if(in_array('updateStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
                    <th>Action</th>
                  <?php endif; ?>
                </tr>
              </thead>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if(in_array('createStore', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Warehouse</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Warehouse/create') ?>" method="post" id="createForm" enctype="multipart/form-data">

        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name">Warehouse Name</label>
            <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Enter warehouse name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="warehouse_image">Upload Warehouse Image</label>
            <input type="file" class="form-control" id="warehouse_image" name="warehouse_image" accept="image/*">
          </div>
          <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(in_array('updateStore', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Warehouse</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Warehouse/update') ?>" method="post" id="updateForm" enctype="multipart/form-data">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_store_name">Warehouse Name</label>
            <input type="text" class="form-control" id="edit_store_name" name="edit_store_name" placeholder="Enter warehouse name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_warehouse_image">Upload Warehouse Image</label>
            <input type="file" class="form-control" id="edit_warehouse_image" name="edit_warehouse_image" accept="image/*">
          </div>
          <div class="form-group">
            <label for="edit_location">Location</label>
            <input type="text" class="form-control" id="edit_location" name="edit_location" placeholder="Enter location" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(in_array('deleteStore', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Warehouse</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Warehouse/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";
$(document).ready(function() {

  $("#storeNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'print'
      ], 
      'ajax': 'fetchStoresData',
      'columns': [
          { data: '0' }, // Image
          { data: '1' }, // Name
          { data: '2' }, // Location
          { data: '3' }, // Status
          { data: '4' }  // Action buttons
      ],
      'order': []
  });
  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function(event) {
  event.preventDefault();

  // Check if a file has been selected
  var fileInput = $('#warehouse_image')[0];
  if (!fileInput.files.length) {
    alert('Please select an image to upload');
    return;
  }

  // Create FormData object to handle file upload along with other form data
  var form = $(this);
  var formData = new FormData(form[0]); // Create FormData with the form elements

  // Remove any existing error messages
  $(".text-danger").remove();

  // Send the form data with the image
  $.ajax({
    url: form.attr('action'),
    type: 'POST',
    data: formData,
    dataType: 'json',
    processData: false, // Don't process the data
    contentType: false, // Don't set content type as it is handled by FormData
    success: function(response) {
      manageTable.ajax.reload(null, false); 

      if (response.success === true) {
        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
          '<strong><span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + 
        '</div>');

        // Reset the form
        $("#createForm")[0].reset();
        $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

      } else {
        if (response.messages instanceof Object) {
          $.each(response.messages, function(index, value) {
            var id = $("#" + index);
            id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
            id.after(value);
          });
        } else {
          $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
              '<strong><span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + 
            '</div>');
          }
        }
      },
      error: function() {
        alert('Error uploading the image');
      }
    });
  });


});


// edit function
function editFunc(id) {

  $.ajax({
        url: 'fetchStoresDataById/' + id,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            $("#edit_store_name").val(response.name);
            $("#edit_location").val(response.location);
            $("#edit_active").val(response.active);

            $('#editModal .modal-body').find('img').remove();

            setTimeout(function() {
                if (response.image) {
                    var imageUrl = base_url + 'assets/images/warehouse/' + response.image;
                    $('#editModal .modal-body').prepend('<div class="form-group"><img src="' + imageUrl + '" alt="Warehouse Image" class="img-fluid" style="max-width: 100%;"></div>');
                } else {
                    $('#editModal .modal-body').prepend('<div class="form-group"><p>No image available for this warehouse.</p></div>');
                }
            }, 500);




            $("#updateForm").unbind('submit').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var formData = new FormData(form[0]);

                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action') + '/' + id,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success === true) {
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong><span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');

                            $("#editModal").modal('hide');

                            $("#updateForm")[0].reset();
                            $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

                            manageTable.ajax.reload(null, false);

                        } else {
                            if (response.messages instanceof Object) {
                                $.each(response.messages, function(index, value) {
                                    var id = $("#" + index);
                                    id.closest('.form-group')
                                        .removeClass('has-error')
                                        .removeClass('has-success')
                                        .addClass(value.length > 0 ? 'has-error' : 'has-success');
                                    id.after(value);
                                });
                            } else {
                                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong><span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                    '</div>');
                            }
                        }
                    }
                });
            });
        }
    });
}


// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { store_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


</script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
