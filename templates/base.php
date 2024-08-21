<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php
function check_user_token()
{
?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var token = localStorage.getItem('mv_jwt_token');

            if (!token) {
                showLoginPopup();
                return;
            }

            fetch('<?php echo admin_url('admin-ajax.php?action=verify_token'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        token: token
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        localStorage.removeItem('mv_jwt_token');
                        localStorage.removeItem('user_info');
                        showLoginPopup();
                    } else {
                        document.getElementById("content-wrapper").style.display = "block";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showLoginPopup();
                });
        });

        function showLoginPopup() {
            var loginPopup = document.getElementById("login-popup");
            if (loginPopup) {
                loginPopup.style.display = "flex";
            }
            document.getElementById("content-wrapper").style.display = "none";
        }
    </script>
<?php
}
check_user_token();
?>

<style>
    .page-sign {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        display: none;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        max-width: calc(100% - 160px) !important;
    }

    .card-sign {
        border-radius: 10px;
        background-color: #fff;
        padding: 20px;
        width: 400px;
        box-shadow: 0 2.8px 2.2px rgba(110, 121, 133, .02),
            0 6.7px 5.3px rgba(110, 121, 133, .028),
            0 12.5px 10px rgba(110, 121, 133, .035),
            0 22.3px 17.9px rgba(110, 121, 133, .042),
            0 41.8px 33.4px rgba(110, 121, 133, .05),
            0 100px 80px rgba(110, 121, 133, .07);
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
<div class="container page-sign" id="login-popup">
    <div class="card card-sign">
        <div class="card-header" style="background-color: unset; border-bottom: 0; padding: 2rem 1rem 0;">
            <a href="<?php echo home_url('/'); ?>" class="header-logo mb-4">MaxValue</a>
            <h3 class="card-title">Login</h3>
            <p class="card-text">Welcome back! Please login to continue.</p>
        </div>
        <div class="card-body">
            <form method="POST" action="" id="login-form">
                <div class="mb-4">
                    <label class="form-label">Email address</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email address" required>
                </div>
                <div class="mb-4">
                    <label class="form-label d-flex justify-content-between">Password
                        <a href="https://stg-publisher.maxvalue.media/password/reset" style="text-decoration: none;">Forgot password?</a>
                    </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <button class="btn btn-primary btn-sign form-control" type="submit">Login</button>
            </form>
            <p id="login-error" style="color: red;"></p>
        </div>
        <div class="card-footer" style="background-color: unset; border-top: unset">
            Don't have an account? <a href="https://stg-publisher.maxvalue.media/register" style="text-decoration: none;">Create an Account</a>
        </div>
    </div>
</div>

<div id="loader" style="display: none">
    <div id="loader-text" class="d-flex justify-content-center align-items-center">
        <div class="text-primary" role="status">
            <h4 class="text-center loader-logo">Loading...</h4>
            <div class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-secondary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-info" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-dark" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        fetch('https://stg-publisher.maxvalue.media/api/login-jwt', {
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
                let res = data.data;
                if (data.success) {
                    fetch('<?php echo admin_url('admin-ajax.php?action=aap_save_user_data'); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                email: email,
                                password: password,
                                token: res.token,
                                user_id: res.user.id
                            })
                        })
                        .then(response => response.json())
                        .then(serverData => {
                            if (serverData.success) {
                                localStorage.setItem('mv_jwt_token', res.token);
                                localStorage.setItem('user_info', JSON.stringify(res.user));
                                location.reload();
                            } else {
                                alert('Failed to save user data: ' + serverData.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error saving user data:', error);
                        });
                } else {
                    alert(res.message || 'Login failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error with the login request.');
            });
    });
</script>
