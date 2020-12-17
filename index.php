<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SWU | MAP</title>
    <link rel="icon" type="image/x-icon" href="img/swu.png" />
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script>
        $(function(){

            // ============================================================================
            // เริ่มต้นให้โหลดข้อมูลทั้งหมดออกมาแสดง โดยเรียกฟังก์ชัน all_users()
            all_users();

            // สร้างฟังก์ชันดึงข้อมูลจากตาราง user ทั้งหมด โดยอ่านจากไฟล์ all_users.php
            function all_users(){
                $.ajax({ 
                        url: 'all_users.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){
                                // กำหนดตัวแปรเก็บโครงสร้างแถวของตาราง
                                var trstring ="";
                                // ตัวแปรนับจำนวนแถว
                                var countrow = 1;

                                // วนลูปข้อมูล JSON ลงตาราง
                                $.each(data, function(key, value){
                                    // ทดสอบแสดงชื่อ
                                    // console.log(value.faculty);
                                    // แสดงค่าลงในตาราง
                                    trstring += `
                                    <tr>
                                        <td class="text-center">${countrow}</td>
                                        <td class="text-center">${value.faculty}</td>
                                        <td class="text-center">${value.campus}</td>
                                        <td class="text-center"><a href="${value.province}"> Link </a></td>          
                                    </tr>`;
                                    $('table tbody').html(trstring);
                                    countrow++;
                        });
                    }
                });
            }

            // ============================================================================
            // เมื่อมีการ submit form
            $('form#search_user').submit(function(event) {
               event.preventDefault();

                // รับค่าจากฟอร์ม
                var faculty = $('input#faculty').val();
                var campus = $('input#campus').val();
               

                // ส่งค่าไป search_result.php ด้วย jQuery Ajax
                $.ajax({
                    url: 'search_result.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        faculty:faculty,
                        campus:campus,
                       
                    },
                    success: function(data){
                        if(data.length != 0){
                            // กรณีมีข้อมูล
                            // กำหนดตัวแปรเก็บโครงสร้างแถวของตาราง
                            var trstring ="";

                            // ตัวแปรนับจำนวนแถว
                            var countrow = 1;

                            // วนลูปข้อมูล JSON ลงตาราง
                            $.each(data, function(key, value){
                                // แสดงค่าลงในตาราง
                                trstring += `
                                    <tr>
                                        <td class="text-center">${countrow}</td>
                                        <td class="text-center">${value.faculty}</td>
                                        <td class="text-center">${value.campus}</td>
                                        <td class="text-center"><a href="${value.province}"> Link </a></td>
                                    
                                    </tr>`;
                                $('table tbody').html(trstring);
                                countrow++;
                            });


                        }else{
                            alert('ไม่พบข้อมูลที่ค้นหา');
                        }
                    }
                });
            });

            // ============================================================================
            // เมื่อกดปุ่มล้างข้อมูลการค้นหา
            $('input#resetform').click(function(){
                // ล้างค่าในฟอร์มทั้งหมด
                $("#search_user").trigger('reset');
                // โฟกัสช่องชื่อ
                $('input#faculty').focus();
                // เรียกแสดงผลข้อมูลทั้งหมด
                all_users();
            });

        });
    </script>
</head>

<body id="page-top">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-Gswu text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a href="index.php"><img src="img/logo1.png" alt="IMG-LOGO"> </a>
            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-Gswu text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="#portfolio">วิธีเดินทาง</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="Faculty/faculty.html">คณะต่าง | Faculty</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="service/service.html">บริการในมหาลัย</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="update/index.php">แนะนำสถานที่หรือเพิ่มสถานที่</a></li>
                    <li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                    data-toggle="modal" data-target="#exampleModalCenter">ค้นหา</a></li>
                    <li>
                    
			</div>	
		</div>	
		</div></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-Gswu text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="img/swu.png" alt="" />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">ยินดีต้อนรับสู่ SWUMAP</h1>
            <br>
            <p class="masthead-subheading font-weight-light mb-0">Website ที่จะนำทางคุณ</p>
        </div>
    </header>
    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">วิธีเดินทาง</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal0">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fa fa-folder-open"></i></div>
                        </div>
                        <img class="img-fluid" src="index/howto/back.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal00">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fa fa-folder-open"></i></div>
                        </div>
                        <img class="img-fluid" src="index/howto/nowswu.png" alt="" />
                    </div>
                </div>

                <div class="col-md- col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal000">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fa fa-folder-open"></i></div>
                        </div>
                        <img class="img-fluid" src="index/howto/goswu.png" alt="" />
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fa fa-folder-open"></i></div>
                        </div>
                        <img class="img-fluid" src="index/howto/mrt.png" alt="" />
                    </div>
                </div>

                <!-- Portfolio Item 2-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal2">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fa fa-folder-open"></i></div>
                        </div>
                        <img class="img-fluid" src="index/howto/bts.png" alt="" />
                    </div>
                </div>

                <!-- Portfolio Item 3-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal3">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fa fa-folder-open"></i></div>
                        </div>
                        <img class="img-fluid" src="index/howto/boatแก้.png" alt="" />
                    </div>
                </div>

                <!-- Portfolio Item 4-->
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal4">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fa fa-folder-open"></i></div>
                        </div>
                        <img class="img-fluid" src="index/howto/bus.png" alt="" />
                    </div>
                </div>

                <!-- Portfolio Item 5-->
                <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal5">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fa fa-folder-open"></i></div>
                        </div>
                        <img class="img-fluid" src="index/howto/airport.png" alt="" />
                    </div>
                </div>

                <!-- Portfolio Item 6-->
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal6">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fa fa-folder-open"></i></div>
                        </div>
                        <img class="img-fluid" src="index/howto/car.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">วัตถุประสงค์ของเว็บ</h4>
                    <p class="lead mb-0">
                        Websiteนี้ถูกทำขึ้นเพื่อเป็นการศึกษาเท่านั้น ข้อมูลต่างที่ใช้นั้นถูกนำมาเรียบเรียงโดยคณะผู้จัดทำ
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">ติดต่อ Admin</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="mailto:thanapat.bank@g.swu.ac.th"><i
                            class="fa fa-envelope" aria-hidden="true"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">รายชื่อผู้จัดทำ</h4>
                    <p class="lead mb-0">
                        1.นาย เจตนิพิฐ เชาว์วุฒิประสิทธิ์ <br>
                        2.นาย ธนพัฒน์ เอี่ยมประเสริฐ <br>
                        3.นางสาว ณัฐนรี แดงสกุล
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright © Your Website 2020</small></div>
    </div>


    <!-- ค้นหา-->
    <div class="scroll-to-top d-lg-none position-fixed">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i
                class="fa fa-chevron-up"></i></a>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <div class="row">
            <!-- สร้างแบบฟอร์มด้วย Bootstrap 4-->
            <div class="col-md-4">
                <div class="container">
                    <form name="search_user" id="search_user" method="POST" action="index.php">

                        <div class="form-group row">
                            <label for="faculty" class="col-sm-3 col-form-label">ค้นหา</label>
                            <div class="col-sm-20">
                            <input type="text" class="form-control" id="faculty" name="faculty">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="campus" class="col-sm-3 col-form-label">วิทยาเขต</label>
                            <div class="col-sm-20">
                            <input type="text" class="form-control" id="campus" name="campus">
                            </div>
                        </div>
                         

                        <div class="form-group row">
                            <label for="province" class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                            <input type="submit" class="btn btn-primary" id="submit" name="submit" value="ค้นหา">
                            <input type="button" class="btn btn-primary" id="resetform" name="resetform" value="ล้างข้อมูลการค้นหา">
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- สร้างตารางด้วย Bootstrap 4-->
            <div class="col-md-8">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="bg-primary text-light">
                            <th>#</th>
                            <th class="text-center">ชื่อคณะ</th>
                            <th class="text-center">วิทยาเขต</th>
                            <th class="text-center">Link</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>

        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 0-->
    <div class="portfolio-modal modal fade" id="portfolioModal0" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal0Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal0Label">Thanks for coming</h2>
                                <!-- Icon Divider-->

                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>



                                <!-- Portfolio Modal - Text-->

                                
                                <a class="btn btn-primary" href="https://www.swu.ac.th/">
                                    เว็บไซต์หลัก
                                </a>
                                <button onclick="self.close()" class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal000" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal000Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal0Label">เลือกตัวเลือกของคุณ</h2>
                                <!-- Icon Divider-->

                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>



                                <!-- Portfolio Modal - Text-->

                                <a class="btn btn-primary" href="faculty/faculty.html">
                                    ไปด้วยรถตู้
                                </a>
                                <a class="btn btn-primary" href="service/service.html">
                                    รถส่วนตัว
                                </a>
                                <button onclick="self.close()" class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal00" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal000Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal0Label">เลือกตัวเลือกของคุณ</h2>
                                <!-- Icon Divider-->

                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>



                                <!-- Portfolio Modal - Text-->

                                <a class="btn btn-primary" href="faculty/faculty.html">
                                    คณะต่างๆในมหาลัย
                                </a>
                                <a class="btn btn-primary" href="service/service.html">
                                    บริการต่างๆในมหาลัย
                                </a>
                                <button onclick="self.close()" class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal1Label">MRT</h2>
                                <!-- Icon Divider-->

                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>

                                <!-- Portfolio Modal - Image-->
                                <div class="img-fluid rounded mb-5"><iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d968.8745445908403!2d100.56256402920988!3d13.748804102075107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQ0JzU1LjciTiAxMDDCsDMzJzQ3LjIiRQ!5e0!3m2!1sth!2sth!4v1607702711888!5m2!1sth!2sth"
                                        height="300" frameborder="0" style="border:0;" allowfullscreen=""
                                        aria-hidden="false" tabindex="0"></iframe></div>

                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">ลงสถานีสุขุมวิท และออกทางออก 3 ขึ้นบันไดออกมาจาก mrt
                                    ให้เลี้ยวซ้ายและเดินตามตามทางเท้า จะเจอวินมอเตอร์ไซค์ ค่าบริการ 20 บาท
                                    หรือ
                                    ลงสถานีเพชรบุรี และออกทางออก 2 ขึ้นบันไดออกมาจาก mrt ให้จะเจอวินมอเตอร์ไซค์
                                    ค่าบริการ 15 บาท</p>
                                <a class="btn btn-primary"
                                    href="https://www.google.com/maps/dir/13.7488839,100.563117/13.7463538,100.5656079/@13.7460174,100.5634301,100z/data=!4m3!4m2!3e2!5i1"
                                    target="_blank">
                                    นำทาง
                                </a>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal1Label">MRT</h2>
                                <!-- Icon Divider-->

                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>

                                <!-- Portfolio Modal - Image-->
                                <div class="img-fluid rounded mb-5"><iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d968.8745445908403!2d100.56256402920988!3d13.748804102075107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQ0JzU1LjciTiAxMDDCsDMzJzQ3LjIiRQ!5e0!3m2!1sth!2sth!4v1607702711888!5m2!1sth!2sth"
                                        height="300" frameborder="0" style="border:0;" allowfullscreen=""
                                        aria-hidden="false" tabindex="0"></iframe></div>

                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">ลงสถานีสุขุมวิท และออกทางออก 3 ขึ้นบันไดออกมาจาก mrt
                                    ให้เลี้ยวซ้ายและเดินตามตามทางเท้า จะเจอวินมอเตอร์ไซค์ ค่าบริการ 20 บาท
                                    หรือ
                                    ลงสถานีเพชรบุรี และออกทางออก 2 ขึ้นบันไดออกมาจาก mrt ให้จะเจอวินมอเตอร์ไซค์
                                    ค่าบริการ 15 บาท</p>
                                <a class="btn btn-primary"
                                    href="https://www.google.com/maps/dir/13.7488839,100.563117/13.7463538,100.5656079/@13.7460174,100.5634301,100z/data=!4m3!4m2!3e2!5i1"
                                    target="_blank">
                                    นำทาง
                                </a>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 1-->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal1Label">MRT</h2>
                                <!-- Icon Divider-->

                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>

                                <!-- Portfolio Modal - Image-->
                                <div class="img-fluid rounded mb-5"><iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d968.8745445908403!2d100.56256402920988!3d13.748804102075107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQ0JzU1LjciTiAxMDDCsDMzJzQ3LjIiRQ!5e0!3m2!1sth!2sth!4v1607702711888!5m2!1sth!2sth"
                                        height="300" frameborder="0" style="border:0;" allowfullscreen=""
                                        aria-hidden="false" tabindex="0"></iframe></div>

                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">ลงสถานีสุขุมวิท และออกทางออก 3 ขึ้นบันไดออกมาจาก mrt
                                    ให้เลี้ยวซ้ายและเดินตามตามทางเท้า จะเจอวินมอเตอร์ไซค์ ค่าบริการ 20 บาท
                                    หรือ
                                    ลงสถานีเพชรบุรี และออกทางออก 2 ขึ้นบันไดออกมาจาก mrt ให้จะเจอวินมอเตอร์ไซค์
                                    ค่าบริการ 15 บาท</p>
                                <a class="btn btn-primary"
                                    href="https://www.google.com/maps/dir/13.7488839,100.563117/13.7463538,100.5656079/@13.7460174,100.5634301,100z/data=!4m3!4m2!3e2!5i1"
                                    target="_blank">
                                    นำทาง
                                </a>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Portfolio Modal 2-->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal2Label">BTS</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <img class="img-fluid rounded mb-5"><iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1937.8455448386942!2d100.55963500057204!3d13.737142948379088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQ0JzEzLjciTiAxMDDCsDMzJzM3LjAiRQ!5e0!3m2!1sth!2sth!4v1607774033954!5m2!1sth!2sth"
                                    height="300" frameborder="0" style="border:0;" allowfullscreen=""
                                    aria-hidden="false" tabindex="0"></iframe>
                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">ลงสถานี อโศก และออกทางออก 3 ลงสะพานลอยมา
                                    ให้เลี้ยวซ้ายและเดินตามตามทางเท้า จะเจอวินมอเตอร์ไซค์ ค่าบริการ 20 บาท</p>
                                <a class="btn btn-primary"
                                    href="https://www.google.com/maps/dir/13.7369211,100.5605971/13.7370651,100.5612397/@13.7369271,100.559839,18z"
                                    target="_blank">
                                    นำทาง
                                </a>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Portfolio Modal 3-->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal3Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal3Label">เรือ</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <img class="img-fluid rounded mb-5"><iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1370.2087515060805!2d100.56549717104627!3d13.74654282844703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x992fec34355f1ee7!2z4Lih4Lio4LinLuC4m-C4o-C4sOC4quC4suC4meC4oeC4tOC4leC4ow!5e0!3m2!1sth!2sth!4v1607774564817!5m2!1sth!2sth"
                                    height="300" frameborder="0" style="border:0;" allowfullscreen=""
                                    aria-hidden="false" tabindex="0"></iframe>
                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">ให้ลงท่าเรือ มศว ประสานมิตร จะถึง มศว เลย</p>

                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Portfolio Modal 4-->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal4Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal4Label">รถเมล์</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <img class="img-fluid rounded mb-5"><iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d968.8759447002222!2d100.5657793292254!3d13.748465702076947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQ0JzU0LjUiTiAxMDDCsDMzJzU4LjgiRQ!5e0!3m2!1sth!2sth!4v1607775218228!5m2!1sth!2sth"
                                    height="300" frameborder="0" style="border:0;" allowfullscreen=""
                                    aria-hidden="false" tabindex="0"></iframe>
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d407.3674217394745!2d100.56264496202782!3d13.745437377108326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29eefef88d691%3A0xd9a08db0540c988b!2z4Lib4LmJ4Liy4Lii4Lij4LiW4Lib4Lij4Liw4LiI4Liz4LiX4Liy4LiHIOC4oeC4q-C4suC4p-C4tOC4l-C4ouC4suC4peC4seC4oiDguKHguKjguKcuIOC4m-C4o-C4sOC4quC4suC4meC4oeC4tOC4leC4oyAx!5e0!3m2!1sth!2sth!4v1607775319653!5m2!1sth!2sth"
                                    height="300" frameborder="0" style="border:0;" allowfullscreen=""
                                    aria-hidden="false" tabindex="0"></iframe>
                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">รถเมล์สาย 11, 23, 58, 60, 72, 93, 99, 113, 206, 512, ปอ.พ. 10 และปอ.พ.
                                    23 เข้าซอยข้าง 7-eleven และ CP Freshmart ข้ามสะพานคลองแสนแสบ
                                    หรือรถเมล์สาย 138, 98, 136 ลงหน้า Q House เดินเข้าลาน SWUNIPLEX
                                    หรือลงโรงพยาบาลจักษุรัตนิน เดินเข้าซอยด้านข้างมหาวิทยาลัย
                                </p>
                                <a class="btn btn-primary"
                                    href="https://www.google.com/maps?saddr=13.748495675456079,%20100.56637765406155&daddr=13.74672052026677,%20100.56562800554744"
                                    target="_blank">
                                    นำทางจาก CP
                                </a>
                                <a class="btn btn-primary"
                                    href="https://www.google.com/maps?saddr=13.745432014069909,%20100.56271183541024&daddr=13.74495662721125,%20100.56351637650808"
                                    target="_blank">
                                    นำทางจาก Q House
                                </a>


                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Portfolio Modal 5-->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal5Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal5Label">Airport Rail Link</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <img class="img-fluid rounded mb-5"><iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1629.434532350184!2d100.56165773365498!3d13.750489791265197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29e5ac5aaca45%3A0xe17e938f6140a81c!2z4Lih4Lix4LiB4LiB4Liw4Liq4Lix4LiZ!5e0!3m2!1sth!2sth!4v1607775504165!5m2!1sth!2sth"
                                    height="300" frameborder="0" style="border:0;" allowfullscreen=""
                                    aria-hidden="false" tabindex="0"></iframe>
                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">ลงสถานีมักกะสัน และเดินทางไป mrt เพชรบุรีและต่อมอเตอร์ไซค์ ค่าบริการ 15
                                    บาท</p>
                                <a class="btn btn-primary"
                                    href="https://www.google.com/maps?saddr=13.751256486094643,%20100.56077100910281&daddr=13.748846955566817,%20100.56311616298701"
                                    target="_blank">
                                    นำทาง
                                </a>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Portfolio Modal 6-->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal6Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal6Label">รถยนต์ส่วนตัว</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <img class="img-fluid rounded mb-5"> <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d814.7385236112201!2d100.5640909522842!3d13.744379330555352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQ0JzQwLjciTiAxMDDCsDMzJzUxLjQiRQ!5e0!3m2!1sth!2sth!4v1607776428453!5m2!1sth!2sth"
                                    height="300" frameborder="0" style="border:0;" allowfullscreen=""
                                    aria-hidden="false" tabindex="0"></iframe>
                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">มาได้จากเส้น ถ.รัชดาภิเษก, หรือมาทาง ถ.พระราม 3, แยกอโศก, แยกเพชรบุรี
                                    ทางด่วนที่ใกล้ ทางด่วนพระราม 9 และทางพิเศษศรีรัชแยกประดิษฐ์มนูธรรม
                                    หรือตรงเข้าซอยสุขุมวิท 23 มาได้จากเส้น ถ.สุขุมวิท จุดสังเกตจะมีปั๊ม Shell
                                    ขับตรงมาจากปากซอย 23 เรื่อยๆจนสุดซอยเข้ามหาลัย จะเจอทางลงไปที่ลานจอดรถใต้สนามฟุตบอล
                                </p>
                                <a class="btn btn-primary"
                                    href="https://www.google.com/maps?saddr=13.735733624374685,%20100.5625898148299&daddr=13.74401819082544,%20100.56397155942464"
                                    target="_blank">
                                    นำทาง
                                </a>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Contact form JS-->
    <script src="assets/mail/jqBootstrapValidation.js"></script>
    <script src="assets/mail/contact_me.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>