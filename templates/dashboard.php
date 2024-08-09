<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</script>
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
        <div class="col-md-6 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h3 class="card-value mb-1">$<?= number_format($dashboardData['revenueYesterday'] ?? 0, 2) ?></h3>
                            <label class="card-title fw-medium text-dark mb-1">Yesterday Earning</label>
                        </div>
                        <div class="col-5">
                            <div id="apexChart1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl">
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
        <div class="col-md-6 col-xl">
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
        <div class="col-md-6 col-xl">
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
            <div class="card card-one">
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

    <!-- <div class="card card-one mt-3">
        <div class="card-body p-3">
            <div class="row justify-content-end p-3">
                <div class="col-md-7 col-sm-12" style="padding-left: 0px;">
                    <form action="{{ route('user.dashboard.index') }}" class="searchReport" method="GET">
                        <input type="hidden" name="date_option" value="{{ request('date_option') }}">
                        <input type="hidden" name="start" value="{{ request('start') }}">
                        <input type="hidden" name="end" value="{{ request('end') }}">
                        <div class="row">
                            <div class="col-sm-3">
                                <select id="searchWebsite" class="form-select form-control" name="website_id">
                                    <option value="null">-Website-</option>
                                    @foreach ($websites as $website)
                                    <option value="{{ $website->id }}" {{ request('website_id') == $website->id ? 'selected' : '' }}>
                                        {{ $website->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="select_date" readonly>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-primary generate" onclick="clickSearchReport(this)"> Generate
                                    </button>
                                    <button style="min-width: 130px" type="button" class="btn btn-outline-success download" onclick="clickDownloadReport()">
                                        <i class="ri-download-2-fill"></i> Download
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 col-sm-12 report-via" style="display: flex; align-items: center; gap: 10px; padding: 0;">
                    <div class="form-check form-switch" style="display: flex; align-items: center">
                        <input style="font-size: 20px; margin-left: -34px" id="emailCheckbox" class="form-check-input switchUpdate" type="checkbox" role="switch" <?php echo $user->sent_email ? 'checked' : ''; ?>>
                        <label style="margin-top: 3px" class="form-check-label ms-2" for="switch">
                            Get Report via Email
                        </label>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="table-report">
                <table class="table table-hover table-four table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="textCenter">Date</th>
                            <th scope="col" class="textCenter">Website</th>
                            <th scope="col" class="textCenter cpm_sort">Impressions</th>
                            <th scope="col" class="textCenter cpm_sort">eCPM</th>
                            <th scope="col" class="textCenter revenue_sort">Revenue</th>
                            <th scope="col" class="textCenter">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        use Carbon\Carbon;

                        $currentDate = Carbon::today();
                        $yesterday = Carbon::yesterday();
                        $threeDaysAgo = Carbon::now()->subDays(3);
                        $currentHourUTC = Carbon::now('UTC')->hour;
                        $previousDate = null;
                        $rowspanCount = 0;
                        @endphp
                        @foreach ($items as $index => $itemReportSite)
                        @if (
                        $isNewPub &&
                        $currentHourUTC < \App\Models\ReportModel::REPORT_DAILY_TIME && ($itemReportSite->date == $yesterday->toDateString() ||
                            $itemReportSite->date == $currentDate->toDateString() ||
                            $itemReportSite->total_impressions == 0))
                            @else
                            @php
                            $currentDate = $itemReportSite->date;
                            $rowspanCount = $items->where('date', $currentDate)->count();
                            @endphp

                            @if ($currentDate !== $previousDate)
                            <tr>
                                <td class="textCenter" rowspan="{{ $rowspanCount }}" style="vertical-align: middle;">{{ $itemReportSite->date }}
                                </td>
                                <td class="textCenter">
                                    <div>{{ $itemReportSite->websiteName }}</div>
                                </td>
                                <td class="textCenter">
                                    {{ number_format($itemReportSite->total_impressions ?? 0) }}
                                </td>
                                <td class="textCenter">
                                    @if ($itemReportSite->date != \Carbon\Carbon::today()->toDateString() && $itemReportSite->average_cpm != 0)
                                    {{ number_format($itemReportSite->average_cpm ?? 0, 2) }}
                                    @endif
                                </td>
                                <td class="textCenter">
                                    @if ($itemReportSite->date != \Carbon\Carbon::today()->toDateString() && $itemReportSite->total_revenue != 0)
                                    ${{ number_format($itemReportSite->total_revenue, 2, '.', ',') }}
                                    @endif
                                </td>
                                <td class="textCenter">
                                    @if (
                                    ($itemReportSite->date <= $threeDaysAgo->toDateString() && $itemReportSite->status) ||
                                        (isset($itemReportSite->status_display) && $itemReportSite->status_display))
                                        <span class="badge bg-success">Confirmed</span>
                                        @elseif (isset($itemReportSite->status_display) && !$itemReportSite->status_display)
                                        <span class="badge bg-warning">Validating</span>
                                        <i class="ri-error-warning-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="This is not your final data"></i>
                                        @else
                                        @endif
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td class="textCenter">
                                    <div>{{ $itemReportSite->websiteName }}</div>
                                </td>
                                <td class="textCenter">
                                    {{ number_format($itemReportSite->total_impressions ?? 0) }}
                                </td>
                                <td class="textCenter">
                                    @if ($itemReportSite->date != \Carbon\Carbon::today()->toDateString() && $itemReportSite->average_cpm != 0)
                                    {{ number_format($itemReportSite->average_cpm ?? 0, 2) }}
                                    @endif
                                </td>
                                <td class="textCenter">
                                    @if ($itemReportSite->date != \Carbon\Carbon::today()->toDateString() && $itemReportSite->total_revenue != 0)
                                    ${{ number_format($itemReportSite->total_revenue, 2, '.', ',') }}
                                    @endif
                                </td>
                                <td class="textCenter">
                                    @if (
                                    ($itemReportSite->date <= $threeDaysAgo->toDateString() && $itemReportSite->status) ||
                                        (isset($itemReportSite->status_display) && $itemReportSite->status_display))
                                        <span class="badge bg-success">Confirmed</span>
                                        @elseif (isset($itemReportSite->status_display) && !$itemReportSite->status_display)
                                        <span class="badge bg-warning">Validating</span>
                                        <i class="ri-error-warning-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="This is not your final data"></i>
                                        @else
                                        @endif
                                </td>
                            </tr>
                            @endif

                            @php
                            $previousDate = $currentDate;
                            @endphp
                            @endif
                            @endforeach
                            @if (
                            ($countItem['totalImpressions'] == 0 && $countItem['averageCPM'] == 0 && $countItem['totalChangeRevenue'] == 0) ||
                            ($isNewPub && $currentHourUTC < \App\Models\ReportModel::REPORT_DAILY_TIME)) @else <tr style="font-weight: bold">
                                <td class="textCenter" scope="row" data-column="Date">Total</td>
                                <td></td>
                                <td class="textCenter">
                                    {{ empty($countItem['totalImpressions']) ? 0 : number_format($countItem['totalImpressions']) }}
                                </td>
                                <td class="textCenter">
                                    {{ empty($countItem['averageCPM']) ? 0 : round($countItem['averageCPM'], 2) }}
                                </td>
                                <td class="textCenter">
                                    ${{ empty($countItem['totalChangeRevenue']) ? 0 : number_format($countItem['totalChangeRevenue'], 2, '.', ',') }}
                                </td>
                                <td></td>
                                </tr>
                                @endif
                    </tbody>
                </table>
                <div>
                    @include('publisher.common.footer_table')
                </div>
            </div>
        </div>
    </div> -->

    <script>
        function clickSearchReport(button) {
            // Get the current URL
            let searchParams = new URLSearchParams(window.location.search);
            var url = new URL(window.location.href);

            // Update URL parameters
            url.searchParams.set("start", searchParams.get('start'));
            url.searchParams.set("end", searchParams.get('end'));

            // Find the closest form element to the button clicked
            var form = button.closest('form.searchReport');

            // Set the form action attribute
            form.action = url.href;

            // Submit the form
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