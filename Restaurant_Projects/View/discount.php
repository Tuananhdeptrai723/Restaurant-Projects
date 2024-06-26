<!DOCTYPE html>

<?php
 include '../Controller/DiscountController.php';
 $role = isset($_SESSION['roleAccount']) ? $_SESSION['roleAccount'] : 'guest';
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/discount.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
  </head>
  <body>
    <nav class="dashboard">
      <div class="header">
        <a href="./main.php">Food Shop</a>
      </div>

      <div class="menu">
        <a href="./info.php" class="active ">
          <i class="fa-regular fa-user"></i>
          <span>Thông tin cá nhân</span>
        </a>

      <a style="background-color: #3b82f6"  href="./discount.php" class="active admin-only">
      <i class="fa-solid fa-tags"></i>
          <span>Quản lý mã giảm giá</span>
        </a>

      <a  href="./quanly.php" class="active admin-only">
      <i class="fa-solid fa-cube"></i>
        <span>Quản lý sản phẩm</span>
      </a>

      <a href="./qltk.php" class="active admin-only">
      <i class="fa-solid fa-user-tie"></i>
        <span>Quản lý tài khoản</span>
      </a>

        <a href="./changepass.php" class="active">
          <i class="fa-solid fa-key"></i>
          <span>Đổi mật khẩu</span>
        </a>
        <a href="../index.html" class="active">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Đăng xuất</span>
        </a>
      </div>
    </nav>

    <main class="main-dashboard">
    <div class="container">
        <h1>Quản lý mã giảm giá</h1>
        <div class="form-container">
        <form id="couponForm" onsubmit="submitAdd(); return false;">
                <label for="code">Mã giảm giá</label>
                <input type="text" id="Addcode" required>
                <label for="discount">Tỉ lệ giảm giá</label>
                <input type="number" id="Adddiscount" required>
                <button type="submit">

                  <span><i class="fa-solid fa-plus"></i></span>
                  Thêm mã giảm giá
                
                </button>
        </form>
        </div>
        <div class="table-container">
            <table id="couponTable">
                <thead>
                    <tr>
                        <th>Mã giảm giá</th>
                        <th>Tỉ lệ giảm giá</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Kết nối cơ sở dữ liệu không bị đóng trước khi thực hiện truy vấn
                $result = $conn->query("SELECT MaGiam, TiLe FROM discount");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['MaGiam']}</td><td>{$row['TiLe']}%</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Không tìm thấy mã giảm giá</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    </main>
  </body>
  <script src="../assets/JS/discount.js">
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
  </script>
</html>
