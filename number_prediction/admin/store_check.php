<?php
include '../db.php';
$id=$_POST['id'] ?? '';
$name=$_POST['name'] ?? '';
$price=$_POST['price'] ?? '';
$rand=rand();
$target_dir="../images/";
if($id==""){
if(($_FILES["photo"]["size"] > 0) != ""){
$photo = "store_${rand}.png";
$target_file = $target_dir . $photo;
$target_file_1 = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file_1,PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $uploadOk = 0;
        $msg="Only jpg/png/jpeg are allowed";
}
if ($uploadOk == 0) {
    echo "no";
	header("location: store.php?msg=$msg");
} else {
if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
$stmt1="insert into STORE(NAME,PRICE,IMAGE) values ('$name','$price','$photo');";
$db->query($stmt1);
	header("location: store.php?msg=Added");
}
}
}else{
	header("location: store.php?msg=Photo not uploaded");
}

	}else{
	if(($_FILES["photo"]["size"] > 0) != ""){
$photo = "store_${rand}.png";
$target_file = $target_dir . $photo;
$target_file_1 = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file_1,PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $uploadOk = 0;
        $msg="Only jpg/png/jpeg are allowed";
}
if ($uploadOk == 0) {
    echo "no";
} else {
if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
$stmt1 = $db->query("select IMAGE from STORE where ID='$id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$d_photo=$row1['IMAGE'] ?? '';
}
if($d_photo!=""){
        unlink("../images/$d_photo");
}
	$stmt1 = "update STORE set IMAGE='$photo' where ID='$id';";
	$db->query($stmt1);
}
}
}
	$stmt1 = "update STORE set NAME='$name', PRICE='$price' where ID='$id';";
	$db->query($stmt1);
	header("location: store.php?id=$id&msg=Updated");
}
?>
