<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Promotion
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/manage-promotion">Promotion</a></li>
        <li class="active">Manage Promotion</li>
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

        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Promotion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Employee Number</th>
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Duration</th>
                      <th>From</th>
                      <th>End</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 

                    // if(isset($_GET['date']) && $_GET['date'] !='' && isset($_GET['status']) && $_GET['status'] !=''){

                    //   $date = validate($_GET['date']);
                    //   $status = validate($_GET['status']);
                    //   $promotion_tbl = mysqli_query($conn,"SELECT * FROM promotion_tbl WHERE desifd='$date' AND status='$status' ORDER BY id DESC");
                    // }else {
                    //   $promotion_tbl = mysqli_query($conn,"SELECT * FROM promotion_tbl ORDER BY id DESC");
                    // }
                     



                      if(isset($content)):
                      $i=1; 
                      foreach($content as $cnt): 
                    ?>  
                        <tr>
                          <td><?php echo $i; ?></td>
                           <!-- <td><?php echo $cnt['employee_num']; ?></td> -->
                         <td><?php echo isset($cnt['employee_num']) ? $cnt['employee_num'] : ''; ?></td>
                          <td><?php echo $cnt['staff_name']; ?></td>
                          <td><?php echo $cnt['designation']; ?></td>
                          <td><?php echo $cnt['desiduration']; ?></td>
                          <td><?php echo $cnt['desifd']; ?></td>
                          <td><?php echo $cnt['desitd']; ?></td>
                          <td><?php echo $cnt['status']; ?></td>
                          <td>
                            <a href="<?php echo base_url(); ?>edit-promotion/<?php echo $cnt['id']; ?>" class="btn btn-success">Edit</a>
                            <a href="<?php echo base_url(); ?>delete-promotion/<?php echo $cnt['id']; ?>" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                      <?php 
                        $i++;
                        endforeach;
                        endif; 
                      ?>
                    
                    </tbody>
                    <!-- Report -->



    <!-- <form action="" method="GET">
      <div class="row">
        <div class="col-md-4">
          <input type="date" name="date" required value="<?= isset($_GET['date']) == true ? $_GET['date']:''?>" class="form-control">
        </div>
        <div class="col-md-4">
          <select name="status" required class="form-select">
            <option value="">Select Status </option>
            <option value="yes" <?= isset($_GET['status']) == true ? ($_GET['status'] == 'yes' ? 'selected':''):''?>>Yes </option>
            <option value="no"  <?= isset($_GET['status']) == true ? ($_GET['status'] == 'no ' ? 'selected':''):''?>>No </option>
           
          </select>
      </div>
      <div class="col-md-4">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="manage-promotion" class="btn btn-danger">Reset</a>
      </div>
                      </form>
     -->


                    <div>
                      <form method="post">
                         <label for="from">From</label>
                             <input type="text" id="from" name="from" required>
                             <label for="to">to</label>
                             <input type="text" id="to" name="to" required>
                             <input type="submit" name="submit" value="Filter" class="btn btn-primary">
                             <a href="manage-promotion" class="btn btn-danger">Reset</a>
                      </form>
                    </div>
                    <br></br>

                               <?php
                                  $cnt=mysqli_connect('localhost','root');
                                  $sub_sql="";
                                       if (isset($_POST['submit'])){
                                             $from=$_POST['from'];
                                             $fromArr=explode("/",$from);
                                             $from=$fromArr['2'].'-'.$fromArr['0'].'-'.$fromArr['1'];
     
                                             $to=$_POST['to'];  
                                             $toArr=explode("/",$to);
                                             $to=$toArr['2'].'-'.$toArr['0'].'-'.$toArr['1'];

                                             $sub_sql= "where desifd >= '$from' $$ desifd <='to' ";
                                       }
                                 ?>


                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <title>jQuery UI Datepicker - Select a Date Range</title>
                            <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                            <link rel="stylesheet" href="/resources/demos/style.css">
                            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



                                   <script>
                                      $( function() {
                                        var dateFormat = "dd/mm/yy",
                                          from = $( "#from" )
                                            .datepicker({
                                              defaultDate: "+1w",
                                              changeMonth: true,
                                              numberOfMonths: 1,
                                              dateFormat:"dd/mm/yy",
                                            })
                                            .on( "change", function() {
                                              to.datepicker( "option", "minDate", getDate( this ) );
                                            }),
                                          to = $( "#to" ).datepicker({
                                            defaultDate: "+1w",
                                            changeMonth: true,
                                            numberOfMonths: 1,
                                            dateFormat:"dd/mm/yy",
                                          })
                                          .on( "change", function() {
                                            from.datepicker( "option", "maxDate", getDate( this ) );
                                          });
                                     
                                        function getDate( element ) {
                                          var date;
                                          try {
                                            date = $.datepicker.parseDate( dateFormat, element.value );
                                          } catch( error ) {
                                            date = null;
                                          }
                                     
                                          return date;
                                        }
                                      } );
                                      </script>
                                     



















                        
                            <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                            </button> -->
                            <a href="<?php echo base_url(); ?>promotion-print">
                            <button type="button" id="cmd" class="btn btn-danger pull-right" style="margin-right: 5px;">
                              <i class="fa fa-download"></i> View PDF
                            </button>
                        </div>
                      </section>






                     
                     

                    

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

    