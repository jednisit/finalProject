<?php
include 'connectdb.php';

// รับค่าจาก jQuery
$faculty = $_POST['faculty'];
$campus = $_POST['campus'];

// เช็คว่าทั้ง 2 ช่องต้องไม่เป็นค่าว่าง
if(!empty($faculty) or !empty($campus)){
    $sql = "SELECT * FROM users WHERE faculty LIKE '%$faculty%'AND campus LIKE '%$campus%'";
    $qeury = mysqli_query($connect,$sql);

    // กำหนดตัวแปรไว้เก็บข้อมูลที่ค้นหาได้
    $search_data = array();
    // วนลูปค้นหาข้อมูล
    while($result = mysqli_fetch_assoc($qeury)){
        // เก็บข้อมูลที่ค้นหาได้ลงตัวแปร
        $search_data[] = $result;
    }

    // แสดงข้อมูลออกเป็น JSON Data
    echo json_encode($search_data);
}
