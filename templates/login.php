<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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

<div class="container page-sign">
    <div class="logout-section">
        <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-danger">Logout</a>
    </div>
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
            <form method="POST" action="">
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