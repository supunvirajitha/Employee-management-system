<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Staff
        </h1>
        <ol class="breadcrumb">
            <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="http://localhost/EMS-CI/manage-staff">Staff Management</a></li>
            <li class="active">Manage Staff</li>
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
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Manage Staff</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered bg-light" style="background-color:#ffffff">

                                <thead>
                                    <th>
                                    <th>

                                        <form action="<?php echo base_url('staff/search'); ?>" method="get" class="sidebar-form">
                                            <div class="input-group">
                                                <input type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="form-control" style="width: 190px;" placeholder="Search Employee Number... ">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-flat" style="padding: 5px 10px;">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                        <table>
                                            <tbody>

                                        </table>
                                    </th>
                                    </th>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Number</th>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Department</th>
                                        <th>Gender</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>DOB</th>
                                        <th>Birth Certificate</th>
                                        <th>Leaving Certificate</th>
                                        <th>Joined On</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Country</th>

                                        <!-- . -->
                                        <th>Duty</th>
                                        <th>Remark</th>
                                        <th>NIC</th>
                                        <th>ID-Photo</th>
                                        <th>B Card photo</th>
                                        <th>EPF</th>
                                        <th>2nd Language</th>
                                        <th>Sub Division</th>
                                        <th>Civil Status</th>
                                        <th>Computer Literacy</th>
                                        <th>Olevel Results</th>
                                        <th>Results Sheet</th>
                                        <th>Alevel Streams</th>
                                        <th>Alevel Results</th>
                                        <th>Results Sheet</th>
                                        <th>Higher Education qualification</th>
                                        <th>Higher Education qualification</th>
                                        <th>Professional qualification</th>
                                        <th>Professional qualification</th>
                                        <th>Additional Qualification</th>
                                        <th>Additional Qualification</th>
                                        <th>Professional Membership</th>
                                        <th>Appointment letter</th>

                                        <!-- <th>EB Exam Certificate</th> -->
                                        <!-- <th>Other qualification</th> -->

                                        <!-- .-->

                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($content)) :
                                        $i = 1;
                                        foreach ($content as $cnt) :

                                            $imgs = $this->Staff_model->get_staff_imgs($cnt['id']);
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $cnt['employee_num']; ?></td>
                                                <td><?php echo $cnt['staff_name']; ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 1) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                            <!-- <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image"> -->

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/profile-pic/<?php echo $cnt['pic'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>
                                                <td><?php echo $cnt['department_name']; ?></td>
                                                <td><?php echo $cnt['gender']; ?></td>
                                                <td><?php echo $cnt['mobile']; ?></td>
                                                <td><?php echo $cnt['email']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($cnt['dob'])); ?></td>


                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 7) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                            <!-- <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image"> -->

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/birthcertificate/<?php echo $cnt['birthcertificate'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>

                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 8) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                            <!-- <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image"> -->

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/leavingcertificate/<?php echo $cnt['leavingcertificate'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>

                                                <td><?php echo date('d-m-Y', strtotime($cnt['doj'])); ?></td>
                                                <td><?php echo $cnt['address']; ?></td>
                                                <td><?php echo $cnt['city']; ?></td>
                                                <td><?php echo $cnt['state']; ?></td>
                                                <td><?php echo $cnt['country']; ?></td>
                                                <!--. -->
                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 2) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                            <!-- <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image"> -->

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/duty/<?php echo $cnt['duty'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>
                                                <td><?php echo $cnt['remark']; ?></td>
                                                <td><?php echo $cnt['nic']; ?></td>


                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 5) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/idphotofront/<?php echo $cnt['idphotofront'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 6) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/bcardphoto/<?php echo $cnt['bcardphoto'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>

                                                <td><?php echo $cnt['epf']; ?></td>
                                                <td><?php echo $cnt['language']; ?></td>
                                                <td><?php echo $cnt['sdivision']; ?></td>
                                                <td><?php echo $cnt['civil']; ?></td>
                                                <td><?php echo $cnt['clitteracy']; ?></td>
                                                <td><?php echo $cnt['ol']; ?></td>

                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 3) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/ols/<?php echo $cnt['ols'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>
                                                <td><?php echo $cnt['alstream']; ?></td>
                                                <td><?php echo $cnt['al']; ?></td>

                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 4) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/als/<?php echo $cnt['als'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>

                                                <td><?php echo $cnt['hq']; ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 9) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/highereducationqualification/<?php echo $cnt['highereducationqualification'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>
                                                <td><?php echo $cnt['pq']; ?></td>

                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 10) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/profesionalqualification/<?php echo $cnt['profesionalqualification'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>

                                                <td><?php echo $cnt['aq']; ?></td>

                                                <td>
                                                    <?php
                                                    foreach ($imgs as $img) {
                                                        if ($img->type == 11) {
                                                    ?>
                                                            <img src="<?php echo base_url(); ?>uploads/staff_new/<?php echo $img->file_name ?>" class="img-circle" width="50px" alt="User Image">

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <img src="<?php echo base_url(); ?>uploads/staff/additionalqualification/<?php echo $cnt['additionalqualification'] ?>" class="img-circle" width="50px" alt="User Image"> -->
                                                </td>

                                                <td><img src="<?php echo base_url(); ?>uploads/staff/appointmentletter/<?php echo $cnt['appointmentletter'] ?>" class="img-circle" width="50px" alt="User Image"></td>

                                                <td><img src="<?php echo base_url(); ?>uploads/staff/professionalmembership/<?php echo $cnt['professionalmembership'] ?>" class="img-circle" width="50px" alt="User Image"></td>



                                                <!-- <td><img src="<?php echo base_url(); ?>uploads/grade/ebexamcertificate/<?php echo $cnt['ebexamcertificate'] ?>"
                                                class="img-circle" width="50px" alt="User Image"></td> -->
                                                <!-- <td><?php echo $cnt['qq']; ?></td> -->
                                                <!-- . -->
                                                <td>
                                                    <a href="<?php echo base_url(); ?>edit-staff/<?php echo $cnt['id']; ?>" class="btn btn-success">Edit</a>
                                                    <a href="<?php echo base_url(); ?>delete-staff/<?php echo $cnt['id']; ?>" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        endforeach;
                                    endif;
                                    ?>

                                </tbody>

                                <!-- Report -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-xs-12">

                                        <button type="button" id="cmd1" class="btn btn-info"><i class="fa fa-print" style="margin-right: 5px;">
                                            </i>Generate Excel</button><br></br>

                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
                                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

                                        <script>
                                            $(document).ready(function() {
                                                $('#cmd1').click(function() {
                                                    /* Assuming you have a table with id 'example2' that you want to export */
                                                    var table = document.getElementById('example1');
                                                    var ws = XLSX.utils.table_to_sheet(table);
                                                    var wb = XLSX.utils.book_new();
                                                    XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

                                                    /* Create and download the Excel file */
                                                    XLSX.writeFile(wb, 'staff.xlsx');
                                                });
                                            });
                                        </script>
                                        <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                            </button> -->
                                        <a href="<?php echo base_url(); ?>staff-print">
                                            <button type="button" id="" class="btn btn-danger pull-right" style="margin-right: 5px;">
                                                <i class="fa fa-download"></i> View PDF

                                            </button><br></br>
                                    </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <script>
        $(document).ready(function() {
            var doc = new jsPDF("l", "pt", "letter");
            $('#cmd').click(function() {
                let doc = new jsPDF('p', 'pt', 'a4');
                doc.addHTML($('#example1'), function() {
                    doc.save('Grade.pdf');
                });
            });
        });
    </script>

    <!-- Include the TCPDF library -->
    <!-- <script src="path/to/tcpdf/tcpdf.js"></script>
                           <script>
                                $(document).ready(function() {
                              $('#cmd').click(function () {
                            // Create new PDF document
                             var doc = new jsPDF();

                             // Add content to the PDF
                            // You can customize the content as per your requirements
                              doc.text(20, 20, 'Staff Report');
                              

                                // Save the PDF
                               doc.save('staff_report.pdf');
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