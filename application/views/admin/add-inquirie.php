  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inquirie
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/add-inquirie">Inquirie</a></li>
        <li class="active">Add Member</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <?php echo validation_errors('<div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Failed!</h4>', '</div>
          </div>'); ?>


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
              <h3 class="box-title">Add Member</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->

            <form enctype="multipart/form-data" method="post" action="<?php echo site_url('inquirie/insert'); ?>"> 
              <div class="box-body">

                <div class="col-md-6">
                  <div class="form-group">
                    <label >Name <span style="color: red;">*</span></label>
                    <!-- <input type="text" name="txtid" class="form-control" placeholder="ID"> -->
                    <select class="form-control" name="txtname" > 
                      <option value=""> Select name</option>
                      <?php 
                        foreach($get_staff as $cnt2)
                        {
                          ?>
                          <option value="<?php echo $cnt2['id']; ?> "> <?php echo $cnt2['staff_name']; ?> </option>
                        <?php }
                        ?>
                   </select>
                  </div>
                </div>



                <div class="col-md-6">
                  <div class="form-group">
                    <label>Employee Number<span style="color: red;">*</span></label>
                    <input type="text" name="txtemployee_num" class="form-control" placeholder="Employee Number">
                  </div>
                </div>

                

                

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Inquriis Note</label>
                    <textarea class="form-control" name="txtinquirienote"></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label >Inquirie date</label>
                    <input type="date" name="txtinquiriedate" class="form-control">
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Inquirie Documents</label>
                    <input type="file" name="inquiriedoc" class="form-control">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right">Submit</button>
              </div>
            </form>


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