<?php
include 'connectdb.php';
$sql = "SELECT * FROM users ORDER BY id DESC";
$qeury = mysqli_query($connect,$sql);

 // กำหนดตัวแปรไว้เก็บข้อมูลที่ค้นหาได้
 $data = array();
 // วนลูปค้นหาข้อมูล
 while($result = mysqli_fetch_assoc($qeury)){
     // เก็บข้อมูลที่ค้นหาได้ลงตัวแปร
     $data[] = $result;
 }


// แสดงข้อมูลออกเป็น JSON Data
 echo json_encode($data);

 ?>
