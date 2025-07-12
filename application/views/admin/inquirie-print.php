<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Inquirie
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/manage-inquirie">Inquirie</a></li>
        <li class="active">Manage Inquirie</li>
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
              <h3 class="box-title">Manage Inquirie</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="table-responsive">
                  <table id="example1" class="table display nowrap table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Employee Number</th>
                      <th>Name</th>
                      <th>Inquirie Note</th>
                      <th>Inquirie Date</th>
                      
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
                          
                         <td><?php echo isset($cnt['employee_num']) ? $cnt['employee_num'] : ''; ?></td>
                          <td><?php echo $cnt['staff_name']; ?></td>
                          <td><?php echo $cnt['inquirienote']; ?></td>
                          <td><?php echo $cnt['inquiriedate']; ?></td>
                          
                        </tr>
                      <?php 
                        $i++;
                        endforeach;
                        endif; 
                      ?>
                  
                  </tbody>
                 
                        </div>
                      </section>
                  

                    </script>












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
    var defaultCellWidth = 150; // Default width of each cell
    var idWidth = 30; // Width for the 'id' column
    var addressWidth = 130; // Width for the 'address' column
    

    $('#cmd').click(function () {
      
      doc.setFontSize(15); // Set font size for the heading
        doc.text("Employee Management System (Inquirie Report)", 50, 30 );

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
                y = 50; // Reset y position for the new page
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

            y += (rowHeight > 70) ? rowHeight : 70; // Add some padding between rows
        });

        // Save the PDF
        doc.save('Inquirie.pdf');
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

    