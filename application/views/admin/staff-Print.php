  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staff Print
      </h1>
      <ol class="breadcrumb">
        <li><a href="http://localhost/EMS-CI/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="http://localhost/EMS-CI/manage-salary">Salary Management</a></li>
        <li class="active">Staff</li>
      </ol>
      <div class="clearfix"></div>
    </section>
    
    <div class="box-body">
      
      
    
              <div class="table-responsive">       
                <table id="example1" class="table table-bordered bg-light" style="background-color:#ffffff">                
                  <thead>               
                  <!-- <th><h4><b>Employee&nbsp;Management&nbsp;System</h4>Staff&nbsp;Report</b></th>          -->
        </div>  
        
                            
        <!-- /.col -->
      </div>
      <th>
                                <th>
                                         
                                
       
                  <tr>
                    
                    
                    <th>#</th>
                    <th>Employee Number</th>
                    <th>Name</th> 
                    <th>Department</th>
                    <th>Sub Division</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>Email</th>                   
                    <th>Address</th>
                    <th>NIC</th>                   
                    
                    <th>Alevel Streams</th>
                                      
                    <!-- <th>Other qualification</th> -->

                    <!-- .-->

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
                        <td><?php echo $cnt['department_name']; ?></td>
                        <td><?php echo $cnt['sdivision']; ?></td>
                        <td><?php echo $cnt['gender']; ?></td>
                        <td><?php echo $cnt['mobile']; ?></td>
                        <td><?php echo $cnt['email']; ?></td> 
                        <td><?php echo $cnt['address']; ?></td>
                        <td><?php echo $cnt['nic']; ?></td>
                        
                        <td><?php echo $cnt['alstream']; ?></td> 
                                                                                    
                        <!-- . -->
                        
                    <?php 
                      $i++;
                      endforeach;
                      endif; 
                    ?>
                  
                  </tbody>
                  

                  </div>
                  
                      </section>
                      <div>
                     <div>
                            <a href="<?php echo base_url(); ?>staff-print">
                            <button type="button" id="cmd" class="btn btn-danger pull-right" style="margin-right: 5px;">
                              <i class="fa fa-download"></i> Generate PDF
                            </button>
                            </a>
                    </div> 
                    </div>
                           
                    <br><br>
                            <div>
                             <div>                                                     
                             <!-- <form id="searchForm" action="<?php echo base_url('staff/search'); ?>" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" id="searchInput" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="form-control" style="width: 190px;" placeholder="Search Employee Number... ">
        <span class="input-group-btn">
            <button type="button" id="searchButton" class="btn btn-flat" style="padding: 5px 10px;">
                Search
            </button>
        </span>
    </div>
</form> -->


</div>
</div>
                     

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>

                    
                    <script>
                   $(document).ready(function() {
    var doc = new jsPDF("l", "pt", "a4"); // Set page layout to A4
    var defaultCellWidth = 75; // Default width of each cell
    var idWidth = 75; // Width for the 'id' column
    var addressWidth = 75; // Width for the 'address' column
    

    $('#cmd').click(function () {

      doc.setFontSize(15); // Set font size for the heading
        doc.text("Employee Management System (Staff Report)", 50, 30 );

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
                doc.text(headers[i], 15 + (i *  addressWidth), y);
            } else if (headers[i] === 'address') {
                doc.text(headers[i], 15 + (i *  addressWidth), y);
            } else {
                doc.text(headers[i], 15 + (i *  addressWidth), y);
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

            y += (rowHeight > 20) ? rowHeight : 20; // Add some padding between rows
        });

        // Save the PDF
        doc.save('Staff.pdf');
    });
});
                    </script>

  <!-- /Report -->
  </table>
             
          
  
    


















    
  


