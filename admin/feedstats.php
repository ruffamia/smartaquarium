<?php 
require "head/header.php";

?>
<style>
      html {font-family: Arial; display: inline-block; text-align: center;}
      p {font-size: 1.2rem;}
      h4 {font-size: 0.8rem;}
      body {margin: 0;}
      /* ----------------------------------- TOPNAV STYLE */
      .topnav {overflow: hidden; background-color: #0c6980; color: white; font-size: 1.2rem;}
      /* ----------------------------------- */
      
      /* ----------------------------------- TABLE STYLE */
      .styled-table {
        border-collapse: collapse;
        margin-left: auto; 
        margin-right: auto;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 0.5em;
        overflow: hidden;
        width: 90%;
      }

      .styled-table thead tr {
        background-color: #0c6980;
        color: #ffffff;
        text-align: left;
      }

      .styled-table th {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table td {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
      }

      .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
      }

      .bdr {
        border-right: 1px solid #e3e3e3;
        border-left: 1px solid #e3e3e3;
      }
      
      td:hover {background-color: rgba(12, 105, 128, 0.21);}
      tr:hover {background-color: rgba(12, 105, 128, 0.15);}
      .styled-table tbody tr:nth-of-type(even):hover {background-color: rgba(12, 105, 128, 0.15);}
      /* ----------------------------------- */
      
      /* ----------------------------------- BUTTON STYLE */
      .btn-group .button {
        background-color: #0c6980; /* Green */
        border: 1px solid #e3e3e3;
        color: white;
        padding: 5px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        float: center;
      }

      .btn-group .button:not(:last-child) {
        border-right: none; /* Prevent double borders */
      }

      .btn-group .button:hover {
        background-color: #094c5d;
      }

      .btn-group .button:active {
        background-color: #0c6980;
        transform: translateY(1px);
      }

      .btn-group .button:disabled,
      .button.disabled{
        color:#fff;
        background-color: #a0a0a0; 
        cursor: not-allowed;
        pointer-events:none;
      }
      /* ----------------------------------- */
    </style>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                   
                </div>
            </li>

            <!-- Nav Item - Alerts -->
            

            <!-- Nav Item - Messages -->
            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['email']; ?></span>
                    <img class="img-profile rounded-circle"
                        src="undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal" >
                    
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Feeding Data Records</h1>
        </div>

       

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            
        </div>

        <!-- Content Row -->
        <div class="row" style="overflow-x:auto;">

        <table class="styled-table" id= "table_id">
      <thead>
        <tr>
          <th>NO</th>
          <!-- <th>ID</th>
          <th>BOARD</th> -->
          <th>FEED STATUS</th>
          <!-- <th>AMMONIA</th>
          <th>PH LEVEL</th> -->
          <!-- <th>LED 01</th>
          <th>LED 02</th> -->
          <th>TIME</th>
          <th>DATE</th>
        </tr>
      </thead>
      <tbody id="tbody_table_record">
        <?php
          include 'database.php';
          $num = 0;
          //------------------------------------------------------------ The process for displaying a record table containing the DHT11 sensor data and the state of the LEDs.
          $pdo = Database::connect();
          // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
          // This table is used to store and record DHT11 sensor data updated by ESP32. 
          // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
          // To store data, this table is operated with the "INSERT" command, so this table will contain many rows.
          // $sql = 'SELECT * FROM table_sensor ORDER BY date, time DESC';
          $sql = 'SELECT * FROM table_sensor where LED_01 = "ON" AND stat = "SUCCESS" ORDER BY date, time DESC';
          foreach ($pdo->query($sql) as $row) {
            $date = date_create($row['date']);
            $dateFormat = date_format($date,"d-m-Y");
            $num++;
            echo '<tr>';
            echo '<td>'. $num . '</td>';
            // echo '<td class="bdr">'. $row['id'] . '</td>';
            // echo '<td class="bdr">'. $row['board'] . '</td>';
            echo '<td class="bdr">'. $row['stat'] . '</td>';
            // echo '<td class="bdr">'. $row['ammonia'] . '</td>';
            // echo '<td class="bdr">'. $row['phlvl'] . '</td>';
            // echo '<td class="bdr">'. $row['LED_01'] . '</td>';
            // echo '<td class="bdr">'. $row['LED_02'] . '</td>';
            echo '<td class="bdr">'. $row['time'] . '</td>';
            echo '<td>'. $dateFormat . '</td>';
            echo '</tr>';
          }
          Database::disconnect();
          //------------------------------------------------------------
        ?>
      </tbody>
    </table>  
      
    </div>

    </div>
    <div class="btn-group">
      <button class="button" id="btn_prev" onclick="prevPage()">Prev</button>
      <button class="button" id="btn_next" onclick="nextPage()">Next</button>
      <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; float: center; margin-left: 2px;;">
        <p style="position:relative; font-size: 14px;"> Table : <span id="page"></span></p>
      </div>
      <select name="number_of_rows" id="number_of_rows">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select>
      <button class="button" id="btn_apply" onclick="apply_Number_of_Rows()">Apply</button>
    </div>

    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Automatic Fish Feeder IOT 2024</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
    </div>
</div>
</div>
</div>
<script>
      //------------------------------------------------------------
      var current_page = 1;
      var records_per_page = 10;
      var l = document.getElementById("table_id").rows.length
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function apply_Number_of_Rows() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function prevPage() {
        if (current_page > 1) {
            current_page--;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function nextPage() {
        if (current_page < numPages()) {
            current_page++;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function changePage(page) {
        var btn_next = document.getElementById("btn_next");
        var btn_prev = document.getElementById("btn_prev");
        var listing_table = document.getElementById("table_id");
        var page_span = document.getElementById("page");
       
        // Validate page
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        [...listing_table.getElementsByTagName('tr')].forEach((tr)=>{
            tr.style.display='none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (var i = (page-1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
          if (listing_table.rows[i]) {
            listing_table.rows[i].style.display = ""
          } else {
            continue;
          }
        }
          
        page_span.innerHTML = page + "/" + numPages() + " (Total Number of Rows = " + (l-1) + ") | Number of Rows : ";
        
        if (page == 0 && numPages() == 0) {
          btn_prev.disabled = true;
          btn_next.disabled = true;
          return;
        }

        if (page == 1) {
          btn_prev.disabled = true;
        } else {
          btn_prev.disabled = false;
        }

        if (page == numPages()) {
          btn_next.disabled = true;
        } else {
          btn_next.disabled = false;
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function numPages() {
        return Math.ceil((l - 1) / records_per_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      window.onload = function() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      };
      //------------------------------------------------------------
    </script>
<?php 
require "head/footer.php";

?>