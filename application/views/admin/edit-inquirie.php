  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Inquiries
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/">Inquirie</a></li>
        <li class="active">Edit Inquirie</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <?php if ($this->session->flashdata('success')) : ?>
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          </div>
        <?php elseif ($this->session->flashdata('error')) : ?>
          <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Failed!</h4>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit inquirie</h3>
            </div>
            <!-- /.box-header -->

            <?php if (isset($content)) : ?>
              <?php foreach ($content as $cnt) : ?>
                <!-- form start -->
                <form role="form" action="<?php echo base_url(); ?>update-inquirie" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="col-md-12">
                      <div class="form-group">

                        <label>Inquirie Note<span style="color: red;">*</span></label>
                        <input type="text" name="txtinquirienote" value="<?php echo $cnt['inquirienote']; ?>" class="form-control" placeholder="Inquirie Note">

                        <label>Employee Number<span style="color: red;">*</span></label>
                        <input type="text" name="txtemployee_num" value="<?php echo $cnt['employee_num']; ?>" class="form-control" placeholder="Employee Number">
                      
                        <input type="hidden" name="txtid" value="<?php echo $cnt['id']; ?>" class="form-control">
                        <input type="hidden" name="txtname" value="<?php echo $cnt['name']; ?>" class="form-control">
                                       
                        <label>Inquirie Date</label>
                        <input type="date" name="txtinquiriedate" value="<?php echo $cnt['inquiriedate']; ?>" class="form-control" placeholder="inquiriedate">
           
                        </div>


                        <div class="col-md-12">
                      <div class="form-group">
                        <label>Inquirie Document</label>
                      </div>
                      <div class="col-md-12 text-center">
                        <?php if ($cnt['inquiriedoc']) : ?>
                          <img src="<?php echo base_url('uploads/inquirie/inquiriedoc/' . $cnt['inquiriedoc']); ?>" alt="Inquirie Document" style="max-width: 200px;">
                          <br>
                          <a href="<?php echo base_url('uploads/inquirie/inquiriedoc/' . $cnt['inquiriedoc']); ?>" target="_blank">View </a>
                        <?php else : ?>
                          <span>No Inquirie Document uploaded</span>
                        <?php endif; ?>
                      </div>

                      <div class="form-group col-md-12">
                        <input type="file" name="inquiriedoc" class="form-control">
                        <label class="custom-file-label" for="inquiriedoc">Uploaded file <?php echo $cnt['inquiriedoc']; ?></label>
                      </div>
                    </div>






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