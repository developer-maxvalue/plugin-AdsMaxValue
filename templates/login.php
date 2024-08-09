<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</script>

<style>
    .page-sign {
        min-height: 100vh;
        padding: 40px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
    }

    .card-sign {
        border-radius: 10px;
        box-shadow: 0 2.8px 2.2px rgba(110, 121, 133, .02), 0 6.7px 5.3px rgba(110, 121, 133, .028), 0 12.5px 10px rgba(110, 121, 133, .035), 0 22.3px 17.9px rgba(110, 121, 133, .042), 0 41.8px 33.4px rgba(110, 121, 133, .05), 0 100px 80px rgba(110, 121, 133, .07);
    }

    .header-logo,
    .sidebar-logo {
        font-size: 24px;
        font-family: "Archivo", sans-serif;
        font-weight: 600;
        display: inline-block;
        line-height: 1;
        color: #212830;
        letter-spacing: -0.5px;
        position: relative;
        text-decoration: none;
    }

    .header-logo::after,
    .sidebar-logo::after {
        content: "";
        position: absolute;
        bottom: 3.5px;
        right: -8px;
        width: 6px;
        height: 6px;
        border-radius: 100%;
        background-color: #506fd9;
    }
</style>

<?php

function save_user_token() {
    error_log('save_user_token called'); // Kiểm tra xem hàm có được gọi không

    if (!isset($_POST['email']) || !isset($_POST['token'])) {
        error_log('Invalid POST data');
        wp_send_json_error('Invalid POST data');
        wp_die();
    }

    $email = sanitize_email($_POST['email']);
    $token = sanitize_text_field($_POST['token']);

    if (empty($email) || empty($token)) {
        error_log('Empty email or token');
        wp_send_json_error('Empty email or token');
        wp_die();
    }

    $user = get_user_by('email', $email);
    if ($user) {
        update_user_meta($user->ID, 'jwt_token', $token);
        error_log('Token saved successfully');
        echo 'Token saved successfully';
    } else {
        error_log('User not found');
        echo 'User not found';
    }

    wp_die();
}

add_action('wp_ajax_save_user_token', 'save_user_token');
add_action('wp_ajax_nopriv_save_user_token', 'save_user_token');
?>
<div class="container page-sign">
    <div class="card card-sign">
        <div class="card-header" style="background-color: unset; border-bottom: 0; padding: 2rem 1rem 0;">
            <a href="<?php echo home_url('/'); ?>" class="header-logo mb-4">MaxValue</a>
            <h3 class="card-title">Login</h3>
            <p class="card-text">Welcome back! Please login to continue.</p>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <form id="custom-login-form">
                <div class="mb-4">
                    <label class="form-label">Email address</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email address" required>
                </div>
                <div class="mb-4">
                    <label class="form-label d-flex justify-content-between">Password
                        <a href="<?php echo wp_lostpassword_url(); ?>" style="text-decoration: none;">Forgot password?</a>
                    </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <button class="btn btn-primary btn-sign form-control" type="submit">Login</button>
                <a href="<?php echo home_url('/auth/google/redirect'); ?>" class="btn btn-light btn-sign mt-4 form-control" style="color: black;">
                    <img src="<?php echo plugins_url('assets/img/google.png', dirname(__FILE__)); ?>" alt="" style="width: 20px; margin-right: 8px">
                    Login with Google
                </a>
            </form>

        </div>
        <div class="card-footer" style="background-color: unset; border-top: unset">
            Don't have an account? <a href="<?php echo wp_registration_url(); ?>" style="text-decoration: none;">Create an Account</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById('custom-login-form').addEventListener('submit', function(event) {
        event.preventDefault();

        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        fetch('http://localhost:8086/api/login-jwt', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    console.log('email == ', email);
                    console.log('token == ', data.token);
                    saveTokenToUserMeta(email, data.token);

                    // window.location.href = "http://localhost:7000/wp-admin/admin.php?page=aap-dashboard";
                } else {
                    alert('Login failed: ' + data.error);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('An error occurred while processing your request.');
            });
    });

    function saveTokenToUserMeta(email, token) {
        console.log('Saving token to user meta:', email, token);
        console.log('<?php echo admin_url('admin-ajax.php'); ?>');
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: new URLSearchParams({
                    action: 'save_user_token',
                    email: email,
                    token: token
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.text();
            })
            .then(data => {
                console.log('Token saved:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>