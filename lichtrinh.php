<!DOCTYPE html>
<html lang="EN">
<?php
include("header.php");
include("connect.php");
?>

<!-- Tim kiem tuyen-->
<div class="row timtuyen container">
    <div class="col-6 mt-3">
        <form class="d-flex" action="timkiem.php" method="POST">
            <input name="tentinh" list="tinh" class="form-control me-2" type="text" placeholder="Tìm Điểm Đi">
            <datalist id="tinh">
                <option value="An Giang">
                <option value="Cà Mau">
                <option value="Cần Thơ">
                <option value="Hậu Giang">
                <option value="Kiên Giang">
                <option value="Hồ Chí Minh">
                <option value="Sóc Trăng">
            </datalist>
            <input class="btn" type="submit" name="sbdau" value="Tìm"></input>
        </form>
        <!-- Tim kiem tuyen diem dau-->

    </div>
    <div class="col-6 mt-3 ">
        <form class="d-flex" action="timkiem.php" method="POST">
            <input name="tinhcuoi" list="tinhcuoi" class="form-control me-2" type="text" placeholder="Tìm Điểm Đi">
            <datalist id="tinhcuoi">
                <option value="An Giang">
                <option value="Cà Mau">
                <option value="Cần Thơ">
                <option value="Hậu Giang">
                <option value="Kiên Giang">
                <option value="Hồ Chí Minh">
                <option value="Sóc Trăng">
            </datalist>
            <input class="btn" type="submit" name="sbcuoi" value="Tìm"></input>
        </form>
        <!-- Tim kiem tuyen diem dau-->
    </div>
</div>
<!-- KT Tim kiem tuyen -->

<?php
//  <!-- bang tuyen xe -->
echo " 
       <div class=\" container bangtuyenxe\">
       <table class=\"table table-striped\" border-collapse=\"collapse\">
           <thead>
               <tr lass=\"table-light\">
                   <th scope=\"col\">Tuyến Xe</th>
                   <th scope=\"col\">Quãng Đường</th>
                   <th scope=\"col\">Thời Gian Đi</th>
                   <th scope=\"col\" colspan=\"2\">Chi Tiết Vé</th>
               </tr>
           </thead>
           <tbody>
               <tr>
       ";
$sql1 = "SELECT tentinh,matinh FROM tinhthanh";
$result1 = $conn->query($sql1);

while ($row = $result1->fetch_array()) {
    echo "<th scope=\"row\" colspan=\"6\" class=\"table-danger\">$row[0]</th>
            </tr>
            ";
    $sql = "SELECT tentuyen,quangduong,tgdichuyentb FROM tuyenxe,benxe,tinhthanh,quanhuyen 
            WHERE tinhthanh.MATINH = quanhuyen.MATINH 
            AND quanhuyen.MAQUANHUYEN = benxe.MAQUANHUYEN 
            AND benxe.MABX = tuyenxe.MABX 
            AND tinhthanh.MATINH = '$row[1]'";
    $result = $conn->query($sql);
    $result_all = $result->fetch_all();

    foreach ($result_all as $row) {
        echo '<tr class="table-light">';
        echo '<form action="" method="post">';
        echo '<td>' . $row[0] . '</td>';
        echo '<td>' . $row[1] . ' Km</td>';
        echo '<td>' . $row[2] . ' Giờ</td>';
        echo '<td><a href="#" class="text-decoration-none">Chi tiết <i class="fa-solid fa-circle-info"></i></a></td>';
        echo '<td><button class="text-danger border-0 bg-transparent" style="cursor: pointer;"><i class="fa-solid fa-ticket-simple"></i> Đặt Vé</button></td>';
        echo '</form>';
        echo '</tr>';
    }
}
echo "
          
          </table>
          </div>
          ";

?>
</section>
<!-- footer-->
<?php
include("footer.php");
?>
</body>

</html>