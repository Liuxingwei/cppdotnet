<?php 
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title="网站目录 - C语言网";

if (isset($_GET['sub'])) {
	$sub = $_GET['sub'];
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta name="renderer" content="webkit|ie-comp|ie-stand">
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../../favicon.ico">

	    <title><?php echo $view_title;?></title>   
	    <?php include("./template/$OJ_TEMPLATE/css.php");?>   
	    <style type="text/css">
	    	.mod_tag {
	    		border-radius: 0px;
	    		border: 0px;
			    box-shadow: 0 1px 6px #ccc;
			    margin-bottom: 20px;
	    	}
	    	.head_tag {
	    		padding: 0px;
	    		border-bottom: 1px solid #DDD;
	    	}
	    	.head_tag_text {
	    		display: inline-block;
	    		margin: 0px 20px;
	    		padding: 15px 0px;
	    	}
	    	.list_tag_index {
	    		padding: 20px;
	    		word-wrap: break-word;
	    	}
	    	.list_tag_index a {
	    		margin-right: 10px;
	    	}
	    </style>
	</head>
	<body>
	    <div class="wrap">
	    <?php include("./template/$OJ_TEMPLATE/nav.php");?>	    
	      <!-- Main component for a primary marketing message or call to action -->
	    	<div class="container">

	    		<div class="mod_tag">
	    			<?php if ($sub == "cyuyan") { ?>
	        		<div class="head_tag">
	                    <h4 class="head_tag_text">C语言教程</h4>
	                </div>
	        		<div class="list_tag_index">
	        			<p>第一章  C语言的过去与未来</p>
			            <a href="/course/c/10101.html">C语言的历史</a>
			            <a href="/course/c/10102.html">C语言的现在</a>
			            <a href="/course/c/10103.html">C语言的未来</a>
			            <p>第二章  C语言快速入门</p>
			            <a href="/course/c/10201.html">C语言第一个简单例子</a>
			            <a href="/course/c/10202.html">实例说明</a>
			            <a href="/course/c/10203.html">本教程的相关说明</a>
			            <a href="/course/c/10204.html">本章总结与作业</a>
			            <p>第三章  C语言的数据类型</p>
			            <a href="/course/c/10301.html">变量和常量</a>
			            <a href="/course/c/10302.html">数据类型和关键字</a>
			            <a href="/course/c/10303.html">本章总结与作业</a>
			            <p>第四章  C语言中的基本输入输出</p>
			            <a href="/course/c/10401.html">字符输出函数putchar</a>
			            <a href="/course/c/10402.html">字符接收函数getchar</a>
			            <a href="/course/c/10403.html">格式输出函数printf</a>
			            <a href="/course/c/10404.html">格式输入函数scanf</a>
			            <a href="/course/c/10405.html">本章总结与作业</a>
			            <p>第五章  运算符和表达式</p>
			            <a href="/course/c/10501.html">基本运算符</a>
			            <a href="/course/c/10502.html">其他运算符</a>
			            <a href="/course/c/10503.html">表达式和语句</a>
			            <a href="/course/c/10504.html">本章总结与作业</a>
			            <p>第六章  C语句和程序流</p>
			            <a href="/course/c/10601.html">表达式和语句</a>
			            <a href="/course/c/10602.html">多项选择结构</a>
			            <a href="/course/c/10603.html">分支和跳转</a>
			            <a href="/course/c/10604.html">本章总结与作业</a>
			            <p>第七章  函数</p>
			            <a href="/course/c/10701.html">函数的定义</a>
			            <a href="/course/c/10702.html">函数的调用</a>
			            <a href="/course/c/10703.html">变量的存储类型</a>
			            <a href="/course/c/10704.html">本章总结与作业</a>
			            <p>第八章  数组</p>
			            <a href="/course/c/10801.html">一维数组的定义和使用</a>
			            <a href="/course/c/10802.html">二维数组的定义和使用</a>
			            <a href="/course/c/10803.html">字符数组与字符串</a>
			            <a href="/course/c/10804.html">本章总结与作业</a>
			            <p>第九章  指针</p>
			            <a href="/course/c/10901.html">地址与指针</a>
			            <a href="/course/c/10902.html">指针的定义与使用</a>
			            <a href="/course/c/10903.html">数组与指针</a>
			            <a href="/course/c/10904.html">字符串与指针</a>
			            <a href="/course/c/10905.html">本章总结与作业</a>
			            <p>第十章  复合结构</p>
			            <a href="/course/c/101001.html">结构体的定义和使用</a>
			            <a href="/course/c/101002.html">结构体的高级使用</a>
			            <a href="/course/c/101003.html">共用体的定义和使用</a>
			            <a href="/course/c/101004.html">关键字typedef的使用</a>
			            <a href="/course/c/101005.html">本章总结与作业</a>
			            <p>第十一章  预处理</p>
			            <a href="/course/c/101101.html">宏定义</a>
			            <a href="/course/c/101102.html">文件包含</a>
			            <a href="/course/c/101103.html">条件编译</a>
			            <a href="/course/c/101104.html">其他预处理命令</a>
			            <a href="/course/c/101105.html">本章总结与作业</a>
			            <a href="/course/c/101106.html">结课</a>
	                </div>
	                <?php } ?>
		            <?php if ($sub == "cpp") { 
		            	$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=201 ORDER BY `order_id`";
						$result=mysqli_query($mysqli,$sql);
						$view_class_201=Array();
						$cnt=0;
						while ($row=mysqli_fetch_object($result)){
							
							$view_class_201[$cnt][0]=$row->class_id;
							$view_class_201[$cnt][1]=$row->title;
							$cnt++;
						}
						mysqli_free_result($result);

						$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=202 ORDER BY `order_id`";
						$result=mysqli_query($mysqli,$sql);
						$view_class_202=Array();
						$cnt=0;
						while ($row=mysqli_fetch_object($result)){
						    
						    $view_class_202[$cnt][0]=$row->class_id;
						    $view_class_202[$cnt][1]=$row->title;
						    $cnt++;
						}
						mysqli_free_result($result);

						$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=203 ORDER BY `order_id`";
						$result=mysqli_query($mysqli,$sql);
						$view_class_203=Array();
						$cnt=0;
						while ($row=mysqli_fetch_object($result)){
						    
						    $view_class_203[$cnt][0]=$row->class_id;
						    $view_class_203[$cnt][1]=$row->title;
						    $cnt++;
						}
						mysqli_free_result($result);

						$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=204 ORDER BY `order_id`";
						$result=mysqli_query($mysqli,$sql);
						$view_class_204=Array();
						$cnt=0;
						while ($row=mysqli_fetch_object($result)){
						    
						    $view_class_204[$cnt][0]=$row->class_id;
						    $view_class_204[$cnt][1]=$row->title;
						    $cnt++;
						}
						mysqli_free_result($result);

						$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=205 ORDER BY `order_id`";
						$result=mysqli_query($mysqli,$sql);
						$view_class_205=Array();
						$cnt=0;
						while ($row=mysqli_fetch_object($result)){
						    
						    $view_class_205[$cnt][0]=$row->class_id;
						    $view_class_205[$cnt][1]=$row->title;
						    $cnt++;
						}
						mysqli_free_result($result);

						$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=206 ORDER BY `order_id`";
						$result=mysqli_query($mysqli,$sql);
						$view_class_206=Array();
						$cnt=0;
						while ($row=mysqli_fetch_object($result)){
						    
						    $view_class_206[$cnt][0]=$row->class_id;
						    $view_class_206[$cnt][1]=$row->title;
						    $cnt++;
						}
						mysqli_free_result($result);
	            	?>
	            	<div class="head_tag">
	                    <h4 class="head_tag_text">C++教程</h4>
	                </div>
	        		<div class="list_tag_index">
	        			<p>第一章 C++入门</p>
			            <?php
	                      foreach($view_class_201 as $row_201){
	                        echo "<a href='/course/cpp/$row_201[0].html'>$row_201[1]</a>";
	                      }
	                    ?>
	                    <p>第一章 C++入门</p>
			            <?php
	                      foreach($view_class_202 as $row_202){
	                        echo "<a href='/course/cpp/$row_202[0].html'>$row_202[1]</a>";
	                      }
	                    ?>
	                    <p>第一章 C++入门</p>
			            <?php
	                      foreach($view_class_203 as $row_203){
	                        echo "<a href='/course/cpp/$row_203[0].html'>$row_203[1]</a>";
	                      }
	                    ?>
	                    <p>第一章 C++入门</p>
			            <?php
	                      foreach($view_class_204 as $row_204){
	                        echo "<a href='/course/cpp/$row_204[0].html'>$row_204[1]</a>";
	                      }
	                    ?>
	                    <p>第一章 C++入门</p>
			            <?php
	                      foreach($view_class_205 as $row_205){
	                        echo "<a href='/course/cpp/$row_205[0].html'>$row_205[1]</a>";
	                      }
	                    ?>
	                    <p>第一章 C++入门</p>
			            <?php
	                      foreach($view_class_206 as $row_206){
	                        echo "<a href='/course/cpp/$row_206[0].html'>$row_206[1]</a>";
	                      }
	                    ?>
		            </div>
		            <?php } ?>

		            <?php if ($sub == "videoc") { 
	            	?>
	            	<div class="head_tag">
	                    <h4 class="head_tag_text">C语言视频</h4>
	                </div>
	        		<div class="list_tag_index">
			            <a href="/wp/134.html"><黄老师C语言即兴课堂>-第一课</a>
			            <a href="/wp/149.html"><黄老师C语言即兴课堂>-第二课</a>
			            <a href="/wp/153.html"><黄老师C语言即兴课堂>-第三课</a>
			            <a href="/wp/166.html"><黄老师C语言即兴课堂>-第四课</a>
			            <a href="/wp/168.html"><黄老师C语言即兴课堂>-第五课</a>
			            <a href="/wp/174.html"><黄老师C语言即兴课堂>-第六课</a>
			            <a href="/wp/179.html"><黄老师C语言即兴课堂>-第七课</a>
			            <a href="/wp/252.html"><黄老师C语言即兴课堂>-第八课</a>
			            <a href="/wp/293.html"><黄老师C语言即兴课堂>-第九课</a>
			            <a href="/wp/300.html"><黄老师C语言即兴课堂>-第十课</a>
			            <a href="/wp/326.html"><黄老师C语言即兴课堂>-第十一课</a>
			            <a href="/wp/328.html"><黄老师C语言即兴课堂>-第十二课</a>
			            <a href="/wp/339.html"><黄老师C语言即兴课堂>-第十三课</a>
			            <a href="/wp/344.html"><黄老师C语言即兴课堂>-第十四课</a>
			            <a href="/wp/346.html"><黄老师C语言即兴课堂>-第十五课</a>
			            <a href="/wp/372.html"><黄老师C语言即兴课堂>-第十六课</a>
			            <a href="/wp/392.html"><黄老师C语言即兴课堂>-第十七课</a>
			            <a href="/wp/477.html"><黄老师C语言即兴课堂>-第十八课</a>
			            <a href="/wp/405.html"><黄老师C语言即兴课堂>-第十九课</a>
			            <a href="/wp/425.html"><黄老师C语言即兴课堂>-第二十课</a>
			            <a href="/wp/429.html"><黄老师C语言即兴课堂>-第二十一课</a>
			            <a href="/wp/456.html"><黄老师C语言即兴课堂>-第二十二课</a>
			            <a href="/wp/458.html"><黄老师C语言即兴课堂>-第二十三课</a>
			            <a href="/wp/467.html"><黄老师C语言即兴课堂>-第二十四课</a>
			            <a href="/wp/480.html"><黄老师C语言即兴课堂>-第二十五课</a>
			            <a href="/wp/485.html"><黄老师C语言即兴课堂>-第二十六课</a>
			            <a href="/wp/487.html"><黄老师C语言即兴课堂>-第二十七课</a>
			            <a href="/wp/499.html"><黄老师C语言即兴课堂>-第二十八课</a>
			            <a href="/wp/514.html"><黄老师C语言即兴课堂>-第二十九课</a>
			            <a href="/wp/531.html"><黄老师C语言即兴课堂>-第三十课</a>
			            <a href="/wp/543.html"><黄老师C语言即兴课堂>-第三十一课</a>
			            <a href="/wp/569.html"><黄老师C语言即兴课堂>-第三十二课</a>
		            </div>
	            	<?php } ?>

		            <?php if ($sub == "vc6") { 
	            	?>
	            	<div class="head_tag">
	                    <h4 class="head_tag_text">VC6断点调试</h4>
	                </div>
	        		<div class="list_tag_index">
			            <a href="/wp/431.html">VC6断点调试之如何下断点(上)<第一篇></a>
			            <a href="/wp/449.html">VC6断点调试之如何下断点(下)<第二篇></a>
			            <a href="/wp/489.html">VC6断点调试之监视变量<第三篇></a>
			            <a href="/wp/502.html">VC6断点调试之条件断点<第四篇></a>
			            <a href="/wp/545.html">VC6断点调试之窗口监视（内存监视、寄存器和栈回溯）<第五篇></a>
			            <a href="/wp/554.html">VC6断点调试之内存断点<第六篇></a>
		            </div>
	            	<?php } ?>

	            	<?php if ($sub == "bianyiqi") { 
	            	?>
	            	<div class="head_tag">
	                    <h4 class="head_tag_text">编译器教程</h4>
	                </div>
	        		<div class="list_tag_index">
			            <a href="/wp/431.html">VC6.0下载安装图文教程</a>
			            <a href="/wp/335.html">win10运行VC6出错无法启动的解决办法(0xc0000142错误)</a>
			            <a href="/wp/144.html">C/C++开发和学习人员必备工具下载集合(含助手及破解补丁)</a>
			            <a href="/wp/847.html">TC2.0编译器下载及入门图文教程</a>
			            <a href="/wp/836.html">Dev-Cpp使用入门教程</a>
			            <a href="/wp/818.html">CodeBlocks的入门使用教程</a>
		            </div>
	            	<?php } ?>

	        	</div>

	    	</div>
    	</div>
		<?php require("./template/$OJ_TEMPLATE/footer.php");?>
	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <?php include("./template/$OJ_TEMPLATE/js.php");?>   
	  </body>
</html>