  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Family
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/">Family</a></li>
        <li class="active">Edit Members</li>
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
              <h3 class="box-title">Edit Member</h3>
            </div>
            <!-- /.box-header -->

            <?php if (isset($content)) : ?>
              <?php foreach ($content as $cnt) : ?>
                <!-- form start -->
                <form role="form" action="<?php echo base_url(); ?>update-family" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="col-md-12">
                      <div class="form-group">

                        <label>Member Name<span style="color: red;">*</span></label>
                        <input type="text" name="txtmname" value="<?php echo $cnt['mname']; ?>" class="form-control" placeholder="Member Name">

                        <label>Employee Number<span style="color: red;">*</span></label>
                        <input type="text" name="txtemployee_num" value="<?php echo $cnt['employee_num']; ?>" class="form-control" placeholder="Employee Number">

                        <label>Relationship<span style="color: red;">*</span></label>
                        <input type="hidden" name="txtid" value="<?php echo $cnt['id']; ?>" class="form-control">
                        <input type="hidden" name="txtname" value="<?php echo $cnt['name']; ?>" class="form-control">
                        <!-- <input type="text" name="txtgrade" value="<?php echo $cnt['grade']; ?>" class="form-control" placeholder="Grade"> -->


                        <select class="form-control" name="txtrelationship">
                          <option value="">Select</option>
                          <?php
                          if ($cnt['relationship'] == 'Parents') {
                            print '<option value="Parents" selected>Parents</option>
                                    <option value="Partner">Partner</option>
                                    <option value="Children">Children</option>';
                          } elseif ($cnt['relationship'] == 'Partner') {
                            print '<option value="Parents">Parents</option>
                                    <option value="Partners" selected>Partners</option>
                                    <option value="Children">Children</option>';
                          } elseif ($cnt['grade'] == 'Children') {
                            print '<option value="Parents">Parents</option>
                                    <option value="Partners">Partners</option>
                                    <option value="Children" selected>Children</option>';
                          } else {
                            print '<option value="Parents">Parents</option>
                              <option value="Partners">Partners</option>
                              <option value="Children">Children</option>';
                          }
                          ?>
                        </select>

                        <label>Birthday</label>
                        <input type="date" name="txtbday" value="<?php echo $cnt['bday']; ?>" class="form-control" placeholder="Bday">

                        <label>NIC<span style="color: red;">*</span></label>
                        <input type="text" name="txtnic" value="<?php echo $cnt['nic']; ?>" class="form-control" placeholder="NIC">
                        <br>
                        <br>

                        <div class="col-md-12">
                          <div class="form-group border">
                            <label>Birth Certificate</label>
                          </div>
                          <div class="col-md-12 text-center">
                            <?php if ($cnt['birce']) : ?>
                              <img src="<?php echo base_url('uploads/family/birth-certificate/' . $cnt['birce']); ?>" alt="Birth Certificate" style="max-width: 200px;">
                              <br>
                              <a href="<?php echo base_url('uploads/family/birth-certificate/' . $cnt['birce']); ?>" target="_blank">View Birth Certificate</a>
                            <?php else : ?>
                              <span>No certificate uploaded</span>
                            <?php endif; ?>
                          </div>

                          <div class="form-group col-md-12">
                            <input type="file" name="birce" class="form-control">
                            <label class="custom-file-label" for="ebexamcertificate">Uploaded file <?php echo $cnt['birce']; ?></label>
                          </div>

                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Marriage Certificate</label>
                          </div>
                          <div class="col-md-12 text-center">
                            <?php if ($cnt['mace']) : ?>
                              <img src="<?php echo base_url('uploads/family/marriage-certificate/' . $cnt['mace']); ?>" alt="Marriage Certificate" style="max-width: 200px;">
                              <br>
                              <a href="<?php echo base_url('uploads/family/marriage-certificate/' . $cnt['mace']); ?>" target="_blank">View Marriage Certificate</a>
                            <?php else : ?>
                              <span>No certificate uploaded</span>
                            <?php endif; ?>
                          </div>

                          <div class="form-group col-md-12">
                            <input type="file" name="mace" class="form-control">
                            <label class="custom-file-label" for="mace">Uploaded file <?php echo $cnt['mace']; ?></label>
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