
// PHP injects the role of the current user
const userRole = '<?php echo $role; ?>';

// JavaScript to show/hide elements based on role
document.addEventListener('DOMContentLoaded', () => {

if (userRole !== 'admin') {
console.log(111)
document.querySelectorAll('.admin-only').forEach(el => el.style.display = 'none');
}

if (userRole !== 'user') {
console.log(111)
document.querySelectorAll('.user-only').forEach(el => el.style.display = 'none');
}
});

function deleteProduct(cartId) {
    var modal = document.getElementById('confirmModal');
    var btnYes = document.getElementById('confirmYes');
    var btnNo = document.getElementById('confirmNo');

    // Mở modal
    modal.style.display = 'block';

    // Xử lý khi nhấn Có
    btnYes.onclick = function() {
        // Gửi yêu cầu xóa bằng AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../Cart/ConnectDb.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {

                // Tải lại trang
                window.location.reload();
            } else {
                alert('Có lỗi xảy ra khi xóa sản phẩm.');
            }
        };
        xhr.send('cartId=' + cartId);

        // Đóng modal
        modal.style.display = 'none';
    };

    // Xử lý khi nhấn Không
    btnNo.onclick = function() {
        // Đóng modal
        modal.style.display = 'none';
    };
}


function confirmPayment() {
    if (confirm('Bạn có chắc chắn muốn thanh toán không?')) {
        // Gửi yêu cầu xóa tất cả dữ liệu bằng AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Hiển thị thông báo thanh toán thành công
                alert('Thanh toán thành công!');
                // Tải lại trang để cập nhật giao diện
                window.location.reload();
            } else {
                // Hiển thị thông báo lỗi
                alert('Có lỗi xảy ra khi thanh toán.');
            }
        };
        xhr.send('deleteAll=true');
    }
}

var totalPriceElement = document.getElementById("totalPrice");
    var originalPrice = parseFloat(totalPriceElement.innerText.replace("$", ""));

    var discountInput = document.getElementById("discountInput");
    var applyButton = document.getElementById("applyButton");

    applyButton.addEventListener("click", function() {
        var discountCode = discountInput.value;

        // Gửi yêu cầu AJAX để lấy tỉ lệ giảm giá từ database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "ConnectDb.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var discount = parseInt(xhr.responseText);

                if (discount > 0) {
                    var discountedPrice = originalPrice * (1 - discount / 100);
                    totalPriceElement.innerText = "$" + discountedPrice.toFixed(2);
                } else {
                    totalPriceElement.innerText = "$" + originalPrice.toFixed(2);
                }
            }
        };
        xhr.send("code=" + encodeURIComponent(discountCode));
    });

// sorting 

