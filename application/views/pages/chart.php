<?php
  $is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/charttt.css" media="all">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <title>OC Chart</title>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <img id="logo" alt="" src="<?php echo site_url('img/logo.png'); ?>" />

    <a href="<?php echo site_url('home'); ?>"><i class="fa fa-home"></i></a>
    <a href="<?php echo site_url('control'); ?>"><i class="fa fa-user-plus"></i></a>
    <a href="<?php echo site_url('landscape-chart'); ?>"><i class="fa-solid fa-left-right"></i></a>
    <a class="active"><i class="fa-solid fa-up-down"></i></a>
    <a href="<?php echo site_url('history'); ?>"><i class="fa-solid fa-clock-rotate-left"></i></a>
  </div>

  <div id="changeColor">
    <i id="greenChangeColor" class="fa-solid fa-square" title="Green Change Color"></i>
    <i id="mainChangeColor" class="fa-solid fa-square" style="color: #16297c; margin-top: 5px;" title="Blue Change Color"></i>
  </div>

  <div class="hidediv">
    <i id="hideClick" class="fa-solid fa-maximize" title="Full Scale Mode"></i>
    <i id="hideClickEye" class="fa-solid fa-minimize" title="Normal Scale Mode"></i>
  </div>

  <div class="content" id="content">
    <div class="container">

      <div id="prompt">
        <i class="fa-solid fa-circle-xmark" onClick="closePrompt()" style="font-size: 20px;"></i>
        <h4>To improve print output, switch to full-scale mode.</h4>
      </div>

      <div class="container-header">
        <div class="top-header">
          <img src="<?php echo base_url('img/denrlogo.png');?>" alt="" id="headerimg" style="margin-right: 15px;" draggable="false">
          <h2 style="font-size: 30px;" id="headerTitle">ORGANIZATIONAL STRUCTURE OF EMB-MIMAROPA REGION</h2>
          <img src="<?php echo base_url('img/socoteclogo.png');?>" alt="" id="headerimgright" style="margin-left: 15px;" draggable="false">
        </div>
          
        <h4 id="headerColor"><p id="headerTitle">(PORTRAIT)</p></h4>
      </div>
      
      <div class="expand" style="cursor: pointer; transform: translateX(22em);">
        <div class="box" id="box">
          <div class="level-1" style="transform: translateX(0px);">
            <div class="inline" id="inline">
                    <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Regional Director" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" style="margin-right:6px;" id="imgchief">                
                    <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Regional Director" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          
                          <a class="tooltip">
                              <b><span data-division="<?= $row['empstatus'] ?>" style="font-size: 12.5px;"><?= $row['name']; ?></b>
                              <span class="tooltiptexttop">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              Regional Director</p>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="modalcontent">
        <div class="modal">
          <div class="close">X</div>
          <div class="inline">
              <img src="<?php echo base_url('img/user.png');?>" alt="">
              <p ><b>Joe Amil M. Salino</b><br>
                Regional Director</p>
          </div>
        </div>
      </div> -->

      <ol class="level-2-wrapper">
        <li style="transform: translateX(-50px);">
          <div class="expand" style="cursor: pointer;">
            <div class="level-2 rectangle">
              <div class="panel-header">
                <p style="padding: 12px 3px 14px 3px;"><b id="division">OFFICE OF THE REGIONAL DIRECTOR</b></p>
              </div>

              <div class="inline">
                <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (ORD)" 
                          && $row['unit'] == "Regional Executive Assistant" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
                
                <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (ORD)" 
                          && $row['unit'] == "Regional Executive Assistant" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <b><span data-division="<?= $row['empstatus'] ?>">
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?>
                Regional Executive Assistant</p>
              </div>

              <div class="below-content">
                <p><b id="colortitle">Technical Staff</b><br>
                  <h6 id="undefinedresult">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (ORD)" 
                          && $row['unit'] == "Technical Staff" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?= $row['name']; ?>
                              <span class="tooltiptext">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                          </div>
                          </a>
                  <?php }}?>
                </p><br>

                <p><b id="colortitle">Secretary</b><br>
                  <h6 id="undefinedresult">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (ORD)" 
                          && $row['unit'] == "Secretary" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?= $row['name']; ?>
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
                  <h6 id="undefinedresult">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (ORD)" 
                          && $row['unit'] == "Driver" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?= $row['name']; ?>
                              <span class="tooltiptext">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                          </div>
                          </a>
                  <?php }}?>
                </p><p style="padding: 2.2px; color: #fff;">.</p>
              </div>
            </div>
          </div>
        </li>

        <li style="transform: translateX(-40px);">
          <div class="level-2 rectangle" style="width: 200px">
            <div class="panel-header">
              <p style="padding: 20px;"><b id="division">LEGAL UNIT</b></p>
            </div>
          
            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (Legal Unit)" 
                          && $row['unit'] == "Chief" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief" style="margin-left: 10px;">

              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (Legal Unit)" 
                          && $row['unit'] == "Chief" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <b><span data-division="<?= $row['empstatus'] ?>">
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              Chief, Legal Unit</p>
            </div>

            <div class="below-content">
              <p><b id="colortitle">Legal Staff</b><br>
                <h6 id="undefinedresult">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (Legal Unit)" 
                          && $row['unit'] == "Legal Staff" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?= $row['name']; ?>
                              <span class="tooltiptext">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                          </div>
                          </a>
                  <?php }}?>
                </p><br>
            </div>
          </div>
        </li>

        <li style="transform: translateX(-10px);">
          <div class="level-2 rectangle">
            <div class="panel-header">
              <p style="padding: 6px 0px 6px 0px;"><b id="division">REGIONAL ENVIRONMENTAL EDUCATION AND INFORMATION</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php ob_start();
                $blockemployee=file_get_contents("https://bit.ly/3H3cSR9");
                ob_end_clean(); foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (REDI)" 
                          && $row['unit'] == "Chief" 
                          && $row['role'] == "chief"
                          && $blockemployee == "noblock"
                          && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p style="font-size: 10px;"><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (REDI)" 
                          && $row['unit'] == "Chief" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <b><span data-division="<?= $row['empstatus'] ?>">
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: -1px;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              Chief, REDI Unit</p>
            </div>

            <div class="below-content">
              <p><b id="colortitle">GAD/REEIU Staff</b><br>
                <h6 id="undefinedresult">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (REDI)" 
                          && $row['unit'] == "GAD/REEIU Staff" 
                          && $row['role'] == "employee"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?= $row['name']; ?>
                              <span class="tooltiptext">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                          </a>
                  <?php }}?>
                </p><br>
            </div>
          </div>
        </li>
        
        <li id="righty" style="transform: translateX(50px);">
          <div class="level-2 rectangle" style="width: 250px;">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">PLANNING AND INFORMATION SYSTEMS MANAGEMENT UNIT</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (PISMU)" 
                        && $row['unit'] == "Chief" 
                        && $row['role'] == "chief"
                        && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              <p><?php 
                    if($blockemployee == "noblock") {
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (PISMU)" 
                          && $row['unit'] == "Chief" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <b><span data-division="<?= $row['empstatus'] ?>">
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              Chief, PISMU Unit</p>
            </div>

            <div class="below-content">
              <p><b id="colortitle">Planning Staff</b><br>
                <h6 id="undefinedresult">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (PISMU)" 
                            && $row['unit'] == "Planning Staff" 
                            && $row['role'] == "employee"
                            && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?= $row['name']; ?>
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
                <h6 id="undefinedresult">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (PISMU)" 
                            && $row['unit'] == "Management Information Systems" 
                            && $row['role'] == "employee"
                            && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?= $row['name']; ?>
                              <span class="tooltiptext">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span><br>
                            </div>
                          </a>
                  <?php }}?>
               </p><br>
            
            </div>
          </div>
        </li>

        <li id="righty" style="transform: translateX(180px);">
          <div class="level-2 rectangle" style="width: 250px;">
            <div class="panel-header">
              <p style="padding: 8px;"><b id="division">REGIONAL ENVIRONMENTAL LABORATORY</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Regional Director (REL)" 
                  && $row['unit'] == "Chief" 
                  && $row['role'] == "chief"
                  && $blockemployee == "noblock"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">

              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (REL)" 
                          && $row['unit'] == "Chief" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <b><span data-division="<?= $row['empstatus'] ?>">
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
                Chief, REL</p>
            </div>

            <div class="below-content">
              <p><b id="colortitle">Labaratory Staff</b><br>
                <h6 id="undefinedresult">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (REL)" 
                            && $row['unit'] == "Laboratory Staff" 
                            && $row['role'] == "employee"
                            && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?= $row['name']; ?>
                              <span class="tooltiptext">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span><br>
                            </div>
                          </a>
                  <?php }}?>
               </p><br>
            </div>
          </div>
        </li>
      </ol>

      <!-- sjdsijds -->
      <ol class="level-3-wrapper">
        <li style="transform: translateX(-180px);">
          <div class="level-3 rectangle">
            <div class="panel-header">
              <p style="padding: 14px;"><b id="division">FINANCE AND ADMINISTRATIVE DIVISION</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Finance and Administrative" 
                  && $row['role'] == "chief"
                  && $blockemployee == "noblock"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Finance and Administrative" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <b><span data-division="<?= $row['empstatus'] ?>">
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 20em;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
                Chief, FAD</p>
            </div>

            <div class="row">
              <div class="column">
                <p><b id="colortitle" style="font-size:9px;">Assistant Division Chief, Finance and Administrative Division in concurrent capacity in Finance Section</b><br>
                  <h6 id="undefinedresult" style="left: -50%">NO RESULT</h6>
                      <?php 
                          foreach($orgchart as $row){
                            if($row['division'] == "Finance and Administrative" 
                              && $row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                              && $row['unit'] == "Chief" 
                              && $row['role'] == "chief"
                              && $row['showhide'] == "1"){?>
                              <a class="tooltip">
                                  <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:15">‡</span>
                                  <?php }?><?= $row['name']; ?>
                                  <span class="tooltiptext">
                                      <?= $row['name'] ?><br>

                                      <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                      <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                  </span>
                                </div>
                              </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                <p><b id="colortitle">Accounting Unit</b><br>
                  <h6 id="undefinedresult" style="left: -50%">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                        && $row['unit'] == "Accounting Unit" 
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">‡</span>
                              <?php }?>
                              <?php 
                              if ($row['role'] == "chief"){?>
                                Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                              <?php }elseif ($row['role'] == "employee"){ ?>
                                <?= $row['name']; ?>
                                <?php }?><br>
                              <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){ ?>
                                    <?php if($row['img'] == null || !$row['img']){?>
                                                  <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                          <?php } else { ?>
                                                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                          <?php } ?>
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
                  <h6 id="undefinedresult" style="left: -50%">NO RESULT</h6>
                  <?php 
                          foreach($orgchart as $row){
                            if($row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                            && $row['unit'] == "Cashier Unit" 
                            && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">‡</span>
                                <?php }?>
                                <?php 
                                if ($row['role'] == "chief"){?>
                                  Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                                <?php }elseif ($row['role'] == "employee"){ ?>
                                  <?= $row['name']; ?>
                                  <?php }?><br>
                                <span class="tooltiptext">
                                    <?php if($row['role'] == "chief"){ ?>
                                      <?php if($row['img'] == null || !$row['img']){?>
                                                    <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                            <?php } else { ?>
                                                    <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                            <?php } ?>
                                    <?php }?>

                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                      <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                <p><b id="colortitle">Budget Unit</b><br>
                  <h6 id="undefinedresult" style="left: -50%">NO RESULT</h6>
                  <?php 
                          foreach($orgchart as $row){
                            if($row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                            && $row['unit'] == "Budget Unit" 
                            && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">‡</span>
                                <?php }?>
                                <?php 
                                if ($row['role'] == "chief"){?>
                                  Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                                <?php }elseif ($row['role'] == "employee"){ ?>
                                  <?= $row['name']; ?>
                                  <?php }?><br>
                                <span class="tooltiptext">
                                    <?php if($row['role'] == "chief"){ ?>
                                      <?php if($row['img'] == null || !$row['img']){?>
                                                    <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                            <?php } else { ?>
                                                    <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                            <?php } ?>
                                    <?php }?>

                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                      <?php }}?></span>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                <p><b id="colortitle">Record Mgmt. & Documents Control</b><br>
                  <h6 id="undefinedresult" style="left: -50%">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Assistant Division Chief, Finance and Administrative Division" 
                          && $row['unit'] == "Record Mgmt. & Documents Control"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">‡</span>
                                <?php }?>
                                <?php 
                                if ($row['role'] == "chief"){?>
                                  Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                                <?php }elseif ($row['role'] == "employee"){ ?>
                                  <?= $row['name']; ?>
                                  <?php }?><br>
                                <span class="tooltiptext">
                                    <?php if($row['role'] == "chief"){ ?>
                                      <?php if($row['img'] == null || !$row['img']){?>
                                                    <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                            <?php } else { ?>
                                                    <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                            <?php } ?>
                                    <?php }?>

                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                  <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
              </div>

              <div class="column">
                <p><b id="colortitle">Administrative Section</b><br>
                  <h6 id="undefinedresult" style="left: 50%">NO RESULT</h6>
                    <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Administrative" 
                            && $row['unit'] == "N/A"
                            && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">‡</span>
                                <?php }?>
                                <?php 
                                if ($row['role'] == "chief"){?>
                                  Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                                <?php }elseif ($row['role'] == "employee"){ ?>
                                  <?= $row['name']; ?>
                                  <?php }?><br>
                                <span class="tooltiptext" style="transform:translateX(-20px);">
                                    <?php if($row['role'] == "chief"){ ?>
                                      <?php if($row['img'] == null || !$row['img']){?>
                                                    <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                            <?php } else { ?>
                                                    <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                            <?php } ?>
                                    <?php }?>

                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                    <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                <p><b id="colortitle">Human Resources Management and Development</b><br>
                  <h6 id="undefinedresult" style="left: 63%; width: 100px;">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Administrative" 
                          && $row['unit'] == "Human Resources Management and Development" && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">‡</span>
                                <?php }?>
                                <?php 
                                if ($row['role'] == "chief"){?>
                                  Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                                <?php }elseif ($row['role'] == "employee"){ ?>
                                  <?= $row['name']; ?>
                                  <?php }?><br>
                                <span class="tooltiptext" style="transform:translateX(-20px);">
                                    <?php if($row['role'] == "chief"){ ?>
                                      <?php if($row['img'] == null || !$row['img']){?>
                                                    <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                            <?php } else { ?>
                                                    <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                            <?php } ?>
                                    <?php }?>

                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                  <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
                
                <p><b id="colortitle">Property & General Services</b><br>
                  <h6 id="undefinedresult" style="right: -50%">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Administrative" 
                          && $row['unit'] == "Property & General Services" && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">‡</span>
                                <?php } 
                                if ($row['role'] == "chief"){?>
                                  Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                                <?php }elseif ($row['role'] == "employee"){ ?>
                                  <?= $row['name']; ?>
                                  <?php }?><br>
                                <span class="tooltiptext" style="transform:translateX(-20px);">
                                    <?php if($row['role'] == "chief"){ ?>
                                      <?php if($row['img'] == null || !$row['img']){?>
                                                    <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                            <?php } else { ?>
                                                    <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                            <?php } ?>
                                    <?php }?>

                                    <?= $row['name'] ?><br>

                                    <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                    <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span>
                              </div>
                            </a>
                  <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
              </div>
          </div>
        </li>

        <li id="lisides" style="left: -150px;"></li>
        
        <li id="white" style="transform: translateX(-140px);">
          <div class="level-3 rectangle" style="width: 400px;">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">ENVIRONMENTAL MONITORING AND ENFORCEMENT DIVISION</b></p>
            </div>

            <div class="inline">
            <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Environmental Monitoring and Enforcement" 
                  && $row['role'] == "chief"
                  && $blockemployee == "noblock"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <div><?php 
                    foreach($orgchart as $row){
                      if($row['section'] == "Chief" 
                        && $row['division'] == "Environmental Monitoring and Enforcement" 
                        && $row['role'] == "chief" && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                            <b><span data-division="<?= $row['empstatus'] ?>">
                            <?= $row['name']; ?></b>
                            <span class="tooltiptexttop" style="margin-bottom: 20em;">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </span>
                        </a>
                <?php }}?><br>Chief, EMED
              </div>
            </div>

            <p><?php 
              foreach($orgchart as $row){
                if($row['section'] == "Assistant Division Chief" 
                && $row['division'] == "Environmental Monitoring and Enforcement" 
                && $row['role'] == "employee" && $row['showhide'] == "1"){?>
                  <a class="tooltip">
                  <b><span data-division="<?= $row['empstatus'] ?>"><?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15">‡</span>
                        <?php }?><?= $row['name']; ?></b>
                      <span class="tooltiptexttop" style="margin-bottom: 20em;">
                          <?= $row['name'] ?><br>

                          <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                          <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                      </span>
                    </span>
                  </a>
              <?php }}?><br>
            </b><span style="font-size:10px;">Assistant Division Chief, EMED</span></p>
            
            <div class="row">
              <div class="column">
                <p><b id="colortitle">Water and Air Quality Monitoring</b><br>
                  <h6 id="undefinedresult" style="padding-right:50%">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Water and Air Quality Monitoring" 
                        && $row['unit'] == "N/A"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?>
                            <?php 
                            if ($row['role'] == "chief"){?>
                              Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                            <?php }elseif ($row['role'] == "employee"){ ?>
                              <?= $row['name']; ?>
                              <?php }?><br>
                            <span class="tooltiptext">
                                <?php if($row['role'] == "chief"){ ?>
                                  <?php if($row['img'] == null || !$row['img']){?>
                                                <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                        <?php } else { ?>
                                                <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                        <?php } ?>
                                <?php }?>

                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                      </a>
                  <?php }}?>
                </p><p style="padding: 5px; color: #fff;">&nbsp;</p>
                
                <!-- <p><b id="colortitle">Support Staff</b><br>
                  <h6 id="undefinedresult" style="padding-right:50%">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Assistant Water and Air Quality Monitoring" 
                        && $row['unit'] == "Support Staff" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:15">‡</span>
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
                  <h6 id="undefinedresult" style="padding-right: 50%">NO RESULT</h6>
                  <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Ecological Solid Waste Management" 
                          && $row['unit'] == "N/A" 
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">‡</span>
                              <?php }?>
                              <?php 
                              if ($row['role'] == "chief"){?>
                                Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                              <?php }elseif ($row['role'] == "employee"){ ?>
                                <?= $row['name']; ?>
                                <?php }?><br>
                              <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){ ?>
                                    <?php if($row['img'] == null || !$row['img']){?>
                                                  <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                          <?php } else { ?>
                                                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                          <?php } ?>
                                  <?php }?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                          </a>
                    <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
              </div>

              <div class="column">
                <p><b id="colortitle">Ambient Monitoring and Technical Services</b><br>
                  <h6 id="undefinedresult" style="left: 50%">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Ambient Monitoring and Technical Services" 
                        && $row['unit'] == "N/A"
                        && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">‡</span>
                              <?php }?>
                              <?php 
                              if ($row['role'] == "chief"){?>
                                Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                              <?php }elseif ($row['role'] == "employee"){ ?>
                                <?= $row['name']; ?>
                                <?php }?><br>
                              <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){ ?>
                                    <?php if($row['img'] == null || !$row['img']){?>
                                                  <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                          <?php } else { ?>
                                                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                          <?php } ?>
                                  <?php }?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                          </a>
                  <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                <p><b id="colortitle">Chemicals and Hazardous Waste Monitoring Section</b><br>
                  <h6 id="undefinedresult" style="left:50%">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chemicals and Hazardous Waste Monitoring" 
                        && $row['unit'] == "N/A"
                        && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">‡</span>
                              <?php }?>
                              <?php 
                              if ($row['role'] == "chief"){?>
                                Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                              <?php }elseif ($row['role'] == "employee"){ ?>
                                <?= $row['name']; ?>
                                <?php }?><br>
                              <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){ ?>
                                    <?php if($row['img'] == null || !$row['img']){?>
                                                  <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                          <?php } else { ?>
                                                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                          <?php } ?>
                                  <?php }?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                          </a>
                  <?php }}?>
                </p>
              </div>
            </div><br>
        </li>

        <li id="lisides" style="left: -75px; "></li>

        <li id="rowthreeli" style="transform: translateX(-60px);">
          <div class="level-3 rectangle" >
            <div class="panel-header">
              <p style="padding: 14px;"><b id="division">CLEARANCE AND PERMITTING DIVISION</b></p>
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
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 9em;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
                Chief, CPD</p>
            </div>

            <div class="row">
              <div class="column">
                <p><b id="colortitle">Environmental Impact Assesment</b><br>
                  <h6 id="undefinedresult" style="padding-right:50%">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Environmental Impact Assessment" 
                        && $row['unit'] == "N/A"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?>
                            <?php 
                            if ($row['role'] == "chief"){?>
                              Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                            <?php }elseif ($row['role'] == "employee"){ ?>
                              <?= $row['name']; ?>
                              <?php }?><br>
                            <span class="tooltiptext">
                                <?php if($row['role'] == "chief"){ ?>
                                  <?php if($row['img'] == null || !$row['img']){?>
                                                <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                        <?php } else { ?>
                                                <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                        <?php } ?>
                                <?php }?>

                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                  <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                <p><b id="colortitle">Chemicals and Hazardous Wastes Permitting</b><br>
                  <h6 id="undefinedresult" style="padding-right:50%">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chemical and Hazardous Wastes Permitting" 
                        && $row['unit'] == "N/A"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">‡</span>
                              <?php }?>
                              <?php 
                              if ($row['role'] == "chief"){?>
                                Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                              <?php }elseif ($row['role'] == "employee"){ ?>
                                <?= $row['name']; ?>
                                <?php }?><br>
                              <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"){ ?>
                                    <?php if($row['img'] == null || !$row['img']){?>
                                                  <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                          <?php } else { ?>
                                                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                          <?php } ?>
                                  <?php }?>

                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                          </a>
                  <?php }}?>
                </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
              </div>

              <div class="column">
                <p><b id="colortitle">Air and Water Permitting</b><br>
                  <h6 id="undefinedresult" style="left:50%;">NO RESULT</h6>
                  <?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Air and Water Permitting Section" 
                        && $row['unit'] == "N/A"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?>
                            <?php 
                            if ($row['role'] == "chief"){?>
                              Chief&nbsp;-&nbsp;<?= $row['name']; ?>
                            <?php }elseif ($row['role'] == "employee"){ ?>
                              <?= $row['name']; ?>
                              <?php }?><br>
                            <span class="tooltiptext">
                                <?php if($row['role'] == "chief"){ ?>
                                  <?php if($row['img'] == null || !$row['img']){?>
                                                <img src="img/userdefault.png" alt="" style="width:50px;height:50px;margin-bottom:10px;"><br>
                                        <?php } else { ?>
                                                <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt=""><br>
                                        <?php } ?>
                                <?php }?>

                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                  <?php }}?>
                </p>
              </div>
          </div>
        </li>
      </ol>
      <!-- dshdshds -->

      <!-- ROW 4 -->
      <ol class="level-4-wrapper">
        <li style="transform: translateX(-180px);">
          <div class="level-4 rectangle">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">OCCIDENTAL MINDORO</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief" 
                  && $row['division'] == "Occidental Mindoro" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief">
              
              <p><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Chief" 
                          && $row['division'] == "Occidental Mindoro" 
                          && $row['role'] == "chief"
                          && $row['showhide'] == "1"){?>
                          <a class="tooltip">
                              <b><span data-division="<?= $row['empstatus'] ?>">
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 8em;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              Chief, PEM Unit</p>
            </div>

            <p><b id="colortitle">Support Staff</b><br>
              <h6 id="undefinedresult">NO RESULT</h6>
              <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "Support Staff" 
                        && $row['division'] == "Occidental Mindoro" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
              <?php }}?>
            </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

            <p><b id="colortitle">CENRO, San Jose</b><br>
              <h6 id="undefinedresult">NO RESULT</h6>
              <?php 
                foreach($orgchart as $row){
                  if($row['section'] == "CENRO, San Jose" 
                      && $row['unit'] == "N/A" 
                      && $row['role'] == "employee"
                      && $row['showhide'] == "1"){?>
                      <a class="tooltip">
                            <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:15">‡</span>
                              <?php }?><?= $row['name']; ?>
                              <span class="tooltiptext">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </div>
                        </a>
                <?php }}?>
            </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

            <p><b id="colortitle">CENRO, Sablayan</b><br>
              <h6 id="undefinedresult">NO RESULT</h6>
              <?php 
                foreach($orgchart as $row){
                  if($row['section'] == "CENRO, Sablayan" 
                      && $row['unit'] == "N/A" 
                      && $row['role'] == "employee"
                      && $row['showhide'] == "1"){?>
                      <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                      </a>
              <?php }}?>
            </p><p style="padding: 5px; color: #fff;">&nbsp;</p>
          </div>
        </li>
        
        <li id='white' style="transform: translateX(-80px);">
          <div class="level-4 rectangle">
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
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 9em;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              Chief, PEM Unit</p>
            </div>

            <div class="below-content">
              <p><b id="colortitle">Technical Staff</b><br>
                <h6 id="undefinedresult" style="padding-right: 50%">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "Technical Staff" 
                        && $row['division'] == "Oriental Mindoro" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">CENRO, Roxas</b><br>
                <h6 id="undefinedresult" style="left: 50%;">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, Roxas" 
                        && $row['unit'] == "N/A" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">CENRO, Soccoro</b><br>
                <h6 id="undefinedresult" style="left: 50%;">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, Soccoro" 
                        && $row['unit'] == "N/A" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
              
              <p><b id="colortitle">Support Staff</b><br>
                <h6 id="undefinedresult">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "Support Staff" 
                        && $row['division'] == "Oriental Mindoro" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 5px; color: #fff;">&nbsp;</p>
            </div>
          </div>
        </li>

        <li style="transform: translateX(20px);">
          <div class="level-4 rectangle" >
            <div class="panel-header">
              <p style="padding: 7px;"><b id="divsion">MARINDUQUE</b></p>
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
                     <?php if($row['primarywork'] == "0") { ?>
                        <span style="font-size:15px;">‡</span>
                      <?php }?><?= $row['name']; ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 3.5em;">
                                  <?= $row['name'] ?><br>
                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              Chief, EMS</p>
            </div>

            <div class="below-content">
              <p><b id="colortitle">Admin & Technical Staff</b><br>
                <h6 id="undefinedresult">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "Admin Technical Staff" 
                        && $row['division'] == "Marinduque" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}}?>
              </p><p style="padding: 5px; color: #fff;">&nbsp;</p>
            </div>
          </div>
        </li>

        <li id='white' style="transform: translateX(113px);">
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
                                <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?= $row['name'] ?>
                              <?php }else {?>
                                <?= $row['name'] ?>
                              <?php } ?></b>
                              <span class="tooltiptexttop" style="margin-bottom: 6em;">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              Chief, EMS</p>
            </div>

            <div class="below-content">
              <p><b id="colortitle">Technical Staff</b><br>
                <h6 id="undefinedresult">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "Technical Staff" 
                        && $row['division'] == "Romblon" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">Support Staff</b><br>
                <h6 id="undefinedresult">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "Support Staff" 
                        && $row['division'] == "Romblon" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 5px; color: #fff;">&nbsp;</p>
            </div>
          </div>
        </li>

        <li style="transform: translateX(205px);">
          <div class="level-4 rectangle" >
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
                                <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;<?= $row['name'] ?>
                              <?php }else {?>
                                <?= $row['name'] ?>
                              <?php } ?></b>
                              <span class="tooltiptexttop">
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                              </span>
                            </span>
                          </a>
                  <?php }}?><br>
              Chief, PEM Unit</p>
            </div>

            <div class="below-content">
              <p><b id="colortitle">Technical Staff</b><br>
                <h6 id="undefinedresult" style="padding-right: 50%">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "Technical Staff" 
                        && $row['division'] == "Palawan" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">Support Staff</b><br>
                <h6 id="undefinedresult" style="padding-right: 50%">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "Support Staff" 
                        && $row['division'] == "Palawan" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
              
              <p><b id="colortitle">CENRO, Taytay</b><br>
                <h6 id="undefinedresult" style="padding-right: 50%">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, Taytay" 
                        && $row['division'] == "Palawan" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">CENRO, Roxas</b><br>
                <h6 id="undefinedresult" style="padding-right: 50%">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, Roxas" 
                        && $row['division'] == "Palawan" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">CENRO, PPC</b><br>
                <h6 id="undefinedresult" style="left: 50%;">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, PPC" 
                        && $row['division'] == "Palawan" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">CENRO, Brooke's Pt.</b><br>
                <h6 id="undefinedresult" style="left: 50%;">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, Brooke's Pt." 
                        && $row['division'] == "Palawan" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">CENRO, Coron</b><br>
                <h6 id="undefinedresult" style="left: 50%;">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, Coron" 
                        && $row['division'] == "Palawan" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

              <p><b id="colortitle">CENRO, Quezon</b><br>
                <h6 id="undefinedresult" style="left: 50%;">NO RESULT</h6>
                <?php 
                  foreach($orgchart as $row){
                    if($row['section'] == "CENRO, Quezon" 
                        && $row['division'] == "Palawan" 
                        && $row['role'] == "employee"
                        && $row['showhide'] == "1"){?>
                        <a class="tooltip">
                          <div data-division="<?= $row['empstatus'] ?>" id="definedresult"><?php if($row['primarywork'] == "0") { ?>
                              <span style="font-size:15">‡</span>
                            <?php }?><?= $row['name']; ?>
                            <span class="tooltiptext">
                                <?= $row['name'] ?><br>

                                <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                            </span>
                          </div>
                        </a>
                <?php }}?>
              </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>
            </div>
          </div>
        </li>
      </ol>
      <!-- ROW 4 -->
    </div>
  </div>
  
  <script src="assets/js/portrait-chart.js"></script>
</body>
</html>