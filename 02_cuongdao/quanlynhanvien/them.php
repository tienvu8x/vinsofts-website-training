<?php
require 'connect.php';
 ?>
<?php
$hoten = "";
$gioitinh = "";
$ngaysinh = "";
$quequan = "";
$diachi = "";

//Lấy giá trị POST từ form vừa submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["ten"])) { $hoten = $_POST['ten']; }
 	if(isset($_POST["gioitinh"])) { $gioitinh = $_POST['gioitinh']; }
    if(isset($_POST["ngaysinh"])) { $ngaysinh = $_POST['ngaysinh']; }
    if(isset($_POST["quequan"])) { $quequan = $_POST['quequan']; }
    if(isset($_POST["diachi"])) { $diachi = $_POST['diachi']; }

  
  

    //Code xử lý, insert dữ liệu vào table
$sql = "INSERT INTO dsnhanvien (hoten, gioitinh, ngaysinh, quequan, diachi ) 
        VALUES ('$hoten','$gioitinh', '$ngaysinh','$quequan','$diachi')";

    if ($conn->query($sql) === TRUE) {
    	$last_id = mysqli_insert_id($conn);
        echo "Thêm dữ liệu thành công có ID là:" . $last_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }}
//Đóng database
$conn->close();
?>