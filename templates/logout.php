<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <script>
        localStorage.removeItem('mv_jwt_token');
        localStorage.removeItem('user_info');

        window.location.href = "<?php echo admin_url('admin.php?page=mv-dashboard'); ?>";
    </script>
</head>
<body>
    <p>Logging out...</p>
</body>
</html>
