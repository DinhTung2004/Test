<?php
if(!isset($_SESSION))
{
    session_start();ob_start();
}
$SLuong=0;
if(isset($_SESSION['cart']) && $_SESSION['cart']!=null)
{
    foreach ($_SESSION['cart'] as $list)
        $SLuong+= $list['qty'];
}
else $SLuong =0;
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 17-Apr-17
 * Time: 21:14
 */
echo "  <header class=\"wrapper clearfix\">
    <div id=\"banner\">
        <div id=\"logo\"><a href=\"\"><img src=\"../images/logo_anspa.png\" width=\"100px\" height=\"100px\" alt=\"logo\"></a></div>
    </div>

    <!-- main navigation -->
    <nav id=\"topnav\" role=\"navigation\" >
        <div class=\"menu-toggle\">Menu</div>
        <ul class=\"srt-menu\" id=\"menu-main-navigation\">
            <li class=\"current\"><a href=\"index.php?index=1\">HOME PAGE</a></li>
            <li><a href=\"#\">NƯỚC HOA </a>
                <ul>
               <li><a href=\"../site/loc_nuoc_hoa_nam.php\">NƯỚC HOA NAM</a> </li>
                <li><a href=\"../site/loc_nuoc_hoa_nu.php\">NƯỚC HOA NỮ</a> </li>
                <li><a href=\"../site/loc_nuoc_hoa_unisex.php\">NƯỚC HOA UNISEX</a></li>
                 <li><a href=\"../site/loc_nuoc_hoa_bo.php\">NƯỚC HOA BỘ</a></li>
                </ul>
            </li>
            <li>
                <a href=\"../site/ds_baiviet.php\">TIN TỨC NƯỚC HOA</a> 
            </li> ";
if(isset($_SESSION['HoTenK']))
{
    $nameuser = $_SESSION['HoTenK'];
    echo "
            <li>
                <a href=\"#\">";echo "<strong>". $nameuser."</strong>"; echo "</a>
                <ul>
                     <li><a href=\"../site/DangXuat.php\">Đăng xuất</a></li>
                     <li><a href=\"../site/Sua_TaiKhoan.php\">Sửa thông tin</a></li>";?>
    <?php if (isset($_SESSION['IDUser']))if($_SESSION['IDUser'] ==1)
    echo "<li><a href=\"../admin/index.php\"> Quản trị </a></li>";?>
              <?php echo " </ul>
            </li>";

}else
{
    echo "
            <li>
                <a href=\"#\">THÀNH VIÊN</a>
                <ul>
                    <li><a href=\"../site/TaoTaiKhoan.php\">Đăng ký </a></li>
                    <li><a href=\"../site/DangNhap.php\">Đăng nhập</a></li>
                     <li><a href=\"../site/DangXuat.php\">Đăng xuất</a></li>
                </ul>
            </li>";
}


echo " <li>
                 <li><a href=\"#\">BỘ LỌC</a>
                <ul>
                <li><a href=\"../site/index.php?index=1\">Tất cả</a> </li>
                <li><a href=\"../site/index.php?index=2\">Sản phẩm nổi bật</a> </li>
                <li><a href=\"../site/index.php?index=3\">Sản phẩm bán chạy</a> </li>
                <li><a href=\"../site/index.php?index=4\">Sản phẩm giảm giá</a> </li>
                <li><a href=\"../site/index.php?index=5\">Sản phẩm mới về</a> </li>
                <li><a href=\"../site/index.php?index=6\">Sản phẩm xem nhiều</a></li>
                <li><a href=\"../site/index.php?index=7\">Giá giảm dần</a></li>
                <li><a href=\"../site/index.php?index=8\">Giá tăng dần</a></li>
                </ul>
            </li>
             </li>
             <li> <div id=\"banner\">
        <div id=\"cart\"><a href=\"../site/GioHang.php?idSP=1\"><img src=\"../images/Cart.png\" width=\"30px\" height=\"30px\" alt=\"cart\">"; echo "  <strong>(".$SLuong.")</strong>"; echo "</a></div>
    </div></li>
        </ul>
    </nav><!-- end main navigation -->

</header><!-- end header -->
<!-- main content area -->
<div id=\"main\" class=\"wrapper\">


    <!-- content area -->
    <section id=\"content\" class=\"wide-content\">
        <div class=\"row\">
            <div class=\"col-md-12 col-lg-12 col-lg-offset-0\">
";