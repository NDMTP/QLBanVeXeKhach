<?php
$conn = mysqli_connect("localhost", "root", "", "qlbanvexe");

if (!$conn) {
  die("Kết nối không thành công: " . mysqli_connect_error());
}

session_start();
//Tạo phiếu đặt vé
$pdv_id = 'P' . rand(1, 999);
$pdv_count = "SELECT COUNT(MAPHIEU) SOPHIEU FROM phieudatve WHERE phieudatve.MAPHIEU = '" . $pdv_id . "'";
$result = mysqli_query($conn, $pdv_count);
$row = mysqli_fetch_assoc($result);
while ($row["SOPHIEU"] > 0) {
  $pdv_id = 'P' . rand(1, 999);
  $pdv_count = "SELECT COUNT(MAPHIEU) SOPHIEU FROM phieudatve WHERE phieudatve.MAPHIEU = '" . $pdv_id . "'";
  $result = mysqli_query($conn, $pdv_count);
  $row = mysqli_fetch_assoc($result);
}
$pdv_email = $_SESSION["email"];
$pdv_date = date('Y-m-d');
$pdv_money = intval(str_replace(['.', ','], '', $_SESSION['tongsotien']), 10);

//Tạo vé
$v_id = 'V' . rand(1, 999);
$v_count = "SELECT COUNT(ID_VE) SOVE FROM vexe WHERE vexe.ID_VE = '" . $v_id . "'";
$result = mysqli_query($conn, $v_count);
$row = mysqli_fetch_assoc($result);
while ($row["SOVE"] > 0) {
  $v_id = 'V' . rand(1, 999);
  $v_count = "SELECT COUNT(ID_VE) SOVE FROM vexe WHERE vexe.ID_VE = '" . $v_id . "'";
  $result = mysqli_query($conn, $v_count);
  $row = mysqli_fetch_assoc($result);
}
$v_idChuyenXe = $_SESSION["idchuyenxe"];
$v_idPdv = $pdv_id;
$v_idViTri = $_SESSION['idvitri'];

foreach ($_SESSION['idvitri'] as $key => $value) {
  ${'id' . ($key + 1)} = $value;
}


$v_sove = $_SESSION["tongsove"];


if ($_POST['action'] == 'xacnhan') {
  //Tạo phiếu
  $query = "INSERT INTO `phieudatve` (`MAPHIEU`, `EMAIL`, `NGAYLAP`, `TongTien`) VALUES ('" . $pdv_id . "', '" . $pdv_email . "', '" . $pdv_date . "', '" . $pdv_money . "')";
  $result = mysqli_query($conn, $query);
  //Tạo vé
  for ($i = 1; $i <= $v_sove; $i++) {
    $idghe = ${'id' . $i};
    $v_ten = 'Vé ' . $v_id;
    $query = "INSERT INTO `vexe` (`ID_VE`, `ID_CHUYENXE`, `MAPHIEU`, `ID_VITRI`, `TENVE`) VALUES ('" . $v_id . "', '" . $v_idChuyenXe . "', '" . $v_idPdv . "', '" . $idghe . "', '" . $v_ten . "')";
    $result = mysqli_query($conn, $query);
    $v_id = 'V' . substr($v_id, 1) + 1;
  }
}

include('header.php');
?>
<div class="text-center p-4">
    <i style="color: green; font-size: 80px;"class="fa-sharp fa-solid fa-circle-check"></i>
    <h1>Đơn đặt hàng thành công</h1>
    <p>Mã giao dịch:</p>
    </div>
    <div class="container">
        <div class="table-responsive" style="max-width: 1250px;">
        <table class="table table-striped table-hover align-middle mx-auto">
        <thead>
        <tr>
          <th scope="col">Thời gian</th>
          <th scope="col">Tên sản phẩm</th>
          <th scope="col">Số lượng</th>
          <th scope="col">Thành tiền</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>2023-04-12 15:30:25</td>
          <td>Vé tầng 1</td>
          <td>2</td>
          <td>1.200.000 đ</td>
        </tr>
        </tbody>
        </table>
        </div>
    </div>
    <div class="text-center p-4">
    <p style = "font-size: 20px;">Chúng tôi sẽ liên hệ với bạn sau khi chúng tôi nhận được đơn đặt hàng này</p>
    <a href="tel:090-080-0760" style = "font-size: 20px;">Mọi thắc mắc xin liên hệ với số điện thoại sau: 090-080-0760</a>
  </div>
<?php
include('footer.php');
?>