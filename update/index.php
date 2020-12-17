<!DOCTYPE html>
<html lang='en'>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Chakra+Petch&display=swap');

    h1 {
        font-family: 'Chakra Petch', sans-serif;
        text-align: center;
    }

    input {

        text-align: center;
    }

    body {
        background: url('img/1.png') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
    }

    #feedback-page {
        text-align: center;
    }

    #form-main {
        width: 100%;
        float: left;
        padding-top: 0px;
    }

    #form-div {
        background-color: rgba(99, 100, 102, 0.4);
        padding-left: 35px;
        padding-right: 35px;
        padding-top: 35px;
        padding-bottom: 50px;
        width: 450px;
        float: left;
        left: 50%;
        position: absolute;
        margin-top: 30px;
        margin-left: -260px;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
    }

    .feedback-input {
        color: #3c3c3c;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: 500;
        font-size: 18px;
        border-radius: 0;
        line-height: 22px;
        background-color: #fbfbfb;
        padding: 13px 13px 13px 54px;
        margin-bottom: 10px;
        width: 100%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
        border: 3px solid rgba(0, 0, 0, 0);
    }

    .feedback-input:focus {
        background: #fff;
        box-shadow: 0;
        border: 3px solid#DA2128;
        color: #DA2128;
        outline: none;
        padding: 13px 13px 13px 54px;
    }

    .focused {
        color: #DA2128;
        border: #DA2128 solid 3px;
    }




    #name {
        background-image: url("img/logo_color.png");
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #name:focus {
        background-image: url('img/logo_color.png');
        background-size: 30px 30px;
        background-position: 8px 5px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }


    textarea {
        width: 100%;
        height: 150px;
        line-height: 150%;
        resize: vertical;
    }

    input:hover,
    textarea:hover,
    input:focus,
    textarea:focus {
        background-color: white;
    }

    #button-blue {
        font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        float: left;
        width: 100%;
        border: white solid 4px;
        cursor: pointer;
        background-color: #414141;
        /*สีปุ่ม verify ก่อน hover*/
        color: white;
        font-size: 24px;
        padding-top: 22px;
        padding-bottom: 22px;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
        margin-top: -4px;
        font-weight: 700;
    }

    #button-blue:hover {
        background-color: rgba(0, 0, 0, 0);
        color: #000000;
    }

    .submit:hover {
        color: #DA2128;
    }

    .ease {
        width: 0px;
        height: 74px;
        background-color: #636466;
        -webkit-transition: .3s ease;
        -moz-transition: .3s ease;
        -o-transition: .3s ease;
        -ms-transition: .3s ease;
        transition: .3s ease;
    }

    .submit:hover .ease {
        width: 100%;
        background-color: #4cce24;
        /*สีหลังเอาเม้าส์ไปชี้*/
    }


    @media only screen and (max-width: 580px) {
        #form-div {
            left: 3%;
            margin-right: 3%;
            width: 88%;
            margin-left: 0;
            padding-left: 3%;
            padding-right: 3%;
        }
    }

    input[placeholder] {
        text-align: center;
    }
</style>
<div id="form-main">
    <div id="form-div">
        <form class="form" id="form1" action="php/verify.php" method="POST">
            <h1 style="color:#000000; font-size: 25px">กรุณากรอกไอดี Buasri เพื่อยืนยันตัวตน</h1>
            <p class="name">
                <input name="name" type="text" class="feedback-input" id="name" />
            </p>
            <div class="g-recaptcha" data-sitekey="6LfK9AcaAAAAABvfsVOWH2r2xrs-Qn-iupPjt4tp"></div>
            <br>
            <div class="submit">
                <input type="submit" value="Verify" name="verify" id="button-blue" />
                <div class="ease"></div>

        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $("#form1").submit(function (event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            console.log(form_data);
            $.ajax({
                type: 'POST',
                url: 'php/verify.php',
                data: form_data,
                dataType: 'json',
                success: function (data) {
                    
                    if (data.status) {
                        Swal.fire({
                            title: 'สำเร็จ!',
                            text: data.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,

                        }).then(function(){
                            window.location.href = '../update/user_map.php';
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ผิดพลาด !',
                            text: data.message,
                            showDenyButton: true,
                            denyButtonText: `Retry`,
                            showConfirmButton: false
                        })
                    }
                }

            });
        });
    });
</script>

</html>