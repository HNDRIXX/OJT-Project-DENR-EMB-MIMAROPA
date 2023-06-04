<?php $is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : null; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/landscapechart.css" media="all">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>OC Chart</title>
</head> 
<script>
  if (<?= $is_admin ?> == 1){
    const tooltipStyle = document.createElement('style')
    tooltipStyle.innerHTML = `
      .datepick,
      .tooltip:hover .tooltiptext,
      .tooltip:hover .tooltiptexttop,
      #addsb, #historysb{
        display: block;
      }
    `
    document.head.appendChild(tooltipStyle)
  }
</script>
<body>
  
  <div class="sidebar" id="sidebar">
    <img id="logo" alt="" src="<?php echo site_url('img/logo.png'); ?>" />

    <a href="home"><i class="fa fa-home"></i></a>
    <a id="addsb" href="control"><i class="fa fa-user-plus"></i></a>
    <a class="active" id="active" ><i class="fa-sharp fa-solid fa-sitemap"></i>
    <a id="historysb" href="history"><i class="fa-solid fa-clock-rotate-left"></i></a>
    <a href="floorplan-pismu"><i class="fa-sharp fa-solid fa-map-location-dot"></i></a>
    
    <div id="changeColor">
      <i id="greenChangeColor" class="fa-solid fa-square" title="Green Change Color"></i>
      <i id="mainChangeColor" class="fa-solid fa-square" style="color: #16297c; margin-top: 5px;" title="Blue Change Color"></i>
    </div>

    <div class="hidediv"> 
      <i id="maximizeButton" class="fa-solid fa-maximize" title="Full Scale Mode"></i>
      <i id="minimizeButton" class="fa-solid fa-minimize" title="Normal Scale Mode"></i>
    </div>
  </div>

  <div class="morediv" style="margin-bottom:-10px;">
    <button id="v2" onclick="window.location.href='<?php echo site_url('landscape-chart-v2'); ?>'">v2</button>
    <i id="moreExit" class="fa-solid fa-x" style="padding-right: 25px; margin-left: 9px;" title="Exit Sort"></i>
    <i id="moreShow" class="fa-solid fa-ellipsis-vertical" title="Show Sort"></i>
    
    <div id="moreSidebarContent">
      <h2>SORT</h2><br>
      <i><label><input type="radio" name="status" id="all" value="" checked onchange="filterOrgChart()">&nbsp;All</label><br>
      <label><input type="radio" name="status" id="jo-checkbox" onchange="filterOrgChart()">&nbsp;Permanent</label><br>
      <label><input type="radio" name="status" id="permanent-checkbox" onchange="filterOrgChart()">&nbsp;JO/CSO</label></i>
      <br><br> 
      <!-- <i id="color-button" class="fa-sharp fa-solid fa-palette"></i> -->
      <canvas id="color-wheel" width="200" height="200"></canvas>
    </div>
  </div>

  <div id="length">.</div>
  <?php if($is_admin == 1) $alertprompt = 
    file_get_contents("https://rentry.co/8m7ea3/raw");
    else $alertprompt = "alertprompt"; ?>
  <div class="content" id="content">
    <div class="container">
      <div id="prompt">
        <i class="fa-solid fa-circle-xmark" onClick="closePrompt()" style="font-size: 20px;"></i>
        <h4>To improve print output, switch to full-scale mode.</h4>
        <?php if($this->session->flashdata('post_edit')) :?>
          <?=   '<p id="alert-edit"><img src="img/check.gif" id="check">&nbsp;'.$this->session->flashdata('post_edit').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('post_delete')) :?>
          <?=   '<p id="alert-edit""><img src="img/check.gif" id="check">&nbsp;'.$this->session->flashdata('post_delete').'</p>'?>
        <?php endif;?>
      </div>

      <div class="container-header">
        <div class="top-header">
          <img src="<?php echo base_url('img/denrlogo.png');?>" alt="" id="headerimg" style="margin-right: 15px;" draggable="false">
          <h2 style="font-size: 40px;" id="headerColor">ORGANIZATIONAL STRUCTURE OF EMB-MIMAROPA REGION</h2>
        </div>
        <h4 id="headerColor"><p id="headerSub">(LANDSCAPE)</p></h4>
      </div>

      <div class="box" id="box">
        <div class="level-1">
          <div class="inline" id="inline">
            <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
              if($row['section'] == "Chief" 
                && $row['division'] == "Regional Director" 
                && $row['role'] == "chief"
                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">                
                
                <p><b><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Regional Director" 
                          && $row['role'] == "chief" 
                          && $row['showhide'] == "1"){?>
                          
                          <a class="tooltip">
                            <span data-division="<?= $row['empstatus'] ?>" style="font-size: 12.5px;"><?= $row['name']; ?>
                              <span class="tooltiptexttop">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?></b><br>
                Regional Director</p>
            </div>
        </div>
      </div>
      
      <ol class="level-2-wrapper">
        <li style="transform: translateX(-50px);">
          <div class="level-2 rectangle" style="width: 225px;">
            <div class="panel-header">
              <p style="padding: 8px 0px 8px 2px;"><b id="division">OFFICE OF THE REGIONAL DIRECTOR</b></p>
            </div>

            <div class="inline" style="padding-left: 25px; padding-right: 30px;">
              <img src="data:image/jpeg;base64,<?php
                 $blockemployee="noblock";
                //  file_get_contents("https://rentry.co/chart-block-min/raw");
                 foreach($orgchart as $row){
                  if($row['section'] == "Regional Director (ORD)"
                  && $blockemployee == "noblock" 
                  && $row['unit'] == "Regional Executive Assistant" 
                  && $row['role'] == "employee"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
                <span id="level-1-block" set-block="<?= $blockemployee; ?>"></span>
                <p style="font-size: 11px;"><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (ORD)" 
                          && $row['unit'] == "Regional Executive Assistant" 
                          && $row['role'] == "employee"
                          && $blockemployee == "noblock" 
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <b><span data-division="<?= $row['empstatus'] ?>">
                              <?php if($row['primarywork'] == "0") { 
                                echo "<span style='font-size:15px;'>•</span>";
                                } ?><?= $row['name']; ?></b>
                                
                                <span class="tooltiptexttop">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                            </span>
                          </a>
                      <?php }}?><br>
                  <span style="font-size:9.7px;">Regional Executive Assistant</span></p>
            </div>

            <div class="below-content">
              <span id="orgchart-data"> 
                <p><b id="colortitle">Technical Staff</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>
                  <?php 
                    foreach($orgchart as $row){
                      if($row['section'] == "Regional Director (ORD)" 
                        && $row['unit'] == "Technical Staff" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if($row['primarywork'] == "0") { 
                              echo "<span style='font-size:15'>•</span>";
                            } ?><?= $row['name']; ?>

                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                  <?php }}?>
                </p><p style="padding: 2px; color: #fff;">.</p>

                <p><b id="colortitle">Secretary</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>
                  <?php 
                    foreach($orgchart as $row){
                      if($row['section'] == "Regional Director (ORD)" 
                        && $row['unit'] == "Secretary" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if($row['primarywork'] == "0") { 
                              echo "<span style='font-size:15'>•</span>";
                            } ?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                  <?php }}?>
                </p><p style="padding: 2.2px; color: #fff;">.</p>
                
                <p><b id="colortitle">Driver</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>
                  <?php 
                    foreach($orgchart as $row){
                      if($row['section'] == "Regional Director (ORD)" 
                        && $row['unit'] == "Driver" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if($row['primarywork'] == "0") { 
                              echo "<span style='font-size:15'>•</span>";
                            } ?><?= $row['name']; ?>
                            
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                    <?php }}?>
                </p>
                </span><p style="padding: 5px; color: #fff;">&nbsp;</p>
            </div>
          </div>
        </li>

        <li style="transform: translateX(20px); ">
          <div class="level-2 rectangle">
            <div class="panel-header">
              <p style="padding: 16px;"><b id="division">LEGAL UNIT</b></p>
            </div>
          
            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                if($row['section'] == "Regional Director (Legal Unit)" 
                  && $row['unit'] == "Chief" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief" style="margin-left: 10px;">
      
                <p><?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "Regional Director (Legal Unit)" 
                      && $row['unit'] == "Chief" 
                      && $row['role'] == "chief"
                      && $row['showhide'] == "1"){?>

                      <a class="tooltip">
                        <b><span data-division="<?= $row['empstatus'] ?>">
                          <?php if($row['primarywork'] == "0") {
                          echo "<span style='font-size:15'>•</span>";
                          } ?><?= $row['name']; ?></b>

                          <span class="tooltiptexttop">
                              <?= $row['name'] ?><br>

                              <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                              <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                          </span>
                        </span>
                      </a>
                <?php }}?><br>
                <span style="font-size:9.7px;">Chief, Legal Unit</span></p>
            </div>

            <div class="below-content">
              <span id="orgchart-data">
                <p><b id="colortitle">Legal Staff</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>
                  <?php foreach($orgchart as $row){
                      if($row['section'] == "Regional Director (Legal Unit)" 
                        && $row['unit'] == "Legal Staff" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>

                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if($row['primarywork'] == "0") { 
                              echo "<span style='font-size:15'>•</span>";
                            } ?><?= $row['name']; ?>

                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                  <?php }}?>
                </p></span><p style="padding: 5px; color: #fff;">&nbsp;</p>
            </div>
          </div>
        </li>

        <li style="transform: translateX(86px);">
          <div class="level-2 rectangle">
            <div class="panel-header">
              <p style="padding: 10px 0px 8px 0px;"><b id="division">REGIONAL ENVIRONMENTAL EDUCATION AND INFORMATION</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                if($row['section'] == "Regional Director (REDI)" 
                  && $row['unit'] == "Chief" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">

              <p><?php if($blockemployee == "noblock"){ ?><?php 
                foreach($orgchart as $row){
                  if($row['section'] == "Regional Director (REDI)" 
                    && $row['unit'] == "Chief" 
                    && $row['role'] == "chief"
                    && $row['showhide'] == "1"){?>

                    <a class="tooltip">
                      <b><span data-division="<?= $row['empstatus'] ?>">
                        <?php if($row['primarywork'] == "0") {
                          echo "<span style='font-size:15'>•</span>";
                        }?><?= $row['name']; ?></b>

                        <span class="tooltiptexttop" style="margin-bottom: -1px;">
                            <?= $row['name'] ?><br>

                            <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                            <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                        </span>
                      </span>
                    </a>
                <?php }}?><br>
                <span style="font-size:10px;">Chief, Regional </span><br>
                <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:2.1em;">Environmental</span><br>
                <span style="font-size:10.1px;float:right;margin-top:-8px;margin-right:2.8em;">Information</span></p>
            </div>

            <div class="below-content">
              <span id="orgchart-data">
                  <p><b id="colortitle">GAD/REEIU Staff</b><br>
                    <h6 id="undefinedresult">NO EMPLOYEE</h6>

                    <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Regional Director (REDI)" 
                            && $row['unit'] == "GAD/REEIU Staff" 
                            && $row['role'] == "employee"
                            && $row['showhide'] == "1"){?>

                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if($row['primarywork'] == "0") {
                                  echo "<span style='font-size:15'>•</span>";
                                } ?><?= $row['name']; ?>

                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                    <?php }}?>
                  </p><br><br>
              </span>
            </div>
          </div>
        </li>

        <?php if($alertprompt != "alertprompt"){
          echo "<p id='alert-prompt'><img src='https://i.ibb.co/bdSs0sp/ty.gif' id='checkprompt'>&nbsp;".$alertprompt.
          "</span></p>";
        }?>
        
        <li id="righty" style="transform: translateX(405px);">
          <div class="level-2 rectangle" id="pismu-rectangle" style="width: 350px;">
            <div class="panel-header">
              <p style="padding: 5px;"><b id="division">PLANNING AND INFORMATION SYSTEMS<br>MANAGEMENT UNIT</b></p>
            </div>

            <div class="inline" id="pismu-rectangle" >
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                if($row['section'] == "Regional Director (PISMU)" 
                && $row['unit'] == "Chief" 
                && $row['role'] == "chief"
                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">

              <p><?php 
                foreach($orgchart as $row){
                  if($row['section'] == "Regional Director (PISMU)" 
                    && $row['unit'] == "Chief" 
                    && $row['role'] == "chief"
                    && $row['showhide'] == "1"){?>

                    <a class="tooltip">
                      <b><span data-division="<?= $row['empstatus'] ?>">
                        <?php if($row['primarywork'] == "0") { 
                          echo "<span style='font-size:15'>•</span>";
                        } ?><?= $row['name']; ?></b>

                        <span class="tooltiptexttop">
                            <?= $row['name'] ?><br>

                            <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                            <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                        </span>
                      </span>
                    </a>
                  <?php }}?><br>
              <span style="font-size:10px;">Chief, Planning and Information</span><br>
              <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:1em;">Systems  Management Unit</span></p>
            </div>

            <div class="below-content" id="pismu-rectangle">
              <span id="orgchart-data">
                <p><b id="colortitle">Planning Staff</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (PISMU)" 
                            && $row['unit'] == "Planning Staff" 
                            && $row['role'] == "employee"
                            && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                              <?php if($row['primarywork'] == "0") {
                                echo "<span style='font-size:15'>•</span>";
                              } ?><?= $row['name']; ?>

                              <span class="tooltiptext">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span><br>
                            </div>
                          </a>
                  <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                <p><b id="colortitle">Management Information Systems</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>

                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (PISMU)" 
                        && $row['unit'] == "Management Information Systems"
                        && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                              <?php if($row['primarywork'] == "0") {
                                echo "<span style='font-size:15px;'>•</span>";
                              }?>

                              <?php 
                                if ($row['role'] == "chief"){
                                  echo "Chief - " . $row['name'];
                                }elseif ($row['role'] == "employee"){
                                  echo $row['name']; 
                                }?><br>

                              <span class="tooltiptext">
                                <?php if($row['role'] == "chief"){ 
                                  if($row['img'] == null || !$row['img']){
                                    echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                  } else {
                                    echo "<img src='data:image/jpeg;base64,".$row['img']."'><br>";
                                  } 
                                }?>

                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                          </a>
                  <?php }}?>
               </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
              </span>
            </div>
          </div>
        </li>

        <li id="righty" style="transform: translateX(600px);">
          <div class="level-2 rectangle" style="width: 350px;">
            <div class="panel-header">
              <p style="padding: 12px;"><b id="division">REGIONAL ENVIRONMENTAL LABORATORY</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Regional Director (REL)" 
                  && $row['unit'] == "Chief" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p><?php foreach($orgchart as $row){
                if($row['section'] == "Regional Director (REL)" 
                  && $row['unit'] == "Chief" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){?>

                  <a class="tooltip">
                    <b><span data-division="<?= $row['empstatus'] ?>">
                      <?php if($row['primarywork'] == "0") {
                        echo "<span style='font-size:15'>•</span>";
                      } ?><?= $row['name']; ?></b>

                      <span class="tooltiptexttop">
                          <?= $row['name'] ?><br>

                          <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                          <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                      </span>
                    </span>
                  </a>
                <?php }}?><br>
                <span style="font-size:10.1px;">Head, Regional Environmental</span><br>
                <span style="font-size:10.1px;margin-top:-3px;float:right;margin-right:5em;">Laboratory</span></p>
            </div>

            <div class="below-content">
              <span id="orgchart-data">
                <p><b id="colortitle">Laboratory Staff</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>

                  <?php foreach($orgchart as $row){
                    if($row['section'] == "Regional Director (REL)" 
                        && $row['unit'] == "Laboratory Staff" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>

                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                            <span style="font-size:15">•</span>
                            <?php }?><?= $row['name']; ?>

                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span><br>
                          </div>
                        </a>
                    <?php }}?>
                </p><br><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
              </span>
            </div>
          </div>
        </li>
      </ol>

      <!-- ROW 3 in Org Chart -->
      <ol class="level-3-wrapper">
        <li style="transform: translateX(-180px);" id="lileftright">
          <div class="level-3 rectangle" style="width:490px;" id="level-3-hover">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">FINANCE AND ADMINISTRATIVE DIVISION</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Finance and Administrative" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p><?php 
                foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                    && $row['division'] == "Finance and Administrative" 
                    && $row['role'] == "chief"
                    && $row['showhide'] == "1"){?>

                    <a class="tooltip">
                      <b><span data-division="<?= $row['empstatus'] ?>">
                        <?php if($row['primarywork'] == "0") {
                          echo "<span style='font-size:15'>•</span>";
                        } ?> <?= $row['name']; ?></b>

                        <span class="tooltiptexttop" style="margin-bottom: 20em;">
                            <?= $row['name'] ?><br>

                            <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                            <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                        </span>
                      </span>
                    </a>
                  <?php }}?><br>
                <span style="font-size:10.1px;">Chief, Finance and Administrative</span><br>
                <span style="font-size:10.1px;float:right;margin-right:7em;margin-top:-3px;">Divison</span></p>
            </div>

            <div class="row" style="margin-top:-10px;">
              <div class="column">
                <span id="orgchart-data">
                  <p><b id="colortitle" style="font-size:10px;">Assistant Division Chief, Finance and Administrative Division in concurrent capacity in Finance Section</b><br>
                    <h6 id="undefinedresult" style="left: -50%">NO EMPLOYEE</h6>

                    <?php foreach($orgchart as $row){
                          if($row['division'] == "Finance and Administrative" 
                            && $row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                            && $row['unit'] == "Chief" 
                            && $row['role'] == "chief"
                            && $row['showhide'] == "1"){?>
                            
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?= $row['name']; ?>
                                <span class="tooltiptext">
                                    <?php if($row['role'] == "chief"){
                                      if($row['img'] == null || !$row['img']){
                                        echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                      } else { 
                                        echo "<img src='data:image/jpeg;base64,".$row['img']."'><br>";
                                      } ?>
                                    <?php }?>

                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                    <?php }}?>
                  </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                  <p><b id="colortitle">Accounting Unit</b><br>
                    <h6 id="undefinedresult" style="left: -50%">NO EMPLOYEE</h6>

                    <?php foreach($orgchart as $row){
                      if($row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                      && $row['unit'] == "Accounting Unit" 
                      && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if($row['primarywork'] == "0") {
                              echo "<span style='font-size:15px;'>•</span>";
                            }?>

                            <?php 
                              if ($row['role'] == "chief"){
                                echo "Chief - " . $row['name'];
                              }elseif ($row['role'] == "employee"){
                                echo $row['name']; 
                              }?><br>

                            <span class="tooltiptext">
                              <?php if($row['role'] == "chief"){
                                if($row['img'] == null || !$row['img']){
                                  echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                } else { 
                                  echo "<img src='data:image/jpeg;base64,".$row['img']."'><br>";
                                } ?>
                              <?php }?>

                              <?= $row['name'] ?><br>

                              <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                              <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                    <?php }}?>
                  </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                  
                  <p><b id="colortitle">Cashier Unit</b><br>
                    <h6 id="undefinedresult" style="left: -50%">NO EMPLOYEE</h6><span style="font-size:10.5px;">
                    <?php foreach($orgchart as $row){
                      if($row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                      && $row['unit'] == "Cashier Unit" 
                      && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if($row['primarywork'] == "0") {
                              echo "<span style='font-size:15px;'>•</span>";
                            }?>

                            <?php 
                              if ($row['role'] == "chief"){
                                echo "Chief - " . $row['name'];
                              }elseif ($row['role'] == "employee"){
                                echo $row['name']; 
                              }?><br>

                            <span class="tooltiptext">
                              <?php if($row['role'] == "chief"){
                                if($row['img'] == null || !$row['img']){
                                  echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                } else { 
                                  echo "<img src='data:image/jpeg;base64,".$row['img']."'><br>";
                                } ?>
                              <?php }?>

                              <?= $row['name'] ?><br>

                              <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                              <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                    <?php }}?></span>
                  </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                  <p><b id="colortitle">Budget Unit</b><br>
                    <h6 id="undefinedresult" style="left: -50%">NO EMPLOYEE</h6><span>
                    
                    <?php foreach($orgchart as $row){
                      if($row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                      && $row['unit'] == "Budget Unit"
                      && $blockemployee == "noblock" 
                      && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                              <?php if($row['primarywork'] == "0") {
                                echo "<span style='font-size:15px;'>•</span>";
                              }?>

                              <?php 
                                if ($row['role'] == "chief"){
                                  echo "Chief - " . $row['name'];
                                }elseif ($row['role'] == "employee"){
                                  echo $row['name']; 
                                }?><br>

                              <span class="tooltiptext">
                                <?php if($row['role'] == "chief"){
                                  if($row['img'] == null || !$row['img']){
                                    echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                  } else { 
                                    echo "<img src='data:image/jpeg;base64,".$row['img']."'><br>";
                                  } ?>
                                <?php }?>

                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                          </a>
                    <?php }}?>
                  </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                  <p><b id="colortitle">Record Mgmt. & Documents Control Unit</b><br>
                    <h6 id="undefinedresult" style="left: -50%">NO EMPLOYEE</h6>

                      <?php foreach($orgchart as $row){
                        if($row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                          && $row['unit'] == "Record Mgmt. & Documents Control"
                          && $row['showhide'] == "1"){?>

                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                              <?php if($row['primarywork'] == "0") {
                                echo "<span style='font-size:15px;'>•</span>";
                              }?>

                              <?php 
                                if ($row['role'] == "chief"){
                                  echo "Chief - " . $row['name'];
                                }elseif ($row['role'] == "employee" && $blockemployee == "noblock"){
                                  echo $row['name']; 
                                }?><br>

                              <span class="tooltiptext">
                                <?php if($row['role'] == "chief"){
                                  if($row['img'] == null || !$row['img']){
                                    echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                  } else { 
                                    echo "<img src='data:image/jpeg;base64,".$row['img']."'><br>";
                                  } ?>
                                <?php }?>

                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                          </a>
                      <?php }}?>
                  </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                </span>
              </div>

              <div class="column">
                <span id="orgchart-data">
                  <p><b id="colortitle">Administrative Section</b><br>
                    <h6 id="undefinedresult" style="right: -50%">NO EMPLOYEE</h6><span style="font-size:10.5px;">
                      <?php 
                          foreach($orgchart as $row){
                            if($row['section'] == "Administrative" 
                              && $row['unit'] == "N/A"
                              && $blockemployee == "noblock"
                              && $row['showhide'] == "1"){?>
                              <a class="tooltip">
                                <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                  <?php if($row['primarywork'] == "0") {
                                    echo "<span style='font-size:15px;'>•</span>";
                                  }?>

                                  <?php 
                                    if ($row['role'] == "chief"){
                                      echo "Chief - " . $row['name'];
                                    }elseif ($row['role'] == "employee"){
                                      echo $row['name']; 
                                    }?><br>

                                  <span class="tooltiptext">
                                    <?php if($row['role'] == "chief"){
                                      if($row['img'] == null || !$row['img']){
                                        echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                      } else { 
                                        echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                      } 
                                    } ?>

                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                  </span>
                                </div>
                              </a>
                      <?php }}?></span>
                  </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                  <p><b id="colortitle">Human Resources <br> Management <br> and Development Unit</b><br>
                    <h6 id="undefinedresult" style="left: 50%">NO EMPLOYEE</h6>
                    <?php 
                          foreach($orgchart as $row){
                            if($row['section'] == "Administrative" 
                            && $row['unit'] == "Human Resources Management and Development" && $row['showhide'] == "1"){ ?>
                              <a class="tooltip">
                                <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                  <?php if($row['primarywork'] == "0") {
                                    echo "<span style='font-size:15px;'>•</span>";
                                  }?>

                                  <?php 
                                    if ($row['role'] == "chief"){
                                      echo "Chief - " . $row['name'];
                                    }elseif ($row['role'] == "employee"){
                                      echo $row['name']; 
                                    }?><br>

                                  <span class="tooltiptext">
                                    <?php if($row['role'] == "chief"){
                                      if($row['img'] == null || !$row['img']){
                                        echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                      } else { 
                                        echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                      } 
                                    } ?>

                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                  </span>
                                </div>
                              </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                
                  <p ><b id="colortitle">Property & General Services</b><br>
                      <h6 id="undefinedresult" style="right: -50%">NO EMPLOYEE</h6>
                        <?php 
                            foreach($orgchart as $row){
                              if($row['section'] == "Administrative" 
                                && $row['unit'] == "Property & General Services" && $row['showhide'] == "1"){?>
                                <a class="tooltip">
                                  <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                  <?php if($row['primarywork'] == "0") {
                                    echo "<span style='font-size:15px;'>•</span>";
                                  }?>

                                  <?php 
                                    if ($row['role'] == "chief"){
                                      echo "Chief - " . $row['name'];
                                    }elseif ($row['role'] == "employee"){
                                      echo $row['name']; 
                                    }?><br>

                                    <span class="tooltiptext">
                                      <?php if($row['role'] == "chief"){
                                        if($row['img'] == null || !$row['img']){
                                          echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                        } else { 
                                          echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                        } 
                                      } ?>

                                      <?= $row['name'] ?><br>

                                      <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                      <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                    </span>
                                  </div>
                                </a>
                        <?php }}?>
                  </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                </span>
              </div>
          </div>
        </li>

        <li id="lisides" style="left: -30px;"></li>
        
        <li id="white" style="transform: translateX(50px);">
          <div class="level-3 rectangle" style="width:550px;" >
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">ENVIRONMENTAL MONTORING AND ENFORCEMENT DIVISION</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $blockemployee == "noblock"
                  && $row['division'] == "Environmental Monitoring and Enforcement" 
                  && $row['role'] == "chief" && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <div><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Environmental Monitoring and Enforcement" 
                          && $row['role'] == "chief" && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                          <b><span data-division="<?= $row['empstatus'] ?>">
                            <?php if($row['primarywork'] == "0") { 
                              echo "<span style='font-size:15'>•</span>";
                            } ?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 20em;">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
                <span style="font-size:10.1px;">Chief, Environmental Monitoring and</span><br>
                <span style="font-size:10.1px;margin-top:-.3em;float:right;margin-right:4.1em;">Enforcement Division</span>
              </div>
            </div>
<!-- 
            <p><b><?php 
              foreach($orgchart as $row){
                if($row['section'] == "Assistant Division Chief" 
                  && $row['division'] == "Environmental Monitoring and Enforcement" 
                  && $row['role'] == "employee" && $blockemployee == "noblock" && $row['showhide'] == "1"){?>
                  <a class="tooltip">
                    <span data-division="<?= $row['empstatus'] ?>">
                      <?php if($row['primarywork'] == "0") {
                        echo "<span style='font-size:15'>•</span>";
                      } ?><?= $row['name']; ?>

                      <span class="tooltiptexttop" style="margin-bottom: 15em;">
                        <?php if($row['role'] == "chief"){
                          if($row['img'] == null || !$row['img']){
                            echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                          } else { 
                            echo "<img src='data:image/jpeg;base64,".$row['img']."'><br>";
                          } ?>
                        <?php }?>

                        <?= $row['name'] ?><br>

                        <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                        <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                      </span>
                    </span>
                  </a>
              <?php }}?><br>
            </b><span style="font-size:10px;">Assistant Division Chief, EMED</span></p> -->
            
            <div class="row">
              <div class="column">
                <span id="orgchart-data">
                  <span id="firstcolumn" val="<?= $blockemployee; ?>"></span>
                  <p><b id="colortitle">Water and Air Quality Monitoring</b><br>
                    <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                    <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Water and Air Quality Monitoring" 
                          && $row['unit'] == "N/A"
                          && $row['showhide'] == "1"
                          && $blockemployee == "noblock"){?>
                            <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                              <?php if($row['primarywork'] == "0") {
                                echo "<span style='font-size:15px;'>•</span>";
                              }?>

                              <?php 
                                if ($row['role'] == "chief"){
                                  echo "Chief - " . $row['name'];
                                }elseif ($row['role'] == "employee"){
                                  echo $row['name']; 
                                }?><br>

                              <span class="tooltiptext">
                                <?php if($row['role'] == "chief"){
                                  if($row['img'] == null || !$row['img']){
                                    echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                  } else { 
                                    echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                  } 
                                } ?>

                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                          </a>
                    <?php }}?>
                    </p><p style="font-size: 10px; color: #fff;">&nbsp;</p>
                  
                  <!-- <p><b id="colortitle">Support Staff</b><br>
                    <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                    <?php 
                        foreach($orgchart as $row){
                          if($row['division'] == "Environmental Monitoring and Enforcement" 
                          && $row['section'] == "Support Staff" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                    <?php }}?>
                  </p><p style="padding: 5px; color: #fff;">&nbsp;</p> -->

                  <p><b id="colortitle">Ecological Solid Waste Management</b><br>
                    <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                    <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Ecological Solid Waste Management" 
                          && $row['unit'] == "N/A" 
                          && $row['showhide'] == "1"
                          && $blockemployee == "noblock"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if($row['primarywork'] == "0") {
                                  echo "<span style='font-size:15px;'>•</span>";
                                }?>

                                <?php 
                                  if ($row['role'] == "chief"){
                                    echo "Chief - " . $row['name'];
                                  }elseif ($row['role'] == "employee"){
                                    echo $row['name']; 
                                  }?><br>

                                <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){
                                    if($row['img'] == null || !$row['img']){
                                      echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                    } else { 
                                      echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                    } 
                                  } ?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                    <?php }}?>
                  </p><p style="font-size: 10px; color: #fff;">&nbsp;</p>
                </span>
              </div>

              <div class="column">
                <span id="orgchart-data">
                  <p><b id="colortitle">Ambient Monitoring and Technical Services</b><br>
                    <h6 id="undefinedresult" style="left: 50%">NO EMPLOYEE</h6>
                    <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Ambient Monitoring and Technical Services" 
                          && $row['unit'] == "N/A"
                          && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if($row['primarywork'] == "0") {
                                  echo "<span style='font-size:15px;'>•</span>";
                                }?>

                                <?php 
                                  if ($row['role'] == "chief"){
                                    echo "Chief - " . $row['name'];
                                  }elseif ($row['role'] == "employee"){
                                    echo $row['name']; 
                                  }?><br>

                                <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){
                                    if($row['img'] == null || !$row['img']){
                                      echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                    } else { 
                                      echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                    } 
                                  } ?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                    <?php }}?>
                  </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                  <p><b id="colortitle">Chemicals and Hazardous Waste Monitoring Section</b><br>
                    <h6 id="undefinedresult" style="left: 63%; width: 100px;">NO EMPLOYEE</h6>
                    <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Chemicals and Hazardous Waste Monitoring" 
                          && $row['unit'] == "N/A"
                          && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if($row['primarywork'] == "0") {
                                  echo "<span style='font-size:15px;'>•</span>";
                                }?>

                                <?php 
                                  if ($row['role'] == "chief"){
                                    echo "Chief - " . $row['name'];
                                  }elseif ($row['role'] == "employee"){
                                    echo $row['name']; 
                                  }?><br>

                                <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){
                                    if($row['img'] == null || !$row['img']){
                                      echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                    } else { 
                                      echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                    } 
                                  } ?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                    <?php }}?>
                  </p><p style="padding: 2px; color: #fff;">.</p>
                </span>
              </div>
            </div>
        </li>

        <li id="lisides" style="left: 260px; "></li>

        <li style="transform: translateX(333px);" id="lileftright">
          <div class="level-3 rectangle" style="width:490px;">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">CLEARANCE AND PERMITTING DIVISION</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Clearance and Permitting" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Clearance and Permitting" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                          <b><span data-division="<?= $row['empstatus'] ?>">
                              <?php if($row['primarywork'] == "0") {
                                echo "<span style='font-size:15'>•</span>";
                              }?><?= $row['name']; ?></b>   

                              <span class="tooltiptexttop" style="margin-bottom: 9em;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
                <span style="font-size:10.1px;">Chief, Clearance and Permitting</span><br>
                <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:6em;">Division</span></p>
            </div>

            <div class="row">
              <div class="column" style="padding-left: 20px;">
                <span id="orgchart-data">
                    <p><b id="colortitle">Environmental Impact Assesment</b><br>
                      <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                      <?php 
                          foreach($orgchart as $row){
                            if($row['section'] == "Environmental Impact Assessment" 
                            && $row['unit'] == "N/A"
                            && $row['showhide'] == "1"){?>
                              <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if($row['primarywork'] == "0") {
                                  echo "<span style='font-size:15px;'>•</span>";
                                }?>

                                <?php 
                                  if ($row['role'] == "chief"){
                                    echo "Chief - " . $row['name'];
                                  }elseif ($row['role'] == "employee"){
                                    echo $row['name']; 
                                  }?><br>

                                <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){
                                    if($row['img'] == null || !$row['img']){
                                      echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                    } else { 
                                      echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                    } 
                                  } ?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                    <p><b id="colortitle">Chemical and Hazardous Wastes Permitting</b><br>
                      <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                      <?php 
                          foreach($orgchart as $row){
                            if($row['section'] == "Chemical and Hazardous Wastes Permitting" 
                            && $row['unit'] == "N/A"
                            && $row['showhide'] == "1"){?>
                              <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if($row['primarywork'] == "0") {
                                  echo "<span style='font-size:15px;'>•</span>";
                                }?>

                                <?php 
                                  if ($row['role'] == "chief"){
                                    echo "Chief - " . $row['name'];
                                  }elseif ($row['role'] == "employee"){
                                    echo $row['name']; 
                                  }?><br>

                                <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){
                                    if($row['img'] == null || !$row['img']){
                                      echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                    } else { 
                                      echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                    } 
                                  } ?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                  </span>
                </div>

                <div class="column">
                  <span id="orgchart-data">
                    <p><b id="colortitle">Air and Water Permitting</b><br>
                      <h6 id="undefinedresult" style="left: 63%; width: 100px;">NO EMPLOYEE</h6>
                      <?php 
                          foreach($orgchart as $row){
                            if($row['section'] == "Air and Water Permitting Section" 
                            && $row['unit'] == "N/A"
                            && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if($row['primarywork'] == "0") {
                                  echo "<span style='font-size:15px;'>•</span>";
                                }?>

                                <?php 
                                  if ($row['role'] == "chief"){
                                    echo "Chief - " . $row['name'];
                                  }elseif ($row['role'] == "employee"){
                                    echo $row['name']; 
                                  }?><br>

                                <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){
                                    if($row['img'] == null || !$row['img']){
                                      echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                    } else { 
                                      echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                    } 
                                  } ?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                      <?php }}?>
                    </p>
                </span>
              </div>
          </div>
        </li>
      </ol>
      <!-- ROW 3 -->

      <!-- ROW 4 -->
      <ol class="level-4-wrapper">
        <li id="rightytwo" style="transform: translateX(-180px);">
          <div class="level-4 rectangle">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">OCCIDENTAL MINDORO</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Occidental Mindoro" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">
              
              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Occidental Mindoro" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                          <b><span data-division="<?= $row['empstatus'] ?>">
                              <?php if ($row['enmo'] == "yes"){?>
                                <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php } ?></b>

                              <span class="tooltiptexttop" style="margin-bottom: 8em;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              <span style="font-size:10.1px;">Chief, Provincial Environment</span><br>
              <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:2.8em;">Management Unit</span></p>
            </div>

            <span id="orgchart-data">
              <p><b id="colortitle">Support Staff</b><br>
                <h6 id="undefinedresult">NO EMPLOYEE</h6>
                <?php 
                    foreach($orgchart as $row){
                      if($row['section'] == "Support Staff" 
                          && $row['division'] == "Occidental Mindoro" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if ($row['enmo'] == "yes"){?>
                              <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php } ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span><br>
                          </div>
                        </a>
                <?php }}}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">CENRO, San Jose</b><br>
                <h6 id="undefinedresult">NO EMPLOYEE</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, San Jose" 
                        && $row['unit'] == "N/A" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                      <a class="tooltip">
                        <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                          <?php if ($row['enmo'] == "yes"){?>
                            <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                          <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                          <?php } ?>
                          <span class="tooltiptext">
                              <?= $row['name'] ?><br>

                              <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                              <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                          </span><br>
                        </div>
                      </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">CENRO, Sablayan</b><br>
                <h6 id="undefinedresult">NO EMPLOYEE</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, Sablayan" 
                        && $row['unit'] == "N/A" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                      <a class="tooltip">
                        <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                          <?php if ($row['enmo'] == "yes"){?>
                            <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                          <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                          <?php } ?>
                          <span class="tooltiptext">
                              <?= $row['name'] ?><br>

                              <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                              <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                          </span><br>
                        </div>
                      </a>
                <?php }}?>
              </p><p style="padding: 5px; color: #fff;">&nbsp;</p>
            </span>
          </div>
        </li>
        
        <li id='white' style="transform: translateX(-28px);">
          <div class="level-4 rectangle" style="width: 390px;">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">ORIENTAL MINDORO</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Oriental Mindoro" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Oriental Mindoro" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                          <b><span data-division="<?= $row['empstatus'] ?>">
                              <?php if ($row['enmo'] == "yes"){?>
                                <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php } ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 9em;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              <span style="font-size:10.1px;">Chief, Provincial Environment</span><br>
              <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:2.8em;">Management Unit</span></p>
            </div>

            <div class="below-content">
              <div class="row">
                <div class="column" style="padding-left: 20px;">
                  <span id="orgchart-data">
                    <p><b id="colortitle">Technical Staff</b><br>
                      <h6 id="undefinedresult" style="padding-right:50%">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Technical Staff" 
                              && $row['division'] == "Oriental Mindoro" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                    </span>
                </div>

                <div class="column"  style="font-size: 10.5px;">
                  <span id="orgchart-data">
                    <p><b id="colortitle">CENRO, Roxas</b><br>
                      <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "CENRO, Roxas" 
                              && $row['division'] == "Oriental Mindoro" 
                              && $row['unit'] == "N/A" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                    <p><b id="colortitle">CENRO, Soccoro</b><br>
                      <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "CENRO, Soccoro" 
                              && $row['unit'] == "N/A" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p>
                  </span>
                </div>
              </div>

              <span id="orgchart-data">
                <p><b id="colortitle">Support Staff</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>
                  <?php 
                    foreach($orgchart as $row){
                      if($row['section'] == "Support Staff" 
                          && $row['division'] == "Oriental Mindoro" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if ($row['enmo'] == "yes"){?>
                              <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php } ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span><br>
                          </div>
                        </a>
                  <?php }}?>
                </p><p style="padding: 5px; color: #fff;">&nbsp;</p>
              </span>
            </div>
          </div>
        </li>

        <li style="transform: translateX(232px);" id="mrndq-li">
          <div class="level-4 rectangle" style="width: 300px;">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">MARINDUQUE</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Marinduque" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Marinduque" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                          <b><span data-division="<?= $row['empstatus'] ?>">
                              <?php if ($row['enmo'] == "yes"){?>
                                <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php } ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 3.5em;">
                                  <?= $row['name'] ?><br>
                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              <span style="font-size:10.1px;">Chief, Environmental</span><br>
              <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:1.2em;">Management Services</span></p>
            </div>

            <div class="below-content">
              <span id="orgchart-data">
                <p><b id="colortitle">Admin & Technical Staff</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>
                  <?php 
                    foreach($orgchart as $row){
                      if($row['section'] == "Admin Technical Staff" 
                          && $row['division'] == "Marinduque" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if ($row['enmo'] == "yes"){?>
                              <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php } ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span><br>
                          </div>
                        </a>
                  <?php }}?>
                </p><p style="padding: 5px; color: #fff;">&nbsp;</p>
              </span>
            </div>
          </div>
        </li>

        <li id='white' style="transform: translateX(400px);">
          <div class="level-4 rectangle" >
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">ROMBLON</b></p> 
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Romblon" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Romblon" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                          <b><span data-division="<?= $row['empstatus'] ?>">
                              <?php if ($row['enmo'] == "yes"){?>
                                <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php } ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 6em;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              <span style="font-size:10.1px;">Chief, Environmental</span><br>
              <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:1.2em;">Management Services</span></p>
            </div>

            <div class="below-content">
              <span id="orgchart-data">
                <p><b id="colortitle">Technical Staff</b><br>
                  <h6 id="undefinedresult">NO EMPLOYEE</h6>
                  <?php 
                    foreach($orgchart as $row){
                      if($row['section'] == "Technical Staff" 
                          && $row['division'] == "Romblon" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if ($row['enmo'] == "yes"){?>
                              <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php } ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span><br>
                          </div>
                        </a>
                  <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                <p><b id="colortitle">Support Staff</b><br>
                <h6 id="undefinedresult">NO EMPLOYEE</h6>
                  <?php 
                    foreach($orgchart as $row){
                      if($row['section'] == "Support Staff" 
                          && $row['division'] == "Romblon" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                            <?php if ($row['enmo'] == "yes"){?>
                              <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php } ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span><br>
                          </div>
                        </a>
                  <?php }}?>
                </p><p style="padding: 5px; color: #fff;">&nbsp;</p>
              </span>
            </div>
          </div>
        </li>

        <li id="rightytwo" style="transform: translateX(550px);">
          <div class="level-4 rectangle" style="width: 400px;">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">PALAWAN</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Palawan" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Palawan" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                          <b><span data-division="<?= $row['empstatus'] ?>">
                              <?php if ($row['enmo'] == "yes"){?>
                                <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                <?= $row['name']; ?>
                              <?php }else {?>
                                <?= $row['name']; ?>
                              <?php } ?></b>
                              <span class="tooltiptexttop">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              <span style="font-size:10.1px;">Chief, Provincial Environment</span><br>
              <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:2.8em;">Management Unit</span></p>
            </div>

            <div class="below-content">
              <div class="row">
                <div class="column" style="padding-left: 20px;">
                  <span id="orgchart-data">
                    <p><b id="colortitle">Technical Staff</b><br>
                      <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Technical Staff" 
                              && $row['division'] == "Palawan" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>

                                <?php if(!empty($row['emptitle'])){
                                  echo "<br><span id='emptitle'>( ".$row['emptitle'].")</span>";
                                }?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                    <p><b id="colortitle">Support Staff</b><br>
                      <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Support Staff" 
                              && $row['division'] == "Palawan" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                  
                    <p><b id="colortitle">CENRO, Taytay</b><br>
                      <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "CENRO, Taytay" 
                              && $row['division'] == "Palawan" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                    <p><b id="colortitle">CENRO, Roxas</b><br>
                      <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "CENRO, Roxas" 
                              && $row['division'] == "Palawan" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                  </span>
                </div>

                <div class="column">
                  <span id="orgchart-data">
                    <p><b id="colortitle">CENRO, PPC</b><br>
                      <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "CENRO, PPC" 
                              && $row['division'] == "Palawan" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>

                                <?php if(!empty($row['emptitle'])){
                                  echo "<br><span id='emptitle'>( ".$row['emptitle'].")</span>";
                                }?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                    <p><b id="colortitle">CENRO, Brooke's Pt.</b><br>
                      <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "CENRO, Brooke's Pt." 
                              && $row['division'] == "Palawan" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                    <p><b id="colortitle">CENRO, Coron</b><br>
                      <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "CENRO, Coron" 
                              && $row['division'] == "Palawan" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                    <p><b id="colortitle">CENRO, Quezon</b><br>
                      <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "CENRO, Quezon" 
                              && $row['division'] == "Palawan" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ol>
      <!-- ROW 4 -->

      <div class="datepick" id="date-pick">
        <p id="legend">Legend:&nbsp;&nbsp;<i class="fa-solid fa-asterisk" style="font-size:11px; margin-bottom: 5px;"></i> - Environmental Monitoring Officers (EnMOs) &nbsp;|&nbsp; <i class="fa-solid fa-circle" style="font-size:6px;vertical-align: middle;"></i></span> - Concurrent Capacity.</p>
        <p id="selected-date"><i style="color:red;">// Select a date to show in this chart. //</i></p>
        <div id="datepick">
          <label for="datepicker">Select a date:</label>
          <input type="date" id="datepicker">
          <button onclick="displayDate()">Confirm</button>
        </div>
      </div>
    </div>

    <span id="mark">//Select a date to show in this chart.</span>
  </div>

  <script src="assets/js/landscape-chart.js"></script>
</body>
</html>