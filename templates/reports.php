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

                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-primary generate" onclick="clickSearchReport(this)"> Search
                                    </button>
                                    <button type="button" class="btn btn-outline-success generate" onclick="clickSearchReport(this)"> Download
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

    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = new URL(window.location.href);
        const params = new URLSearchParams(currentUrl.search);
        const website = <?php echo MV_DEBUG ? "'dev.riseearning.com'" : "'" . $_SERVER['HTTP_HOST'] . "'" ?>;

        var urlParams = new URLSearchParams(window.location.search);

        var dateSelect = urlParams.get('dateSelect');
        var page = urlParams.get('wp_page');
        var date_option = urlParams.get('date_option');

        const apiUrl = `https://stg-publisher.maxvalue.media/api/report?website_name=${encodeURIComponent(website)}&date_option=${date_option}&page=${page}`;

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

    function formatNumberWithCommas(number) {
        return number.toLocaleString('en-US');
    }

    function clickSearchReport(button) {
        event.preventDefault();
        $('#loader').show();
    }
</script>