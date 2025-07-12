  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staff Management
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/add-staff">Staff Management</a></li>
        <li class="active">Add Staff</li>
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
              <h3 class="box-title">Add Staff</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open_multipart('Staff/insert');?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Full Name <span style="color: red;">*</span> </label>
                    <input type="text" name="txtname" class="form-control" placeholder="Full Name">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Department<span style="color: red;">*</span></label>
                    <select class="form-control" name="slcdepartment">
                      <option value="">Select</option>
                      <?php
                      if(isset($department))
                      {
                        foreach($department as $cnt)
                        {
                          print "<option value='".$cnt['id']."'>".$cnt['department_name']."</option>";
                        }
                      } 
                      ?>
                    </select>
                  </div>
                </div>

<!-- . -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sub Division</label>
                    <select class="form-control" name="slcsdivision">

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
                    <label>Employee Number<span style="color: red;">*</span></label>
                    <input type="text" name="txtemployee_num" class="form-control" placeholder="Employee Number">
                  </div>
                </div>
                

<!-- 
                <div class="col-md-6">
    <div class="form-group">
        <label>ID Photo (front side) <span style="color: red;">*</span></label>
        <input type="file" name="idphotofront[]" class="form-control" multiple>
    </div>
</div> -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>NIC Photo <span style="color: red;">*</span></label>
                    <input type="file" name="idphotofront" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>B Card Photo </label>
                    <input type="file" name="bcardphoto" class="form-control">
                  </div>
                </div>



                <div class="col-md-6">
                  <div class="form-group">
                    <label>NIC<span style="color: red;">*</span></label>
                    <input type="int" name="intnic" class="form-control" placeholder="NIC Number">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Leaving Certificate</label>
                    <input type="file" name="leavingcertificate" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Birth Certificate</label>
                    <input type="file" name="birthcertificate" class="form-control">
                  </div>
                </div>


                <!--\ . -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Gender<span style="color: red;">*</span></label>
                    <select class="form-control" name="slcgender">
                      <option value="">Select</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email<span style="color: red;">*</span></label>
                    <input type="text" name="txtemail" class="form-control" placeholder="Email">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile<span style="color: red;">*</span></label>
                    <input type="text" name="txtmobile" class="form-control" placeholder="Mobile">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Photo<span style="color: red;">*</span></label>
                    <input type="file" name="filephoto" class="form-control">
                  </div>
                </div>




                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date of Birth<span style="color: red;">*</span></label>
                    <input type="date" name="txtdob" class="form-control" placeholder="DOB">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date of Joining<span style="color: red;">*</span></label>
                    <input type="date" name="txtdoj" class="form-control" placeholder="DOJ">
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>City<span style="color: red;">*</span></label>
                    <input type="text" name="txtcity" class="form-control" placeholder="City">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>District<span style="color: red;">*</span></label>
                    <input type="text" name="txtstate" class="form-control" placeholder="State">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="form-control" name="slccountry" >
                      <option value="">Select</option>
                      <option value="Sri Lanka">Sri lanka</option>
                      <!-- <?php
                        if(isset($country))
                        {
                          foreach ($country as $cnt1)
                          {
                            print "<option value='".$cnt1['country_name']."'>".$cnt1['country_name']."</option>";
                          }
                        }
                      ?> -->
                    </select>
                  </div>
                </div>

                <!-- . -->

                
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Duty<span style="color: red;">*</span></label>
                    <input type="file" name="duty" class="form-control">
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Address<span style="color: red;">*</span></label>
                    <textarea class="form-control" name="txtaddress"></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Remark</label>
                    <textarea class="form-control" name="txtremark"></textarea>
                  </div>
                </div>

                

                <div class="col-md-6">
                  <div class="form-group">
                    <label>EPF Number<span style="color: red;">*</span></label>
                    <input type="text" name="txtepf" class="form-control" placeholder="EPF">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Second Language</label>
                    <select class="form-control" name="slclanguage">
                      <option value="">Select</option>
                      <option value="Sinhala">Sinhala</option>
                      <option value="Tamil">Tamil</option>
                      <option value="English">English</option>
                    </select>
                  </div>
                </div>

               

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Civil Status</label>
                    <select class="form-control" name="slccivil">
                      <option value="">Select</option>
                      <option value="Married">Married</option>
                      <option value="Unmarried">Unmarried</option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Computer Literacy</label>
                    <input type="text" name="txtclitteracy" class="form-control" placeholder="Computer Literacy">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>O/L Results</label>
                    <input type="text" name="txtol" class="form-control" placeholder="Olevel Results">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>O/L Results Sheet</label>
                    <input type="file" name="ols" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>A/L  Stream</label>
                    <input type="text" name="txtalstream" class="form-control" >
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>A/L Results</label>
                    <input type="text" name="txtal" class="form-control" placeholder="Alevel Results">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>A/L Results Sheet</label>
                    <input type="file" name="als" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Higher Education Qualification</label>
                    <textarea class="form-control" name="txtpq"></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Higher Education Qualification </label>
                    <input type="file" name="highereducationqualification" class="form-control">
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Profesional Qualification</label>
                    <textarea class="form-control" name="txthq"></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Profesional Qualification </label>
                    <input type="file" name="profesionalqualification" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Additional Qualification</label>
                    <textarea class="form-control" name="txtaq"></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Additional Qualification </label>
                    <input type="file" name="additionalqualification" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Professional Membership </label>
                    <input type="file" name="professionalmembership" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label> Appointment  letter </label>
                    <input type="file" name="appointmentletter" class="form-control">
                  </div>
                </div>


                

                <!-- <div class="col-md-6">
                  <div class="form-group">
                    <label>EB Exam Certificate</label>
                    <input type="file" name="ebexamcertificate" class="form-control">
                  </div>
                </div> -->
                
              <!--/ . -->

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