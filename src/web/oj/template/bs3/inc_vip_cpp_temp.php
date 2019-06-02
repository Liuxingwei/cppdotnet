<dl class="list_dl">
  <dt class="list_dt dt_sec_201" id="<?php echo $open_201;?>">
      <span class="_after"></span>
      <p>第一章 C++入门</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_201;?>">
      <ul class="left_menu">
        <?php
          $selected="";
          foreach($view_class_201 as $row_201){
            if ($row_201[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_cpp/study/$row_201[0]'>$row_201[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_202" id="<?php echo $open_202;?>">
      <span class="_after"></span>
      <p>第二章 C++控制结构</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_202;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_202 as $row_202){
            if ($row_202[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_cpp/study/$row_202[0]'>$row_202[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_203" id="<?php echo $open_203;?>">
      <span class="_after"></span>
      <p>第三章 C++函数</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_203;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_203 as $row_203){
            if ($row_203[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_cpp/study/$row_203[0]'>$row_203[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_204" id="<?php echo $open_204;?>">
      <span class="_after"></span>
      <p>第四章 构造数据类型</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_204;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_204 as $row_204){
            if ($row_204[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_cpp/study/$row_204[0]'>$row_204[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_205" id="<?php echo $open_205;?>">
      <span class="_after"></span>
      <p>第五章 面向对象编程</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_205;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_205 as $row_205){
            if ($row_205[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_cpp/study/$row_205[0]'>$row_205[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_206" id="<?php echo $open_206;?>">
      <span class="_after"></span>
      <p>第六章 继承与多态性</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_206;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_206 as $row_206){
            if ($row_206[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_cpp/study/$row_206[0]'>$row_206[1]</a></li>";
          }
        ?>
      </ul>
  </dd>
  <dt class="list_dt dt_sec_207" id="<?php echo $open_207;?>">
      <span class="_after"></span>
      <p>第七章 STL库入门</p>
      <i class="list_dt_icon"></i>
  </dt>
  <dd class="list_dd <?php echo $open_207;?>">
      <ul class="left_menu">
          <?php
          $selected="";
          foreach($view_class_207 as $row_207){
            if ($row_207[0]==$class) {
              $selected="selected";
              $open='open';
            }
            else {
              $selected="";
              $open="";
            }
            echo "<li class='list_li'><a class='".$selected."' href='/vipstudy_cpp/study/$row_207[0]'>$row_207[1]</a></li>";
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