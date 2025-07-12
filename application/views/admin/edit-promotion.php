  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Promotion
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/">Promotion</a></li>
        <li class="active">Edit Promotion</li>
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

        <!-- column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Promotion</h3>
            </div>
            <!-- /.box-header -->

            <?php if(isset($content)): ?>
              <?php foreach($content as $cnt): ?>

                <!-- form start -->
                <form role="form" action="<?php echo base_url(); ?>update-promotion" method="POST">
                  <div class="box-body">
                    <div class="col-md-12">
                      <div class="form-group">

                        <label>Designation<span style="color: red;">*</span></label>
                        <input type="hidden" name="txtid" value="<?php echo $cnt['id']; ?>" class="form-control">
                        <input type="hidden" name="txtname" value="<?php echo $cnt['name']; ?>" class="form-control">
                        <input type="text" name="txtdesignation" value="<?php echo $cnt['designation']; ?>" class="form-control" placeholder="Promotion">

                        <label>Designation Duration</label>
                        <input type="text" name="txtdesiduration" value="<?php echo $cnt['desiduration']; ?>" class="form-control" placeholder="Duration">

                        <label>Employee Number<span style="color: red;">*</span></label>
                    <input type="text" name="txtemployee_num" value="<?php echo $cnt['employee_num']; ?>" class="form-control" placeholder="Employee Number">

                        <label>From<span style="color: red;">*</span></label>
                        <input type="date" name="txtdesifd" value="<?php echo $cnt['desifd']; ?>" class="form-control" placeholder="From">

                        <label>End</label>
                        <input type="date" name="txtdesitd" value="<?php echo $cnt['desitd']; ?>" class="form-control" placeholder="To">

                        <label>Status<span style="color: red;">*</span></label>
                        <!-- <input type="text" name="txtstatus" value="<?php echo $cnt['status']; ?>" class="form-control" placeholder="status"> -->
                        <select class="form-control" name="txtstatus">
                            <option value="">Select</option>
                            <?php
                            if($cnt['exam']=='Current')
                            {
                              print '<option value="Current" selected>Current</option>
                                    <option value="Previous">Previous</option>';
                            }
                            elseif($cnt['exam']=='Previous')
                            {
                              print '<option value="Current">Current</option>
                                    <option value="Previous" selected>Previous</option>';
                            }
                            else{
                              print '<option value="Current">Current</option>
                              <option value="Previous">Previous</option>';
                            }
                            ?>
                          </select>


                      </div>
                    </div>
                    
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Update</button>
                  </div>
                </form>

              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->