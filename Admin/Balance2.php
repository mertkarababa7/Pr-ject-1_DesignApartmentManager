
<?php 
include 'checklogin.php';
include '../db_conn.php';
include 'navbar.php';

?>
<!DOCTYPE html>
<html>
<head>
 
<title> Payment List </title>
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      const urlParameters = new URLSearchParams(window.location.search);
      let blockValue = urlParameters.get('block');
     
      let monthValue = urlParameters.get('month');
      blockValue = blockValue !== null ? blockValue : 'A';
   
      monthValue = monthValue !== null ? monthValue : '1';
      document.addEventListener('DOMContentLoaded',function(){
        const selectBlock = document.querySelector('#selectBlock');
     
        const selectMonth = document.querySelector('#selectMonth');
        const buttonFilter = document.querySelector('#buttonFilter');

        selectBlock.value = blockValue;
       
        selectMonth.value = monthValue;
        
        function updateQuery(){
          window.location = window.location.pathname + '?block=' + selectBlock.value  + '&month=' + selectMonth.value;          
        }
        
        buttonFilter.addEventListener('click',updateQuery);

      });


      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['customer_id', 'amount'],
         <?php
         $blockValue = 'A';
        
         $monthValue = 1;
         if(isset($_GET['block']))
         {
          $blockValue = $_GET['block'];
         }
         if(isset($_GET['month']))
         {
          $monthValue = $_GET['month'];
         }

         $sqlQuery = "SELECT CollectedMoney,Block,SpentMoney,id FROM dues Where id='$monthValue' and Block='$blockValue'";

           $fire = mysqli_query($conn,$sqlQuery);
           $result32='Collected Money';
           $result33='Spent Money';
           $result34='Money In The Case';
          
          while ($result = mysqli_fetch_assoc($fire)) {
          
            $balance=$result['CollectedMoney']-$result['SpentMoney'];
            
            echo"['".$result32."',".$result['CollectedMoney']."],";
           
             echo"['".$result33."',".$result['SpentMoney']."],";


             echo"['".$result34."',".$balance."],";
            
          
          }
         ?>
        ]);

        
        var options = {
          title: 'Balance Chart For Selected Due' ,
          width: 1450,
  height: 550,
  colors: [ '#e6693e', '#4E73DF', '#9E73DF' ]
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }

    </script>


</head>
<body>

  <h2> Balance </h2>


            <div id="piechart" style="width: 900px; height: 500px;"></div>

            <div class="container">
              <div class="row">
            <div class="col-md-4">
            <select id="selectBlock" class="form-control">
              <option value="A">A Blok</option>
              <option value="B">B Blok</option>
            </select>
          </div>
            <div class="col-md-4">
            <select class="form-control" id="selectMonth">
            
    <option value="Did">Select Due</option>
    <?php 
  $result = $conn->query("SELECT details,id,Block FROM dues ") or die($conn->error);?>
   <?php
    while ($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row['id'] . "'>" . $row['details'] . " >" . $row['Block'] . "</option>";
    }
    ?>         
</select>
          </div>
        
           <div class="col-md-4"><button id="buttonFilter" class="btn btn-danger navbar-btn" onclick="drawChart()">Filter</button>
            </div>
           
          </div>


           <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">




    <thead>
  <tr "active-row">
    <th>Spent Money </th>
    <th>Details </th>
  <th>Spent Date </th>
    

     

  </tr>
   </thead>

 
    <?php 

    $sql1 = "SELECT * FROM customer";
 $result= mysqli_query($conn, $sql1);
   $row =$result->fetch_assoc();
   $name=$row['name'];
   $surname=$row['surname'];


         $query = "SELECT * FROM duespent where due_id='$monthValue'  ";
$once = false;

$data = mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

 echo "<input class=Search id=Input type=text placeholder=Search..> <br>";
   if($total!=0)

   {
while($result = mysqli_fetch_assoc($data)){   //Creates a loop to loop through results
 
echo "  <tbody id=Table><tr class='active-row'>
<td>".$result['amount']."</td>
<td>".$result['details']."</td>
<td>".$result['SpentDate']."</td>
</tr></tbody>";
  
      
      }
}

?>
  
</table>
        


          
                      

                        <script>
     $(document).ready(function(){
       $("#Input").on("keyup", function() {
         var value = $(this).val().toLowerCase();
         $("#Table tr").filter(function() {
           $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
         });
       });
     });

  </script>
                        




<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {

 window.location = window.location.pathname + '?block=' + selectBlock.value + '&month=' + selectMonth.value;          
   window.location2=admin.php;     
        buttonFilter.addEventListener('click',updateQuery);
        location.href =window.location2;
    };
</script>


</body>




</html>


