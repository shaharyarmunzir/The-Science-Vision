<title>TSV</title>
<link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
<style>
body{
	background-color: #190251;
}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}
#customers tr:nth-child(even){background-color: #9df57d;}
#customers tr:nth-child(odd){background-color: #f1f5f0;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4df211;
  color: white;
}
td a .Edit{
	background: rgb(31, 190, 13);
	color: rgb(249, 249, 249);
	text-decoration: none;
	padding: 5px 10px;
	cursor: pointer;
}
td a .Edit:hover{
	background: rgb(3, 92, 11);
}
td a .Delete{
	background: rgb(255, 2, 2);
	color: rgb(249, 249, 249);
	text-decoration: none;
	padding: 5px 10px;
	cursor: pointer;
}
td a .Delete:hover{
	background: rgb(152, 25, 25);
}

.add-student-link {
            display: block;
            margin: 20px auto;
            border-radius: 20px;
            box-shadow: 0 2px 6px 2px gray;
            padding: 10px 20px;
            text-decoration: none;
            color: #f9f9f9;
            background: #fc0000;
            text-align: center;
        }
@media (max-width: 768px) {
  #customers {
    font-size: 14px;
  }
}

/* Media Query for Mobile Devices */
@media (max-width: 480px) {
  #customers {
    font-size: 12px;
  }
  .add-student-link {
    font-size: 14px;
  }
}
</style>
<!-- <a href="asif.php" class="add-student-link">Add more students</a> -->
<?php
error_reporting(0);
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mia";

	$conn = mysqli_connect($servername,$username,$password,$dbname);

	if($conn)
	{
		// echo "ok";
	}
	else
	{
		echo "connection failed";
	}
?>
<?php
error_reporting(0);
    $query = "SELECT * FROM `notice`";
	$data = mysqli_query($conn, $query);

	$total = mysqli_num_rows($data);

	if($total != 0){
		?>
		<table id="customers">
			<th>Roll No</th>
			<th>Name</th>
			<th>English</th>
			<th>Option</th>
		
		<?php
		while($result = mysqli_fetch_assoc($data)){
			echo "<tr>
				<td>".$result["date"]."</td>
				<td>".$result["noticetop"]."</td>
				<td>".$result["notice"]."</td>
				<td>
				<a href='boardNoticeEdit.php?id=$result[id]' ><input type='submit' value='Edit' class='Edit'></a>				</td>
			</tr>";
		}
	}
	else{
		echo "No records has founds";
	}
	
?>
</table>
<script>
	function checkdelete(){
		return confirm('Are you sure you want to delete this record?')
	}
</script>