<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
</style>
<?php
include_once 'base.php';
?>
<div id="content-wrapper" style="display:none;">
    <div class="row referralProgram" id="referralProgram">
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
                            value="{{ config('app.url', '') . '/register?ref=' . \Illuminate\Support\Facades\Auth::user()->code }}"
                            readonly>
                        <div class="bd-clipboard">
                            <button type="button" class="btn btn-primary btn-sm btn-clipboard"
                                data-bs-original-title="Copy to clipboard" onclick="copyValueInput('referralCode')"
                                title="Copy to clipboard">
                                <i class="ri-file-copy-line"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3 text-center social" style="margin-bottom: 2rem !important;">
                        <div class="col">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://maxvalue.media?ref={{\Illuminate\Support\Facades\Auth::user()->code}}"
                                target="_blank" class="ri-facebook-fill" title="share facebook"></a>
                            <a href="https://twitter.com/share?text=&url=https://maxvalue.media?ref={{\Illuminate\Support\Facades\Auth::user()->code}}"
                                target="_blank" class="ri-twitter-x-fill" title="share twitter"></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://maxvalue.media?ref={{\Illuminate\Support\Facades\Auth::user()->code}}"
                                target="_blank" class="ri-linkedin-fill" title="share linkedin"></a>
                        </div>
                    </div>
                    <div class="row mt-3 text-center">
                        <p class="fw-bold" style="font-size: 19px">Or share via email</p>
                    </div>
                    <div class="row">
                        <input type="email" class="form-control" id="emailReferral" name="emailReferral"
                            placeholder="Your friend's email address" style="height: 50px;" value="">
                        <div class="bd-clipboard">
                            <button type="button" class="btn btn-primary btn-sm btn-clipboard"
                                data-bs-original-title="Send mail" title="Send mail" onclick="sentMailReferral()">
                                <i class="ri-send-plane-line"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row alert-message">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function sentMailReferral() {
        $(".alert-message").empty();
        var $this = $('#referralProgram');

        let emailReferral = $this.find('input[name="emailReferral"]').val();

        if (!IsEmail(emailReferral)) {
            $(".alert-message").append('<div class="alert alert-danger" role="alert">Email invalidate! </div>')
            return;
        }

        var formZoneData = new FormData();
        formZoneData.append('email', emailReferral);
        formZoneData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        $("#loader").show();
        $.ajax({
            url: "{{ route('user.referral.sendMail')}}",
            type: "POST",
            data: formZoneData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $(".alert-message").append('<div class="alert alert-success" role="alert">' + response
                        .message + '</div>')
                    $("#loader").hide();
                } else {
                    $(".alert-message").append('<div class="alert alert-danger" role="alert">' + response
                        .message + '</div>')
                    $("#loader").hide();
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $("#loader").hide();
                alert(XMLHttpRequest.responseText);
            }
        });
    }
</script>