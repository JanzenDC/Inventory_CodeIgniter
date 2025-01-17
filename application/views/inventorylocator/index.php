
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>var $j = jQuery.noConflict(true);</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Items Locator

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Items Locator</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <div class="box">
         
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Warehouse</th>
                        <th>Warehouse Image</th>
                        <th>Location</th>
                        <th>Availability</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated here by DataTables -->
                </tbody>
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




<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$j(document).ready(function() {
    $j("#itemLocator").addClass('active');

    // initialize the datatable 
    manageTable = $('#manageTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    orthogonal: 'export' // Use the "export" version of the data
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    orthogonal: 'export' // Use the "export" version of the data
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    orthogonal: 'export' // Use the "export" version of the data
                }
            },
            'copy'
        ],
        'ajax': {
            'url': base_url + 'Controller_InventoryLocator/fetchProductDataNew',
            'dataSrc': 'data'
        },
        'columns': [
        { 'data': 0 },  // Product name
        { 'data': 1 },  // Price
        { 'data': 2 },  // Quantity
        { 'data': 3 },  // Warehouse name
        { 
            'data': 4,
            'render': function(data, type, row) {
                if (type === 'export') {
                    // Extract URL from the hidden <p> tag
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.display;
                    const hiddenText = tempDiv.querySelector('p')?.innerText || 'No image';
                    return hiddenText;
                }
                return data.display; // Display image in table
            }
        },
        { 'data': 5 },  // Location
        { 'data': 6 }   // Availability
        ],
        'order': []
    });
});

</script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>