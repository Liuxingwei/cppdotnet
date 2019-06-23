<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分销设定</title>
    <link rel=stylesheet href='../include/hoj.css' type='text/css'>
    <style>
        body {
            font-size: 13px;
        }
    </style>
</head>
<body>
<?php
if (isset($saveStatus)) :
?>
<div class="container" id="state_alert">
    <div class="row">
        <div class="span12">
            <div class="alert alert-success"><?=$saveStatus?></div>
        </div>
    </div>
</div>
<?php
endif;
?>

<div class="container">
    <div class="row">
        <div class="span12">
            <h3>分销设定：</h3>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <form method="post">
                <input type="hidden" name="setting" value="1">
                <fieldset class="form-inline">
                    <label>只有VIP用户可参与分销：</label><input type="radio" name="if_need_vip" id="if_need_vip_true" value="1"<?php if ($distribution->getIfNeedVip()) echo ' checked=\"checked\"' ?>> <label for="if_need_vip_true">是</label> <input type="radio" name="if_need_vip" id="if_need_vip_false" value="0"<?php if (!$distribution->getIfNeedVip()) echo ' checked=\"checked\"' ?>> <label for="if_need_vip_false">否</label>
                </fieldset>
                <fieldset class="form-inline">
                    <label>分销最高层级：</label> <input type="text" name="max_level" id="max_level" value="<?=$distribution->getMaxLevel()?>">
                </fieldset>
                <fieldset class="form-inline">
                    <label>分销传播路径设置：</label>
                    <select name="distribution_path">
                        <option value="0"<?php if (0 == $distribution->getDistributionPath()) echo ' selected=\"selected\"' ?>>统一分销路径</option>
                        <option value="1"<?php if (1 == $distribution->getDistributionPath()) echo ' selected=\"selected\"' ?>>单科分销路径</option>
                    </select>
                </fieldset>
                <fieldset class="form-inline">
                    <label>分销收入方案：</label>
                    <select name="rebate_scheme">
                        <option value="0"<?php if (0 == $distribution->getRebateScheme()) echo ' selected=\"selected\"' ?>>任意两级返利</option>
                        <option value="1"<?php if (1 == $distribution->getRebateScheme()) echo ' selected=\"selected\"' ?>>全部分销商返利</option>
                    </select>
                </fieldset>
                <fieldset class="form-inline">
                    <label>是否需要人为指定一级分销商：</label><input type="radio" name="if_need_special_top" id="if_need_special_top_true" value="1"<?php if ($distribution->getIfNeedSpecialTop()) echo ' checked=\"checked\"' ?>> <label for="if_need_vip_true">是</label> <input type="radio" name="if_need_special_top" id="if_need_special_top_false" value="0"<?php if (!$distribution->getIfNeedSpecialTop()) echo ' checked=\"checked\"' ?>> <label for="if_need_vip_false">否</label>
                </fieldset>
                <fieldset class="form-inline">
                    <label>分销返利比例：</label> <input type="text" name="rebate_ratio" value="<?=$distribution->getRebateRatio()?>">
                </fieldset>
                <fieldset class="form-inline">
                    <button class="btn btn-primary">保存</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php
if ($distribution->getIfNeedSpecialTop() == 1) :
?>
<div class="container">
    <div class="row">
        <div class="span12">
            <h3>一级分销商：</h3>
        </div>
    </div>
    <br>
    <div class="row">
        <table class="table table-bordered table-striped table-condensed table-hover">
            <thead>
            <tr>
                <th>用户id</th>
                <th>用户昵称</th>
                <th>电话</th>
                <th>邮箱</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($users as $user):
            ?>
                <tr>
                    <td><?=$user['user_id']?></td>
                    <td><?=$user['nick']?></td>
                    <td><?=$user['phone']?></td>
                    <td><?=$user['email']?></td>
                    <td><?=$user['reg_time']?></td>
                    <td>
                        <?php
                        if ($user['state'] == 1) :
                        ?>
                        <a class="deny_link" href="javascript:void(0)" data-id="<?=$user['user_id']?>">禁用</a>
                        <?php
                        else :
                        ?>
                        <a class="allow_link" href="javascript:void(0)" data-id="<?=$user['user_id']?>">启用</a>
                        <?php
                        endif;
                        ?>
                        <a class="delete_link" href="javascript:void(0)" data-id="<?=$user['user_id']?>">删除</a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
        <?=$db->pageFregment()?>
    </div>
</div>
<form id="deny_form" method="post">
    <input type="hidden" name="deny_post" value="1">
    <input type="hidden" name="user_id">
</form>
<div class="container">
    <div class="row">
        <div class="span12">
            <a href="javascript:void(0)" class="btn btn-primary" id="append_switch">添加一级分销</a>
        </div>
    </div>
    <div class="row<?=!isset($_GET['append'])? ' hide' : ''?>">
        <div class="span12">
            <form method="get" class="form-inline" id="search_candidates" name="search_candidates">
                <input type="text" placeholder="请输入用户id" name="c_user_id" value="<?=$_GET['c_user_id']?>">
                <?php
                foreach ($_GET as $key => $get) :
                    if ('c_user_id' != $key) :
                ?>
                    <input type="hidden" name="<?=$key?>" value="<?=$get?>">
                <?php
                    endif;
                endforeach;
                ?>
                <button class="btn btn-primary">查找</button>
            </form>
        </div>
    </div>
    <div class="row<?=!isset($_GET['append'])? ' hide' : ''?>">
        <table class="table table-bordered table-striped table-condensed table-hover">
            <thead>
            <tr>
                <th>用户id</th>
                <th>用户昵称</th>
                <th>电话</th>
                <th>邮箱</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($candidates as $candidate):
                ?>
                <tr>
                    <td><?=$candidate['user_id']?></td>
                    <td><?=$candidate['nick']?></td>
                    <td><?=$candidate['phone']?></td>
                    <td><?=$candidate['email']?></td>
                    <td><?=$candidate['reg_time']?></td>
                    <td><a class="append_link" href="javascript:void(0)" data-id="<?=$candidate['user_id']?>">添加</a></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
        <?=$candidateDb->pageFregment()?>
    </div>
</div>
<form id="append_form" method="post">
    <input type="hidden" name="append_post" value="1">
    <input type="hidden" name="user_id">
</form>
<?php
endif;
?>
<script src="../template/bs3/js/jquery.min.js"></script>
<script>
    $(function () {
        $('#state_alert').fadeOut(3000);
        $('.deny_link').click(function () {
            $('#deny_form input[name="deny_post"]').val(1);
            $('#deny_form input[name="user_id"]').val($(this).data('id'));
            $('#deny_form').submit();
        });
        $('.allow_link').click(function () {
            $('#deny_form input[name="deny_post"]').val(3);
            $('#deny_form input[name="user_id"]').val($(this).data('id'));
            $('#deny_form').submit();
        });
        $('.delete_link').click(function () {
            $('#deny_form input[name="deny_post"]').val(2);
            $('#deny_form input[name="user_id"]').val($(this).data('id'));
            $('#deny_form').submit();
        });
        $('.append_link').click(function () {
            $('#append_form input[name="user_id"]').val($(this).data('id'));
            $('#append_form').submit();
        });
        $('#append_switch').click(function () {
            var url = window.location.protocol + '//' + window.location.host + window.location.pathname;
            var search = window.location.search;
            search = search.replace(/&{0,1}append=[^&]+/g, '');
            if ('?' == search) {
                search += 'append=true';
            } else if ('' == search) {
                search = '?append=true'
            } else {
                search += '&append=true';
            }
            url += search;
            window.location.href = url;
        });
        $('#search_candidates').submit(function () {
            $(this).attr('action', window.location.href);
        })
    })
</script>
</body>
</html>