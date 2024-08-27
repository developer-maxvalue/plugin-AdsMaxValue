<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
include_once 'base.php';
?>
<style>
    .unsetWidth {
        max-width: unset;
    }

    .select2-container .select2-selection--single {
        height: 33px !important;
    }
    .card {
        padding: 0 !important;
    }
    .wrap {
        margin-top: 0;
    }
    .content-wrapper {
        background-color: #F9FAFC;
    }
</style>
<div id="content-wrapper" style="display:none;">
    <div class="wrap">
        <?php
        include_once 'header.php';
        ?>

        <div class="col-md-12 col-xl-12">
            <div class="card card-one unsetWidth">
                <div class="card-body">
                    <form action="<?php echo esc_url(admin_url('admin.php')); ?>" class="searchReport" method="GET">
                        <input type="hidden" name="page" value="mv-dashboard">
                        <input type="hidden" name="date_option" value="<?php echo isset($_GET['date_option']) ? esc_attr($_GET['date_option']) : ''; ?>">
                        <input type="hidden" name="start" value="<?php echo isset($_GET['start']) ? esc_attr($_GET['start']) : ''; ?>">
                        <input type="hidden" name="end" value="<?php echo isset($_GET['end']) ? esc_attr($_GET['end']) : ''; ?>">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <input type="text" class="form-control" id="date_select" readonly>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <select id="zoneSearch" class="form-select form-control" name="zoneId">
                                    <option value="">-Zone-</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-primary generate" onclick="clickSearchReport(this)"> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-one mt-3 unsetWidth">
            <div class="card-body p-3">
                <div class="table-responsive" id="table-report">
                    <table class="table table-hover table-four table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="textCenter">Date</th>
                                <th scope="col" class="textCenter">Zone</th>
                                <th scope="col" class="textCenter cpm_sort">Impressions</th>
                                <th scope="col" class="textCenter cpm_sort">eCPM</th>
                                <th scope="col" class="textCenter revenue_sort">Revenue</th>
                                <th scope="col" class="textCenter">Status</th>
                            </tr>
                        </thead>
                        <tbody id="report-table-body"></tbody>
                    </table>
                    <nav aria-label="Page navigation">
                        <ul class="pagination" id="pagination-links">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    localStorage.setItem('page_title', 'Report');

    const token = localStorage.getItem('mv_jwt_token');

    $(document).ready(function() {
        $("#zoneSearch").select2({
            placeholder: "- Zone -",
            allowClear: true,
            width: '100%'
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = new URL(window.location.href);
        const website = <?php echo MV_DEBUG ? "'dev.riseearning.com'" : "'" . $_SERVER['HTTP_HOST'] . "'" ?>;

        var urlParams = new URLSearchParams(currentUrl.search);

        var page = urlParams.get('wp_page');
        const zoneId = urlParams.get('zoneId');

        if (!zoneId) {
            $('#zoneSearch').val(null).trigger('change');
        }

        const dateSelect = urlParams.get('dateSelect');

        const apiUrl = new URL(`https://stg-publisher.maxvalue.media/api/report`);
        apiUrl.searchParams.append('website_name', website);
        apiUrl.searchParams.append('page', page);
        apiUrl.searchParams.append('zoneId', zoneId);
        apiUrl.searchParams.append('dateSelect', dateSelect);

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
                $('#loader').hide();

                if (res.success) {
                    const data = res.data;

                    if (data.zones && Array.isArray(data.zones)) {
                        data.zones.forEach(zone => {
                            var selectedAttribute = (zoneId && zoneId === String(zone.ad_zone_id)) ? ' selected' : '';
                            $('#zoneSearch').append('<option value="' + zone.ad_zone_id + '"' + selectedAttribute + '>' + zone.name + '</option>');
                        });
                    } else {
                        $('#zoneSearch').empty();
                    }

                    let pagination = data.items;

                    let paginationContainer = document.getElementById('pagination-links');
                    paginationContainer.innerHTML = '';

                    if (pagination.last_page > 1) {
                        pagination.links.forEach(link => {
                            let li = document.createElement('li');
                            li.className = `page-item ${link.active ? 'active' : ''}`;

                            if (link.url) {
                                let a = document.createElement('a');
                                a.className = 'page-link';
                                let url = new URL(window.location.href);
                                if (link.label == 'Next &raquo;') {
                                    link.label = '›';
                                } else if (link.label == '&laquo; Previous') {
                                    link.label = '‹';
                                }
                                url.searchParams.set('wp_page', link.label);
                                a.href = url.toString();
                                a.textContent = link.label;
                                li.appendChild(a);
                            } else {
                                let span = document.createElement('span');
                                span.className = 'page-link';
                                span.textContent = link.label == '&laquo; Previous' ? '‹' : '›';
                                li.appendChild(span);
                            }

                            paginationContainer.appendChild(li);
                        });
                    }

                    const items = data.items;

                    const threeDaysAgo = new Date();
                    threeDaysAgo.setDate(threeDaysAgo.getDate() - 3);
                    const today = new Date();
                    const reportTableBody = document.getElementById('report-table-body');
                    reportTableBody.innerHTML = '';

                    items.data && items.data.forEach(item => {
                        const currentDate = new Date(item.date);
                        const statusDisplay = item.status_display || false;
                        const confirmed = (currentDate <= threeDaysAgo && item.status) || statusDisplay;

                        const rowHtml = `
                <tr>
                    <td class="textCenter">${item.date}</td>
                    <td class="textCenter">${item.zoneName}</td>
                    <td class="textCenter">${item.total_impressions ? formatNumberWithCommas(item.total_impressions) : 0}</td>
                    <td class="textCenter">${item.date !== today && item.average_cpm !== 0 && item.average_cpm ? item.average_cpm : ''}</td>
                    <td class="textCenter">${item.date !== today && item.total_revenue !== 0 && item.total_revenue ? '$' + item.total_revenue : ''}</td>
                    <td class="textCenter">
                        ${confirmed ? '<span class="badge bg-success">Confirmed</span>' : ''}
                        ${!confirmed && statusDisplay === false ? '<span class="badge bg-warning">Validating</span><i class="ri-error-warning-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="This is not your final data"></i>' : ''}
                    </td>
                </tr>
            `;
                        reportTableBody.insertAdjacentHTML('beforeend', rowHtml);
                    });

                    if (data.countItem) {
                        const countItem = data.countItem;
                        const totalRowHtml = `
                <tr style="font-weight: bold">
                    <td class="textCenter" scope="row">Total</td>
                    <td></td>
                    <td class="textCenter">${countItem.totalImpressions ? formatNumberWithCommas(countItem.totalImpressions) : 0}</td>
                    <td class="textCenter">${countItem.averageCPM ? countItem.averageCPM : 0}</td>
                    <td class="textCenter">${countItem.totalChangeRevenue ? '$' + countItem.totalChangeRevenue : 0}</td>
                    <td></td>
                </tr>
            `;
                        reportTableBody.insertAdjacentHTML('beforeend', totalRowHtml);
                    }
                } else {
                    console.error('Failed to fetch report data:', data.message);
                }
            })
            .catch(error => {
                $('#loader').hide();
                console.error('Error fetching report data:', error);
            });
    });

    jQuery(document).ready(function($) {
        var urlParams = new URLSearchParams(window.location.search);
        var dateSelectParam = urlParams.get('dateSelect');

        var startDate, endDate;

        if (dateSelectParam) {
            var dateRange = dateSelectParam.split(' - ');
            startDate = moment(decodeURIComponent(dateRange[0].trim()), 'YYYY-MM-DD');
            endDate = moment(decodeURIComponent(dateRange[1].trim()), 'YYYY-MM-DD');
        } else {
            startDate = moment().subtract(6, 'days');
            endDate = moment();
        }

        $('#date_select').daterangepicker({
            startDate: startDate,
            endDate: endDate,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            alwaysShowCalendars: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

        $('#date_select').on('apply.daterangepicker', function(ev, picker) {
            var newDateSelect = picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD');
            $(this).val(newDateSelect);

            var newUrl = updateQueryStringParameter(window.location.href, 'dateSelect', encodeURIComponent(newDateSelect));
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
        });

        function updateQueryStringParameter(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return uri + separator + key + "=" + value;
            }
        }

        $('#date_select').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });

    function formatNumberWithCommas(number) {
        return number.toLocaleString('en-US');
    }

    function clickSearchReport(button) {
        event.preventDefault();
        $('#loader').show();

        const zoneId = document.getElementById('zoneSearch').value;

        if (!zoneId) {
            $('#zoneSearch').val(null).trigger('change');
        }

        let website = <?php echo MV_DEBUG ? "'dev.riseearning.com'" : "'" . $_SERVER['HTTP_HOST'] . "'" ?>;

        var urlParams = new URLSearchParams(window.location.search);
        var dateSelect = urlParams.get('dateSelect');
        var page = urlParams.get('wp_page');

        const apiUrl = `https://stg-publisher.maxvalue.media/api/report?website_name=${encodeURIComponent(website)}&page=${page}&zoneId=${zoneId}&dateSelect=${dateSelect}`;

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
                    const data = res.data;

                    if (data.zones && Array.isArray(data.zones)) {
                        data.zones.forEach(zone => {
                            var selectedAttribute = (zoneId && zoneId === String(zone.ad_zone_id)) ? ' selected' : '';
                            $('#zoneSearch').append('<option value="' + zone.ad_zone_id + '"' + selectedAttribute + '>' + zone.name + '</option>');
                        });
                    } else {
                        $('#zoneSearch').empty();
                    }

                    let pagination = data.items;

                    let paginationContainer = document.getElementById('pagination-links');
                    paginationContainer.innerHTML = '';

                    if (pagination.last_page > 1) {
                        pagination.links.forEach(link => {
                            let li = document.createElement('li');
                            li.className = `page-item ${link.active ? 'active' : ''}`;

                            if (link.url) {
                                let a = document.createElement('a');
                                a.className = 'page-link';
                                let url = new URL(window.location.href);
                                if (link.label == 'Next &raquo;') {
                                    link.label = '›';
                                } else if (link.label == '&laquo; Previous') {
                                    link.label = '‹';
                                }
                                url.searchParams.set('wp_page', link.label);
                                a.href = url.toString();
                                a.textContent = link.label;
                                li.appendChild(a);
                            } else {
                                let span = document.createElement('span');
                                span.className = 'page-link';
                                span.textContent = link.label == '&laquo; Previous' ? '‹' : '›';
                                li.appendChild(span);
                            }

                            paginationContainer.appendChild(li);
                        });
                    }

                    const items = data.items;

                    const threeDaysAgo = new Date();
                    threeDaysAgo.setDate(threeDaysAgo.getDate() - 3);
                    const today = new Date();
                    const reportTableBody = document.getElementById('report-table-body');
                    reportTableBody.innerHTML = '';

                    items.data && items.data.forEach(item => {
                        const currentDate = new Date(item.date);
                        const statusDisplay = item.status_display || false;
                        const confirmed = (currentDate <= threeDaysAgo && item.status) || statusDisplay;

                        const rowHtml = `
                <tr>
                    <td class="textCenter">${item.date}</td>
                    <td class="textCenter">${item.zoneName}</td>
                    <td class="textCenter">${item.total_impressions ? formatNumberWithCommas(item.total_impressions) : 0}</td>
                    <td class="textCenter">${item.date !== today && item.average_cpm !== 0 && item.average_cpm ? item.average_cpm : ''}</td>
                    <td class="textCenter">${item.date !== today && item.total_revenue !== 0 && item.total_revenue ? '$' + item.total_revenue : ''}</td>
                    <td class="textCenter">
                        ${confirmed ? '<span class="badge bg-success">Confirmed</span>' : ''}
                        ${!confirmed && statusDisplay === false ? '<span class="badge bg-warning">Validating</span><i class="ri-error-warning-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="This is not your final data"></i>' : ''}
                    </td>
                </tr>
            `;
                        reportTableBody.insertAdjacentHTML('beforeend', rowHtml);
                    });

                    if (data.countItem) {
                        const countItem = data.countItem;
                        const totalRowHtml = `
                <tr style="font-weight: bold">
                    <td class="textCenter" scope="row">Total</td>
                    <td></td>
                    <td class="textCenter">${countItem.totalImpressions ? formatNumberWithCommas(countItem.totalImpressions) : 0}</td>
                    <td class="textCenter">${countItem.averageCPM ? countItem.averageCPM : 0}</td>
                    <td class="textCenter">${countItem.totalChangeRevenue ? '$' + countItem.totalChangeRevenue : 0}</td>
                    <td></td>
                </tr>
            `;
                        reportTableBody.insertAdjacentHTML('beforeend', totalRowHtml);
                    }
                    $('#loader').hide();
                } else {
                    console.error('Failed to fetch report data:', data.message);
                    $('#loader').hide();
                }
            });
    }
</script>