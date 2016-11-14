<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asiri Tex</title>
<link rel="stylesheet" type="text/css" href="Style/viewtablesearch.css" />
</head>
<body>
<center><h1>Asiri Tex Control Panel</h1></center>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="addnew" href="Add_Form.php" style="font-face:Khmer OS Battambang; font-size:16px;">Add new Item</a></font>
	<div class="search">
	<form method="post" action="searchidandname.php">
    <select name="cbosearch">
    	<option>ID</option>
    	<option>Item Name</option>
        <option>Price</option>
    </select>
	<input type="text" name="txtsearch" placeholder="Type to Search" /><input type="submit" name="cmdsearch" value="Search" />
    </form>
    </div>
	<table>
    	<tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Image</th>
            <th>Quantity</th>
			<th>Option</th>
    	</tr>
        <?php
			$num_rec_per_page=2;
			include "connect.php";
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $num_rec_per_page; 
			$sql = "SELECT * FROM item LIMIT $start_from, $num_rec_per_page"; 
			$rs_result = mysqli_query ($conn,$sql);
			while($tr=mysqli_fetch_array($rs_result))
			{
		?>
        <tr>
        	<td><?php echo $tr[0]; ?></td>
            <td><?php echo $tr[1]; ?></td>
            <td><?php echo $tr[2]; ?></td>
            <td><?php echo $tr[3]; ?></td>
            <td><img src="uploads/<?php echo $tr[4];?>" /></td>
            <td><?php echo $tr[5]; ?></td>
            <td align="center"><a href="Delete_Form.php? id=<?php echo $tr[0];?>">Delete</a> / <a href="Edit_Form.php? id=<?php echo $tr[0];?>">Edit</a> </td>    
        </tr>
        <?php
			}
		?>
		
    </table>
	
	<center >
	<?php 
	$sql = "SELECT * FROM item"; 
	$rs_result = mysqli_query($conn,$sql); //run the query
	$total_records = mysqli_num_rows($rs_result);  //count number of records
	$total_pages = ceil($total_records / $num_rec_per_page); 

	echo "<a style=\"font-size:25px;\" href='index.php?page=1'>".'|<'."</a> "; // Goto 1st page  

	for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a style=\"font-size:25px;\" href='index.php?page=".$i."'>".$i."</a> "; 
	}; 
	echo "<a style=\"font-size:25px;\" href='index.php?page=$total_pages'>".'>|'."</a> "; // Goto last page
	?>
	</center>
	
</body>
</html>