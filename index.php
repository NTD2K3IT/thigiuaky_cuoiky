<?php
require "config.php";

// Thêm category
if (isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Thêm thể loại thành công!</p>";
    } else {
        echo "<p style='color:red;'>Lỗi: " . $conn->error . "</p>";
    }
}

// Xoá category
// Xoá category và các sản phẩm liên quan
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Bắt đầu transaction
    $conn->begin_transaction();

    try {
        // 1️⃣ Xóa các sản phẩm thuộc category
        $stmt1 = $conn->prepare("DELETE FROM products WHERE category_id=?");
        $stmt1->bind_param("i", $id);
        $stmt1->execute();

        // 2️⃣ Xóa category
        $stmt2 = $conn->prepare("DELETE FROM categories WHERE id=?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();

        // Commit nếu không lỗi
        $conn->commit();
        echo "<p style='color:green;'>Xóa thể loại và sản phẩm liên quan thành công!</p>";
    } catch (Exception $e) {
        // Rollback nếu lỗi
        $conn->rollback();
        echo "<p style='color:red;'>Lỗi khi xóa: " . $e->getMessage() . "</p>";
    }
}


// Lấy danh sách category
$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Thêm link CSS Bootstrap 5 trong <head> nếu chưa có -->
    
    <header class="py-3 bg-light sticky-top border-bottom shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="m-0 h4">
                <a href="./index.php" class="text-decoration-none text-dark">YanZuRiiAdmin</a>
            </h1>
        </div>
    </header>
    <div class="container my-4">
        <!-- Tiêu đề -->
        <h2 class="mb-4">Quản lý Thể loại</h2>

        <!-- Form thêm category -->
        <form method="POST" class="row g-3 mb-4">
            <div class="col-auto">
                <input type="text" name="name" class="form-control" placeholder="Tên thể loại" required>
            </div>
            <div class="col-auto">
                <button type="submit" name="add_category" class="btn btn-primary">Thêm</button>
            </div>
        </form>

        <!-- Bảng hiển thị danh sách category -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên thể loại</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $categories->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td>
                                <a href="?delete=<?= $row['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xoá?')">
                                    Xoá
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>