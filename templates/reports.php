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
</style>
<div id="content-wrapper" style="display:none;">
    <div class="wrap">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="main-title mb-0">Welcome to Reports</h4>
            </div>
        </div>

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
                                <select id="zoneSearch" class="form-select form-control" name="zones"></select>
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
    const token = localStorage.getItem('mv_jwt_token');

    $(document).ready(function() {
        $("#zoneSearch").select2({
            placeholder: "- Zone -",
            allowClear: true,
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = new URL(window.location.href);
        const website = <?php echo MV_DEBUG ? "'dev.riseearning.com'" : "'" . $_SERVER['HTTP_HOST'] . "'" ?>;

        var urlParams = new URLSearchParams(currentUrl.search);

        var page = urlParams.get('wp_page');
        const zoneId = urlParams.get('zoneId');

        const apiUrl = new URL(`https://stg-publisher.maxvalue.media/api/report`);
        apiUrl.searchParams.append('website_name', website);
        apiUrl.searchParams.append('page', page);
        apiUrl.searchParams.append('zoneId', zoneId);

        console.log("Constructed API URL: ", apiUrl.toString());

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

                    $('#zoneSearch').empty();

                    if (data.zones && Array.isArray(data.zones)) {
                        data.zones.forEach(zone => {
                            $('#zoneSearch').append('<option value="' +
                                zone.id + '">' + zone.name +
                                '</option>');
                        });
                    } else {
                        $('#zoneSearch').empty();
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
        var startDateParam = urlParams.get('start');
        var endDateParam = urlParams.get('end');

        var startDate = startDateParam ? moment(startDateParam, 'YYYY-MM-DD') : moment().subtract(6, 'days');
        var endDate = endDateParam ? moment(endDateParam, 'YYYY-MM-DD') : moment();

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
            "alwaysShowCalendars": true
        }, function(start, end, label) {
            var from = start.format('YYYY-MM-DD');
            var to = end.format('YYYY-MM-DD');
            var route = "<?php echo esc_js(admin_url('admin.php?page=mv-dashboard')); ?>";
            route += "&website_id=" + <?php echo json_encode($siteId); ?> + "&date_option=";
            switch (label) {
                case 'Today':
                    route += "TODAY";
                    break;
                case 'Yesterday':
                    route += "YESTERDAY";
                    break;
                case 'Last 7 Days':
                    route += "SUB_7";
                    break;
                case 'Last 30 Days':
                    route += "SUB_30";
                    break;
                case 'This Month':
                    route += "SUB_THIS_MONTH";
                    break;
                case 'Last Month':
                    route += "SUB_LAST_MONTH";
                    break;
                default:
                    route += "CUSTOM";
                    break;
            }
            window.history.pushState(null, '', route + "&start=" + from + "&end=" + to);
        });
    });

    function formatNumberWithCommas(number) {
        return number.toLocaleString('en-US');
    }

    function clickSearchReport(button) {
        event.preventDefault();
        $('#loader').show();
    }
</script>