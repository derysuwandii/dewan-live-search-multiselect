<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <link rel="icon" href="dk.png">
  <title>Live Search dengan Multi Select</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/css/bootstrap-select.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/js/bootstrap-select.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand text-white" href="index.php" style="color: #fff;">
      Dewan Komputer
    </a>
  </nav>

  <div class="container">
    <h2 align="center">Ajax Live Data Search using Multi Select Dropdown in PHP</h2><br />
    
    <div class="row mb-5">
      <div class="col-sm-6">
        <select name="multi_search_filter" id="multi_search_filter" multiple class="form-control selectpicker">
          <?php
            include 'koneksi.php';
            $query = "SELECT DISTINCT Country FROM customer ORDER BY Country ASC";
            $dewan1 = $db1->prepare($query);
            $dewan1->execute();
            $res1 = $dewan1->get_result();
            while ($row = $res1->fetch_assoc()) {
              echo '<option value="'.$row["Country"].'">'.$row["Country"].'</option>'; 
            }
          ?>
         </select>
      </div>
    </div>
    
    <input type="hidden" name="hidden_country" id="hidden_country" />
    <div style="clear:both"></div>

    <div class="table-responsive" style="margin-top: 30px;">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Customer Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Postal Code</th>
            <th>Country</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
     </div>

    </div>

    <div class="text-center fixed-bottom p-3">© <?php echo date('Y'); ?> Copyright:
      <a href="https://dewankomputer.com/"> Dewan Komputer</a>
    </div>
</body>
</html>

<script>
  $(document).ready(function(){
    load_data();

    function load_data(query=''){
      $.ajax({
        url:"ambil_data.php",
        method:"POST",
        data:{query:query},
        success:function(data){
          $('tbody').html(data);
        }
      });
    }

    $('#multi_search_filter').change(function(){
      $('#hidden_country').val($('#multi_search_filter').val());
      var query = $('#hidden_country').val();
      load_data(query);
    });
  });
</script>