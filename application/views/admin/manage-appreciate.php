<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Appreciate
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/manage-appreciate">Appreciate</a></li>
        <li class="active">Manage Appreciate</li>
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
              <h3 class="box-title">Manage Appreciate</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="table-responsive">
                  <table id="example1" class="table display nowrap table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Employee Number</th>
                      <th>Name</th>
                      <th>Appreciate Note</th>
                      <th>Appreciate Date</th>
                      <th>Appreciate Documents</th>
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
                         <td><?php echo isset($cnt['employee_num']) ? $cnt['employee_num'] : ''; ?></td>
                          <td><?php echo $cnt['staff_name']; ?></td>
                          <td><?php echo $cnt['appreciatenote']; ?></td>
                          <td><?php echo $cnt['appreciatedate']; ?></td>
                          <td><img src="<?php echo base_url(); ?>uploads/appreciate/appreciatedoc/<?php echo $cnt['appreciatedoc'] ?>"
                                                class="img-circle" width="50px" alt="User Image"></td> 
                          <td>
                            <a href="<?php echo base_url(); ?>edit-appreciate/<?php echo $cnt['id']; ?>" class="btn btn-success">Edit</a>
                            <a href="<?php echo base_url(); ?>delete-appreciate/<?php echo $cnt['id']; ?>" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                      <?php 
                        $i++;
                        endforeach;
                        endif; 
                      ?>         
                  </tbody>
                            <a href="<?php echo base_url(); ?>appreciate-print">
                            <button type="button" id="cmd" class="btn btn-danger pull-right" style="margin-right: 5px;">
                              <i class="fa fa-download"></i> View PDF
                            </button>
                        </div>
                      </section>
                    </script>
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

    