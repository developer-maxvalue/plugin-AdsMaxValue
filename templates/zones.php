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

<?php
include_once 'base.php';
?>
<div id="content-wrapper" style="display:none;">
    <div class="wrap">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="main-title mb-0">Welcome to Zones</h4>
            </div>
        </div>
        <div class="list-group" id="list-websites"></div>
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
        <div class="modal fade" id="addZoneModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="addZoneModal"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add zones</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion accordion-faq" id="accordionExample">
                            <div class="accordion-item create-website">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#zoneCollapseOne" aria-expanded="true"
                                        aria-controls="zoneCollapseOne">
                                        <span class="site-verified"><i class="ri-checkbox-circle-line"></i></span><b> Add
                                            zones </b><span class="website-name"></span>
                                    </button>
                                </h2>
                                <hr>
                                <div id="zoneCollapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body pt-0">
                                        <div class="alert-message"></div>
                                        <form id="createZone">
                                            <input type="text" name="websiteId" class="websiteId" value="" hidden>
                                            <div class="mt-3">
                                                <label for="url" class="fw-bold">URL (<span
                                                        class="text-danger">*</span>)</label>
                                                <input type="text" name="url"
                                                    {{ !empty($websiteInfo) ? ' disabled value="' . $websiteInfo->url . '"' : '' }}
                                                    class="form-control @error('url') is-invalid @enderror"
                                                    placeholder="example.com" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-7 col-xs-12">
                                                    @foreach ($groupDimensions as $lable => $listDimensions)
                                                    <label
                                                        class="control-label fw-semibold mb-2 mt-4">{{ $lable }}</label>
                                                    <div class="row container">
                                                        @foreach ($listDimensions as $key => $dimensions)
                                                        <div
                                                            class="col-6 @if ($lable === 'Sticky Ads') dimension_sticky @endif ">
                                                            <div class="form-check">
                                                                <input
                                                                    class="form-check-input form-check-label input-dimension"
                                                                    for="dimension_{{ $key }}"
                                                                    type="checkbox" value="{{ $key }}"
                                                                    name="list_zone_dimensions[]"
                                                                    id="dimension_{{ $key }}">
                                                                <label class="dimension_label form-check-label"
                                                                    for="dimension_{{ $key }}">
                                                                    {{ $dimensions['name'] }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div>
                                                <p class="mt-4"><a class="control link-opacity-100" target="_blank"
                                                        href="{{ route('user.faqs') }}">To view detailed
                                                        information,
                                                        please refer to
                                                        the Frequently Asked Questions (FAQ) section.</a></p>
                                            </div>

                                        </form>
                                        <div class="mb-3 text-center">
                                            <button type="submit" class="btn btn-primary" onclick="addZones()">Add zones
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item complete pointer-events-none">
                                <h2 class="accordion-header" id="heading-complete">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#zoneCollapseTwo" aria-expanded="false"
                                        aria-controls="zoneCollapseTwo">
                                        <span class="site-complete"><i class="ri-checkbox-circle-line"></i></span> Verify
                                        site
                                        ownership
                                    </button>
                                </h2>
                                <hr>
                                <div id="zoneCollapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="heading-complete" data-bs-parent="#accordionExample">
                                    <div class="accordion-body pt-0">
                                        <div class="row">
                                            <center>No data !</center>
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
</div>

<script>
    const token = localStorage.getItem('mv_jwt_token');
    if (token) {
        const currentUrl = new URL(window.location.href);

        const params = new URLSearchParams(currentUrl.search);
        const website = 'https://dev.riseearning.com/';

        const apiUrl = `https://stg-publisher.maxvalue.media/api/zone?website_name=${encodeURIComponent(website)}`;

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
                    renderLabels(data.items, data.spanStatusSite, data.zones);
                    renderZones(data.zones);
                }
            })
    }

    function renderLabels(item, spanStatusSite, zones) {
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
                buttonsHtml = `<button class="btn btn-outline-primary btn-sm mb-1 button-format">
                            <i class="ri-check-double-fill"></i> Verify site
                        </button>`;
            }
        }

        let labelHtml = `
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold">${item.name}</span>
            <span>${spanStatusSite}</span>
            ${buttonsHtml}
        </div>
    `;

        listContainer.innerHTML += labelHtml;

        document.getElementById(`add_zone_${item.id}`).addEventListener('click', function() {
            showModelAddZone(item);
        });
    }

    function generateReportUrl(apiSiteId) {
        const reportUrl = `${currentUrl.origin}/wp-admin/admin.php?page=mv-report`;
    }

    function showModelAddZone(websiteInfo) {
        $(".alert-message").empty();
        $(".dimension_sticky").removeClass("pointer-events-none");
        event.stopPropagation();
        $(".site-verified i").removeClass('ri-checkbox-circle-fill text-success').addClass('ri-checkbox-circle-line');
        $('#addZoneModal input[name="websiteId"]').attr('value', websiteInfo.id)
        $('#addZoneModal input[name="url"]').attr('value', websiteInfo.name)
        $('#addZoneModal input[name="url"]').attr('disabled', 'disabled')

        $(".complete").addClass("pointer-events-none");
        websiteInfo.zones.forEach(item => {
            if (item.dimension_id == 1) {
                $(".dimension_sticky").addClass("pointer-events-none");
            }
        });
        $(".complete .accordion-button").addClass("collapsed");
        $("#addZoneModal #zoneCollapseOne").addClass("show");
        $(".complete #zoneCollapseTwo").removeClass("show");

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

    function generateZoneReportUrl(adZoneId) {
        return `admin.php?page=mv-reports`;
    }

    function convertSpanStatusZone(zone) {
        return `<!-- Replace with logic for \App\Services\Common::convertSpanStatusZone -->`;
    }

    function getCode(id) {
        $("#loader").show();
        var $this = $('#getCode');
        $this.find('form').attr('data-id', id);

        $('#detailZoneModal').modal('hide');

        let apiUrl = `https://stg-publisher.maxvalue.media/api/getCode?id=${id}`;

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

    function openAddZonePopup(itemId, itemName) {
        const modal = document.getElementById('addZoneModal');
        const modalTitle = modal.querySelector('.modal-title');
        const modalBody = modal.querySelector('.modal-body');

        modalTitle.textContent = `Add Zone for ${itemName}`;
        modalBody.innerHTML = `
        <form id="addZoneForm">
            <input type="hidden" name="item_id" value="${itemId}">
            <div class="mb-3">
                <label for="zoneName" class="form-label">Zone Name</label>
                <input type="text" class="form-control" id="zoneName" name="zone_name" required>
            </div>
            <!-- Add more form fields as needed -->
        </form>
    `;

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
    }
</script>