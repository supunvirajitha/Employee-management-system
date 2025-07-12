  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Grades
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/manage-grade">Grade</a></li>
        <li class="active">Edit Grade</li>
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
              <h3 class="box-title">Edit Grade</h3>
            </div>
            <!-- /.box-header -->

            <?php if (isset($content)) : ?>
              <?php foreach ($content as $cnt) : ?>
                <!-- form start -->
                <form role="form" action="<?php echo base_url(); ?>update-grade" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="col-md-12">
                      <div class="form-group">

                        <label>Grade</label>
                        <input type="hidden" name="txtid" value="<?php echo $cnt['id']; ?>" class="form-control">
                        <input type="hidden" name="txtname" value="<?php echo $cnt['name']; ?>" class="form-control">
                        <!-- <input type="text" name="txtgrade" value="<?php echo $cnt['grade']; ?>" class="form-control" placeholder="Grade"> -->

                        <select class="form-control" name="txtgrade">
                          <option value="">Select</option>
                          <?php
                          if ($cnt['grade'] == '1') {
                            print '<option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>';
                          } elseif ($cnt['grade'] == '2') {
                            print '<option value="1">1</option>
                                    <option value="2" selected>2</option>
                                    <option value="3">3</option>';
                          } elseif ($cnt['grade'] == '3') {
                            print '<option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3" selected>3</option>';
                          } else {
                            print '<option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>';
                          }
                          ?>
                        </select>

                        <label>Employee Number<span style="color: red;">*</span></label>
                        <input type="text" name="txtemployee_num" value="<?php echo $cnt['employee_num']; ?>" class="form-control" placeholder="Employee Number">

                        <label>From<span style="color: red;">*</span></label>
                        <input type="date" name="txtgfd" value="<?php echo $cnt['gfd']; ?>" class="form-control" placeholder="From">

                        <label>To</label>
                        <input type="date" name="txtgtd" value="<?php echo $cnt['gtd']; ?>" class="form-control" placeholder="To">

                        <label>Exam<span style="color: red;">*</span></label>
                        <!-- <input type="text" name="txtexam" value="<?php echo $cnt['exam']; ?>" class="form-control" placeholder="Exam"> -->
                        <select class="form-control" name="txtexam">
                          <option value="">Select</option>
                          <?php
                          if ($cnt['exam'] == 'Yes') {
                            print '<option value="Yes" selected>Yes</option>
                                    <option value="No">No</option>';
                          } elseif ($cnt['exam'] == 'No') {
                            print '<option value="Yes">Yes</option>
                                    <option value="No" selected>No</option>';
                          } else {
                            print '<option value="Yes">Yes</option>
                              <option value="No">No</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label> EB Exam Date </label>
                        <input type="date" name="txtebexamdate" value="<?php echo $cnt['ebexamdate']; ?>" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>EB Exam Certificate</label>
                      </div>
                      <div class="col-md-12 text-center">
                        <?php if ($cnt['ebexamcertificate']) : ?>
                          <img src="<?php echo base_url('uploads/grade/ebexamcertificate/' . $cnt['ebexamcertificate']); ?>" alt="EB Exam Certificate" style="max-width: 200px;">
                          <br>
                          <a href="<?php echo base_url('uploads/grade/ebexamcertificate/' . $cnt['ebexamcertificate']); ?>" target="_blank">View Certificate</a>
                        <?php else : ?>
                          <span>No certificate uploaded</span>
                        <?php endif; ?>
                      </div>

                      <div class="form-group col-md-12">
                        <input type="file" name="ebexamcertificate" class="form-control">
                        <label class="custom-file-label" for="ebexamcertificate">Uploaded file <?php echo $cnt['ebexamcertificate']; ?></label>
                      </div>
                    </div>


                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success pull-right">Submit</button>
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