<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分镜设定</title>
    <link rel=stylesheet href='../include/hoj.css' type='text/css'>
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
<script src="../template/bs3/js/jquery.min.js"></script>
<script>
    $(function () {
        $('#state_alert').fadeOut(3000);
    })
</script>
</body>
</html>