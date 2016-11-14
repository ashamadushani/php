<?php
include ("connect.php");
$g = mysqli_query($conn,"select max(id) as total from item");
$id=mysqli_fetch_assoc($g);
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Form</title>
		<link href="Style/Add_Form.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#FFFFFF" background="Images/MyBackground.png">
<div class="img"><img src="Images/auditoria.png" /></div>
<div class="ii"><center><img src="Images/Edit_Yes.png" style="margin-top:20px"/></center></div>
<div id="topbar">
    	<center><h1 style="color:#939">Welcome to Add Form</h1>
    </div>
<div id="form">
		<table>
        	<form method="post" action="Add_Form.php" enctype="multipart/form-data">
            	<tr>
                
                	<th>ID:</th>
                    <td><input type="text" name="id" value="<?php echo $id['total']+1; ?>" readonly="readonly" /></td>
                </tr>
                
                <tr>
                	<th>Item Name:</th>
                    <td><input type="text" name="item_name" placeholder="Type Name"  /></td>
                </tr>
                <tr>
                	<th>Price:</th>
                    <td><input type="text" name="price" placeholder="Type Price"  /></td>
                </tr>
                <tr>
                	<th>Discount:</th>
                    <td><input type="text" name="discount" placeholder="Type Discount"  /></td>
                </tr>
                <tr>
                	<th>Image:</th>
                    <td><input type="file" name="image1" id="fileToUpload"></td>
                </tr>
                <tr>
                    <th>Quanyity:</th>
                    <td><input type="number" name="qty" placeholder="0"  /></td>
        		</tr>
                <tr>
                    <td><input type="submit" name="cmdadd" value="Add" /></td>
                    <td><input type="reset" name="cmdreset" value="Clear"/></td>
                </tr>
        	</form>
        </table>
    	</div>
        <?php 
        
        if(isset($_POST['cmdadd'])){
			
			
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
			if(empty($item_name) || empty($price) || empty($image)|| empty($qty))
			{
				echo "<center>Sorry please input data</center>";
			}else{
				
				$result=mysqli_query($conn,"INSERT INTO item(id, item_name, price, discount, image, qty) VALUES ('$id','$item_name','$price','$discount','$image','$qty')");
				if($result==true){
					header("Location:index.php");
				}
			
			}
						
		}
    ?>
</body>
</html>