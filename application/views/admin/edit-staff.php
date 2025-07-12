<style>
  .floatybox {
    display: inline-block;
    width: 123px;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Staff Management
    </h1>
    <ol class="breadcrumb">
      <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Staff Management</a></li>
      <li class="active">Edit Staff</li>
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
            <h3 class="box-title">Edit Staff</h3>
          </div>
          <!-- /.box-header -->
          <?php if (isset($content)) : ?>
            <?php foreach ($content as $cnt) : ?>

              <!-- form start -->
              <?php echo form_open_multipart('Staff/update'); ?>
              <div class="box-body">
                <?php
                $imgs = $this->Staff_model->get_staff_imgs($cnt['id']);
                ?>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Full Name</label>
                    <input type="hidden" name="txtid" value="<?php echo $cnt['id'] ?>" class="form-control" placeholder="Full Name">
                    <input type="text" name="txtname" value="<?php echo $cnt['staff_name'] ?>" class="form-control" placeholder="Full Name">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Employee Number</label>
                    <input type="text" name="txtemployee_num" value="<?php echo $cnt['employee_num'] ?>" class="form-control" placeholder="Employee Number">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Department</label>
                    <select class="form-control" name="slcdepartment">
                      <option value="">Select</option>
                      <?php
                      if (isset($department)) {
                        foreach ($department as $cnt1) {
                          if ($cnt1['id'] == $cnt['department_id']) {
                            print "<option value='" . $cnt1['id'] . "' selected>" . $cnt1['department_name'] . "</option>";
                          } else {
                            print "<option value='" . $cnt1['id'] . "'>" . $cnt1['department_name'] . "</option>";
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="slcgender">
                      <option value="">Select</option>
                      <?php
                      if ($cnt['gender'] == 'Male') {
                        print '<option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>';
                      } elseif ($cnt['gender'] == 'Femle') {
                        print '<option value="Male">Male</option>
                                    <option value="Female" selected>Female</option>
                                    <option value="Others">Others</option>';
                      } elseif ($cnt['gender'] == 'Others') {
                        print '<option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others" selected>Others</option>';
                      } else {
                        print '<option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Others">Others</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="txtemail" value="<?php echo $cnt['email'] ?>" class="form-control" placeholder="Email" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="txtmobile" value="<?php echo $cnt['mobile'] ?>" class="form-control" placeholder="Mobile" readonly>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Photo</label>
                  </div>
                  <div class="row">
                    <div id="image_div1">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 1) : ?>
                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                      <!-- <div class="col-md-3">
                          <input type="text"  name="image[][]">
                          <a target="_blank" href="<?= base_url() ?>uploads/staff_new" class="btn btn-primary">View</a>
                          <button type="button" class="btn btn-danger">Remove</button>
                        </div> -->
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(1)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>

                  <!-- <div class="col-md-11 text-center">
                    <?php if ($imgs) : ?>
                      <div class="col-md-12 text-center">

                        <img src="<?php echo base_url('uploads/staff/profile-pic/' . $cnt['pic']); ?>" alt="Photo" style="max-width: 200px;">
                        <br>
                        <a href="<?php echo base_url('uploads/staff/profile-pic/' . $cnt['pic']); ?>" target="_blank">View</a>
                      <?php else : ?>
                        <span>No Photo uploaded</span>
                      </div>
                    <?php endif; ?>
                  </div> -->

                  <!-- <div class="form-group col-md-13">
                       <input type="file" name="filephoto" class="form-control">
                       <label class="custom-file-label" for="pic">Uploaded file <?php echo $cnt['pic']; ?></label>
                     </div> -->
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="txtdob" value="<?php echo $cnt['dob'] ?>" class="form-control" placeholder="DOB">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date of Joining</label>
                    <input type="date" name="txtdoj" value="<?php echo $cnt['doj'] ?>" class="form-control" placeholder="DOJ">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>City</label>
                    <input type="text" name="txtcity" value="<?php echo $cnt['city'] ?>" class="form-control" placeholder="City">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>State</label>
                    <input type="text" name="txtstate" value="<?php echo $cnt['state'] ?>" class="form-control" placeholder="State">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="form-control" name="slccountry">
                      <option value="">Select</option>
                      <?php
                      if (isset($country)) {
                        foreach ($country as $cnt1) {
                          if ($cnt1['country_name'] == $cnt['country']) {
                            print "<option value='" . $cnt1['country_name'] . "' selected>" . $cnt1['country_name'] . "</option>";
                          } else {
                            print "<option value='" . $cnt1['country_name'] . "'>" . $cnt1['country_name'] . "</option>";
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="txtaddress"><?php echo $cnt['address'] ?></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Duty</label>
                  </div>
                  <div class="row">
                    <div id="image_div2">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 2) : ?>
                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(2)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>

                  <div class="col-md-12 text-center">

                  </div>
                  <!-- <div class="col-md-11 text-center">
                       <?php if ($cnt['duty']) : ?>
                         <img src="<?php echo base_url('uploads/staff/duty/' . $cnt['duty']); ?>" alt="Duty" style="max-width: 200px;">
                         <br>
                         <a href="<?php echo base_url('uploads/staff/duty/' . $cnt['duty']); ?>" target="_blank">View</a>
                       <?php else : ?>
                         <span>No Duty uploaded</span>
                       <?php endif; ?>
                     </div> -->

                  <!-- <div class="form-group col-md-13">
                       <input type="file" name="duty" class="form-control">
                       <label class="custom-file-label" for="duty">Uploaded file <?php echo $cnt['duty']; ?></label>
                     </div> -->
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Remark</label>
                    <textarea class="form-control" name="txtremark"><?php echo $cnt['remark'] ?></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>NIC</label>
                    <input type="int" name="intnic" value="<?php echo $cnt['nic'] ?>" class="form-control" placeholder="NIC Number">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>ID Photo</label>
                  </div>
                  <div class="row">
                    <div id="image_div3">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 5) : ?>
                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(5)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">

                  </div>

                  <!-- <div class="col-md-11 text-center">
                        <?php if ($cnt['idphotofront']) : ?>
                          <img src="<?php echo base_url('uploads/staff/idphotofront/' . $cnt['idphotofront']); ?>" alt="ID Photo" style="max-width: 200px;">
                          <br>
                          <a href="<?php echo base_url('uploads/staff/idphotofront/' . $cnt['idphotofront']); ?>" target="_blank">View</a>
                        <?php else : ?>
                          <span>No ID Photo uploaded</span>
                        <?php endif; ?>
                      </div>

                      <div class="form-group col-md-13">
                        <input type="file" name="idphotofront" class="form-control">
                        <label class="custom-file-label" for="idphotofront">Uploaded file <?php echo $cnt['idphotofront']; ?></label>
                      </div> -->
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>B Card Photo</label>
                  </div>
                  <div class="row">
                    <div id="image_div4">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 6) : ?>


                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(6)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">

                  </div>
                  <!-- <div class="col-md-11 text-center">
                       <?php if ($cnt['bcardphoto']) : ?>
                         <img src="<?php echo base_url('uploads/staff/bcardphoto/' . $cnt['bcardphoto']); ?>" alt="B Card Photo" style="max-width: 200px;">
                         <br>
                         <a href="<?php echo base_url('uploads/staff/bcardphoto/' . $cnt['bcardphoto']); ?>" target="_blank">View</a>
                       <?php else : ?>
                         <span>No B Card Photo uploaded</span>
                       <?php endif; ?>
                     </div> -->

                  <!-- <div class="form-group col-md-13">
                       <input type="file" name="bcardphoto" class="form-control">
                       <label class="custom-file-label" for="bcardphoto">Uploaded file <?php echo $cnt['bcardphoto']; ?></label>
                     </div> -->
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Leaving Certificate</label>
                  </div>
                  <div class="row">
                    <div id="image_div5">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 8) : ?>


                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(8)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>



                  <!-- <div class="col-md-11 text-center">
                       <?php if ($cnt['leavingcertificate']) : ?>
                         <img src="<?php echo base_url('uploads/staff/leavingcertificate/' . $cnt['leavingcertificate']); ?>" alt="Leaving Certificate" style="max-width: 200px;">
                         <br>
                         <a href="<?php echo base_url('uploads/staff/leavingcertificate/' . $cnt['leavingcertificate']); ?>" target="_blank">View</a>
                       <?php else : ?>
                         <span>No Leaving Certificate uploaded</span>
                       <?php endif; ?>
                     </div> -->

                  <!-- <div class="form-group col-md-13">
                       <input type="file" name="leavingcertificate" class="form-control">
                       <label class="custom-file-label" for="leavingcertificate">Uploaded file <?php echo $cnt['leavingcertificate']; ?></label>
                     </div> -->
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Birth Certificate</label>
                  </div>
                  <div class="row">
                    <div id="image_div6">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 7) : ?>


                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(7)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">

                  </div>
                  <!-- <div class="col-md-11 text-center">
                       <?php if ($cnt['birthcertificate']) : ?>
                         <img src="<?php echo base_url('uploads/staff/birthcertificate/' . $cnt['birthcertificate']); ?>" alt="Birth Certificate" style="max-width: 200px;">
                         <br>
                         <a href="<?php echo base_url('uploads/staff/birthcertificate/' . $cnt['birthcertificate']); ?>" target="_blank">View</a>
                       <?php else : ?>
                         <span>No Birth Certificate uploaded</span>
                       <?php endif; ?>
                     </div> -->


                  <!-- <div class="form-group col-md-13">
                       <input type="file" name="birthcertificate" class="form-control">
                       <label class="custom-file-label" for="birthcertificate">Uploaded file <?php echo $cnt['birthcertificate']; ?></label>
                     </div> -->
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>EPF</label>
                    <input type="text" name="txtepf" value="<?php echo $cnt['epf'] ?>" class="form-control" placeholder="EPF">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Second Language</label>
                    <select class="form-control" name="slclanguage">
                      <option value="<?php echo $cnt['gender'] ?>">Select</option>
                      <?php
                      if ($cnt['language'] == 'Sinhala') {
                        print '<option value="Sinhala" selected>Sinhala</option>
                                          <option value="Tamil">Tamil</option>
                                          <option value="English">English/option>';
                      } elseif ($cnt['language'] == 'Tamil') {
                        print '<option value="English">English</option>
                                          <option value="Tamil" selected>Tamil</option>
                                          <option value="Sinhala">Sinhala</option>';
                      } elseif ($cnt['language'] == 'English') {
                        print '<option value="Tamil">Tamil</option>
                                          <option value="Sinhala">Sinhala</option>
                                          <option value="English" selected>English</option>';
                      } else {
                        print '<option value="Tamil">Tamil</option>
                                    <option value="Sinhala">Sinhala</option>
                                    <option value="English">English</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sub Division</label>
                    <select class="form-control" name="slcsdivision">

                      <option value="<?php echo $cnt['sdivision'] ?>"><?php print $cnt['sdivision'] ?></option>
                      <option value="Transfort">Transport</option>
                      <option value="Hr & Admin">Hr & Admin</option>
                      <option value="Chariman Division">Chariman Division</option>
                      <option value="Sales">Sales</option>
                      <option value="Marketing">Marketing</option>
                      <option value="MOU">MOU</option>
                      <option value="Counter">Counter</option>
                      <option value="Return">Return</option>
                      <option value="Sub Store">Sub Store</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Civil Status</label>
                    <select class="form-control" name="slccivil">
                      <option value="">Select</option>
                      <?php
                      if ($cnt['civil'] == 'Married') {
                        print '<option value="Married" selected>Married</option>
                                          <option value="Unmarried">Unmarried</option>
                                          <option value="Others">Others</option>';
                      } elseif ($cnt['civil'] == 'Unmarried') {
                        print '<option value="Married">married</option>
                                          <option value="Unmarried" selected>Unmarried</option>
                                          <option value="Others">Others</option>';
                      } elseif ($cnt['civil'] == 'Others') {
                        print '<option value="Married">Married</option>
                                          <option value="Unmarried">Unmarried</option>
                                          <option value="Others" selected>Others</option>';
                      } else {
                        print '<option value="Married">Married</option>
                                    <option value="Unmarried">unmarried</option>
                                    <option value="Others">Others</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Computer Literacy</label>
                    <input type="text" name="txtclitteracy" value="<?php echo $cnt['clitteracy'] ?>" class="form-control" placeholder="Computer Literacy">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>O/L Results</label>
                    <input type="text" name="txtol" value="<?php echo $cnt['ol'] ?>" class="form-control" placeholder="Olevel Results">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>O/L Results Sheet</label>
                  </div>
                  <div class="row">
                    <div id="image_div7">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 3) : ?>
                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(3)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">

                  </div>

                  <!-- <div class="col-md-11 text-center">
                       <?php if ($cnt['ols']) : ?>
                         <img src="<?php echo base_url('uploads/staff/ols/' . $cnt['ols']); ?>" alt="O/L Results Sheet" style="max-width: 200px;">
                         <br>
                         <a href="<?php echo base_url('uploads/staff/ols/' . $cnt['ols']); ?>" target="_blank">View</a>
                       <?php else : ?>
                         <span>No O/L Results Sheet uploaded</span>
                       <?php endif; ?>
                     </div> -->

                  <!-- <div class="form-group col-md-13">
                       <input type="file" name="ols" class="form-control">
                       <label class="custom-file-label" for="ols">Uploaded file <?php echo $cnt['ols']; ?></label>
                     </div> -->
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>A/L Stream</label>
                    <input type="text" name="txtalstream" value="<?php echo $cnt['alstream'] ?>" class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>A/L Results</label>
                    <input type="text" name="txtal" value="<?php echo $cnt['al'] ?>" class="form-control" placeholder="Alevel Results">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>A/L Results Sheet</label>
                  </div>
                  <div class="row">
                    <div id="image_div8">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 4) : ?>


                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(4)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>

                  <div class="col-md-12 text-center">

                  </div>
                  <!-- <div class="col-md-11 text-center">
                       <?php if ($cnt['als']) : ?>
                         <img src="<?php echo base_url('uploads/staff/als/' . $cnt['als']); ?>" alt="A/L Results Sheet" style="max-width: 200px;">
                         <br>
                         <a href="<?php echo base_url('uploads/staff/als/' . $cnt['als']); ?>" target="_blank">View</a>
                       <?php else : ?>
                         <span>No A/L Results Sheet uploaded</span>
                       <?php endif; ?>
                     </div> -->

                  <!-- <div class="form-group col-md-13">
                       <input type="file" name="als" class="form-control">
                       <label class="custom-file-label" for="als">Uploaded file <?php echo $cnt['als']; ?></label>
                     </div> -->
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Higher education qualification</label>
                    <textarea class="form-control" name="txthq"><?php echo $cnt['hq'] ?></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Higher Education Qualification</label>
                  </div>
                  <div class="row">
                    <div id="image_div9">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 9) : ?>


                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(9)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>

                  <div class="col-md-12 text-center">

                  </div>

                  <!-- <div class="col-md-11 text-center">
                       <?php if ($cnt['highereducationqualification']) : ?>
                         <img src="<?php echo base_url('uploads/staff/highereducationqualification/' . $cnt['highereducationqualification']); ?>" alt="Higher Education Qualification" style="max-width: 200px;">
                         <br>
                         <a href="<?php echo base_url('uploads/staff/highereducationqualification/' . $cnt['highereducationqualification']); ?>" target="_blank">View</a>
                       <?php else : ?>
                         <span>No Higher Education Qualification uploaded</span>
                       <?php endif; ?>
                     </div> -->

                  <!-- <div class="form-group col-md-13">
                       <input type="file" name="highereducationqualification" class="form-control">
                       <label class="custom-file-label" for="highereducationqualification">Uploaded file <?php echo $cnt['highereducationqualification']; ?></label>
                     </div> -->
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Profesional qualification</label>
                    <textarea class="form-control" name="txtpq"><?php echo $cnt['pq'] ?></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Profesional Qualification</label>
                  </div>
                  <div class="row">
                    <div id="image_div10">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 10) : ?>


                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(10)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>

                  <div class="col-md-12 text-center">

                  </div>


                  <!-- <div class="col-md-11 text-center">
                       <?php if ($cnt['profesionalqualification']) : ?>
                         <img src="<?php echo base_url('uploads/staff/profesionalqualification/' . $cnt['profesionalqualification']); ?>" alt="Profesional Qualification" style="max-width: 200px;">
                         <br>
                         <a href="<?php echo base_url('uploads/staff/profesionalqualification/' . $cnt['profesionalqualification']); ?>" target="_blank">View</a>
                       <?php else : ?>
                         <span>No Profesional Qualification uploaded</span>
                       <?php endif; ?>
                     </div> -->

                  <!-- <div class="form-group col-md-13">
                       <input type="file" name="profesionalqualification" class="form-control">
                       <label class="custom-file-label" for="profesionalqualification">Uploaded file <?php echo $cnt['profesionalqualification']; ?></label>
                     </div> -->
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Additional Qualification</label>
                    <textarea class="form-control" name="txtaq"><?php echo $cnt['aq'] ?></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group border">
                    <label>Additional Qualification</label>
                  </div>
                  <div class="row">
                    <div id="image_div11">
                      <?php foreach ($images as $k => $val) : ?>
                        <?php if ($val->type == 11) : ?>


                          <div id="image_div<?= $val->type ?>" class="col-md-2">
                            <input type="hidden" value="<?= $val->file_name ?>" name="image[<?= $val->type ?>][]">
                            <a target="_blank" href="<?= base_url() ?>uploads/staff_new/<?= $val->file_name ?>" class="btn btn-primary">View</a>
                            <button type="button" id="image_remove<?= $val->type ?>" class="btn btn-danger">Remove</button>
                          </div>
                        <?php endif ?>
                      <?php endforeach ?>
                    </div>
                    <div class="col-md-3">
                      <button type="button" onclick="load_image_upload_modal(11)" class="btn btn-primary">Add Image</button>
                    </div>
                  </div>



                  <!-- <div class="col-md-12 text-center">
                       <?php if ($cnt['additionalqualification']) : ?>
                         <img src="<?php echo base_url('uploads/staff/additionalqualification/' . $cnt['additionalqualification']); ?>" alt="Additional Qualification" style="max-width: 200px;">
                         <br>
                         <a href="<?php echo base_url('uploads/staff/additionalqualification/' . $cnt['additionalqualification']); ?>" target="_blank">View</a>
                       <?php else : ?>
                         <span>No Additional Qualification uploaded</span>
                       <?php endif; ?>
                     </div> -->

                  <!-- <div class="form-group col-md-14">
                       <input type="file" name="additionalqualification" class="form-control">
                       <label class="custom-file-label" for="additionalqualification">Uploaded file <?php echo $cnt['additionalqualification']; ?></label>
                     </div> -->
                </div>
              </div>
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
<!-- Modal -->
<div id="myModal_image" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Image Upload</h4>
      </div>
      <div class="modal-body">
        <form id="form_upload">
          <div class="form-group col-md-13">
            <label class="custom-file-label" for="birthcertificate">Uploaded file <?php echo $cnt['birthcertificate']; ?></label>
            <input type="file" name="Upload_image" id="upload_image_file" class="form-control">

          </div>
        </form>
        <input type="hidden" id="image_type" name="">
        <button type="button" onclick="upload_image()" class="btn btn-primary">Upload</button>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  function load_image_upload_modal(type) {

    $('#image_type').val(type);
    $('#myModal_image').modal('show');
  }

  function upload_image() {
    var image_name = $('#upload_image_file').val();
    var image_type = $('#image_type').val();
    if (image_name == "") {
      Swal.fire({
        title: "The Image?",
        text: "Please attach a image",
        icon: "question"
      });
      return false;
    }
    Swal.fire({
      imageUrl: '<?= base_url() ?>assets/upload_image/200.gif',
      imageHeight: 200,
      imageAlt: 'A tall image',
      showCancelButton: false,
      showConfirmButton: false,
      title: 'Uploading Image',
    })
    var formData = new FormData($("#form_upload")[0]);
    $.ajax({
      type: 'ajax',
      method: 'POST',
      url: "<?php echo base_url() ?>staff/upload_image",
      // async:false,
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      error: function() {
        swal.close()
        Swal.fire({

          icon: 'error',
          title: 'Upload Fail',
          showConfirmButton: false,
          timer: 1500
        })
      },
      success: function(data) {
        swal.close()
        $('#myModal_image').modal('hide');
        $('#image_type').val('');
        // $('#upload_image_file').val('No file selected');
        if (data.Status == 2) {
          html = '<div id="image_div' + image_type + '" class="col-md-2">' +
            '<input type="hidden" value="' + data.FileName + '" name="image[' + image_type + '][]">' +
            '<a target="_blank" href="<?= base_url() ?>uploads/staff_new/' + data.FileName + '" class="btn btn-primary">View</a>' +
            '<button type="button" id="image_remove' + image_type + '" class="btn btn-danger">Remove</button>' +
            '</div>';

          $('#image_div' + image_type).append(html);
        } else {
          Swal.fire({

            icon: 'error',
            title: 'Upload Fail',
            showConfirmButton: false,
            timer: 1500
          })
        }

      }
    });

  }
  $(document).on('click', '#image_remove1', function() {
    $(this).closest('#image_div1').remove();
  });

  $(document).on('click', '#image_remove2', function() {
    $(this).closest('#image_div2').remove();
  });

  $(document).on('click', '#image_remove3', function() {
    $(this).closest('#image_div3').remove();
  });


  $(document).on('click', '#image_remove4', function() {
    $(this).closest('#image_div4').remove();
  });

  $(document).on('click', '#image_remove5', function() {
    $(this).closest('#image_div5').remove();
  });

  $(document).on('click', '#image_remove6', function() {
    $(this).closest('#image_div6').remove();
  });

  $(document).on('click', '#image_remove7', function() {
    $(this).closest('#image_div7').remove();
  });

  $(document).on('click', '#image_remove8', function() {
    $(this).closest('#image_div8').remove();
  });

  $(document).on('click', '#image_remove9', function() {
    $(this).closest('#image_div9').remove();
  });

  $(document).on('click', '#image_remove10', function() {
    $(this).closest('#image_div10').remove();
  });

  $(document).on('click', '#image_remove11', function() {
    $(this).closest('#image_div11').remove();
  });
</script>