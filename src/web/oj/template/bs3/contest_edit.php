<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- <div class="container"> -->
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
     <div class="container" id="body">
  
  <form method=POST class="form-horizontal col-lg-4 col-lg-offset-4 text-center">
  <h1>编辑比赛</h1>
  <input type=hidden name='cid' value=<?php echo $cid?>>
  <div class="form-group">
    <div class="col-lg-3"><label>比赛名称</label></div>
    <div class="col-lg-9"><input type=text class="form-control" maxlength=30 name=title id="c_title" value="<?php echo $title;?>"></div>
  </div>
  <div class="form-group">
    <div class="col-lg-3"><label>开始时间</label></div>
    <div class="col-lg-9">
      <input type=text name=syear value=<?php echo substr($starttime,0,4)?> size=4 >年
      <input type=text name=smonth value='<?php echo substr($starttime,5,2)?>' size=2 >月
      <input type=text name=sday size=2 value='<?php echo substr($starttime,8,2)?>'>日
      <input type=text name=shour size=2 value='<?php echo substr($starttime,11,2)?>'>时
      <input type=text name=sminute value=<?php echo substr($starttime,14,2)?> size=2 >分
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-3"><label>结束时间</label></div>
    <div class="col-lg-9">
      <input class=input-mini    type=text name=eyear value=<?php echo substr($endtime,0,4)?> size=4 >年
      <input class=input-mini    type=text name=emonth value=<?php echo substr($endtime,5,2)?> size=2 >月
      <input class=input-mini  type=text name=eday size=2 value=<?php echo substr($endtime,8,2)?>>日
      <input class=input-mini  type=text name=ehour size=2 value=<?php echo substr($endtime,11,2)?>>时
      <input class=input-mini  type=text name=eminute value=<?php echo substr($endtime,14,2)?> size=2 >分
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-3"><label>权限</label></div>
    <div class="col-lg-9">
      <select name=private class="form-control">
        <option value=0 <?php echo $private=='0'?'selected=selected':''?>>公开</option>
        <option value=1 <?php echo $private=='1'?'selected=selected':''?>>私有</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-3"><label>密码</label></div>
    <div class="col-lg-9">
      <input type=text name=password value="<?php echo htmlentities($password,ENT_QUOTES,'utf-8')?>" class="form-control" maxlength=16> 
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-3"><label>语言</label></div>
    <div class="col-lg-9">
      <select name="lang[]" multiple="multiple"    style="height:90px" class="form-control">
          <?php
        $lang_count=count($language_ext);

         $langmask=$OJ_LANGMASK;
         ?>
        <option value="0" selected="">C</option>
        <option value="1" selected="">C++</option>
        <option value="2" selected="">Pascal</option>
        <option value="3" selected="">Java</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-3"><label>问题</label></div>
    <div class="col-lg-9">
      <input class=form-control type=text name=cproblem value="<?php echo isset($plist)?$plist:""?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-3"><label>比赛公告</label></div>
    <div class="col-lg-9">
      <textarea class="form-control" rows="5" name=description ><?php echo htmlentities($description,ENT_QUOTES,"UTF-8")?></textarea>
    </div>
  </div>
    <input type="submit" value=创建 name=submit class="btn btn-primary form-control">
  </form>
      <hr style="border:0px;clear:both;height:20px;" />
     </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/contest_add.js"></script> 
  </body>
</html>
