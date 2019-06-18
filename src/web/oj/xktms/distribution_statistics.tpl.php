<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分销排行</title>
    <link rel=stylesheet href='../template/bs3/css/bootstrap.min.css' type='text/css'>
    <style>
        body {
            font-size: 13px;
        }
        .container .row {
            margin-top: 30px;
        }
        .modal-content {
            width: 800px;
        }
        .modal-dialog {
            margin-left: 60px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="span8">
            <div class="alert-info">
            当前共有一级分销商：<?=$distributors?>人。
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <h3>分销排行：</h3>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <form class="form-search">
                <label for="start_date">开始时间：</label><input type="date" id="start_date" name="start_date" value="<?=$_GET['start_date']?>">&nbsp;&nbsp;
                <label for="end_date">结束时间：</label><input type="date" id="end_date" name="end_date" value="<?=$_GET['end_date']?>">&nbsp;&nbsp;
                <button class="btn btn-primary">确定</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <ul class="nav nav-tabs" id="myTab">
                <li><a data-toggle="tab" href="#total-list">总排行</a></li>
                <li><a data-toggle="tab" href="#unsettle-list">未结算排行</a></li>
                <li><a data-toggle="tab" href="#settled-list">已结算排行</a></li>
        </div>
    </div>
    <div class="row">
        <div class="tab-content"$>
            <div class="tab-pane" id="total-list">
                <table class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>用户id</th>
                        <th>分成总收入</th>
                        <th>详情</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ti = 1;
                    foreach ($totalList as $trow) :
                    ?>
                    <tr>
                        <td><?=$ti * ($_GET['tpage'] == '' ? 1 : (int) $_GET['tpage'])?></td>
                        <td><?=$trow['user_id']?></td>
                        <td><?=$trow['total']?></td>
                        <td><a href="javascript:void(0);" data-userid="<?=$trow['user_id']?>" data-state="total" class="detail-link">详情</a></td>
                    </tr>
                    <?php
                        $ti++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
                <?php
                $totalDb->pageFregment();
                ?>
            </div>
            <div id="unsettle-list" class="tab-pane">
                <form method="post">
                <table class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <td><input type="checkbox" id="select_all"></td>
                        <th>序号</th>
                        <th>用户id</th>
                        <th>未结算分成收入</th>
                        <th>详情</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ui = 1;
                    foreach ($unsettleList as $urow) :
                    ?>
                        <tr>
                            <td><input type="checkbox" name="settle[]" value="<?=$urow['user_id']?>"></td>
                            <td><?=$ui * ($_GET['upage'] == '' ? 1 : (int) $_GET['upage'])?></td>
                            <td><?=$urow['user_id']?></td>
                            <td><?=$urow['total']?></td>
                            <td><a href="javascript:void(0);" data-userid="<?=$trow['user_id']?>" data-state="unsettle" class="detail-link">详情</a></td>
                        </tr>
                    <?php
                        $ui++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
                    <input type="hidden" name="post_settle" value="1">
                    <button class="btn btn-primary">结算</button>
                </form>
                <?php
                $unsettleDb->pageFregment();
                ?>
            </div>

            <div class="tab-pane" id="settled-list">
                <table class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>用户id</th>
                        <th>已结算分成收入</th>
                        <th>详情</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $si = 1;
                    foreach ($settledList as $srow) :
                    ?>
                        <tr>
                            <td><?=$si * ($_GET['spage'] == '' ? 1 : (int) $_GET['spage'])?></td>
                            <td><?=$srow['user_id']?></td>
                            <td><?=$srow['total']?></td>
                            <td><a href="javascript:void(0);" data-userid="<?=$trow['user_id']?>" data-state="settled" class="detail-link">详情</a></td>
                        </tr>
                    <?php
                        $si++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
                <?php
                $settledDb->pageFregment();
                ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">详情</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>订单id</th>
                            <th>订单用户id</th>
                            <th>订单金额</th>
                            <th>分成金额</th>
                            <th>订购课程</th>
                            <th>下单时间</th>
                            <th>结算状态</th>
                            <th>结算时间</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script src="../template/bs3/js/jquery.min.js"></script>
<script src="../template/bs3/js/bootstrap.min.js"></script>
<script>
    $(function () {
        if (!window.location.hash) {
            window.location.hash = '#total-list';
        }
        $('#myTab a[href="' + window.location.hash +'"]').tab('show');
        $('#myTab a').click(function () {
            window.location.hash = $(this).attr('href');
        });

        $('.detail-link').click(function () {
            var that = this;
            $.get('distribution_detail.php?user_id=' + $(that).data('userid') + '&state=' + $(that).data('state'), function (result) {
                $('#myModal tbody').html(result);
                $('#myModal .modal-title').text($(that).data('userid') + ' 的分销详情');
                $('#myModal').modal('show');
            })
        });

        $('#select_all').click(function () {
            $('#unsettle-list input[type="checkbox"]').prop("checked", $(this).prop('checked'));
        })
    })
</script>
</body>
</html>