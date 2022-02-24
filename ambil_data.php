<?php
include 'koneksi.php';

if($_POST["query"] != ''){
  $search_array = explode(",", $_POST["query"]);
  $search_text = "'" . implode("', '", $search_array) . "'";
  $query = "SELECT * FROM customer WHERE Country IN (".$search_text.") ORDER BY CustomerID DESC";
} else {
  $query = "SELECT * FROM customer ORDER BY CustomerID DESC";
}

$dewan1 = $db1->prepare($query);
$dewan1->execute();
$res1 = $dewan1->get_result();
$output = '';

if($res1->num_rows > 0){
  while ($row = $res1->fetch_assoc()) {
    $output .= '
    <tr>
     <td>'.$row["CustomerName"].'</td>
     <td>'.$row["Address"].'</td>
     <td>'.$row["City"].'</td>
     <td>'.$row["PostalCode"].'</td>
     <td>'.$row["Country"].'</td>
    </tr>';
  }
} else {
  $output .= '
   <tr>
    <td colspan="5" align="center">No Data Found</td>
   </tr>';
}

echo $output;
?>