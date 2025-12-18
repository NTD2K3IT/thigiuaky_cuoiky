
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column vh-100">
    <!-- Header -->
     <h1>Nguyễn Trọng Dương - Chiều thứ 5</h1>
    <header class="py-3 bg-white border-bottom shadow-sm w-100">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="m-0 h4">
                <a href="./index.php" class="text-decoration-none text-dark">YanZuRiiAdmin</a>
            </h1>
        </div>
    </header>

    <!-- Container chính căn giữa -->
    <div class="d-flex flex-grow-1 align-items-center justify-content-center">
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <h2 class="mb-3 text-center">Đăng nhập Admin</h2>

            <?php if ($login_error): ?>
                <div class="alert alert-danger"><?= $login_error ?></div>
            <?php endif; ?>

            <form method="post" class="d-flex flex-column gap-3">
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required>
                <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" required>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="togglePassword">
                    <label class="form-check-label" for="togglePassword">Hiện mật khẩu</label>
                </div>

                <button type="submit" name="login" class="btn btn-primary w-100">Đăng nhập</button>
            </form>
        </div>
    </div>

    <script>
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        toggle.addEventListener('change', function() {
            password.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>




</html>