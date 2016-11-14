<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search by ID</title>
	<link rel="stylesheet" type="text/css" href="Style/viewtablesearch.css" />
</head>

<body>
<center><h1>Search Result</h1></center>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="addnew" href="index.php" style="font-face:Khmer OS Battambang; font-size:16px;">Home</a></font>
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
		$text = $_POST['txtsearch'];
		if($text==""){
			echo "No Data....Please Try Again!!!"."<br>";
			echo '<a href="ViewTable.php"><img src="Images/Users_Group.png" title="Go Back"></a>';
		}
	?>
    <?php
		$cbo = $_POST['cbosearch'];
		$search = $_POST['txtsearch'];
		
		include "connect.php";
		
		$sql = "SELECT * FROM item WHERE id='$search'";
	
		if($cbo=="ID")
		{
			$id = mysqli_query($conn,$sql);
	?>

    <?php
		while($tr=mysqli_fetch_array($id))
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
		}else if($cbo=="Item Name")
		{
			$na = mysqli_query($conn,"SELECT * FROM item WHERE item_name like '$search%'");

		while($an=mysqli_fetch_array($na))
		{
	?>
			<tr>
        	<td><?php echo $an[0]; ?></td>
            <td><?php echo $an[1]; ?></td>
            <td><?php echo $an[2]; ?></td>
            <td><?php echo $an[3]; ?></td>
            <td><img src="uploads/<?php echo $an[4];?>" /></td>
            <td><?php echo $an[5]; ?></td>
            <td align="center"><a href="Delete_Form.php? id=<?php echo $tr[0];?>">Delete</a> / <a href="Edit_Form.php? id=<?php echo $tr[0];?>">Edit</a> </td>    
        </tr>
            <?php
				}
			?>  
     <?php
		}else if($cbo=="Price")
				{
					$pri=floatval($search);
        $add = mysqli_query($conn,"SELECT * FROM item WHERE price<='$pri'");
     ?>
		<?php
		while($dda=mysqli_fetch_array($add))
		{
		?>
			<tr>
        	<td><?php echo $dda[0]; ?></td>
            <td><?php echo $dda[1]; ?></td>
            <td><?php echo $dda[2]; ?></td>
            <td><?php echo $dda[3]; ?></td>
            <td><img src="uploads/<?php echo $dda[4];?>" /></td>
            <td><?php echo $dda[5]; ?></td>
            <td align="center"><a href="Delete_Form.php? id=<?php echo $tr[0];?>">Delete</a> / <a href="Edit_Form.php? id=<?php echo $tr[0];?>">Edit</a> </td>    
        </tr>
            <?php
				}
				}
			?>
</table>
</body>
</html>