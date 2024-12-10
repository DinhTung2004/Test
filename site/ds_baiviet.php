<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 17-Apr-17
 * Time: 20:24
 */?>
<!DOCTYPE html>
<html>

<header>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style type="text/css">
        .example{
            margin: 20px;
        }
    </style>
    <?php include_once ("header.php"); ?>
<title>Bài viết</title>
<?php include_once ("header1.php");?>
    <style>
        .btn_time {background-image: url("../images/clock.png";)}
        .glyphicon.btn_time{background-image: url("../images/clock.png";)}
    </style>
    <link rel="stylesheet" href="../css/hoa.min.css" type="text/css">
</header>
<body>
<?php include_once ("header2.php");?>
<!---- Nội dung---->
<?php include_once('../connection/connect_database.php');?>
<?php

$result = mysqli_query($conn, 'select count(idBV) as total from baiviet');
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

//  TÌM LIMIT VÀ CURRENT_PAGE
$current_page = isset($_GET['page'])?$_GET['page'] : 1;
$limit = 6;
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page){
    $current_page = $total_page;
}
else if ($current_page < 1){
    $current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $limit;
// lấy danh sách tin tức
$result = mysqli_query($conn, "SELECT * FROM baiviet LIMIT $start, $limit");

?>

<body>
<div class="row">
    <div class="row text-center" style="margin-top:40px">
        <div id="productlist">
<?php
include ('../connection/connect_database.php');
$sql = "select * from baiviet ORDER by NgayCapNhat DESC ";
$rs_bv = mysqli_query($conn,$sql);
if(!$rs_bv)
{
    echo "<script language='javascript'>alert('Tạm ngưng hoạt động!');";
    echo "location.href='../site/index.php?index=1';</script>";
}
?>
<div class="indexh3 text-center">
    <h3>TIN TỨC</h3>
    <div class="sep-wrap center nz-clearfix">
        <div class="nz-separator solid" style="margin-top:10px; border-bottom-color:#ddd;width:40%;border-bottom-width:2px;">&nbsp;</div>
    </div>
    <div class="sep-wrap center nz-clearfix">
        <div class="nz-separator solid" style="margin-top:1px;margin-left:40%; border-bottom-color:#f1f1f1;width:40%;border-bottom-width:2px;">&nbsp;</div>
    </div>
</div>
<div style="margin-top:20px">
    <div class="row" id="newslist">
<?php while($r_bv=$result->fetch_assoc() ){?>
        <div class="col-md-6 col-sm-6" style="margin-bottom:20px">
            <div class="newsboxinmenu">
                <div id="hover-new" class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <a href="#" class="prod-block">
                                    <span class="prod-image-blocknew">
                                        <span class="prod-image-box">
                                            <img class="prod-image" src="../images/<?php echo $r_bv['img'];?>" alt="" />
                                        </span>
                                    </span>
                        </a>
                    </div>
                    <div class="col-md-7  col-sm-7 col-xs-12">
                        <div class="prod-image-blocknewtit">
                            <a href="MoTa_BaiViet.php?idBV=<?php echo $r_bv['idBV'];?>" class="new-block">
                                    <h4 class="color-hover"><?php echo $r_bv['TieuDe'];?></h4>
                                    <p><i class="glyphicon btn_time"></i> <?php echo $r_bv['NgayCapNhat'];?></p>
                                    <div class="text-limit-news"><?php echo $r_bv['MoTa'];?></div>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
<?php }?></div>
</div>
            <div class="example">
                <div class="row" align="center">
                    <div class="pagination" >
                        <?php
                        // PHẦN HIỂN THỊ PHÂN TRANG
                        echo "<ul class=\"pagination\">";
                        if ($current_page > 1 && $total_page > 1){
                            echo '<li><a href="ds_baiviet.php?page='.($current_page-1).'">Prev</a> </li> ';
                        }
                        for ($i = 1; $i <= $total_page; $i++){
                            if ($i == $current_page){
                                echo '<li><span>'.$i.'</span> </li> ';
                            }
                            else{
                                echo '<li><a href="ds_baiviet.php?page='.$i.'">'.$i.'</a> </li> ';
                            }
                        }
                        if ($current_page < $total_page && $total_page > 1){
                            echo '<li><a href="ds_baiviet.php?page='.($current_page+1).'">Next</a> </li> ';
                        }
                        echo "</ul>";
                        ?>
                    </div>
                </div>
            </div>
<?php include_once ("footer.php");?>

</body>
</html>