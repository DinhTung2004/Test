<?php

include_once('../connection/connect_database.php'); ?>

<!DOCTYPE html>
<html>
<header>
    <?php include_once("header1.php"); ?>
    <title>Bài viết</title>
    <?php include_once('header2.php'); ?>
</header>

<body>
    <?php include_once('header3.php'); ?>
    <!-- Nội dung ở đây -->
    <h3 style="text-align: center">DANH SÁCH CÁC BÀI VIẾT </h3>

    <div style="overflow-x: scroll">
        <table class=" table table-bordered hover" style="overflow-x: scroll" border="2">
            <thead class="text-center">
                <tr>
                    <td width=""><strong> STT</strong></td>
                    <td width=""><strong> ID BÀI VIẾT </strong></td>
                    <td width=""><strong> TÊN SẢN PHẨM </strong></td>
                    <td width=""><strong> TIÊU ĐỀ </strong></td>
                    <td width=""><strong> NGÀY CẬP NHẬT</strong></td>
                    <td width=""><strong> ẨN HIỆN</strong></td>
                    <td><a href="them_baiviet.php"><strong> THÊM </strong></a></td>
                </tr>
            </thead>
            <?php $stt = 0;
            $sl_baiviet = "select * from baiviet";
            $rs_baiviet = mysqli_query($conn, $sl_baiviet);
            if (!$rs_baiviet) {
                echo "<script language='javascript'>alert('Tạm ngưng phục vụ!');";
                echo "location.href='baiviet.php';</script>";
            } ?>
            <?php while ($r = $rs_baiviet->fetch_assoc()) { ?>
                <tbody>
                    <td width=""><strong><?php echo ++$stt; ?> </strong></td>
                    <td width=""><strong><?php echo $r['idBV']; ?> </strong></td>
                    <?php
                    $q_sp = "select TenSP from sanpham WHERE idSP=" . $r['idSP'];
                    $rs_sp = mysqli_query($conn, $q_sp);
                    $row_sp = mysqli_fetch_array($rs_sp);
                    ?>
                    <td width=""><strong><?php echo $row_sp['TenSP']; ?></strong></td>
                    <td><a href="chitiet_baiviet.php?idBV=<?php echo $r["idBV"] ?>"><?php echo $r['TieuDe']; ?> </strong></a>
                    </td>
                    <td width=""><strong><?php echo $r['NgayCapNhat']; ?> </strong></td>
                    <td width=""><strong><?php if ($r['AnHien'] == 1) echo "Hiện";
                                            else echo "Ẩn"; ?> </strong></td>
                    <td><a href="sua_xoa_baiviet.php?idBV=<?php echo $r["idBV"] ?>"><strong> Sửa/Xóa </strong></a></td>
                </tbody>
            <?php } ?>
        </table>
    </div>
    <?php include_once('footer.php'); ?>
</body>

</html>