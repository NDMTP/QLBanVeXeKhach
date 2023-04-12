<?php 
$conn = mysqli_connect("localhost", "root", "", "qlbanvexe");

if (!$conn) {
  die("Kết nối không thành công: " . mysqli_connect_error());
}

session_start();
//Tạo phiếu đặt vé
$pdv_id = 'P'.rand(1, 999);
$pdv_count = "SELECT COUNT(MAPHIEU) SOPHIEU FROM phieudatve WHERE phieudatve.MAPHIEU = '".$pdv_id."'";
$result = mysqli_query($conn, $pdv_count);
$row = mysqli_fetch_assoc($result);
while($row["SOPHIEU"] > 0){
    $pdv_id = 'P'.rand(1, 999);
    $pdv_count = "SELECT COUNT(MAPHIEU) SOPHIEU FROM phieudatve WHERE phieudatve.MAPHIEU = '".$pdv_id."'";
    $result = mysqli_query($conn, $pdv_count);
    $row = mysqli_fetch_assoc($result);
}
$pdv_email = $_SESSION["email"];
$pdv_date = date('Y-m-d');
$pdv_money = intval(str_replace(['.', ','], '', $_SESSION['tongsotien']), 10);

//Tạo vé
$v_id = 'V'.rand(1, 999);
$v_count = "SELECT COUNT(ID_VE) SOVE FROM vexe WHERE vexe.ID_VE = '".$v_id."'";
$result = mysqli_query($conn, $v_count);
$row = mysqli_fetch_assoc($result);
while($row["SOVE"] > 0){
    $v_id = 'V'.rand(1, 999);
    $v_count = "SELECT COUNT(ID_VE) SOVE FROM vexe WHERE vexe.ID_VE = '".$v_id."'";
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
    $query = "INSERT INTO `phieudatve` (`MAPHIEU`, `EMAIL`, `NGAYLAP`, `TongTien`) VALUES ('".$pdv_id."', '".$pdv_email."', '".$pdv_date."', '".$pdv_money."')";
    $result = mysqli_query($conn, $query);
    //Tạo vé
    for($i=1; $i<=$v_sove; $i++){
        $idghe = ${'id'.$i};
        $query = "INSERT INTO `vexe` (`ID_VE`, `ID_CHUYENXE`, `MAPHIEU`, `ID_VITRI`, `TENVE`) VALUES ('".$v_id."', '".$v_idChuyenXe."', '".$v_idPdv."', '".$idghe."', '".$v_ten."')";
        $result = mysqli_query($conn, $query);
        $v_id = 'V'.substr($v_id, 1)+1;
        $v_ten = 'Vé '.$v_id;
    }
  }

  include('header.php');
?>
<h1>ĐÃ ĐẶT THÀNH CÔNG !</h1>
<?php
  include('footer.php');
?>