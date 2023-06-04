<?php
  $is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/landscapechart-v2.css" media="all">
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
    <i id="moreExit" class="fa-solid fa-x" style="padding-right: 25px; margin-left: 9px;" title="Exit Sort"></i>
    <i id="moreShow" class="fa-solid fa-ellipsis-vertical" title="Show Sort"></i>
    
    <div id="moreSidebarContent">
      <h2>SORT</h2><br>
      <i><label><input type="radio" name="status" id="all" value="" checked onchange="filterOrgChart()">&nbsp;All</label><br>
      <label><input type="radio" name="status" id="jo-checkbox" onchange="filterOrgChart()">&nbsp;Permanent</label><br>
      <label><input type="radio" name="status" id="permanent-checkbox" onchange="filterOrgChart()">&nbsp;JO/CSO</label></i>
      <br><br> 
      <canvas id="color-wheel" width="200" height="200"></canvas>
    </div>
  </div>
  
  <!-- <div class="hidewide">
    <i id="openWide" class="fa-solid fa-up-right-and-down-left-from-center"></i>
    
    <i id="closeWide" class="fa-solid fa-down-right-and-down-left-from-center"></i>
  </div> -->
    
  <div id="length">.</div>
  <?php if($is_admin == 1) $alertprompt = file_get_contents("https://bit.ly/40ZLZ81");
    else $alertprompt = "alertprompt"; ?>
  <div class="content" id="content">
    <div class="container" id="container">
      <div id="prompt">
        <i class="fa-solid fa-circle-xmark" onClick="closePrompt()" style="font-size: 20px;"></i>
        <h4>To improve print output, switch to full-scale mode.</h4>
        <?php if($this->session->flashdata('post_edit')) :?>
          <?=   '<p id="alert-edit"><img src="img/check.gif" id="check">&nbsp;'.$this->session->flashdata('post_edit').'</p>'?>
        <?php endif;?>
        <?php if($this->session->flashdata('post_delete')) :?>
          <?=   '<p id="alert-edit""><img src="img/check.gif" id="check">&nbsp;'.$this->session->flashdata('post_delete').'</p>'?>
        <?php endif;?>
        <?php if($alertprompt != "alertprompt"){
          echo "<p id='alert-prompt'><img src='https://i.ibb.co/bdSs0sp/ty.gif' id='checkprompt'>&nbsp;".$alertprompt.
          "</span></p>";
        }?>
      </div>

      <div class="container-header">
        <div class="top-header">
          <img src="<?php echo base_url('img/denrlogo.png');?>" alt="" id="headerimg" style="margin-right: 15px; margin-top:.5px;" draggable="false">
          <h2 style="font-size: 40px;" id="headerColor">ORGANIZATIONAL STRUCTURE OF EMB-MIMAROPA REGION</h2>
        </div>
        <h4 id="headerColor"><p id="headerSub">(LANDSCAPE v2)</p></h4>
      </div>

      <div id="testwe">
      <div class="box" id="box">
        <div class="level-1">
          <div class="inline" id="inline">
            <img src="data:image/jpeg;base64,<?php
                $blockemployee="noblock";
                // file_get_contents("https://rentry.co/chart-block-lib-min/raw");
                foreach($orgchart as $row){
              if($row['section'] == "Chief" 
                && $row['division'] == "Regional Director" 
                && $row['role'] == "chief"
                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">                
                
                <p><b><?php if($blockemployee == "noblock"){ 
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

      <!-- ROW 3 in Org Chart -->
      <ol class="level-3-wrapper">
        <li style="transform: translateX(-180px);" id="lileftright">
          <div class="level-3 rectangle" style="width:590px;" id="level-3-hover">
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
                <span style="font-size:10.8px;">Chief, Finance and Administrative</span></p>
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
                    <?php }}}?>
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
                
                  <p><b id="colortitle">Property & General Services</b><br>
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

        <li id="lisides" style="left:50px;"></li>
        
        <li id="white" style="transform: translateX(7em);">
          <div class="level-3 rectangle" style="width:620px;" >
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">ENVIRONMENTAL MONTORING AND ENFORCEMENT DIVISION</b></p>
            </div>

            <div class="inline">
              <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Chief"
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
                <span style="font-size:10.8px;">Chief, Environmental Monitoring</span><br>
                <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:20px;">and Enforcement Division</span>
              </div>
            </div>
            
            <div class="row">
              <div class="column">
                <span id="orgchart-data">
                  <p><b id="colortitle">Water and Air Quality Monitoring</b><br>
                    <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6>
                    <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "Water and Air Quality Monitoring" 
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
                                  <span style="font-size:20px;">•</span>
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

        <li id="lisides" style="left:370px;"></li>

        <li style="transform: translateX(26.6em);" id="lileftright">
          <div class="level-3 rectangle" style="width:580px;">
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
              <span style="font-size:10.8px;">Chief, Clearance and</span><br> 
              <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:20px;">Permitting Division</span></p>
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
          <div class="level-4 rectangle" style="width:380px;">
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
                                <span style="font-size:20px;">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:20px;">•</span>
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
                <span style="font-size:10.8px;">Chief, Provincial Environment</span><br>
                <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:30px;">Management Unit</span></p>
            </div>

            <div class="row" style="margin-top:-10px;">
              <div class="column">
              <span id="orgchart-data">
                <p><b id="colortitle">Support Staff</b><br>
                  <!-- <h6 id="undefinedresult">NO EMPLOYEE</h6> -->
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
                                  <span style="font-size:20px;">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:20px;">•</span>
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

                <p><b id="colortitle">CENRO, San Jose</b><br>
                  <!-- <h6 id="undefinedresult">NO EMPLOYEE</h6> -->
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
                                  <span style="font-size:20px;">•</span>
                                <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:20px;">•</span>
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
              </div>

              <div class="column">
                <p><b id="colortitle">CENRO, Sablayan</b><br>
                  <!-- <h6 id="undefinedresult">NO EMPLOYEE</h6> -->
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
                                  <span style="font-size:20px;">•</span>
                                <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:20px;">•</span>
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
              </div>
              </div>
            </span>
          </div>
        </li>
        
        <li id='white' style="transform: translateX(4.5em);">
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
                                  <span style="font-size:20px;">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:20px;">•</span>
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
                <span style="font-size:10.8px;">Chief, Provincial Environment</span><br>
                <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:30px;">Management Unit</span></p>
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
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
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

                  <span id="orgchart-data">
                    <p><b id="colortitle">Support Staff</b><br>
                      <h6 id="undefinedresult" style="right:50%">NO EMPLOYEE</h6>
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
                                      <span style="font-size:20px;">•</span>
                                    <?php }?><?= $row['name']; ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
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

                <div class="column"  style="font-size: 10.5px;">
                  <span id="orgchart-data">
                    <p><b id="colortitle">CENRO, Roxas</b><br>
                      <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6>
                      <?php 
                        foreach($orgchart as $row){
                          if($row['section'] == "CENRO, Roxas" 
                              && $row['division'] == "Oriental Mindoro" 
                              && $row['role'] == "employee"
                              && $row['showhide'] == "1"){?>
                            <a class="tooltip">
                              <div data-division="<?= $row['empstatus'] ?>" id="definedresult">
                                <?php if ($row['enmo'] == "yes"){?>
                                  <i class="fa-solid fa-asterisk" style="font-size: 8px;"></i>&nbsp;
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
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
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
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
            </div>
          </div>
        </li>
        <li id="mrndq-li" style="transform: translateX(21em);">
          <div class="level-4 rectangle" style="width: 280px;">
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">MARINDUQUE</b></p>
            </div>

            <div class="inline">
              <img style="margin-left:10px;" src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
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
                                  <span style="font-size:20px;">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:20px;">•</span>
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
                <span style="font-size:10.1px;float:right;margin-top:-3px;padding-right:13px;">Management Services</span></p>
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
                                <span style="font-size:20px;">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:20px;">•</span>
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

        <li id='white' style="transform: translateX(30em);">
          <div class="level-4 rectangle" >
            <div class="panel-header">
              <p style="padding: 7px;"><b id="division">ROMBLON</b></p> 
            </div>

            <div class="inline">
              <img style="margin-left:10px;" src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
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
                                  <span style="font-size:20px;">•</span>
                                <?php }?><?= $row['name']; ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:20px;">•</span>
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
              <span style="font-size:10.1px;float:right;margin-top:-3px;">Management Services</span></p>
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
                                <span style="font-size:20px;">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:20px;">•</span>
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
                                <span style="font-size:20px;">•</span>
                              <?php }?><?= $row['name']; ?>
                            <?php }else {?>
                              <?php if($row['primarywork'] == "0") { ?>
                                <span style="font-size:20px;">•</span>
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

        <li id="rightytwo" style="transform: translateX(39em);">
          <div class="level-4 rectangle" style="width: 500px;font-size:11px;">
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
              <span style="font-size:10.8px;">Chief, Provincial Environment</span><br>
              <span style="font-size:10.1px;float:right;margin-top:-3px;margin-right:30px;">Management Unit</span></p>
            </div>

            <div class="below-content">
              <div class="threerow">
                <!-- style="padding-left: 20px;" -->
                <div class="threecol" >
                  <span id="orgchart-data">
                    <p><b id="colortitle">Technical Staff</b><br>
                      <!-- <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6> -->
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
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php } ?>

                                <?php if(!empty($row['emptitle'])){
                                  echo "<br><span id='emptitle'>( ".$row['emptitle'].")</span>";
                                }?>
                                <span class="tooltiptext">
                                  <?php if($row['role'] == "chief"  || !empty($row['emptitle'])){
                                    if($row['img'] == null || !$row['img']){
                                      echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                    } else { 
                                      echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                    } 
                                  }?>
                                  <?= $row['name'] ?><br>

                                  <button onclick="location.href='edit/<?= $row['id']; ?>'" type="button"><i class="fa-solid fa-pen-to-square" title="EDIT"></i></button>
                                  <button onclick="location.href='delete/<?= $row['id']; ?>'"><i class="fa-solid fa-trash" title="DELETE"></i></button>
                                </span><br>
                              </div>
                            </a>
                      <?php }}?>
                    </p><p style="padding: 1.9px; color: #fff;">&nbsp;</p>

                    <p><b id="colortitle">Support Staff</b><br>
                      <!-- <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6> -->
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
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
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

                <div class="threecol">
                  <span id="orgchart-data">
                  <p><b id="colortitle">CENRO, Taytay</b><br>
                    <!-- <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6> -->
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
                                  <span style="font-size:20px;">•</span>
                                <?php }?>
                                <?= $row['name'] ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:20px;">•</span>
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
                      <!-- <h6 id="undefinedresult" style="padding-right: 50%;">NO EMPLOYEE</h6> -->
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
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
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

                    <p><b id="colortitle">CENRO, PPC</b><br>
                      <!-- <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6> -->
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
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>

                                  <?php if(!empty($row['emptitle'])){
                                    echo "<br><span id='emptitle'>( ".$row['emptitle'].")</span>";
                                  }?>
                                <?php } ?>
                                <span class="tooltiptext">
                                    <?php if($row['role'] == "chief"  || !empty($row['emptitle'])){
                                      if($row['img'] == null || !$row['img']){
                                        echo "<img src='img/userdefault.png' style='width:50px;height:50px;margin-bottom:10px;'><br>";
                                      } else { 
                                        echo "<img src='data:image/jpeg;base64," . $row['img'] . "'><br>";
                                      } 
                                    }?>

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

                <div class="threecol">
                  <span id="orgchart-data">
                  <p><b id="colortitle">CENRO, Brooke's Pt.</b><br>
                    <!-- <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6> -->
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
                                  <span style="font-size:20px;">•</span>
                                <?php }?>
                                <?= $row['name'] ?>
                              <?php }else {?>
                                <?php if($row['primarywork'] == "0") { ?>
                                  <span style="font-size:20px;">•</span>
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
                      <!-- <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6> -->
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
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
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
                      <!-- <h6 id="undefinedresult" style="left: 50%;">NO EMPLOYEE</h6> -->
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
                                    <span style="font-size:20px;">•</span>
                                  <?php }?>
                                  <?= $row['name'] ?>
                                <?php }else {?>
                                  <?php if($row['primarywork'] == "0") { ?>
                                    <span style="font-size:20px;">•</span>
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

      <ol class="level-2-wrapper" style="transform: translateY(7em);">
        <li style="transform: translateX(-50px);">
          <div class="level-2 rectangle" style="width:350px;">
            <div class="panel-header">
              <p style="padding: 14.5px 0px 14.5px 0px;"><b id="division">OFFICE OF THE REGIONAL DIRECTOR</b></p>
            </div><br>

            <div class="inline" style="padding-left:25px;padding-right:30px;">
              <!-- <img src="data:image/jpeg;base64,<?php
                 foreach($orgchart as $row){
                  if($row['section'] == "Regional Director (ORD)"
                  && $row['unit'] == "Regional Executive Assistant" 
                  && $row['role'] == "employee"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief"> -->
              
                <p style="font-size: 11px;"><?php 
                      foreach($orgchart as $row){
                        if($row['section'] == "Regional Director (ORD)" 
                          && $row['unit'] == "Regional Executive Assistant" 
                          && $row['role'] == "employee"
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
                  Regional Executive Assistant</p>
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

        <li style="transform:translateX(10.5em);">
          <div class="level-2 rectangle" style="width:340px;">
            <div class="panel-header">
              <p style="padding:13.5px;"><b id="division">LEGAL UNIT</b></p>
            </div><br>
          
            <div class="inline">
              <!-- <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                if($row['section'] == "Regional Director (Legal Unit)" 
                  && $row['unit'] == "Chief" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief" style="margin-left: 10px;"> -->
      
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
              <span style="font-size:10.1px;">Chief, Legal Unit</span></p>
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

        <li style="transform: translateX(23.6em);" id="liredi">
          <div class="level-2 rectangle" style="width:320px;">
            <div class="panel-header">
              <p style="padding: 5px 0px 6px 0px;"><b id="division">REGIONAL ENVIRONMENTAL<br>EDUCATION AND INFORMATION</b></p>
            </div><br>

            <div class="inline">
              <!-- <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                if($row['section'] == "Regional Director (REDI)" 
                  && $row['unit'] == "Chief" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief"> -->

              <p><?php 
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
              <span style="font-size:10.1px;">Chief, Regional Environmental,</span><br>
              <span style="font-size:10.1px;float:right;margin-top:-3px;">Education and Information Unit</span></p>
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
      
        <li id="righty" style="transform: translateX(35em);">
          <div class="level-2 rectangle" id="pismu-rectangle" style="width:350px;">
            <div class="panel-header">
              <p style="padding:4px;"><b id="division">PLANNING AND INFORMATION<br>SYSTEMS MANAGEMENT UNIT</b></p>
            </div><br>

            <div class="inline">
              <!-- <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                if($row['section'] == "Regional Director (PISMU)" 
                && $row['unit'] == "Chief" 
                && $row['role'] == "chief"
                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief"> -->

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
              <span style="font-size:10.1px;">Chief, Planning and Information</span><br>
              <span style="font-size:10.1px;float:right;margin-top:-3px;padding-right:10px;">Systems Management Unit</span></p>
            </div>

            <div class="below-content">
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

        <li id="righty" style="transform: translateX(48.7em);">
          <div class="level-2 rectangle" style="width: 350px;">
            <div class="panel-header">
              <p style="padding:12px;"><b id="division">REGIONAL ENVIRONMENTAL LABORATORY</b></p>
            </div><br>

            <div class="inline">
              <!-- <img src="data:image/jpeg;base64,<?php foreach($orgchart as $row){
                  if($row['section'] == "Regional Director (REL)" 
                  && $row['unit'] == "Chief" 
                  && $row['role'] == "chief"
                  && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" alt="" id="imgchief"> -->
              
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
              <span style="font-size:10.1px;">Head, Regional Environmental Laboratory</span></p>
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
                            <span style="font-size:20px;">•</span>
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

      <div class="datepick" id="date-pick">
        <p id="legend">Legend:&nbsp;&nbsp;<i class="fa-solid fa-asterisk" style="font-size:11px; margin-bottom: 5px;vertical-align:middle;"></i> - Environmental Monitoring Officers (EnMOs) &nbsp;|&nbsp; <span style="font-size:11px;"><i class="fa-solid fa-circle" style="font-size:6px;vertical-align:middle;"></i></span> - Concurrent Capacity.</p>
        <p id="selected-date"><i style="color:red;">// Select a date to show in this chart. //</i></p>
        <div id="datepick">
          <label for="datepicker">Select a date:</label>
          <input type="date" id="datepicker">
          <button onclick="displayDate()">Confirm</button>
        </div>
      </div>
    </div>
    </div>

    <span id="mark">//Select a date to show in this chart.</span>
  </div>

  <script src="assets/js/landscape-chart-v2.js"></script>
</body>
</html>