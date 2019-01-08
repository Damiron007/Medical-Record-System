<?php require_once('Connections/Medical_record.php'); ?>
<?php
mysql_select_db($database_Medical_record, $Medical_record);
$query_Patient_Record = "SELECT * FROM patient_record";
$Patient_Record = mysql_query($query_Patient_Record, $Medical_record) or die(mysql_error());
$row_Patient_Record = mysql_fetch_assoc($Patient_Record);
$totalRows_Patient_Record = mysql_num_rows($Patient_Record);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Patient Record Summary</title>
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
.style3 {
	color: #FFFFFF;
	font-weight: bold;
}
.style4 {
	font-size: 24px;
	font-weight: bold;
}
</style>
</head>

<body>
  <p>&nbsp;</p>
  <p align="center" class="style4">PATIENT RECORD DATABASE </p>
  <p align="center"><strong>This provides summary of all patient records </strong></p>
  <form id="form1" name="form1" method="post" action="">
  <table class="data-table" border="1">

  <!--DWLayoutTable-->
   <caption class="title"><h1><b>Patient Record Summary </b></h1></caption>
	  <thead>
        <tr>
          <td bgcolor="#0000FF"><span class="style3">Patient Name</span></td>
          <td bgcolor="#0000FF"><span class="style3">Sex</span></td>
          <td bgcolor="#0000FF"><span class="style3">Amount</span></td>
          <td bgcolor="#0000FF"><span class="style3">Age</span></td>
          <td bgcolor="#0000FF"><span class="style3">Date</span></td>
          <td bgcolor="#0000FF"><span class="style3">Type of test</span></td>
          <td bgcolor="#0000FF"><span class="style3">Patient ID</span></td>
          <td bgcolor="#0000FF"><span class="style3">Phone Number</span></td>
          <td bgcolor="#0000FF"><span class="style3">Report</span></td>
        </tr>
	</thead>
		<tbody>
        <?php do { ?>
          <tr>
            <td><?php echo $row_Patient_Record['Patient_Name']; ?></td>
            <td><?php echo $row_Patient_Record['Sex']; ?></td>
            <td><?php echo $row_Patient_Record['Amount']; ?></td>
            <td><?php echo $row_Patient_Record['Age']; ?></td>
            <td><?php echo $row_Patient_Record['Date']; ?></td>
            <td><?php echo $row_Patient_Record['Type_of_test']; ?></td>
            <td><?php echo $row_Patient_Record['Patient_id']; ?></td>
            <td><?php echo $row_Patient_Record['Phone_Number']; ?></td>
            <td><?php echo $row_Patient_Record['Report']; ?></td>
          </tr>
          <?php } while ($row_Patient_Record = mysql_fetch_assoc($Patient_Record)); ?>
</table>
</form>
<p> 
<p align="center"><input type="button" name="Print" value="Print" onClick="javascript:window.print();" />
<p align="center"> BACK TO <a href="patient_record.php">Patient Record
</a>
</body>
</html>
<?php
mysql_free_result($Patient_Record);
?>
