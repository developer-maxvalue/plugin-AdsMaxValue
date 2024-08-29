<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.52.0/apexcharts.min.css" integrity="sha512-w3pXofOHrtYzBYpJwC6TzPH6SxD6HLAbT/rffdkA759nCQvYi5AHy5trNWFboZnj4xtdyK0AFMBtck9eTmwybg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.52.0/apexcharts.min.js" integrity="sha512-piY4QAXPoG2xLdUZZbcc5klXzMxckrQKY9A2o6nKDRt9inolvvLbvGPC+z9IZ29b28UJlD05B7CjxxPaxh4bjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/maps/jquery.vmap.world.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<style>
    .bd-clipboard {
        position: relative;
        display: block;
        float: right;
    }

    .btn-clipboard {
        position: absolute;
        top: 0.5rem;
        right: 2rem;
        z-index: 10;
        display: block;
        padding: 0.25rem 0.5rem;
        font-size: .65em;
        color: #0d6efd;
        background-color: #fff;
        border: 1px solid;
        border-radius: 0.25rem;
    }

    .btn-clipboard:hover,
    .btn-clipboard:focus {
        color: #fff;
        background-color: #0d6efd;
    }

    .btn-clipboard {
        right: 1rem;
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
include_once 'header.php';
?>

<div id="content-wrapper" style="display:none; background-color: #F9FAFC; margin-left: -22px">
    <div class="wrap">
        <div class="list-group mb-4 pt-4" id="list-websites"></div>
        <div class="table-responsive bg-white pb-5 p-3">
            <table class="table table-hover m-0">
                <thead>
                    <tr>
                        <th class="border-0 fw-bold">
                            <span>Zone</span>
                        </th>
                        <th class="border-0 fw-bold text-center">
                            <span>Status</span>
                        </th>
                        <th class="border-0 fw-bold text-center">
                            <span>Statistics</span>
                        </th>
                        <th class="border-0 text-end">
                        </th>
                    </tr>
                </thead>
                <tbody class="accordion table-list-website" id="accordionContainer"></tbody>
            </table>
        </div>
        <div class="modal fade" id="getCode" tabindex="-1" aria-labelledby="getCode" aria-hidden="true"
            style="z-index: 100000">
        </div>
        <div class="modal fade" id="detailZoneModal" tabindex="-1" aria-labelledby="detailZoneModal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailZoneModalLable"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <table class="table table-report-detail">
                                        <thead>
                                            <tr>
                                                <th>Zone</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addZoneModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="addZoneModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add zones</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion accordion-faq" id="accordionExample">
                            <div class="accordion-item create-website">
                                <div id="zoneCollapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body pt-0">
                                        <div class="alert-message"></div>
                                        <form id="createZone">
                                            <input type="text" name="websiteId" class="websiteId" value="" hidden>
                                            <div class="mt-3">
                                                <label for="url" class="fw-bold">URL (<span class="text-danger">*</span>)</label>
                                                <input type="text" name="url" class="form-control" placeholder="example.com" required>
                                            </div>
                                            <div class="row" id="groupDimensionsContainer">

                                            </div>
                                        </form>
                                        <div class="mb-3 text-center">
                                            <button type="submit" class="btn btn-primary" onclick="addZones(event)">Add zones</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="reviewRequestedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showReviewRequestedLabel">Verify site ownership</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="text-danger"> Please add our script into the &lt;head&gt; tag of your
                                    website</span>
                                <p class="pt-1"><i style="font-size: 11px">If you have integrated successfully our script,
                                        your website will be reviewed within 24
                                        hours (72h if the review falls on weekends). You will be notified of the
                                        results via email</i></p>
                            </div>
                            <div class="col-12">
                                <div class="row review-request-content">
                                    <div class="bd-clipboard">
                                        <button type="button" class="btn-clipboard btn btn-primary btn-sm" title data-bs-original-title="Copy to clipboard" onclick="copyCode()">
                                            copy
                                        </button>
                                    </div>
                                    <div class="col-12 highlight">
                                        <textarea class="form-control" style="padding-top: 30px" rows="3" readonly placeholder="Code ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'base.php';
?>

<script>
    localStorage.setItem('page_title', 'Zone');

    let groupDimensions;

    if (token) {
        const currentUrl = new URL(window.location.href);

        const params = new URLSearchParams(currentUrl.search);
        const website = 'https://dev.riseearning.com/';

        const apiUrl = `<?php echo AAP_MAXVALUE_URL; ?>/api/zone?website_name=${encodeURIComponent(website)}`;

        $('#loader').show();

        fetch(apiUrl, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                }
            })
            .then(response => response.json())
            .then(res => {
                if (res.success) {
                    $('#loader').hide();
                    let data = res.data;
                    renderLabels(data.items, data.spanStatusSite, data.zones, data.groupDimensions, data.zoneStickyFirst);
                    renderZones(data.zones);
                    groupDimensions = data.groupDimensions;
                }
            })
    }

    function getNormalAdCode(zoneStickyFirst) {
        const adCodes = JSON.parse(zoneStickyFirst.ad_code);
        const normalAdCodeObj = adCodes.find(ad => ad.id === 'normal');
        return normalAdCodeObj ? normalAdCodeObj.code : null;
    }

    function renderLabels(item, spanStatusSite, zones, dimensions, zoneStickyFirst) {
        const listContainer = document.getElementById('list-websites');

        const isApproved = item.status == 3500;
        const isReviewingOrAuto = ['AUTO', 'REVIEWING'].includes(item?.type_status);
        const hasNoZones = zones.length == 0;
        const isRejected = item.status == 3510;

        listContainer.innerHTML = '';

        let buttonsHtml = '';
        if ((isApproved && !isReviewingOrAuto) || hasNoZones) {
            buttonsHtml = `<button id="add_zone_${item.id}" class="btn btn-outline-primary btn-sm mb-1 button-format">
                            <i class="ri-add-circle-fill"></i> Add zone
                        </button>`;
        } else {
            if (!isRejected) {
                buttonsHtml = `<button id="verify_site_${item.id}" class="btn btn-outline-primary btn-sm mb-1 button-format">
                                <i class="ri-check-double-fill"></i> Verify site
                            </button>`;
            }
        }

        let labelHtml = `
            <div class="list-group-item">
            <div class="row align-items-center">
                <div class="col-md-6 fw-bold">
                    ${item.name}
                </div>
                <div class="col-md-2">
                    ${spanStatusSite}
                </div>
                <div class="col-md-1">
                    ${zones.length} zone(s)
                </div>
                <div class="col-md-2 text-center">
                    ${buttonsHtml}
                </div>
            </div>
        </div>
        `;

        listContainer.innerHTML += labelHtml;

        if ((isApproved && !isReviewingOrAuto) || hasNoZones) {
            document.getElementById(`add_zone_${item.id}`).addEventListener('click', function() {
                showModelAddZone(item, dimensions, zoneStickyFirst);
            });
        } else {
            if (!isRejected) {
                document.getElementById(`verify_site_${item.id}`).addEventListener('click', function() {
                    const normalAdCode = getNormalAdCode(zoneStickyFirst);
                    document.querySelector('#reviewRequestedModal textarea').value = normalAdCode;

                    $('#reviewRequestedModal').modal('show');
                });
            }
        }

        document.querySelector('.btn-clipboard').addEventListener('click', function() {
            copyCode();
        });
    }

    function copyCode() {
        const textarea = document.querySelector('#reviewRequestedModal textarea');
        textarea.select();
        document.execCommand('copy');
    }

    function generateReportUrl(apiSiteId) {
        const reportUrl = `${currentUrl.origin}/wp-admin/admin.php?page=mv-report`;
    }

    function findDimensionNameById(groupDimensions, searchId) {
        for (let category in groupDimensions) {
            if (groupDimensions.hasOwnProperty(category)) {
                const dimensions = groupDimensions[category];

                for (let dimensionName in dimensions) {
                    if (dimensions.hasOwnProperty(dimensionName) && dimensions[dimensionName].id === searchId) {
                        return dimensionName;
                    }
                }
            }
        }
        return null;
    }

    function showModelAddZone(websiteInfo, dimensions, zoneStickyFirst) {
        $(".alert-message").empty();
        $(".dimension_sticky").removeClass("pointer-events-none");
        event.stopPropagation();
        $(".site-verified i").removeClass('ri-checkbox-circle-fill text-success').addClass('ri-checkbox-circle-line');

        $('#addZoneModal input[name="websiteId"]').attr('value', websiteInfo.id);
        $('#addZoneModal input[name="url"]').attr('value', websiteInfo.name);
        $('#addZoneModal input[name="url"]').attr('disabled', 'disabled');

        $(".complete").addClass("pointer-events-none");
        websiteInfo.zones.forEach(item => {
            if (item.dimension_id == 1) {
                $(".dimension_sticky").addClass("pointer-events-none");
            }
        });

        $(".complete .accordion-button").addClass("collapsed");
        $("#addZoneModal #zoneCollapseOne").addClass("show");
        $(".complete #zoneCollapseTwo").removeClass("show");

        const groupDimensionsContainer = $("#groupDimensionsContainer");
        groupDimensionsContainer.empty();

        Object.keys(dimensions).forEach(label => {
            let dimensionHtml = `
            <div class="col-sm-12 col-xs-12">
                <label class="control-label fw-semibold mb-2 mt-4">${label}</label>
                <div class="row container">
        `;

            Object.values(dimensions[label]).forEach(dimension => {
                let isStickyAd = label === 'Sticky Ads' && dimension.size.join('x') === '1x1';
                let isDisabled = zoneStickyFirst && isStickyAd ? 'disabled' : '';
                let pointerEventsNone = isStickyAd ? 'pointer-events-none' : '';

                dimensionHtml += `
                <div class="col-6 ${isStickyAd ? 'dimension_sticky' : ''} ${pointerEventsNone}">
                    <div class="form-check">
                        <input style="margin-top: 0.4em;" class="form-check-label input-dimension" type="checkbox" value="${dimension.id}" name="list_zone_dimensions[]" id="dimension_${dimension.id}" ${isDisabled}>
                        <label class="dimension_label form-check-label" for="dimension_${dimension.id}">
                            ${dimension.name}
                        </label>
                    </div>
                </div>
            `;
            });

            dimensionHtml += `</div></div>`;
            groupDimensionsContainer.append(dimensionHtml);
        });

        $('#addZoneModal').modal('show');
    }

    function renderZones(zones) {
        const accordionContainer = document.getElementById('accordionContainer');
        let zonesHtml = '';
        zones.forEach(zone => {
            zonesHtml += `
            <tr>
                <td class="w-20"><span>${zone.name}</span></td>
                <td class="text-center w-20">${zone.span_status}</td>
                <td class="text-center w-10" style="padding-left: 0.9rem;">
                    <a class="mb-1" href="${generateZoneReportUrl(zone.ad_zone_id)}" style="text-decoration: none"><i class="ri-bar-chart-2-line"></i> Statistics</a>
                </td>
                <td class="fw-bold w-10" style="padding-left: 0.9rem;">
                    <button class="btn btn-outline-primary btn-sm mb-1" ${zone.status == 7000 ? '' : 'disabled'} onclick="getCode(${zone.ad_zone_id})">
                        <i class="ri-code-s-slash-line"></i> Get Code
                    </button>
                </td>
            </tr>
        `;
        });
        accordionContainer.innerHTML += zonesHtml;
    }

    function addZones(event) {
        event.preventDefault();

        const formData = new FormData();

        const websiteId = document.querySelector('input[name="websiteId"]').value;
        formData.append('websiteId', websiteId);

        document.querySelectorAll('input[name="list_zone_dimensions[]"]:checked').forEach((input) => {
            const dimensionId = parseInt(input.value, 10);
            const dimensionName = findDimensionNameById(groupDimensions, dimensionId);

            if (dimensionName) {
                formData.append('list_zone_dimensions[]', dimensionName);
            }
        });

        const apiUrl = '<?php echo AAP_MAXVALUE_URL; ?>/api/zone/store';

        $('#loader').show();
        fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('mv_jwt_token')}`,
                },
                body: formData
            })
            .then(response => response.json())
            .then(response => {
                $('#loader').hide();
                if (response.success) {
                    window.location.reload();
                } else {
                    alert('Failed to add zones: ' + response.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                $('#loader').hide();
                alert('An error occurred while adding zones.');
            });
    }

    function generateZoneReportUrl(adZoneId) {
        return `admin.php?page=mv-reports&zoneId=${adZoneId}`;
    }

    function getCode(id) {
        $("#loader").show();
        var $this = $('#getCode');
        $this.find('form').attr('data-id', id);

        $('#detailZoneModal').modal('hide');

        let apiUrl = `<?php echo AAP_MAXVALUE_URL; ?>/api/getCode?id=${id}`;

        fetch(apiUrl, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                }
            })
            .then(response => response.json())
            .then(res => {
                $("#loader").hide();
                $this.find('.getcode__info--name input').val(res.zoneInfo.name);
                $this.html(res.html);
                $this.modal('show');
            })
    }
</script>