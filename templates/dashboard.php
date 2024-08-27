<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.52.0/apexcharts.min.css" integrity="sha512-w3pXofOHrtYzBYpJwC6TzPH6SxD6HLAbT/rffdkA759nCQvYi5AHy5trNWFboZnj4xtdyK0AFMBtck9eTmwybg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.52.0/apexcharts.min.js" integrity="sha512-piY4QAXPoG2xLdUZZbcc5klXzMxckrQKY9A2o6nKDRt9inolvvLbvGPC+z9IZ29b28UJlD05B7CjxxPaxh4bjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/maps/jquery.vmap.world.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">

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

    .unsetWidth {
        max-width: unset;
    }

    #loader-text {
        width: 100%;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 9999;
    }

    .vmap-one {
        height: 200px;
    }

    .card-header {
        background-color: transparent !important;
    }

    .bg-orange {
        background-color: #fd7e14 !important;
    }

    .bg-pink {
        background-color: #ea4c89 !important;
    }

    .bg-purple {
        background-color: #6f42c1 !important;
    }

    .bg-warning {
        color: black !important;
    }

    .card {
        padding: 0 !important;
    }

    .wrap {
        margin: 0 20px !important;
    }

    @media (min-width: 1200px) {
        .vmap-one {
            height: 350px;
        }
    }

    @media (min-width: 768px) and (max-width: 1199px) {
        .vmap-one {
            height: 300px;
        }
    }
</style>

<?php
include_once 'base.php';
?>

<div id="content-wrapper" style="display:none; background-color: #F9FAFC; margin-left: -22px">
    <div class="wrap">
        <?php
        include_once 'header.php';
        ?>
        <div class="row g-3 justify-content-center mb-4">
            <div class="col-md-3 col-xl">
                <div class="card card-one">
                    <div class="card-body">
                        <h3 class="card-value mb-1" id="yesterday_earning"></h3>
                        <label class="card-title fw-medium text-dark mb-1">Yesterday Earning</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xl">
                <div class="card card-one">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-value mb-1" id="this_month"></h3>
                                <label class="card-title fw-medium text-dark mb-1">This Month</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xl">
                <div class="card card-one">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-value mb-1" id="last_month"></h3>
                                <label class="card-title fw-medium text-dark mb-1">Last Month</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xl">
                <div class="card card-one">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-value mb-1" id="total_earning"></h3>
                                <label class="card-title fw-medium text-dark mb-1">Total Earning</label>
                            </div>
                        </div>
                    </div>
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
                <div class="card card-one unsetWidth">
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
                <div class="card card-one unsetWidth" style="height: 95%;">
                    <div class="card-header">
                        <h6 class="card-title">Your Top Countries</h6>
                    </div>
                    <div class="card-body p-4 d-flex align-items-center justify-content-center">
                        <div class="row g-3" style="width: 100%;">
                            <div class="col-md-3 d-flex flex-column">
                                <table class="table table-one mb-4">
                                    <tbody id="country-traffic-table"></tbody>
                                </table>
                            </div>
                            <div class="col-md-9 mt-5 mt-md-0">
                                <div id="vmap" class="vmap-one" style="width: 600px; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-4 col-xl-3 d-flex flex-column">
                <div class="card card-one mb-1">
                    <div class="card-header">
                        <h6 class="card-title">Traffic Source</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="progress progress-one ht-8 mt-2 mb-4" id="progress-container">
                        </div>
                        <table class="table table-three">
                            <tbody id="domain-table-body"></tbody>
                        </table>
                    </div>
                </div>

                <div class="card card-one">
                    <div class="card-header">
                        <h6 class="card-title">Device Used By Users</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="progress progress-one ht-8 mt-2 mb-4" id="progress-device"></div>
                        <table class="table table-three">
                            <tbody id="table-device"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-one mt-3 unsetWidth">
                    <div class="card-body p-3">
                        <div class="table-responsive" id="table-report">
                            <table class="table table-hover table-four table-bordered">
                                <thead>
                                    <tr style="background-color: rgba(0, 0, 0, .03);">
                                        <th scope="col" class="textCenter">Date</th>
                                        <th scope="col" class="textCenter">Website</th>
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
    </div>

    <script>
        localStorage.setItem('page_title', 'Dashboard');
        let chart;

        const token = localStorage.getItem('mv_jwt_token');

        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                colors: ['rgb(0, 143, 251)', 'rgb(0, 227, 150)', 'rgb(254, 176, 25)', 'rgb(255, 69, 96)',
                    'rgb(119, 93, 208)', '#FF4081', '#4CAF50', '#2196F3', '#FF9800', '#9C27B0', '#FFC107', '#03A9F4',
                    '#E91E63', '#00BCD4', '#8BC34A', '#673AB7', '#FF5722', '#607D8B', '#9E9E9E', '#795548', '#F44336',
                    '#FFEB3B', '#9C27B0', '#009688', '#FF5722'
                ],
                series: [],
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [0]
                },
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: true,
                        offsetX: 0,
                        offsetY: 0,
                        tools: {
                            download: true
                        },
                        export: {
                            csv: {
                                filename: '',
                            },
                            svg: {
                                filename: '',
                            },
                            png: {
                                filename: '',
                            }
                        },
                        autoSelected: 'zoom'
                    },
                },
                stroke: {
                    width: [0, 4]
                },
                xaxis: {
                    categories: [],
                },
                yaxis: [{
                    title: {
                        text: 'Revenue',
                    },
                    labels: {
                        formatter: function(value) {
                            if (value >= 1000) {
                                return (value / 1000).toFixed(2) + "k";
                            } else {
                                return value.toFixed(2);
                            }
                        }
                    }
                }]
            };

            chart = new ApexCharts(document.querySelector("#chart_custom"), options);
            chart.render();

            const currentUrl = new URL(window.location.href);
            const params = new URLSearchParams(currentUrl.search);
            const website = <?php echo MV_DEBUG ? "'dev.riseearning.com'" : "'" . $_SERVER['HTTP_HOST'] . "'" ?>;

            var urlParams = new URLSearchParams(window.location.search);

            var start = urlParams.get('start');
            var end = urlParams.get('end');
            var date_option = urlParams.get('date_option');
            var page = urlParams.get('wp_page');

            const apiUrl = `https://stg-publisher.maxvalue.media/api/dashboard?website_name=${encodeURIComponent(website)}&start=${start}&end=${end}&date_option=${date_option}&page=${page}`;

            if (!token) return;
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
                        let data = res.data;
                        console.log('map data = ', data.listMapCountryTraffic);

                        $('#yesterday_earning').text("$" + data.revenueYesterday);
                        $('#this_month').text("$" + data.revenueThisMonth);
                        $('#last_month').text("$" + data.revenueLastMonth);
                        $('#total_earning').text("$" + data.totalReport);
                        chart.updateSeries(data.chart.data);
                        chart.updateOptions({
                            xaxis: {
                                categories: data.chart.date
                            },
                            chart: {
                                toolbar: {
                                    export: {
                                        csv: {
                                            filename: data.fileNameExport,
                                        },
                                        svg: {
                                            filename: data.fileNameExport,
                                        },
                                        png: {
                                            filename: data.fileNameExport,
                                        }
                                    }
                                }
                            }
                        });
                        let colors = ['bg-success', 'bg-orange', 'bg-pink', 'bg-info', 'bg-indigo'];
                        let progressContainerTrafic = document.getElementById('progress-container');
                        progressContainerTrafic.innerHTML = '';
                        data.reportRefererDomain.forEach((domain, index) => {
                            let progressBar = document.createElement('div');
                            progressBar.className = `progress ${colors[index % colors.length]}`;
                            progressBar.style.width = `${domain.percent}%`;
                            progressBar.setAttribute('aria-valuenow', domain.percent);
                            progressBar.setAttribute('aria-valuemin', '0');
                            progressBar.setAttribute('aria-valuemax', '100');
                            progressBar.style.borderRadius = 'unset';

                            progressContainerTrafic.appendChild(progressBar);
                        });
                        let tableDomain = document.getElementById('domain-table-body');
                        tableDomain.innerHTML = '';

                        if (data.reportRefererDomain.length > 0) {
                            data.reportRefererDomain.forEach((domain, index) => {
                                let row = document.createElement('tr');

                                let colorCell = document.createElement('td');
                                let badgeDot = document.createElement('div');
                                badgeDot.className = `badge-dot ${colors[index % colors.length]}`;
                                colorCell.appendChild(badgeDot);
                                row.appendChild(colorCell);

                                let nameCell = document.createElement('td');
                                nameCell.className = 'domain-name';
                                nameCell.textContent = domain.name;
                                row.appendChild(nameCell);

                                let percentCell = document.createElement('td');
                                percentCell.textContent = `${domain.percent}%`;
                                row.appendChild(percentCell);

                                tableDomain.appendChild(row);
                            });
                        } else {
                            let noDataRow = document.createElement('tr');
                            let noDataCell = document.createElement('td');
                            noDataCell.colSpan = 3;
                            noDataCell.textContent = 'No data available';
                            noDataRow.appendChild(noDataCell);
                            tableDomain.appendChild(noDataRow);
                        }

                        let progressContainerDevice = document.getElementById('progress-device');
                        progressContainerDevice.innerHTML = '';

                        data.reportDevice.forEach((device, index) => {
                            let progressBar = document.createElement('div');
                            progressBar.className = `progress ${colors[index % colors.length]}`;
                            progressBar.style.width = `${device.percent}%`;
                            progressBar.setAttribute('aria-valuenow', device.percent);
                            progressBar.setAttribute('aria-valuemin', '0');
                            progressBar.setAttribute('aria-valuemax', '100');
                            progressBar.style.borderRadius = 'unset';

                            progressContainerDevice.appendChild(progressBar);
                        });

                        let tableDevice = document.getElementById('table-device');
                        tableDevice.innerHTML = '';

                        if (data.reportDevice.length > 0) {
                            data.reportDevice.forEach((device, index) => {
                                let row = document.createElement('tr');

                                let colorCell = document.createElement('td');
                                let badgeDot = document.createElement('div');
                                badgeDot.className = `badge-dot ${colors[index % colors.length]}`;
                                colorCell.appendChild(badgeDot);
                                row.appendChild(colorCell);

                                let nameCell = document.createElement('td');
                                nameCell.textContent = device.name;
                                row.appendChild(nameCell);

                                let percentCell = document.createElement('td');
                                percentCell.textContent = `${device.percent}%`;
                                row.appendChild(percentCell);

                                tableDevice.appendChild(row);
                            });
                        } else {
                            let noDataRow = document.createElement('tr');
                            let noDataCell = document.createElement('td');
                            noDataCell.colSpan = 3;
                            noDataCell.textContent = 'No data available';
                            noDataRow.appendChild(noDataCell);
                            tableDevice.appendChild(noDataRow);
                        }

                        let items = data.items && data.items.data.length > 0 ? data.items.data : [];
                        let countItem = data.countItem;
                        let isNewPub = data.isNewPub;
                        let currentDate = new Date();
                        let yesterday = new Date();
                        yesterday.setDate(currentDate.getDate() - 1);
                        let threeDaysAgo = new Date();
                        threeDaysAgo.setDate(currentDate.getDate() - 3);
                        let currentHourUTC = new Date().getUTCHours();
                        let previousDate = null;

                        let tableBody = document.getElementById('report-table-body');
                        tableBody.innerHTML = '';

                        items.forEach((itemReportSite, index) => {
                            if (
                                isNewPub &&
                                currentHourUTC < 12 &&
                                (itemReportSite.date === formatDate(yesterday) ||
                                    itemReportSite.date === formatDate(currentDate) ||
                                    itemReportSite.total_impressions === 0)
                            ) {
                                return;
                            }

                            let currentDate = itemReportSite.date;
                            let rowspanCount = items.filter(item => item.date === currentDate).length;

                            if (currentDate !== previousDate) {
                                let row = document.createElement('tr');
                                row.innerHTML = `
                        <td class="textCenter" rowspan="${rowspanCount}" style="vertical-align: middle;">${itemReportSite.date}</td>
                        <td class="textCenter"><div>${itemReportSite.websiteName}</div></td>
                        <td class="textCenter">${formatNumber(itemReportSite.total_impressions)}</td>
                        <td class="textCenter">${(itemReportSite.date !== formatDate(new Date()) && itemReportSite.average_cpm !== 0) ? formatNumber(itemReportSite.average_cpm, 2) : ''}</td>
                        <td class="textCenter">${(itemReportSite.date !== formatDate(new Date()) && itemReportSite.total_revenue !== 0) ? '$' + formatNumber(itemReportSite.total_revenue, 2) : ''}</td>
                        <td class="textCenter">
                            ${(itemReportSite.date <= formatDate(threeDaysAgo) && itemReportSite.status) || (itemReportSite.status_display !== undefined && itemReportSite.status_display) ? 
                                '<span class="badge bg-success">Confirmed</span>' : 
                                (itemReportSite.status_display == 0 ? '<span class="badge bg-warning">Validating</span>' : '')
                            }
                        </td>
                    `;
                                tableBody.appendChild(row);
                            } else {
                                let row = document.createElement('tr');
                                row.innerHTML = `
                        <td class="textCenter"><div>${itemReportSite.websiteName}</div></td>
                        <td class="textCenter">${formatNumber(itemReportSite.total_impressions)}</td>
                        <td class="textCenter">${(itemReportSite.date !== formatDate(new Date()) && itemReportSite.average_cpm !== 0) ? formatNumber(itemReportSite.average_cpm, 2) : ''}</td>
                        <td class="textCenter">${(itemReportSite.date !== formatDate(new Date()) && itemReportSite.total_revenue !== 0) ? '$' + formatNumber(itemReportSite.total_revenue, 2) : ''}</td>
                        <td class="textCenter">
                            ${(itemReportSite.date <= formatDate(threeDaysAgo) && itemReportSite.status) || (itemReportSite.status_display !== undefined && itemReportSite.status_display) ? 
                                '<span class="badge bg-success">Confirmed</span>' : 
                                (itemReportSite.status_display == 0 ? '<span class="badge bg-warning">Validating</span>' : '')
                            }
                        </td>
                    `;
                                tableBody.appendChild(row);
                            }

                            previousDate = currentDate;
                        });

                        if (
                            (countItem.totalImpressions === 0 && countItem.averageCPM === 0 && countItem.totalChangeRevenue === 0) ||
                            (isNewPub && currentHourUTC < 12)
                        ) {} else {
                            let totalRow = document.createElement('tr');
                            totalRow.style.fontWeight = 'bold';
                            totalRow.innerHTML = `
                    <td class="textCenter" scope="row" data-column="Date">Total</td>
                    <td></td>
                    <td class="textCenter">${formatNumber(countItem.totalImpressions)}</td>
                    <td class="textCenter">${formatNumber(countItem.averageCPM, 2)}</td>
                    <td class="textCenter">$${formatNumber(countItem.totalChangeRevenue, 2)}</td>
                    <td></td>
                `;
                            tableBody.appendChild(totalRow);
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
                                    if (link.label === 'Next &raquo;') {
                                        link.label = '›';
                                    } else if (link.label === '&laquo; Previous') {
                                        link.label = '‹';
                                    }

                                    url.searchParams.set('wp_page', new URL(link.url).searchParams.get('page') || link.label);
                                    a.href = url.toString();
                                    a.textContent = link.label;
                                    li.appendChild(a);

                                    if (link.label === '‹' && pagination.current_page === 1) {
                                        li.classList.add('disabled');
                                        a.href = '#';
                                    }

                                    if (link.label === '›' && pagination.current_page === pagination.last_page) {
                                        li.classList.add('disabled');
                                        a.href = '#';
                                    }

                                } else {
                                    let span = document.createElement('span');
                                    span.className = 'page-link';
                                    span.textContent = link.label === '&laquo; Previous' ? '‹' : '›';
                                    li.appendChild(span);

                                    li.classList.add('disabled');
                                }

                                paginationContainer.appendChild(li);
                            });
                        }

                        let listCountryTraffic = data.listCountryTraffic;
                        let totalCountryTraffic = data.totalCountryTraffic;
                        let countryTraffic = document.getElementById('country-traffic-table');

                        countryTraffic.innerHTML = '';

                        if (listCountryTraffic.length > 0) {
                            listCountryTraffic.forEach(itemTraffic => {
                                let percentage = totalCountryTraffic != 0 ?
                                    ((itemTraffic.total_impressions / totalCountryTraffic) * 100).toFixed(2) :
                                    0;

                                let row = document.createElement('tr');
                                row.innerHTML = `
                        <td scope="row" data-column="Date">
                            <span class="flag-icon flag-icon-${itemTraffic.code}"></span>
                            <span class="fw-medium">${itemTraffic.name}</span>
                        </td>
                        <td>${percentage}%</td>
                    `;

                                countryTraffic.appendChild(row);
                            });
                        } else {
                            let noDataRow = document.createElement('tr');
                            noDataRow.innerHTML = `
                    <td colspan="2">No data available</td>
                `;
                            countryTraffic.appendChild(noDataRow);
                        }

                        jQuery('#vmap').vectorMap('set', 'colors', data.listMapCountryTraffic);
                        $('#loader').hide();
                    } else {
                        alert(res.message || 'Get data dashboard fail');
                        $('#loader').hide();
                    }
                })
                .catch(error => {
                    console.error('Error fetching dashboard data:', error);
                    $('#loader').hide();
                });

        });

        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }

        function formatNumber(number, decimals = 0) {
            return number ? number.toLocaleString(undefined, {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            }) : 0;
        }

        function clickSearchReport(button) {
            event.preventDefault();
            window.location.reload();
        }
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: '#fff',
                borderColor: '#fff',
                color: '#d9dde7',
                colors: {},
                hoverColor: null,
                hoverOpacity: 0.8,
                enableZoom: false,
                showTooltip: true,
                multiSelectRegion: true
            });
        });
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
    </script>