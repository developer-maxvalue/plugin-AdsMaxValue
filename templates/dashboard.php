<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<style>
    .textCenter {
        text-align: center !important;
    }

    .table-three td.domain-name {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (min-width: 768px) {
        .report-via {
            justify-content: end;
        }
    }
</style>
<div class="wrap">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="main-title mb-0">Welcome to Dashboard</h4>
        </div>
    </div>
    <div class="row g-3 justify-content-center mb-4">
        <div class="col-md-3 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <h3 class="card-value mb-1">$<?= number_format($dashboardData['revenueYesterday'] ?? 0, 2) ?></h3>
                    <label class="card-title fw-medium text-dark mb-1">Yesterday Earning</label>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h3 class="card-value mb-1">$<?= number_format($dashboardData['revenueThisMonth'] ?? 0, 2) ?></h3>
                            <label class="card-title fw-medium text-dark mb-1">This Month</label>
                        </div>
                        <div class="col-5">
                            <div id="apexChart2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h3 class="card-value mb-1">$<?php echo number_format($dashboardData['revenueLastMonth'] ?? 0, 2); ?></h3>
                            <label class="card-title fw-medium text-dark mb-1">Last Month</label>
                        </div>
                        <div class="col-5">
                            <div id="apexChart3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h3 class="card-value mb-1">
                                $<?= number_format($dashboardData['totalReport'] ?? 0, 2) ?></h3>
                            <label class="card-title fw-medium text-dark mb-1">Total Earning</label>
                        </div>
                        <div class="col-5">
                            <div id="apexChart03"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-12">
            <div class="card card-one" style="max-width: unset;">
                <div class="card-body">
                    <form action="<?php echo esc_url(admin_url('admin.php')); ?>" class="searchReport" method="GET">
                        <input type="hidden" name="page" value="aap-dashboard">
                        <input type="hidden" name="date_option" value="<?php echo isset($_GET['date_option']) ? esc_attr($_GET['date_option']) : ''; ?>">
                        <input type="hidden" name="start" value="<?php echo isset($_GET['start']) ? esc_attr($_GET['start']) : ''; ?>">
                        <input type="hidden" name="end" value="<?php echo isset($_GET['end']) ? esc_attr($_GET['end']) : ''; ?>">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <select id="websiteSearch" class="form-select form-control" name="website_id">
                                    <option value="null">-Website-</option>
                                    <?php if (!empty($dashboardData['websites'])) : ?>
                                        <?php foreach ($dashboardData['websites'] as $website) : ?>
                                            <option value="<?php echo esc_attr($website['id']); ?>" <?php echo isset($_GET['website_id']) && $_GET['website_id'] == $website['id'] ? 'selected' : ''; ?>>
                                                <?php echo esc_html($website['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <input type="text" class="form-control" id="date_select" readonly>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-primary generate" onclick="clickSearchReport(this)"> Generate
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card card-one">
                <div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
                    <h6 class="card-title">Revenue Chart</h6>
                </div>
                <div class="card-body" style="padding-bottom: 0">
                    <div id="chart_custom" class="apex-chart-nine"></div>
                </div>
                <h6 class="text-center text-danger" style="padding-bottom: 6px">
                    We do need 1- 3 weeks to integrate our demands to optimize your revenue.
                </h6>
            </div>
        </div>

        <div class="col-md-12 col-lg-8 col-xl-9">
            <div class="card card-one">
                <div class="card-header">
                    <h6 class="card-title">Your Top Countries</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-3 d-flex flex-column">
                            <table class="table table-one mb-4">
                                <?php if (!empty($listCountryTraffic)) : ?>
                                    <?php foreach ($listCountryTraffic as $itemTraffic) : ?>
                                        <tr>
                                            <td scope="row" data-column="Date">
                                                <span class="flag-icon flag-icon-<?php echo esc_attr($itemTraffic['code']); ?> flag-icon-<?php echo esc_attr($itemTraffic['code']); ?>"></span>
                                                <span class="fw-medium"><?php echo esc_html($itemTraffic['name']); ?></span>
                                            </td>
                                            <td>
                                                <?php echo $totalCountryTraffic != 0 ? round(($itemTraffic['total_impressions'] / $totalCountryTraffic) * 100, 2) : 0; ?>%
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="2">No data available</td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <div class="col-md-9 mt-5 mt-md-0">
                            <div id="vmap" class="vmap-one"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-4 col-xl-3 d-flex flex-column">
            <!-- Traffic Source -->
            <div class="card card-one mb-1">
                <div class="card-header">
                    <h6 class="card-title">Traffic Source</h6>
                </div>
                <div class="card-body p-3">
                    <div class="progress progress-one ht-8 mt-2 mb-4">
                        <?php
                        $colors = ['bg-success', 'bg-orange', 'bg-pink', 'bg-info', 'bg-indigo'];
                        ?>
                        <?php if (!empty($reportRefererDomain)) : ?>
                            <?php foreach ($reportRefererDomain as $index => $domain) : ?>
                                <div class="progress <?php echo esc_attr($colors[$index % count($colors)]); ?>" style="width: <?php echo esc_attr($domain['percent']); ?>%; border-radius: unset" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <table class="table table-three">
                        <tbody>
                            <?php if (!empty($reportRefererDomain)) : ?>
                                <?php foreach ($reportRefererDomain as $index => $domain) : ?>
                                    <tr>
                                        <td>
                                            <div class="badge-dot <?php echo esc_attr($colors[$index % count($colors)]); ?>"></div>
                                        </td>
                                        <td class="domain-name"><?php echo esc_html($domain['name']); ?></td>
                                        <td><?php echo round($domain['percent'], 2); ?>%</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">No data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Device Used By Users -->
            <div class="card card-one">
                <div class="card-header">
                    <h6 class="card-title">Device Used By Users</h6>
                </div>
                <div class="card-body p-3">
                    <div class="progress progress-one ht-8 mt-2 mb-4">
                        <?php
                        $colors = ['bg-success', 'bg-orange', 'bg-pink', 'bg-info', 'bg-indigo'];
                        ?>
                        <?php if (!empty($reportDevice)) : ?>
                            <?php foreach ($reportDevice as $index => $device) : ?>
                                <div class="progress <?php echo esc_attr($colors[$index % count($colors)]); ?>" style="width: <?php echo esc_attr($device['percent']); ?>%; border-radius: unset" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <table class="table table-three">
                        <tbody>
                            <?php if (!empty($reportDevice)) : ?>
                                <?php foreach ($reportDevice as $index => $device) : ?>
                                    <tr>
                                        <td>
                                            <div class="badge-dot <?php echo esc_attr($colors[$index % count($colors)]); ?>"></div>
                                        </td>
                                        <td><?php echo esc_html($device['name']); ?></td>
                                        <td><?php echo esc_html($device['percent']); ?>%</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">No data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        jQuery(document).ready(function($) {
            $("#websiteSearch").select2({
                placeholder: "- Website -",
                allowClear: true,
            });

            $('#websiteSearch').one('select2:open', function(e) {
                $('input.select2-search__field').prop('placeholder', 'Search...');
            });
        });
    </script>

    <script>
        function clickSearchReport(button) {
            let searchParams = new URLSearchParams(window.location.search);
            var url = new URL(window.location.href);

            url.searchParams.set("start", searchParams.get('start'));
            url.searchParams.set("end", searchParams.get('end'));

            var form = button.closest('form.searchReport');

            form.action = url.href;

            form.submit();
        }
    </script>

    <script>
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
                var route = "<?php echo esc_js(admin_url('admin.php?page=aap-dashboard')); ?>";
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
                window.location.href = route + "&start=" + from + "&end=" + to;
            });

            $('#select_date').daterangepicker({
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
                var route = "<?php echo esc_js(admin_url('admin.php?page=aap-dashboard')); ?>";
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
                window.location.href = route + "&start=" + from + "&end=" + to;
            });
        });
    </script>
</div>