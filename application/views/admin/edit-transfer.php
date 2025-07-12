<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit Transfer</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('manage-transfer'); ?>">Transfer</a></li>
            <li class="active">Edit Transfer</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Transfer</h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="<?php echo base_url('transfer/update'); ?>" method="POST">
                        <div class="box-body">
                            <?php foreach ($content as $cnt) : ?>
                                <input type="hidden" name="txtid" value="<?php echo $cnt['id']; ?>">
                                <div class="form-group">
                                    <!-- <label>Name</label> -->
                                    <input type="hidden" name="txtname" class="form-control" value="<?php echo $cnt['name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Employee Number</label>
                                    <input type="text" name="txtemployee_num" class="form-control" value="<?php echo $cnt['employee_num']; ?>">
                                </div>

                                <label>Type<span style="color: red;">*</span></label>
                      <select class="form-control" name="txtttype">
                        <option value="">Select</option>
                        <option value="Transfer" <?php echo ($cnt['ttype'] == 'Transfer') ? 'selected' : ''; ?>>Transfer</option>
                        <option value="Retirement" <?php echo ($cnt['ttype'] == 'Retirement') ? 'selected' : ''; ?>>Retirement</option>
                        <option value="Leave" <?php echo ($cnt['ttype'] == 'Leave') ? 'selected' : ''; ?>>Leave</option>
                        <option value="Other" <?php echo ($cnt['ttype'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                      </select>


                      <label>Division<span style="color: red;">*</span></label>
                      <select class="form-control" name="txtdepartment_tid">
                        <option value="">Select</option>
                        <option value="HR & Admin" <?php echo ($cnt['department_tid'] == 'HR & Admin') ? 'selected' : ''; ?>>HR & Admin</option>
                        <option value="IT" <?php echo ($cnt['department_tid'] == 'IT') ? 'selected' : ''; ?>>IT</option>
                        <option value="Finance" <?php echo ($cnt['department_tid'] == 'Finance') ? 'selected' : ''; ?>>Finance</option>
                        <option value="Marcketing" <?php echo ($cnt['department_tid'] == 'Marcketing') ? 'selected' : ''; ?>>Marcketing</option>
                      </select>

                                
                                

                        <label>Sub Division<span style="color: red;">*</span></label>
                        <select class="form-control" name="txtsdivision">
                        <option value="">Select</option>
                        <option value="Transport" <?php echo ($cnt['sdivision'] == 'Transport') ? 'selected' : ''; ?>>Transport</option>
                        <option value="Hr & Admin" <?php echo ($cnt['sdivision'] == 'Hr & Admin') ? 'selected' : ''; ?>>Hr & Admin</option>
                        <option value="Chariman Division" <?php echo ($cnt['sdivision'] == 'Chariman Division') ? 'selected' : ''; ?>>Chariman Division</option>
                        <option value="Sales" <?php echo ($cnt['sdivision'] == 'Sales') ? 'selected' : ''; ?>>Sales</option>
                        <option value="Marketing" <?php echo ($cnt['sdivision'] == 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
                        <option value="MOU" <?php echo ($cnt['sdivision'] == 'MOU') ? 'selected' : ''; ?>>MOU</option>
                        <option value="Counter" <?php echo ($cnt['sdivision'] == 'Counter') ? 'selected' : ''; ?>>Counter</option>
                        <option value="IT" <?php echo ($cnt['sdivision'] == 'IT') ? 'selected' : ''; ?>>IT</option>
                        <option value="Return" <?php echo ($cnt['sdivision'] == 'Return') ? 'selected' : ''; ?>>Return</option>
                        <option value="Sub Store" <?php echo ($cnt['sdivision'] == 'Sub Store') ? 'selected' : ''; ?>>Sub Store</option>
                        
                      </select>

                                    <label>From<span style="color: red;">*</span></label>
                                    <input type="date" name="txttransferfd" value="<?php echo $cnt['transferfd']; ?>" class="form-control" placeholder="From">

                                     <label>To</label>
                                     <input type="date" name="txttransfertd" value="<?php echo $cnt['transfertd']; ?>" class="form-control" placeholder="To">

                                     <label>Note</label>
                                    <textarea class="form-control" name="txtdis"><?php echo $cnt['dis'] ?></textarea>

                                <!-- Add other form fields for editing -->
                            <?php endforeach; ?>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
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
