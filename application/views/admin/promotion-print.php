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
            
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="table-responsive">
                  <table id="example1" class="table table-bordered bg-light "style="background-color:#ffffff">
                    <thead>
                    <!-- <th><h4><b>Employee&nbsp;Management&nbsp;System</h4>Promotion</b></th> -->
                    <tr>
                      <th>#</th>
                      <th>Employee Number</th>
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Duration</th>
                      <th>From</th>
                      <th>End</th>
                      <th>Status</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
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
                          
                          
                        </tr>
                      <?php 
                        $i++;
                        endforeach;
                        endif; 
                      ?>
                    
                    </tbody>
                    <!-- Report -->





                <!-- <style>
                @media print {
                @page {
                 size: A3;
        }
    }
</style> -->

                  <!-- this row will not appear when printing -->


                  <!-- <div class="row no-print">
    <div class="col-xs-12">
        <script>
            function printCurrentPage() {
                window.print();
            }
        </script>

        <?php
        if(isset($_POST['print'])) {
            echo '<script>printCurrentPage();</script>';
        }
        ?>

        <form method="post">
            <button type="submit" name="print" class="btn btn-info"><i class="fa fa-print"></i>Print</button>
        </form>
    </div>
</div> -->


         







<div>
                      <form method="post">
                         <label for="from">From</label>
                             <input type="text" id="from" name="from" required>
                             <label for="to">to</label>
                             <input type="text" id="to" name="to" required>
                             <input type="submit" name="submit" value="Filter" class="btn btn-primary">
                             <a href="promotion-print" class="btn btn-danger">Reset</a>
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
                            
                            <button type="button" id="cmd" class="btn btn-danger pull-right" style="margin-right: 5px;">
                              <i class="fa fa-download"></i> Generate PDF
                            </button>
                        </div>
                      </section>
                     

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>  
                    
                    <script>

$(document).ready(function() {
    var doc = new jsPDF("l", "pt", "a4"); // Set page layout to A4
    var defaultCellWidth = 105; // Default width of each cell
    var idWidth = 30; // Width for the 'id' column
    var addressWidth = 120; // Width for the 'address' column
    

    $('#cmd').click(function () {
      
      doc.setFontSize(15); // Set font size for the heading
        doc.text("Employee Management System (Promotion Report)", 50, 30 );

        let contentElement = $('#example1')[0];
        let pageHeight = doc.internal.pageSize.height;
        let y = 70; // Initial y position for the content

        
        
        

        doc.setFontSize(10);

        // Get column headers
        let headers = [];
        $('#example1 thead th').each(function(index, element) {
            headers.push($(element).text().toLowerCase()); // Convert header text to lowercase for comparison
        });

        // Add column headers
        for (let i = 0; i < headers.length; i++) {
            if (headers[i] === 'id') {
                doc.text(headers[i], 15 + (i * defaultCellWidth), y);
            } else if (headers[i] === 'address') {
                doc.text(headers[i], 15 + (i * defaultCellWidth), y);
            } else {
                doc.text(headers[i], 15 + (i * defaultCellWidth), y);
            }
        }

        y += 30; // Add padding after headers

        // Iterate through each row and add to the PDF
        $('#example1 tbody tr').each(function(index, element) {
            let rowHeight = $(element).height();

            if (y + rowHeight > pageHeight) {
                doc.addPage(); // Add new page if the row won't fit
                y = 30; // Reset y position for the new page
            }

            let cellIndex = 0;
            $(element).find('td').each(function(index, cell) {
                // Only consider specific columns: Id, name, department, gender, mobile, email, address, nic, sub division
                let cellWidth = defaultCellWidth; // Default width for cell
                if (cellIndex === 0) {
                    cellWidth = defaultCellWidth;
                } else if (cellIndex === 7) {
                    cellWidth = defaultCellWidth;
                }
                
                let text = $(cell).text();
                let textLines = doc.splitTextToSize(text, cellWidth);
                doc.text(textLines, 10 + (cellIndex * cellWidth), y);
                cellIndex++;
            });

            y += (rowHeight > 70) ? rowHeight + 10 : 80; // Add some padding between rows
        });

        // Save the PDF
        doc.save('Promotion.pdf');
    });
});

</script>

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

    