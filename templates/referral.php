<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .social a {
        font-size: 22px;
        padding: 10px;
        width: 30px;
        text-align: center;
        text-decoration: none;
        margin: 5px 2px;
    }

    .social a:hover {
        opacity: 0.7;
    }

    .social .ri-facebook-fill {
        background: #2C68FF;
        color: white;
    }

    .social .ri-twitter-x-fill {
        background: #000000;
        color: white;
    }

    .social .ri-linkedin-fill {
        background: #007EBB;
        color: white;
    }

    .referralProgram .bd-clipboard {
        bottom: 68px;
        left: 30px;
    }

    .btn-clipboard {
        position: absolute;
        top: 1rem;
        right: 35px;
        z-index: 10;
        display: block;
        padding: 0.25rem 0.5rem;
        font-size: 1em;
        color: #0d6efd;
        background-color: #fff;
        border: 1px solid;
        border-radius: 0.25rem;
    }

    .referralProgram .bd-clipboard {
        bottom: 68px;
        left: 30px;
    }

    .bd-clipboard {
        position: relative;
        display: block;
        float: right;
    }

    .card {
        padding: 0 !important;
    }

    .wrap {
        margin: 0 20px !important;
    }

    .content-wrapper {
        background-color: #F9FAFC;
    }

</style>
<?php
include_once 'base.php';

$userInfo = get_transient('user_info');
$userInfo = $userInfo['user'] ?? [];
?>

<div id="content-wrapper" style="display:none; background-color: #F9FAFC; margin-left: -22px">
    <div class="row referralProgram wrap" id="referralProgram">
        <?php
        include_once 'header.php';
        ?>
        <div class="col-sm-12 col-md-12 col-xl-6 d-flex align-items-end justify-content-start">
            <img src="<?php echo plugins_url('assets/img/banner-referral-mv.png', dirname(__FILE__)); ?>" class="img-fluid"
                alt="referral program maxvalue">
        </div>
        <div class="col-sm-12 col-md-12 col-xl-6 invite-section" style="background: #fff;">
            <div class="p-3">
                <div>
                    <div class="row text-center">
                        <img src="<?php echo plugins_url('assets/img/get-referral-mv.png', dirname(__FILE__)); ?>"
                            class="rounded mx-auto d-block" style="max-width: 185px"
                            alt="referral program maxvalue">
                    </div>
                    <div class="row mt-4 text-center">
                        <p>The Maxvalue referral program allows you to receive a 5%
                            commission on the
                            earnings of
                            websites you invited to join Maxvalue adnetwork.</p>
                        <p class="mb-3 fw-bold">THE MORE YOU INVITE, THE MORE YOU RECEIVE!</p>
                    </div>
                    <div class="row mb-3">
                        <input type="text" class="form-control" id="referralCode" aria-describedby="referral code"
                            style="height: 50px;"
                            value="<?php echo AAP_MAXVALUE_URL . '/register?ref=' . ($userInfo['code'] ?? '') ?>"
                            readonly>
                        <div class="bd-clipboard">
                            <button type="button" class="btn btn-primary btn-sm btn-clipboard"
                                data-bs-original-title="Copy to clipboard" onclick="copyValueInput('referralCode')"
                                title="Copy to clipboard">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>