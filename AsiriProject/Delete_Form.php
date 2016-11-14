<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Form</title>
	<link href="Style/Delete_Form.css" type="text/css" rel="stylesheet" />
</head>

<body background="Images/MyBackground.png" bgcolor="#999966">
	<div class="topbar"><center><h1 style="color:#FFF">Delete Form</h1></center></div>
	<div id="box"><center>
    
    	<?php
		
			$id = $_GET['id'];
			include ("connect.php");
			$i = "select * from item where id=".$id;
			$h = mysqli_query($conn,$i);
			if($tr=mysqli_fetch_array($h))
			{
		?>
    
	<table>
    		<form method="post" action="">
    	<tr>
        	<th>ID:</th>
            <td><input type="text" name="id" value="<?php echo $tr[0]; ?>" /></td>
        </tr>
        <tr>
        	<th>Item Name:</th>
            <td><input type="text" name="item_name" value="<?php echo $tr[1]; ?>"/></td>
        </tr>
        <tr>
        	<th>Price:</th>
            <td><input type="text" name="price" value="<?php echo $tr[2]; ?>" /></td>
        </tr>
        <tr>
        	<th>Discount:</th>
            <td><input type="text" name="discount" value="<?php echo $tr[3]; ?>" /></td>
        </tr>
        <tr>
        	<th>Image:</th>
            <td><img src="uploads/<?php echo $tr[4];?>" /></td>
        </tr>
        <tr>
        	<th>Quantity:</th>
            <td><input type="text" name="qty" value="<?php echo $tr[5]; ?>" /></td>
        </tr>
        
        <?php
			}
		?>
        <tr>
            <td colspan="2" align="center">
            <input type="submit" name="cmddelete" value="Delete"/>
            <a href="index.php"><img src="Images/ItemList.png" title="Go Back" /></a>
            </td>
        </tr>
        	</form>
    </table></center>
	</div>
        <?php
		if(isset($_POST['cmddelete'])){
        $id=intval($_POST['id']);        
        include("connect.php");
        $i = mysqli_query($conn,"delete from item where id='$id'");
        if($i==true){
        header("Location:index.php");
        }
        
        //exit;
        //mysql_close();
		}
    ?>
</body>
</html>