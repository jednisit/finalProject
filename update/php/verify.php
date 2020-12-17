<?php 

header("Content-type: application/json; charset=utf-8"); 

if(isset($_POST['name'])) {
 
        //รับค่าname มาจาก index.php ของ update
        $name = $_POST['name'];
        $captcha = $_POST['g-recaptcha-response'];
        $secretkey ='6LfK9AcaAAAAAATCx6gj5X122oEjsLNCLrtQQO_8'; //โค้ดจาก Captcha

        $url='https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($secretkey).'&response='.urldecode($captcha).' '; //เป็นการถอดรหัสจาก $secretkey และ $captcha

        $response=file_get_contents($url); //อ่านไฟล์ออกมาเป็น string 

        $responseKey = json_decode($response, TRUE); //เป็นฟังก์ชันที่จะแปลงค่า argument ที่ส่งให้เป็น json เพื่อให้จะช่วยให้เราใช้ javascript จัดการกับ Response ง่ายขึ้น


        $pattern='/^([sS][cC]|[eE][nN]|[hH][mM]|[sS][sS]|[pP][eE]|[eE][dD]|[fF][aA]|[dD][tT]|[pP][hH]|[pP][tT]|[nN][sS]|[mM][dD]|[gG][sS]|[eE][cC]|[sS][tT]|[cC][oO]|[Ll][cC]|[bB][cC]|[aA][iI]|[bB][sS]|[cC][iI]|[pP][cC])*[6][0-9][1-2][0-9][0-9][0-9][0-9][0-9][0-9]$/m';

        if($responseKey["success"] && preg_match($pattern, $name)) {
            //ถ้า captcha = success และค่าที่ส่งมาตรงกับ $pattern ให้ไปหน้า user_map.php
            // header("Location: ../update/user_map.php");
            echo json_encode(["status"=>true,"message"=>"ยินดีต้อนรับ"]);
        }else if ( !($responseKey["success"]) && (preg_match($pattern, $name))) {
            //ถ้า captcha != success และ ค่าที่ส่งมาตรงกับ $pattern ให้ขึ้น alert
            echo json_encode(["status"=>false,"message"=>"โปรดVerify Captcha!"]);

        }else if (($responseKey["success"]) && !(preg_match($pattern, $name))) {
            //ถ้า captcha = success และ แต่ค่าที่ส่งมาไม่ตรงกับ $patternให้ขึ้น alert
            echo json_encode(["status"=>false,"message"=>"โปรดตรวจสอบรหัสบัวศรีของคุณ!"]);
        }
    }

    ?>