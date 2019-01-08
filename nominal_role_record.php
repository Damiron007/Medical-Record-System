<?php require_once('Connections/ckc_db.php'); ?>
<?php
$maxRows_rsnominal_role_record = 100;
$pageNum_rsnominal_role_record = 0;
if (isset($_GET['pageNum_rsnominal_role_record'])) {
  $pageNum_rsnominal_role_record = $_GET['pageNum_rsnominal_role_record'];
}
$startRow_rsnominal_role_record = $pageNum_rsnominal_role_record * $maxRows_rsnominal_role_record;

mysql_select_db($database_ckc_db, $ckc_db);
$query_rsnominal_role_record = "SELECT * FROM nominal_role";
$query_limit_rsnominal_role_record = sprintf("%s LIMIT %d, %d", $query_rsnominal_role_record, $startRow_rsnominal_role_record, $maxRows_rsnominal_role_record);
$rsnominal_role_record = mysql_query($query_limit_rsnominal_role_record, $ckc_db) or die(mysql_error());
$row_rsnominal_role_record = mysql_fetch_assoc($rsnominal_role_record);
$totalRows_rsnominal_role_record = mysql_num_rows($rsnominal_role_record);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nominal Role Record</title>
<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>

</head>

<body>

<form id="form1" name="form1" method="post" action="">
     <table class="data-table" border="1">
  <caption class="title"><h1><b>HARVEST RECORD TABLE</b></h1></caption>
  <thead>
	<tr>
      <th>Serial Number</th>
      <th>Name of Parishioner</th>
	  <th>Gender</th>
      <th>Address</th>
	  <th>Phone number</th>
	  <th>Occupation</th>
	  <th>Marital Status</th>
      <th>Children</th>
      <th>Socieites</th>
	  <th>State origin</th>
	  <th>Date of birth</th>
    </tr>
	</thead>
		<tbody>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsnominal_role_record['Serial_Number']; ?></td>
        <td><?php echo $row_rsnominal_role_record['Name_of_Parishioner']; ?></td>
		 <td><?php echo $row_rsnominal_role_record['Gender']; ?></td>
        <td><?php echo $row_rsnominal_role_record['Address']; ?></td>
		<td><?php echo $row_rsnominal_role_record['Phone_number']; ?></td>
		<td><?php echo $row_rsnominal_role_record['Occupation']; ?></td>
		<td><?php echo $row_rsnominal_role_record['Marital_status']; ?></td>
        <td><?php echo $row_rsnominal_role_record['Children']; ?></td>
        <td><?php echo $row_rsnominal_role_record['Socieites']; ?></td>
		<td><?php echo $row_rsnominal_role_record['State_origin']; ?></td>
		<td><?php echo $row_rsnominal_role_record['Date_of_birth']; ?></td>
            
      </tr>
      <?php } while ($row_rsnominal_role_record = mysql_fetch_assoc($rsnominal_role_record)); ?>
  </table>
</form><p>
<p> BACK TO <a href="nominal_role.php">NOMINAL ROLE FORM
</a>
</body>
</html>

