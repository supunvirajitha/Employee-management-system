<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Transfer
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/manage-transfer">Transfer </a></li>
        <li class="active">Manage Transfer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <?php if($this->session->flashdata('success')): ?>
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo $this->session->flashdata('success'); ?>
            </div>
          </div>
        <?php elseif($this->session->flashdata('error')):?>
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Failed!</h4>
                  <?php echo $this->session->flashdata('error'); ?>
            </div>
          </div>
        <?php endif;?>

        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Manage Transfer </h3>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped " >
                <thead>
                <tr>
                  <th>#</th>
                  <th>Employee Number</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Division</th>
                  <th>Sub Division</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Note</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  if(isset($content)):
                  $i=1; 
                  foreach($content as $cnt): 
                ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                       <!-- <td><?php echo $cnt['employee_num']; ?></td> -->
                       <td><?php echo isset($cnt['employee_num']) ? $cnt['employee_num'] : ''; ?></td>
                      <td><?php echo $cnt['staff_name']; ?></td>
                      <td><?php echo $cnt['ttype']; ?></td>
                      <td><?php echo $cnt['department_tid']; ?></td>
                      <td><?php echo $cnt['sdivision']; ?></td>
                      <td><?php echo $cnt['transferfd']; ?></td>
                      <td><?php echo $cnt['transfertd']; ?></td>
                      <td><?php echo $cnt['dis']; ?></td>
                      <td>
                        <a href="<?php echo base_url(); ?>edit-transfer/<?php echo $cnt['id']; ?>" class="btn btn-success">Edit</a>
                        <a href="<?php echo base_url(); ?>delete-transfer/<?php echo $cnt['id']; ?>" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                  <?php 
                    $i++;
                    endforeach;
                    endif; 
                  ?>
                
                </tbody>
                <!-- Report -->

                        
                            <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                            </button> -->
                            <a href="<?php echo base_url(); ?>transfer-print">
                            <button type="button" id="cmd" class="btn btn-danger pull-right" style="margin-right: 5px;">
                              <i class="fa fa-download"></i> View PDF
                            </button>
                        </div>
                      </section>
                     

                    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
                    <script>
                    $(document).ready(function() {
                        var doc = new jsPDF("l", "pt", "letter");
                        $('#cmd').click(function () {
                          let doc = new jsPDF('p','pt','a4');
                          doc.addHTML($('#invoice'),function() {
                              doc.save('invoice.pdf');
                          }); 
                        });
                    });
                    </script> -->

                  <!-- /Report -->
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    