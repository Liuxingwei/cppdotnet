<?php require_once("admin-header.php");

if(isset($OJ_LANG)){
        require_once("../lang/$OJ_LANG.php");
}

if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}

$sql="SELECT * FROM `order_vippay` WHERE `status`='1' ORDER BY `pay_time` DESC";
$result=mysqli_query($mysqli,$sql);
$cnt=0;
$payorder_user=Array();
$payorder_user_time=Array();
while ($row=mysqli_fetch_object($result)){
	$payorder_user_time[$cnt]=$row->pay_time ;
	$payorder_user[$cnt][1]="<div style='padding-left: 50px;'><p style='font-weight: bold;'>订单编号：<span style='font-size: 13px;'>".$row->order_id."</span></p><p>".$row->goods."</p></div>" ;
	$payorder_user[$cnt][2]="<span style='line-height: 60px;'>".$row->user_id."</span>" ;
	$payorder_user[$cnt][3]="<span style='line-height: 60px;color: blue;font-weight: bolder;'>￥".$row->pay_amount."</span>" ;
	$cnt++;
}
mysqli_free_result($result);


?> 
    <style type="text/css">
    	.table>thead>tr>th {
    		border: 0px;
    		background: #1D84FF;
    		color: #FFF;
    	}
    	.table>tbody>tr {
    		border: 1px solid #DCDCDC;
    		border-top: 0px;
    		margin-top: 10px;
    	}
    	.table>tbody>tr.tr_head {
    		border-top: 1px solid #DCDCDC;;
    	}
    	.table>tbody>tr>td {
    		font-size: 14px;
    		border: 0px;
    	}
    	.table>tbody>tr>td.td_head {
			height: 14px;
		    line-height: 14px;
		    font-size: 12px;
		    color: #aaa;
		    background: #F5F5F5;
		    padding-left: 30px;
    	}
    	.table>tbody>tr.tr_empty {
    		height: 14px;
    		border: 0px;
    	}
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    


          <table class='table'>
          	<thead>
		        <tr align=left class='toprow'>
		            <th>订单详情</th>
		            <th>购买用户</th>
		            <th>付款金额</th>
		        </tr>
		    </thead>
		    
		    <tbody>
		        <?php
		        $cnt=0;
		        $cnt_time=0;
		        foreach($payorder_user as $row){
		        	echo "<tr class='tr_empty'><td colspan='3'></td></tr><tr class='tr_head'><td colspan='3' class='td_head'>".$payorder_user_time[$cnt]."</td></tr>";
		            $cnt_time++;
		            if ($cnt)
		                echo "<tr class='oddrow'>";
		            else
		                echo "<tr class='evenrow'>";
		            
		            foreach($row as $table_cell){
		                echo "<td>";
		                echo "\t".$table_cell;
		                echo "</td>";
		            }
		            echo "</tr>";
		            $cnt=1-$cnt;
		        }
		        ?>
		    </tbody>
          </table>
<?php 
	require("../oj-footer.php");
?>
