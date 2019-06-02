<dl class="list_dl">
  <dt class="list_dt dt_sec_301" id="<?php echo $open_301;?>">
      <span class="_after"></span>
      <p>第一章 算法初步</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_301;?>">
      <ul class="left_menu">
        <?php
          $selected="";
          foreach($view_class_301 as $row_301){
            if ($row_301[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_suanfa/study/$row_301[0]'>$row_301[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_302" id="<?php echo $open_302;?>">
      <span class="_after"></span>
      <p>第二章 数据结构（上）</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_302;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_302 as $row_302){
            if ($row_302[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_suanfa/study/$row_302[0]'>$row_302[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_303" id="<?php echo $open_303;?>">
      <span class="_after"></span>
      <p>第三章 程序设计技巧</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_303;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_303 as $row_303){
            if ($row_303[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_suanfa/study/$row_303[0]'>$row_303[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_304" id="<?php echo $open_304;?>">
      <span class="_after"></span>
      <p>第四章 动态规划</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_304;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_304 as $row_304){
            if ($row_304[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_suanfa/study/$row_304[0]'>$row_304[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_305" id="<?php echo $open_305;?>">
      <span class="_after"></span>
      <p>第五章 图论（上）</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_305;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_305 as $row_305){
            if ($row_305[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_suanfa/study/$row_305[0]'>$row_305[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_306" id="<?php echo $open_306;?>">
      <span class="_after"></span>
      <p>第六章 数学</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_306;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_306 as $row_306){
            if ($row_306[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_suanfa/study/$row_306[0]'>$row_306[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_307" id="<?php echo $open_307;?>">
      <span class="_after"></span>
      <p>第七章 图论（下）</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_307;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_307 as $row_307){
            if ($row_307[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_suanfa/study/$row_307[0]'>$row_307[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_308" id="<?php echo $open_308;?>">
      <span class="_after"></span>
      <p>第八章 数据结构（下）</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_308;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_308 as $row_308){
            if ($row_308[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_suanfa/study/$row_308[0]'>$row_308[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  
  <!-- <div class="list_dt">
      <a class="a_link" href="/oj/myvalue.php?user=<?php echo $user_id;?>">
      <p>学习成果</p>
      </a>
  </div>  -->
</dl>