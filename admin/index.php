<?php 
require "head/header.php";

?>
<style>
          .content {padding: 5px; }
      .card {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #0c6980; border-radius: 15px;}
      .card.header {background-color: #0c6980; color: white; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 12px; border-top-left-radius: 12px;}
      .cards {max-width: 1024px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));}
      .carding {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #0c6980; border-radius: 130px;}
    .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}
.chart {
  width: 100%; 
  min-height: 450px;
}
.row {
  margin:0 !important;
}

.switch input {display:none;}

.sliderTS {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #D3D3D3;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 34px;
}

.sliderTS:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 4px;
  background-color: #f7f7f7;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .sliderTS {
  background-color: #00878F;
}

input:focus + .sliderTS {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .sliderTS:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.sliderTS:after {
  content:'OFF';
  color: white;
  display: block;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 70%;
  font-size: 10px;
  font-family: Verdana, sans-serif;
}

input:checked + .sliderTS:after {  
  left: 25%;
  content:'ON';
}

input:disabled + .sliderTS {  
  opacity: 0.3;
  cursor: not-allowed;
  pointer-events: none;
}
.reading {font-size: 1.3rem;}
.packet {color: #bebebe;}
.temperatureColor {color: #fd7e14;}
.humidityColor {color: #1b78e2;}
.phColor {color: #2bed5b;}
.statusreadColor {color: #702963; font-size:12px;}
.LEDColor {color: #183153;}

.chartMenu {
        width: 100vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(54, 162, 235, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 80vw;
        /* height: calc(100vh - 40px); */
        /* background: rgba(54, 162, 235, 0.2); */
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 400px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 1);
        background: white;
      }
</style>

<?php 
$con =new mysqli ('localhost','root','','sus');
$query= $con->query("SELECT date as monthname,temperature as amount FROM table_sensor GROUP BY monthname");
foreach ($query as $data)
{
    $month[] = $data ['monthname'];
    $amount[]= $data ['amount'];
}

$query2= $con->query("SELECT date as monthname2,ammonia as amount2 FROM table_sensor GROUP BY monthname2");
foreach ($query2 as $data2)
{
    $month2[] = $data2 ['monthname2'];
    $amount2[]= $data2 ['amount2'];
}

$query3= $con->query("SELECT date as monthname3,phlvl as amount3 FROM table_sensor GROUP BY monthname3");
foreach ($query3 as $data3)
{
    $month3[] = $data3 ['monthname3'];
    $amount3[]= $data3 ['amount3'];
}

?>

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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                

                    
                    </div>

                    <!-- Content Row -->
                    <div class="content">
                    
                    <div class="col-md-6">
    
  </div>
  <!-- <div class="cards">
  <div id="chart_temperature" class="chart"></div>
  <div id="chart_ammonia" class="chart"></div>
  <div id="chart_ph" class="chart"></div>
  </div> -->

  <!-- <div class="chartCard"> -->
  <div class="cards">
    <canvas id="myChart"></canvas>
    </div>
    <div class="cards">
      <canvas id="myChart2"></canvas>
    </div>
    <div class="cards">
      <canvas id="myChart3"></canvas>
    </div>
  <!-- </div> -->

  <hr>
  

      <div class="cards">
        
        <!-- == MONITORING ======================================================================================== -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">TEMPERATURE</h3>
          </div>
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i>TEMPERATURE</h4>
          <p class="temperatureColor"><span class="reading"><span id="ESP32_01_Temp"></span> &deg;C</span></p>
        </div>
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">AMMONIA LEVEL</h3>
          </div>
          <!-- Displays the humidity and temperature values received from ESP32. *** -->
          <h4 class="humidityColor"><i class="fas fa-tint"></i> AMMONIA</h4>
          <p class="humidityColor"><span class="reading"><span id="ESP32_01_Humd"></span> &percnt;</span></p>
           </div>
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">PH LEVEL</h3>
          </div>
          <h4 class="phColor"><i class="fas fa-tint"></i> PH LEVEL</h4>
          <p class="phColor"><span class="reading"><span id="ESP32_01_Ph"></span> &percnt;</span></p>
        </div>
        <!-- ======================================================================================================= -->
        
        <!-- == CONTROLLING ======================================================================================== -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">MANUAL FEEDING</h3>
          </div>
          
          <!-- Buttons for controlling the LEDs on Slave 2. ************************** -->
          <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> FEED</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_01_TogLED_01" onclick="GetTogBtnLEDState('ESP32_01_TogLED_01')">
            <div class="sliderTS"></div>
          </label>
          <!-- <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 2</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_01_TogLED_02" onclick="GetTogBtnLEDState('ESP32_01_TogLED_02')">
            <div class="sliderTS"></div>
          </label> -->
          <!-- *********************************************************************** -->
        </div>  
        <!-- <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">AUTOMATIC FEEDING</h3>
          </div> -->
          
          <!-- Buttons for controlling the LEDs on Slave 2. ************************** -->
          <!-- <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> FEED</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_01_TogLED_01" onclick="GetTogBtnLEDState('ESP32_01_TogLED_01')">
            <div class="sliderTS"></div>
          </label> -->
          <!-- <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> FEED</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_01_TogLED_02" onclick="GetTogBtnLEDState('ESP32_01_TogLED_02')">
            <div class="sliderTS"></div>
          </label> -->
          <!-- *********************************************************************** -->
        <!-- </div>   -->
        <!-- ======================================================================================================= -->
        
      </div>
    </div>
    <br>
    
    <div class="content">
      <div class="cards">
        <div class="card header" style="border-radius: 15px;">
            <h3 style="font-size: 0.7rem;">LAST TIME RECEIVED DATA FROM CONTROL BOX [ <span id="ESP32_01_LTRD"></span> ]</h3>
            
            <h3 style="font-size: 0.7rem;"></h3>
        </div>
      </div>
    </div>


                    <!-- Content Row -->
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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
      document.getElementById("ESP32_01_Temp").innerHTML = "NN"; 
      document.getElementById("ESP32_01_Humd").innerHTML = "NN";
      document.getElementById("ESP32_01_Ph").innerHTML = "NN";
      document.getElementById("ESP32_01_LTRD").innerHTML = "NN";
    //   document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = "NN";
      
      //------------------------------------------------------------
      
      Get_Data("esp32_01");
      
      setInterval(myTimer, 5000);
      
      //------------------------------------------------------------
      function myTimer() {
        Get_Data("esp32_01");
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function Get_Data(id) {
				if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            const myObj = JSON.parse(this.responseText);
            if (myObj.id == "esp32_01") {
              document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
              document.getElementById("ESP32_01_Humd").innerHTML = myObj.ammonia;
              document.getElementById("ESP32_01_Ph").innerHTML = myObj.phlvl;
            //   document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;
              document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " ";
              if (myObj.LED_01 == "ON") {
                document.getElementById("ESP32_01_TogLED_01").checked = true;
              } else if (myObj.LED_01 == "OFF") {
                document.getElementById("ESP32_01_TogLED_01").checked = false;
              }
              if (myObj.LED_02 == "ON") {
                document.getElementById("ESP32_01_TogLED_02").checked = true;
              } else if (myObj.LED_02 == "OFF") {
                document.getElementById("ESP32_01_TogLED_02").checked = false;
              }
            }
          }
        };
        xmlhttp.open("POST","getdata.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id);
			}
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function GetTogBtnLEDState(togbtnid) {
        if (togbtnid == "ESP32_01_TogLED_01") {
          var togbtnchecked = document.getElementById(togbtnid).checked;
          var togbtncheckedsend = "";
          if (togbtnchecked == true) togbtncheckedsend = "ON";
          if (togbtnchecked == false) togbtncheckedsend = "OFF";
          Update_LEDs("esp32_01","LED_01",togbtncheckedsend);
        }
        if (togbtnid == "ESP32_01_TogLED_02") {
          var togbtnchecked = document.getElementById(togbtnid).checked;
          var togbtncheckedsend = "";
          if (togbtnchecked == true) togbtncheckedsend = "ON";
          if (togbtnchecked == false) togbtncheckedsend = "OFF";
          Update_LEDs("esp32_01","LED_02",togbtncheckedsend);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function Update_LEDs(id,lednum,ledstate) {
				if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("demo").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("POST","updateLEDs.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id+"&lednum="+lednum+"&ledstate="+ledstate);
			}
      //------------------------------------------------------------

      

    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
//$(document).ready(function(){
//-------------------------------------------------------------------------------------------------
google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawTemperatureChart);
//-------------------------------------------------------------------------------------------------
function drawTemperatureChart() {
	//guage starting values
	var data = google.visualization.arrayToDataTable([
		['Label', 'Value'],
		['Temperature', 0],
	]);
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	var options = {
		width: 		400, 
		height: 	300,
		redFrom: 	6.0, 
		redTo:		10,
		yellowFrom:	3.0, 
		yellowTo: 	6.0,
		greenFrom:	00, 
		greenTo: 	3.0,
		minorTicks: 5,
		min:0,
		max:10
	};
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
	chart.draw(data, options);
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN



	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	function refreshData () {
		$.ajax({
			url: 'getdata1.php',
			// use value from select element
			data: 'q=' + $("#users").val(),
			dataType: 'json',
			success: function (responseText) {
				//______________________________________________________________
				//console.log(responseText);
				var var_temperature = parseFloat(responseText.temperature).toFixed(2)
				//console.log(var_temperature);
				// use response from php for data table
				//______________________________________________________________
				//guage starting values
				var data = google.visualization.arrayToDataTable([
					['Label', 'Value'],
					['Temperature', eval(var_temperature)],
				]);
				//______________________________________________________________
				//var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
				chart.draw(data, options);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown + ': ' + textStatus);
			}
		});
    }
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	//refreshData();
	
	setInterval(refreshData, 1000);
}

//-------------------------------------------------------------------------------------------------
google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawAmmoniaChart);
//-------------------------------------------------------------------------------------------------
function drawAmmoniaChart() {
	//guage starting values
	var data = google.visualization.arrayToDataTable([
		['Label', 'Value'],
		['Ammonia', 0],
	]);
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	var options = {
		width: 		400, 
		height: 	300,
		redFrom: 	6.0, 
		redTo:		10,
		yellowFrom:	3.0, 
		yellowTo: 	6.0,
		greenFrom:	00, 
		greenTo: 	3.0,
		minorTicks: 5,
		min:0,
		max:10
	};
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	var chart = new google.visualization.Gauge(document.getElementById('chart_ammonia'));
	chart.draw(data, options);
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN



	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	function refreshData () {
		$.ajax({
			url: 'getdata.php',
			// use value from select element
			data: 'q=' + $("#users").val(),
			dataType: 'json',
			success: function (responseText) {
				//______________________________________________________________
				//console.log(responseText);
				var var_ammonia = parseFloat(responseText.ammonia).toFixed(2)
				//console.log(var_temperature);
				// use response from php for data table
				//______________________________________________________________
				//guage starting values
				var data = google.visualization.arrayToDataTable([
					['Label', 'Value'],
					['Ammonia', eval(var_ammonia)],
				]);
				//______________________________________________________________
				//var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
				chart.draw(data, options);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown + ': ' + textStatus);
			}
		});
    }
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	//refreshData();
	
	setInterval(refreshData, 1000);
}

////////////////////////////////////////////////////////

google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawPhChart);
//-------------------------------------------------------------------------------------------------
function drawPhChart() {
	//guage starting values
	var data = google.visualization.arrayToDataTable([
		['Label', 'Value'],
		['PH Level', 0],
	]);
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	var options = {
		width: 		400, 
		height: 	300,
		redFrom: 	6.0, 
		redTo:		10,
		yellowFrom:	3.0, 
		yellowTo: 	6.0,
		greenFrom:	00, 
		greenTo: 	3.0,
		minorTicks: 5,
		min:0,
		max:10
	};
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	var chart = new google.visualization.Gauge(document.getElementById('chart_ph'));
	chart.draw(data, options);
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN



	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	function refreshData () {
		$.ajax({
			url: 'getdata.php',
			// use value from select element
			data: 'q=' + $("#users").val(),
			dataType: 'json',
			success: function (responseText) {
				//______________________________________________________________
				//console.log(responseText);
				var var_ph = parseFloat(responseText.phlvl).toFixed(2)
				//console.log(var_temperature);
				// use response from php for data table
				//______________________________________________________________
				//guage starting values
				var data = google.visualization.arrayToDataTable([
					['Label', 'Value'],
					['PH Level', eval(var_ph)],
				]);
				//______________________________________________________________
				//var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
				chart.draw(data, options);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown + ': ' + textStatus);
			}
		});
    }
	//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
	//refreshData();
	
	setInterval(refreshData, 1000);
}

    </script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- /////////////////////temperature  chart////////////////////// -->
    <script>
  const labels = <?php echo json_encode($month) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Temperature Dataset',
      data: <?php echo json_encode($amount) ?>,
      backgroundColor: [
        'rgba(249, 189, 111, 0.9)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

    // === include 'setup' then 'config' above ===

    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  
  

  
</script>
<!-- /////////////////////end temperature  chart////////////////////// -->

<!-- /////////////////////ammonia  chart////////////////////// -->
<script>
const labels2 = <?php echo json_encode($month2) ?>;
const data2 = {
  labels: labels2,
  datasets: [{
    label: 'Ammonia Dataset',
    data: <?php echo json_encode($amount2) ?>,
    backgroundColor: [
      'rgba(24, 52, 250, 0.9)',
      'rgba(14, 241, 45, 0.6)',
      'rgba(239, 76, 2, 0.9)',
      'rgba(184, 38, 49, 0.7)',
      'rgba(71, 225, 219, 0.6)',
      'rgba(177, 92, 225, 0.7)',
      'rgba(164, 65, 36, 0.6)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};

const config2 = {
  type: 'line',
  data: data2,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};

  // === include 'setup' then 'config' above ===

  const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
  );
  
  

  
</script>
<!-- end ammonia chart -->

<script>
const labels3 = <?php echo json_encode($month3) ?>;
const data3 = {
  labels: labels3,
  datasets: [{
    label: 'PH Level Dataset',
    data: <?php echo json_encode($amount3) ?>,
    backgroundColor: [
      'rgba(16, 218, 61, 0.8)',
      'rgba(149, 181, 42, 0.7)',
      'rgba(122, 17, 126, 0.8)',
      'rgba(41, 73, 145, 0.5)',
      'rgba(80, 251, 231, 0.9)',
      'rgba(196, 128, 3, 0.5)',
      'rgba(236, 22, 20, 0.1)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};

const config3 = {
  type: 'bar',
  data: data3,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};

  // === include 'setup' then 'config' above ===

  const myChart3 = new Chart(
    document.getElementById('myChart3'),
    config3
  );
  
  

  
</script>


    <?php  require "head/footer.php";  ?>