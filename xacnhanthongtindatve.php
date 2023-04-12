<?php
include('header.php');
?>
<title>Xác Nhận Thông tin</title>
<div class="m-5">
    <form class="p-5 m-5" action="phieudatve.php" method="post">
        <div class="row border d-flex justify-content-center"
            style="border-radius: 15px 15px 0 0; background-color:#E9E9E9;">
            <h4 class=" p-3 font-weight-bold" style="color: #ba2f25; text-align: center;">THÔNG TIN HÀNH KHÁCH</h4>
        </div>
        <div class="row border-left border-right shadow">
            <div class="row ml-5 mr-5">
                <div class="col m-3 p-5 border-right">
                    <h5 class="border p-1 ml-5 mr-5"
                        style="color: #ba2f25; text-align: center; border-radius:10px; background-color: #f7f7f7;">XÁC
                        NHẬN THÔNG TIN</h5>
                    <div class="row border mt-3" style="border-radius:10px; background-color: #f7f7f7;">
                        <?php
                        $gettenben = "SELECT bx.TENBEN from tuyenxe t, benxe bx WHERE t.MABX = bx.MABX AND bx.MABX = '" . $_SESSION["benxedi"] . "'";
                        $result = mysqli_query($conn, $gettenben);
                        $row = mysqli_fetch_assoc($result);
                        $StringTenViTri = implode(",", $_SESSION['tenvitri']);
                        echo '<div class="m-4" id="info-personal">';
                        echo '<p><b style="color: #ba2f25;">Họ tên hành khách: </b>' . $_SESSION["name"] . '</p>';
                        echo '<p><b style="color: #ba2f25;">Số điện thoại: </b>' . $_SESSION["sdt"] . '</p>';
                        echo '<p><b style="color: #ba2f25;">Email: </b>' . $_SESSION["email"] . '</p>';
                        echo '<p><b style="color: #ba2f25;">Chuyến xe: </b>' . $_SESSION["tenchuyenxe"] . '</p>';
                        echo '<p><b style="color: #ba2f25;">Thời gian khởi hành: </b>' . $_SESSION["thoigiankhoihanh"] . '</p>';
                        echo '<p><b style="color: #ba2f25;">Số lượng ghế: </b>' . $_SESSION["tongsove"] . '</p>';
                        echo '<p><b style="color: #ba2f25;">Tên ghế: </b>' . $StringTenViTri . '</p>';
                        echo '<p><b style="color: #ba2f25;">Tổng số tiền: </b>' . $_SESSION['tongsotien'] . '.000đ</p>';
                        echo '<p><b style="color: #ba2f25;">Điểm lên xe: </b>' . $row["TENBEN"] . '</p>';
                        echo '<br>';
                        echo '<p><input type="checkbox" required> Chấp nhận <b style="color: #ba2f25;">điều khoản đặt vé</b> của Xe Khách ABC</p>';
                        echo '</div>';
                        ?>
                    </div>
                </div>
                <div class="col m-3 p-5">
                    <h5 class="border p-1 ml-5 mr-5"
                        style="color: #ba2f25; text-align: center; border-radius:10px; background-color: #f7f7f7;">QUY
                        ĐỊNH & ĐIỀU KHOẢN</h5>
                    <div class="row border mt-3" style="border-radius:10px; background-color: #f7f7f7;">
                        <div class="m-4">
                            <div class="row">
                                <p>(*) Quý khách vui lòng mang email có chứa mã vé đến văn phòng để đổi vé lên xe trước
                                    giờ xuất bến ít nhất <b style="color: #ba2f25;">60 phút</b> để chúng tôi trung
                                    chuyển.</p>
                            </div>
                            <div class="row">
                                <p>(*) Thông tin hành khách phải chính xác, nếu không sẽ không thể lên xe hoặc hủy/đổi
                                    vé.</p>
                            </div>
                            <div class="row">
                                <p>(*) Quý khách không được đổi/trả vé vào các ngày Lễ Tết (ngày thường quý khách được
                                    quyền chuyển đổi hoặc hủy vé <b style="color: #ba2f25;">một lần</b> duy nhất trước
                                    giờ xe chạy 24 giờ), phí hủy vé 10%.</p>
                            </div>
                            <div class="row">
                                <p>(*) Nếu quý khách có nhu cầu trung chuyển, vui lòng liên hệ số điện thoại <b
                                        style="color: #ba2f25;">1900 2082</b> trước khi đặt vé. Chúng tôi không
                                    đón/trung chuyển tại những điểm xe trung chuyển không thể tới được.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border shadow border-top-0 pb-5" style="border-radius: 0 0 15px 15px; background-color:white;">
            <div class="col-md-6">
                <button class="btn btn-outline-secondary mr-4 p-2" style="width: 50%; float: right;" type="submit"
                    name="action" value="quayve">QUAY VỀ</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-info p-2" style="width: 50%;" type="submit" name="action" value="xacnhan">XÁC
                    NHẬN</button>

            </div>
        </div>
    </form>
</div>

<?php
include('footer.php');
?>