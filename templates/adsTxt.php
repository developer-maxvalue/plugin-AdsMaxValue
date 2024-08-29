<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<?php
include_once 'base.php';
?>
<style>
    .wrap {
        margin: 0 20px !important;
    }

    .content-wrapper {
        background-color: #F9FAFC;
    }
</style>

<?php
include_once 'header.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
<div id="content-wrapper" style="display:none; background-color: #F9FAFC; margin-left: -22px">
    <div class="wrap">
        <div class="row mb-3 pt-4">
            <form method="POST" id="formAdsTxt">
                <div class="mb-3">
<!--                    <textarea class="form-control" id="editorAdsTxt" name="adsTxt" rows="10"> --><?php //echo esc_textarea(trim($contentAdsTxt ?? '')); ?><!--</textarea>-->
                    <div id="editorAdsTxt"><?php echo esc_textarea(trim($contentAdsTxt ?? '')); ?></div>
                    <textarea hidden name="adsTxt" id="adsTxt"></textarea>
                    <p class="mt-3">The file is available on <a href='<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
                                                                            === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] ?>/ads.txt' target="_blank"><?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
                                                                                                                                                                            === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] ?>/ads.txt</a> .</p>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Update</button>
            </form>
        </div>
    </div>
</div>
<style>
    #editorAdsTxt {
        height: 300px;
        width: 100%;
        border: 1px solid #ccc;
    }
</style>
<script>
    var editor = ace.edit("editorAdsTxt");

    document.getElementById("formAdsTxt").onsubmit = function() {
        document.getElementById("adsTxt").value = editor.getValue();
    };
</script>
<script>
    localStorage.setItem('page_title', 'Ads.Txt Configuration');
</script>