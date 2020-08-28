<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

require_once $way['class_user'];
$user = new User();
if($user->getData($_SESSION['id'])['status'] == 'Администратор'){
    
}
else{
    return "<meta http-equiv = 'refresh' content = '0, URL=\"/\"' >"; 
}
require_once $way['class_statistic'];

$stat = new Statistic();
$row = $stat->getTotalUsers();
?>

<!-- Tiles -->
<!-- Row 1 -->
<div class="dash-tiles row">
   <h1 class="text-center">За месяц</h1>
    <!-- Column 1 of Row 1 -->
    <div class="col-sm-3">
        <!-- Total Users Tile -->
        <div class="dash-tile dash-tile-ocean clearfix animation-pullDown">
            <div class="dash-tile-header">
                <div class="dash-tile-options">
                    <div class="btn-group">
                        <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Manage Users"><i class="fa fa-cog"></i></a>
                        <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Statistics"><i class="fa fa-bar-chart-o"></i></a>
                    </div>
                </div>
                Всего пользователей
            </div>
            <div class="dash-tile-icon"><i class="fa fa-users"></i></div>
            <div class="dash-tile-text"><? echo $row['count'];?></div>
        </div>
        <!-- END Total Users Tile -->
    </div>
    <!-- END Column 1 of Row 1 -->

    <!-- Column 2 of Row 1 -->
    <div class="col-sm-3">
        <!-- Total Sales Tile -->
        <div class="dash-tile dash-tile-flower clearfix animation-pullDown">
            <div class="dash-tile-header">
                <div class="dash-tile-options">
                    <div class="btn-group">
                        <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="View new orders"><i class="fa fa-shopping-cart"></i></a>
                        <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Statistics"><i class="fa fa-bar-chart-o"></i></a>
                    </div>
                </div>
                Всего ставок
            </div>
            <div class="dash-tile-icon"><i class="fa fa-tags"></i></div>
            <div class="dash-tile-text"><? $row = $stat->getTotalBets(); echo $row['count'];?></div>
        </div>
        <!-- END Total Sales Tile -->
    </div>
    <!-- END Column 2 of Row 1 -->

    <!-- Column 3 of Row 1 -->
    <div class="col-sm-3">
        <!-- Total Profit Tile -->
        <div class="dash-tile dash-tile-leaf clearfix animation-pullDown">
            <div class="dash-tile-header">
                <span class="dash-tile-options">
                    <a href="javascript:void(0)" class="btn btn-default" data-toggle="popover" data-placement="top" data-content="$500 (230 Sales)" title="Today's profit"><i class="fa fa-credit-card"></i></a>
                </span>
                Приблизительный доход
            </div>
            <div class="dash-tile-icon"><i class="fa fa-money"></i></div>
            <div class="dash-tile-text"><? $row = $stat->getTotalProfit(); echo round($row['count'],2);?></div>
        </div>
        <!-- END Total Profit Tile -->
    </div>
    <!-- END Column 3 of Row 1 -->

    <!-- Column 4 of Row 1 -->
    <div class="col-sm-3">
        <!-- Total Tickets Tile -->
        <div class="dash-tile dash-tile-doll clearfix animation-pullDown">
            <div class="dash-tile-header">
                <div class="dash-tile-options">
                    <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Open tickets"><i class="fa fa-file-o"></i></a>
                </div>
                Новых пользователей
            </div>
            <div class="dash-tile-icon"><i class="fa fa-wrench"></i></div>
            <div class="dash-tile-text"><? $row = $stat->getNewUsers(); echo $row['count'];?></div>
        </div>
        <!-- END Total Tickets Tile -->
    </div>
    <!-- END Column 4 of Row 1 -->
</div>
<!-- END Row 1 -->

<!-- Row 2 -->
<div class="row">
    <!-- Column 1 of Row 2 -->
    <div class="col-sm-6">
        <!-- Statistics Tile -->
        <div class="dash-tile dash-tile-2x">
            <div class="dash-tile-header">
                <div class="dash-tile-options">
                    <div id="example-advanced-daterangepicker" class="btn btn-default">
                        <i class="fa fa-calendar"></i>
                        <span></span>
                        <b class="caret"></b>
                    </div>
                </div>
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="dash-tile-content">
                <div id="dash-example-stats" class="dash-tile-content-inner"></div>
            </div>
        </div>
        <!-- END Statistics Tile -->
    </div>
    <!-- END Column 1 of Row 2 -->

    <!-- Column 2 of Row 2 -->
    <div class="col-sm-6">
        <!-- Statistics Tile -->
        <div class="dash-tile dash-tile-2x">
            <div class="dash-tile-header">
                <div class="dash-tile-options">
                    <div id="example-advanced-daterangepicker" class="btn btn-default">
                        <i class="fa fa-calendar"></i>
                        <span></span>
                        <b class="caret"></b>
                    </div>
                </div>
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="dash-tile-content">
                <div id="dash-stats-money" class="dash-tile-content-inner"></div>
            </div>
        </div>
        <!-- END Statistics Tile -->
    </div>
    <!-- END Column 2 of Row 2 -->
</div>
<!-- END Row 2 -->

<!-- Row 3 -->
<div class="row">
    <!-- Column 1 of Row 3 -->
    <div class="col-sm-6">
        <!-- Datatables Tile -->
        <div class="dash-tile dash-tile-2x">
            <div class="dash-tile-header">
                <div class="dash-tile-options">
                    <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Manage Orders"><i class="fa fa-cogs"></i></a>
                </div>
                <i class="fa fa-shopping-cart"></i> Ближайшие матчи
            </div>
            <div class="dash-tile-content">
                <div class="dash-tile-content-inner-fluid">
                    <table id="dash-example-orders" class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th class="cell-small"></th>
                                <th class="hidden-xs hidden-sm hidden-md">#</th>
                                <th><i class="fa fa-shopping-cart"></i> Ставка</th>
                                <th class="hidden-xs hidden-sm hidden-md"><i class="fa fa-user"></i> Пользователь</th>
                                <th><i class="fa fa-bolt"></i> Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $labels['0']['class'] = "label-default";
                            $labels['0']['text'] = "Inactive";
                            $labels['1']['class'] = "label-success";
                            $labels['1']['text'] = "Sent!";
                            $labels['2']['class'] = "label-danger";
                            $labels['2']['text'] = "Canceled!";
                            $labels['3']['class'] = "label-warning";
                            $labels['3']['text'] = "Pending..";
                            $labels['4']['class'] = "label-info";
                            $labels['4']['text'] = "Manual process..";
                            $labels['5']['class'] = "label-inverse";
                            $labels['5']['text'] = "On hold..";
                            ?>
                            <?php for($i=1; $i<13; $i++) { ?>
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Process" class="btn btn-xs btn-primary"><i class="fa fa-book"></i></a>
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Cancel" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                    </div>
                                </td>
                                <td class="hidden-xs hidden-sm hidden-md"><?php echo $i; ?></td>
                                <td><a href="javascript:void(0)">Order#<?php echo $i; ?></a></td>
                                <td class="hidden-xs hidden-sm hidden-md"><a href="javascript:void(0)">User<?php echo $i; ?></a></td>
                                <?php $rand = rand(0, 5); ?>
                                <td><span class="label<?php echo ($labels[$rand]['class']) ? " " . $labels[$rand]['class'] : ""; ?>"><?php echo $labels[$rand]['text'] ?></span></td>
                            </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Datatables Tile -->
    </div>
    <!-- END Column 1 of Row 3 -->
</div>
<!-- END Row 3 -->
<!-- END Tiles -->

<script>
    $(function(){
        // Initialize dash Datatables
        $('#dash-example-orders').dataTable({
            columnDefs: [ { orderable: false, targets: [ 0 ] } ],
            pageLength: 6,
            lengthMenu: [[6, 10, 30, -1], [6, 10, 30, "All"]]
        });
        $('.dataTables_filter input').attr('placeholder', 'Search');

        // Dash example stats
        var dashChart = $('#dash-example-stats');
        var dashStat = $('#dash-stats-money');

        var dashChartData1 = [
            [0, 200],[1, 250],[2, 360],[3, 584],[4, 1250],[5, 1100],
            [6, 1500],[7, 1521],[8, 1600],[9, 1658],[10, 1623],
            [11, 1900],[12, 2100],[13, 1700],[14, 1620],[15, 1820],
            [16, 1950],[17, 2220],[18, 1951],[19, 2152],[20, 2300],
            [21, 2325],[22, 2200],[23, 2156],[24, 2350],[25, 2420],
            [26, 2480],[27, 2320],[28, 2380],[29, 2520],[30, 2590]
        ];
        var dashChartData2 = [
            [0, 50],[1, 180],[2, 200],[3, 350],[4, 700],[5, 650],[6, 700],
            [7, 780],[8, 820],[9, 880],[10, 1200],[11, 1250],[12, 1500],
            [13, 1195],[14, 1300],[15, 1350],[16, 1460],[17, 1680],[18, 1368],
            [19, 1589],[20, 1780],[21, 2100],[22, 1962],[23, 1952],[24, 2110],
            [25, 2260],[26, 2298],[27, 1985],[28, 2252],[29, 2300],[30, 2450]
        ];

        // Initialize Chart
        $.plot(dashChart, [
            { data: dashChartData1, lines: { show: true, fill: true, fillColor: { colors: [{ opacity: 0.05 }, { opacity: 0.05 }] } }, points: { show: true }, label: 'All Visits' },
            { data: dashChartData2, lines: { show: true, fill: true, fillColor: { colors: [{ opacity: 0.05 }, { opacity: 0.05 }] } }, points: { show: true }, label: 'Unique Visits' } ],
            {
                legend: {
                    position: 'nw',
                    backgroundColor: '#f6f6f6',
                    backgroundOpacity: 0.8
                },
                colors: ['#555555', '#db4a39'],
                grid: {
                    borderColor: '#cccccc',
                    color: '#999999',
                    labelMargin: 5,
                    hoverable: true,
                    clickable: true
                },
                yaxis: {
                    ticks: 5
                },
                xaxis: {
                    tickSize: 2
                }
            }
        );
        
        $.plot(dashStat, [
            { data: dashChartData1, lines: { show: true, fill: true, fillColor: { colors: [{ opacity: 0.05 }, { opacity: 0.05 }] } }, points: { show: true }, label: 'All Money' },
            { data: dashChartData2, lines: { show: true, fill: true, fillColor: { colors: [{ opacity: 0.05 }, { opacity: 0.05 }] } }, points: { show: true }, label: 'Profit' } ],
            {
                legend: {
                    position: 'nw',
                    backgroundColor: '#f6f6f6',
                    backgroundOpacity: 0.8
                },
                colors: ['#555555', '#db4a39'],
                grid: {
                    borderColor: '#cccccc',
                    color: '#999999',
                    labelMargin: 5,
                    hoverable: true,
                    clickable: true
                },
                yaxis: {
                    ticks: 5
                },
                xaxis: {
                    tickSize: 2
                }
            }
        );

        // Create and bind tooltip
        var previousPoint = null;
        dashChart.bind("plothover", function (event, pos, item) {

            if (item) {
                if (previousPoint !== item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0],
                        y = item.datapoint[1];

                    $('<div id="tooltip" class="chart-tooltip"><strong>' + y +'</strong> visits</div>')
                        .css( { top: item.pageY - 30, left: item.pageX + 5 })
                        .appendTo("body")
                        .show();
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
        var previousPoint = null;
        dashStat.bind("plothover", function (event, pos, item) {

            if (item) {
                if (previousPoint !== item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0],
                        y = item.datapoint[1];

                    $('<div id="tooltip" class="chart-tooltip"><strong>' + y +'</strong> visits</div>')
                        .css( { top: item.pageY - 30, left: item.pageX + 5 })
                        .appendTo("body")
                        .show();
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    });
</script>