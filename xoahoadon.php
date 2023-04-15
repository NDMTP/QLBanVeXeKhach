<?php 
$conn = mysqli_connect("localhost", "root", "", "qlbanvexe");

if (!$conn) {
  die("Kết nối không thành công: " . mysqli_connect_error());
}

$idPDV = $_POST['idphieu'];

if ($_POST['action'] == 'xoaChuyen') {
    $query = "SELECT pdv.*, vx.* FROM phieudatve pdv
              INNER JOIN vexe vx ON pdv.MAPHIEU = vx.MAPHIEU
              INNER JOIN chuyenxe cx ON vx.ID_CHUYENXE = cx.ID_CHUYENXE
              WHERE pdv.MAPHIEU = '".$idPDV."'
              AND cx.THOIDIEMDITT < NOW()"; // Thêm điều kiện kiểm tra thời gian đi của chuyến xe
    $result = mysqli_query($conn, $query);
    if (!$result) {
      echo "Hủy chuyến thất bại: " . $conn->error;
    } else {
      $numRows = mysqli_num_rows($result);
      if ($numRows > 0) {
        echo '<script language="javascript">
        alert("Không thể hủy chuyến vì đã quá thời gian đi!");
        history.back();
        </script>';
      } else {
        $rmVe = "DELETE FROM vexe WHERE MAPHIEU = '".$idPDV."'";
        $result = mysqli_query($conn, $rmVe);
        $rmPDV = "DELETE FROM phieudatve WHERE MAPHIEU = '".$idPDV."'";
        $result = mysqli_query($conn, $rmPDV);
        if (!$result) {
          echo "Hủy chuyến thất bại: " . $conn->error;
        } else {
          echo '<script language="javascript">
          alert("Hủy chuyến thành công !");
          history.back();
          </script>';
        }
      }
    }
}
?>
