<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 17-Mar-17
 * Time: 23:38
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<header>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style type="text/css">
        .example{
            margin: 20px;
        }
    </style>
    <?php include_once ("header.php");?>
    <title>Trang chủ</title>
    <?php include_once ("header1.php");?>
    <?php include ('../connection/connect_database.php');?>
    <?php include ('../libs/lib.php');?>
    <style>
        .box{ border-radius: 2%;}
        .box.hover{border-color: green;}
        .boxsizing {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            width: 180px;
            height: 182px;
            border: 1px solid blue;
        }
        div.row{padding-top: 2%;}

        .buyproduct{ background-color: #fbc902;}
    </style>
    <style type="text/css">

        .hovergallery:hover{
            -webkit-transform:scale(1.2); /*Webkit: Scale up image to 1.2x original size*/
            -moz-transform:scale(1.2); /*Mozilla scale version*/
            -o-transform:scale(1.2); /*Opera scale version*/
            box-shadow:0px 0px 30px gray; /*CSS3 shadow: 30px blurred shadow all around image*/
            -webkit-box-shadow:0px 0px 30px gray; /*Safari shadow version*/
            -moz-box-shadow:0px 0px 30px gray; /*Mozilla shadow version*/
            opacity: 1;
        }
    </style>

    <link rel="stylesheet" href="../css/hoa.min.css" type="text/css">
    <link rel="stylesheet" href="../css/layout.min.css" type="text/css">

</header>
<body>
<?php include_once ("header2_index.php");?>
    <!---- Nội dung----><div class="row">
        <div class="col-md-2"><strong></strong></div>
        <div class="col-md-9">
        </div>
    </div>
    <!---- Nội dung---->
    <?php
    if(isset($_GET['index'])) {
        switch ($_GET['index']) {
            case 1: {

                $sl_sanpham = "select * from sanpham WHERE AnHien=1";
                $rs_sanpham = mysqli_query($conn, $sl_sanpham);
                if (!$rs_sanpham) {
                    echo "<script language='javascript'>alert('Không thể kết nối !');";
                    echo "location.href='index.php?index=1';</script>";
                }
                include_once ("../site/loc_all.php");
                break;
            }
            case 2: {
                include_once ("../site/TimKiemNoiBat.php");
                break;
            }
            case 3:{
                include_once ("../site/TimKiem_SPBanChay.php");
                break;
            }
            case 4:{
                include_once ("../site/TimKiem_SPKhuyenMai.php");
                break;
            }
            case 5:{
                include_once ("../site/TimKiem_SPMoiVe.php");
                break;
            }
            case 6:{
                include_once ("../site/TimKiem_SPXemNhieu.php");
                break;
            }
            case 7:{
                include_once ("../site/TimKiem_GiaCaoThap.php");
                break;
            }
            case 8:{
                include_once ("../site/TimKiem_GiaThapCao.php");
                break;
            }
        }
    }
    else
    {
        echo "<script language='javascript'> location.href='index.php?index=1';</script>";
    }

    ?>


        <!---- Khuyến mãi---->
        <!--Trigger the modal with a button -->
        <div id="myModal" style="margin-top: 90px;" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="background-color: transparent;">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" style="color: #f7fff6; font-size: 200%;">&times;</button>
                        <?php
                        include_once ('../connection/connect_database.php');
                        $sl_km="select * from khuyenmai where AnHien=1";
                        $qr_km = mysqli_query($conn,$sl_km);
                        $d=mysqli_fetch_array($qr_km);
                        ?>
                        <p><img src="../images/<?php echo $d['urlHinh'];?>"></p>
                    </div>
                </div>

            </div>
        </div>
        <!--Hiển thị khuyến mãi-->
        <?php if(!isset($_SESSION['solan']))
            $_SESSION['solan']=0;
        else
            $_SESSION['solan']++;
        if($_SESSION['solan']==0) {
            echo "<script language='JavaScript'>
                $(window).on('load',function(){
                    $('#myModal').modal('show');
                });
            </script>";
        }
        else
            echo "<script>$('#x').click(function(event){
                $('#myModal').hide();
                $('.modal-backdrop').hide(); 

});</script>";
        ?>
        <?php include_once ("footer.php");?>

    </body>
</html>
