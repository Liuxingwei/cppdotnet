<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="在这里，你可以分享你的解题经验，蓝桥杯或者是NOI/ACM的竞赛经验，分享你的程序人生！记录你的点滴成长！">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title;?></title>  
    <!-- <script type="text/javascript">
        CKEDITOR.editorConfig = function( config ) {
            config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Scayt,Form,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,CreateDiv,Language,Flash,PageBreak,Iframe,About,Checkbox,PasteFromWord,Find,Replace,Blockquote,BidiLtr,BidiRtl,Image,HorizontalRule,FontSize,Font,TextColor,BGColor';
        };
    </script> -->
    <?php include("template/$OJ_TEMPLATE/css.php");?>	   
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/discuss.css">
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/blog.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        div.ueditor_container img {
            max-width: 100%;
        }
        div.ueditor_container table.syntaxhighlighter {
            display: block;
        }
    </style>
  </head>

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
    <div class="row row_user">
        <div class="col-lg-3">
            <div class="mod_blog" style="margin-bottom: 20px;">
                <div class="photo mod_left">
                    <h4 class="user_nick" style="text-align: center;"><?php echo getNickByid($user_id);?></h4>
                    <br>
                    <?php 
                        if ($user_id!==$_SESSION['user_id']) {
                            echo "<p style='font-size: 12px;text-align: center;'><a target='_blank' href='".$url_oj."mail.php?to_user=$user_id'>私信TA</a></p>";
                        }
                    ?>
                    <p>用户名：<?php echo $user_id;?></p>
                    <p>访问量：<?php echo $userinfo_scan;?></p>
                    <p>签　名：</p>
                    <p><?php echo $userinfo_autograph;?></p>
                </div>
                <div class="mod_left">
                <table class="tab_user">
                    <?php echo "<img class='img_intro' src='".$url_oj."template/$OJ_TEMPLATE/img/icon007.png'>";?>
                    <tr>
                        <td>等　　级</td>
                        <td><?php echo "<button type='button' class='btn tag_lvl ".$tag_class." btn-xs'>P".$userinfo_lvl."</button>";?></td>
                    </tr>
                    <tr>
                        <td>排　　名</td>
                        <td><?php echo $userinfo_rank;?></td>
                    </tr>
                    <tr>
                        <td>经　　验</td>
                        <td><?php echo $userinfo_exp;?></td>
                    </tr>
                    <tr>
                        <td>参赛次数</td>
                        <td><?php echo $cnt_contest;?></td>
                    </tr>
                    <tr>
                        <td>文章发表</td>
                        <td><?php echo $cnt_blog;?></td>
                    </tr>
                    <tr>
                        <td>年　　龄</td>
                        <td><?php echo $userinfo_age;?></td>
                    </tr>
                    <tr>
                        <td>在职情况</td>
                        <td><?php echo $userinfo_iswork;?></td>
                    </tr>
                    <tr>
                        <td>学　　校</td>
                        <td><?php echo $userinfo_school;?></td>
                    </tr>
                    <tr>
                        <td>专　　业</td>
                        <td><?php echo $userinfo_subject;?></td>
                    </tr>
                </table>
                <?php 
                      if ($user_id==$_SESSION['user_id'] || isset($_SESSION['user_cpn']) || isset($_SESSION['administrator'])) {
                ?>
                <!-- <br>
                <p class="to_userinfo">　　<a href="<?php echo $url_oj."myvalue.php?user=$user_id";?>">我的竞争力</a></p> -->
                <?php } ?>
                </div>
                <div class="mod_left">
                    <p class="user_intro">　　自我简介：</p>
                    <p><?php echo $userinfo_intro;?></p>
                </div>
            </div>
            <div class="mod_blog" style="margin-bottom: 20px;">
                <div style="padding: 20px;border-bottom: 1px solid #DDD;">
                    <h4 style="margin: 0px;">TA的其他文章</h4>
                </div>
                <div class="row" style="width: 100%;">
                <table class='table_list'>
                    <?php
                        foreach ($blog_data_r as $row_tr) {
                            echo "<tr>";
                            foreach ($row_tr as $row_td) {
                                
                                echo $row_td;
                                
                            }
                        echo "</tr>";
                        }
                    ?>
                </table>
                </div>
            </div>
            <div class="mod_blog" style="margin-bottom: 20px;">
                <div style="padding: 20px;border-bottom: 1px solid #DDD;">
                    <h4 style="margin: 0px;">你可能喜欢</h4>
                </div>
                <div class="row" style="width: 100%;">
                <table class='table_list'>
                    <?php
                        foreach ($blog_data_ran as $row_tr) {
                            echo "<tr>";
                            foreach ($row_tr as $row_td) {
                                
                                echo $row_td;
                                
                            }
                        echo "</tr>";
                        }
                    ?>
                </table>
                </div>
            </div>
        </div>
        <div class="col-lg-9 row_detail mod_blog">
            <div id="banner_detail">
                <h4 style="line-height: 35px;">
                    <?php echo $blog_tt;?>
                </h4>
                <br>
                <p class="detail_author">　　作者: <?php echo "<a target='_blank' href='/home/".$tmprow['user_id']."'>".getNickByid($tmprow['user_id'])."</a>";?>　　
                <span class="detail_time">　　发表时间：<?php echo $tmprow['post_time'];?></span>
                <span style="float: right;">浏览：<?php echo $tmprow['scan'];?>　|　评论：<?php echo $disc_cnt;?>　|　赞：<?php echo $tmprow['nice'];?>　
                <?php if ($tmprow['user_id']==$_SESSION['user_id']) {?>
                　|　<a href="/blog/redit<?php echo $blog_id?>">重新编辑</a>　|　<a style="cursor: pointer;" onclick='blog_del(<?php echo $blog_id; ?>)'>删除</a>
                <?php }?>
                </p>
            </div>
    
            <div class="blog_msg" style="height: auto;border-bottom: 1px solid #DDD;">

                <?php if ($problem_id) { ?>
            
                    <?php
                        if(isset($_SESSION['administrator']) || isset($_SESSION['lowlevel_admin'])){
                    ?>
                    <a style="margin-bottom: 30px;float: right;" href="/oj/post_blog.php?blog_id=<?php echo $blog_id;?>">加精</a>
                    <?php } ?>

                
                <div class="blog_problink">原题链接：<a target='_blank' href="<?php echo $url_oj;?>problem<?php echo $problem_id;?>.html"><?php echo $blog_problink;?></a></div>
                <?php } ?>
                <div class="blog_content">
            		<div class="ueditor_container"><?php echo $tmprow['content'];?> </div>
                    <div style="font-size: 22px;height: 60px;margin-top: 30px;">   
                        <div style="float: right;" class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                        <button class="btn btn-primary btn-nice" onclick="blog_nice(this,<?php echo $tmprow['blog_id'];?>)">赞<?php if($tmprow['nice']!=0) echo "(".$tmprow['nice'].")";?></button>
                        
                    </div>
                </div>
            </div>
            <a style="display: block;color: #428bca;width: 100%;border-bottom: 1px solid #DDD;" class="blog_msg" href="/vipjoin/">
                C语言网提供<span style="color: #fc596e;font-weight: bold;">「C语言、C++、算法竞赛」</span>在线课程，全部由研发工程师或ACM金牌退役选手亲自授课，以<span style="color: #fc596e;font-weight: bold;">视频+配套题目</span>的学练同步模式教学，强化动手，并提供增值服务！
            </a>
            <div class="blog_msg">
                <div style="padding-bottom: 30px;border-bottom: 1px solid #DDD;">
                    <h4 class="detail_dis">　　评论区</h4>
                </div>
                <?php
                foreach($view_discuss as $tmprow){
                ?>
                    <div class="discuss_msg">
                        <div>
                             <div class="col-lg-2 text-center"> <a href="/home/<?php echo $tmprow['user_id'];?>"> <?php echo $tmprow['nick'];?></a></div>
                        </div>                        
                        <div class="blog_dis_content" id="blogdis<?php echo $tmprow['discuss_id'];?>">
                            <pre class="dis_content col-lg-10 col-lg-offset-2"><?php echo htmlentities($tmprow['content'],ENT_QUOTES,"UTF-8");?></pre>
                        </div>
                        <div class="bottom_right">
                            <?php echo $tmprow['post_time'];?> | 
                            <button  class="btn btn-link" onclick="dis_nice(this,<?php echo $tmprow['discuss_id'];?>)">赞<?php if($tmprow['nice']!=0) echo "(".$tmprow['nice'].")";?></button> | 
                            <button class="btn btn-link comment_cnt" name="<?php echo $tmprow['discuss_id'];?>" id="<?php echo $tmprow['discuss_id'];?>" onclick="showComment(this);">评论<?php if($tmprow['comment_cnt']!=0) echo "(".$tmprow['comment_cnt'].")";?></button>
                            <!-- title=恶意举报会被系统封禁哦 -->
                            <!-- <button class="btn btn-link" onclick="dis_inform(<?php echo $tmprow['discuss_id'] ?>);" >举报</button> -->
                            <?php if(isset($_SESSION['administrator'])){
                                require_once("include/set_get_key.php");
                             ?>

                                 | <a class="btn btn-link" href="<?php echo $url_oj;?>xktms/discuss_del.php?blog_discuss_id=<?php echo $tmprow['discuss_id'];?> &getkey=<?php echo $_SESSION['getkey']?>">删除</a>
                            <?php } ?>
                        </div>
                        <div hidden class="well" style="position:absolute;width:100%;">
                            <div class="comment_show">
                                <?php
                                if($tmprow['comment_cnt']!=0){
                                foreach($tmprow['comment'] as $comment_row){
                                ?>
                                <div>
                                    <p>
                                        <a href="/home/<?php echo $comment_row['user_id'];?>"><?php echo $comment_row['nick'];?></a>
                                        <span style="color:#888"><?php echo $comment_row['post_time'];?></span>
                                        <?php if($comment_row['user_id']!=$_SESSION['user_id']) {
                                                $to_user=$comment_row['user_id'];
                                            ?>
                                            | <button class="btn btn-link" onclick="reply_to(this,'<?php echo getNickByid($to_user);?>','<?php echo $to_user;?>')" >回复</button> 
                                        <?php } ?>
                                        <!-- | <button class="btn btn-link" onclick="com_inform(<?php echo $comment_row['comment_id'];?>);" >举报</button>  -->
                                        <?php if(isset($_SESSION['administrator'])){
                                          require_once("include/set_get_key.php");
                                        ?>
                                        | <a class="btn btn-link" href="<?php echo $url_oj;?>xktms/discuss_del.php?blog_comment_id=<?php echo $comment_row['comment_id'];?> &getkey=<?php echo $_SESSION['getkey']?>">删除</a>
                                        <?php } ?>
                                    </p><p><?php echo htmlentities($comment_row['content'],ENT_QUOTES,"UTF-8");?></p></div>
                                <?php 
                                }}
                                ?>
                            </div>
                            <!-- <form action="postcomment.php" method="post"> -->
                            <div>
                                <div class="form-group col-lg-11">
                                    <input type="text" max="30" class="comment_msg form-control" placeholder="说点什么...">
                                    <span class="reply_to_user"></span>
                                    <input type="text" hidden>
                                </div>
                                <div class="form-group col-lg-1">
                                    <button type="submit" class="btn btn-primary" onclick="comment_submit(this,<?php echo $tmprow['discuss_id'];?>)">提交</button>
                                </div>
                            <!-- </form> -->
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div style="height: 80px;">
                <ul class="pagination pull-right">
                 <?php
                    if($page==1) echo "<li class='disabled'><span>&laquo;</span></li>";
                    else {
                        echo "<li><a href='/blog/".$blog_id."-".($page-1).".html'>&laquo;</a></li>";
                    }
                    $maxpag = 5;
                    $view_total_page = (int)$view_total_page;
                    $midpag = (int)($maxpag/2);
                    $starpag = 1;
                    $endpag = $view_total_page;
                    if($view_total_page>$maxpag){
                        $starpag = $page - $midpag;
                        $endpag = $page + $midpag;
                        if($starpag<=0){
                            $starpag = 1;
                            $endpag = $maxpag;
                        }
                        if($endpag>$view_total_page){
                            $endpag = $view_total_page;
                            $starpag =  $endpag - $maxpag + 1;
                        }
                    }
                    $stardian = "<li><a href='/blog/".$blog_id."-".($starpag-1).".html'>···</a></li>";
                    $enddian = "<li><a href='/blog/".$blog_id."-".($endpag+1).".html'>···</a></li>";
                    if($starpag!=1)echo $stardian;
                    for ($i=$starpag;$i<=$endpag;$i++){
                        if ($i==$page) echo "<li class='active'><a href='#'>".$i."</a></li>";
                        else {
                            echo "<li><a href='/blog/".$blog_id."-".$i.".html'>".$i."</a></li>";
                        }
                    }
                    if($endpag!=$view_total_page)echo $enddian;
                    if($page==$view_total_page) echo "<li class='disabled'><span>&raquo;</span></li>";
                    else {
                        echo "<li><a href='/blog/".$blog_id."-".($page+1).".html'>&raquo;</a></li>";
                    }
                ?>
                </ul>
                </div>
                <form action="<?php echo $url_oj;?>post_blog_discuss.php" method="post" id="disForm">
                    <div>
                        <textarea id="dis_edit" name="dismsg" cols="30" rows="10" style="width:100%"></textarea>
                    </div>
                    <hr style="border:0px;"/>
                    <input name="blog_id" type="text" value="<?php echo $blog_id;?>" hidden>
                    <div style="clear:both;">
                       <div class="form-group pull-right"><button class="btn btn-primary">提交</button></div>
                    </div> 
                </form>
            </div>
    	</div> 
    </div>
    </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>   
    <script type="text/javascript" src="<?php echo $url_oj;?>ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="<?php echo $url_oj;?>ueditor/ueditor.all.js"></script>
    <script src="<?php echo $url_oj;?>ueditor/ueditor.parse.js"></script>
    <script src="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/js/blog.js"></script>
    <script type="text/javascript">
        /*var ue = UE.getEditor('dis_edit',{
            toolbars: [
                ['undo', 'redo', 'emotion',]
            ],
            initialFrameHeight:240,
            retainOnlyLabelPasted: true,
            pasteplain:true
        });*/
        uParse('.ueditor_container', {
            rootPath: '<?php echo $url_oj;?>ueditor/'
        })
        home_scan("<?php echo $user_id;?>");
        blog_scan(<?php echo $blog_id;?>);//执行浏览统计函数
    </script>
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["mshare","qzone","tsina","weixin","renren","tqq","tieba","douban","sqq"],"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
  </body>
</html>