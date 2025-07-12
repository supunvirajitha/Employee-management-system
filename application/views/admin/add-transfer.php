  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transfer 
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/add-transfer">Transfer </a></li>
        <li class="active">Add Transfer </li>
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
              <h3 class="box-title">Add Transfer </h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('transfer/insert'); ?>
              <div class="box-body">
               
                <!-- <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">ID</label>
                    <input type="text" name="txtid" class="form-control" placeholder="Id">
                  </div>
                </div> -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label >Name <span style="color: red;">*</span> </label>
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
                    <label>Employee Number<span style="color: red;">*</span> </label>
                    <input type="text" name="txtemployee_num" class="form-control" placeholder="Employee Number">
                  </div>
                </div>

                

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Type</label>
                    <select class="form-control" name="txttype">
                      <option value="">Select</option>
                      <option value="Transfer">Transfer</option>
                      <option value="Retirement">Retirement</option>
                      <option value="Leave">Leave</option>
                      <option value="Other">Other</option>
                      
                      
                      <!-- <option value="Others">Others</option> -->
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Division</label>
                    <!-- <input type="text" name="txtdepartment_tid" class="form-control"> -->
                    <!-- <select class="form-control" name="txtdepartment" > 
                    <option value=""> Select Department</option>
                    <?php 
                      foreach($get_dep as $cnt)
                      {
	                      ?>
	                      <option value="<?php echo $cnt['department']; ?> "> <?php echo $cnt['department']; ?> </option>
                      <?php }
                      ?>
                   </select> -->
                   <select class="form-control" name="txtdepartment_tid">
                    
                    <option value="">Select</option>
                    
                      <option value="HR & Admin">HR & Admin</option>
                      <option value="IT">IT</option>
                      <option value="Finance">Finance</option>
                      <option value="Marcketing">Marcketing</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sub Division </label>
                    <!-- <input type="text" name="txtsdivision" class="form-control"> -->
                    <select class="form-control" name="txtsdivision">   
                    <option value="">Select</option>
                    
                      <option value="Transfort">Transport</option>
                      <option value="Hr & Admin">Hr & Admin</option>
                      <option value="Chariman Division">Chariman Division</option>
                      <option value="Sales">Sales</option>
                      <option value="Marketing">Marketing</option>
                      <option value="MOU">MOU</option>
                      <option value="Counter">Counter</option>
                      <option value="IT">IT</option>
                      <option value="Return">Return</option>
                      <option value="Sub Store">Sub Store</option>
                    </select>
                  </div>
                </div>



                





                <div class="col-md-6">
                  <div class="form-group">
                    <label>Start<span style="color: red;">*</span> </label>
                    <input type="date" name="txttransferfd" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>End</label>
                    <input type="date" name="txttransfertd" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Note</label>
                    <textarea  name="txtdis" class="form-control"></textarea>
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