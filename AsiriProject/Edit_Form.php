<!DOCTYPE html>
<html >
<head>

<title>Edit Form</title>

	<link rel="stylesheet" type="text/css"  href="Style/Edit_Form.css" />

</head>

<body background="Images/MyBackground.png" bgcolor="#252A67">
	<div class="topbar"> <h1 style="color:#FFF"><center>Edit Form</center></h1></div>    
	<center>
    <div class="box">
    	<?php
		
			$id = $_GET['id'];
			include ("connect.php");
			$i = "select * from item where id=".$id;
			$h = mysqli_query($conn,$i);
			if($tr=mysqli_fetch_array($h))
			{
		?>
    
	<table>
    		<form method="post" action="Edit_Form.php" enctype="multipart/form-data">
    	<tr>
        	<th>ID:</th>
            <td><input type="text" name="id" value="<?php echo $tr[0]; ?>" readonly="readonly"/></td>
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
            <td><img src="uploads/<?php echo $tr[4];?>" />
			<input type="file" name="image1" id="fileToUpload"></td>
        </tr>
        <tr>
        	<th>Quantity:</th>
            <td><input type="text" name="qty" value="<?php echo $tr[5]; ?>" /></td>
        </tr>
        
        
        	<td colspan="2" align="center"><input type="submit" name="cmdedit" value="Save" />
            <a href="index.php"><img src="Images/ItemList.png" title="Go Back"/></a>
            </td>
        </tr>
	</form></table>
    </div>
    </center>
    <?php
			}
	if(isset($_POST['cmdedit'])){
		
		
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image1"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["image1"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image1"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image1"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}			
			
			
			
			$id = intval($_POST['id']);
			$item_name = trim($_POST['item_name']);
			$price = floatval($_POST['price']);
			$discount = floatval($_POST['discount']);
			$image = basename( $_FILES["image1"]["name"]);
			$qty = intval($_POST['qty']);
			
        include ("connect.php");
        $i = mysqli_query($conn,"update item set item_name='$item_name', price='$price', discount='$discount', image='$image', qty='$qty' where id='$id'");
		
        if($i==true){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
        }
        //header('Location::index.php');
        //exit;
        //mysql_close();
	}
    ?>
</body>
</html>