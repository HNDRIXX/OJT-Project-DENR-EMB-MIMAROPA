<?php
  $is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/floorplan-technical.css" media="all">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <title>OC Floorplan</title>
  <script>
    if (<?= $is_admin ?>){
      const tooltipStyle = document.createElement('style')
      tooltipStyle.innerHTML = `
        .btnclick, .dropdown{
          display: unset;
        }

        #content{
          margin-top:-2.1em;
        }
      `
      document.head.appendChild(tooltipStyle)
    }
  </script>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <img id="logo" alt="" src="img/logo.png" />

    <a href="home"><i class="fa fa-home"></i></a>
    <a class="active" id="active"><i class="fa-sharp fa-solid fa-map-location-dot"></i></a>
    <a href="floorplan-chief"><i class="fa-solid fa-users"></i></a>
    <!-- <a href="frlogs"><i class="fa-solid fa-clock-rotate-left"></i></a> -->
  </div>

  <a href="floorplan-fad"><i id="left" class="fa-solid fa-chevron-left"></i></a>
  <a href="floorplan-records"><i id="right" class="fa-solid fa-chevron-right"></i></a>

  <div class="dropdown">
    <i class="fa-solid fa-users-viewfinder" data-toggle="dropdown" id="dropdownicon"></i>

    <div class="dropdown-menu" id="dropdown-menu">
      <span id="dropdown-title">ADD EMPLOYEE BLOCK</span>
      <div id="otherhead">
        <p id="noblock">Walang Laman</p>
          <?php 
            foreach($orgchart as $row){
            $dv = $row['division'];
            if($row['block'] == "noblock" && $row['primarywork'] == "1" &&
               $dv != "Oriental Mindoro" && $dv != "Marinduque" && $dv != "Occidental Mindoro"
               && $dv != "Romblon" && $dv != "Palawan"){ ?>
              <div id="yesblock" style="margin-bottom:1em;">
                <?php if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>
                
                <span style="font-size:13px;"><?= $row['name'] ?></span>
                <button type="button" title="Add Block" class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>
              </div>
          <?php }} ?>
        <p style="margin-bottom: 1em;"></p>
      </div>
    </div>
  </div>

  <div class="content" id="content">
    <div class="container" id="container">
      <!-- <div id="prompt">
        <i class="fa-solid fa-circle-xmark" onClick="closePrompt()" style="font-size: 20px;"></i>
        <h4>Maintain the page in 100% zoom to see the designated position.</h4>
      </div> -->

      <?php if($this->session->flashdata('post_block')) :?>
          <?= '<p id="alert-edit"><img src="img/check.gif" id="check">&nbsp;'.$this->session->flashdata('post_block').'</p>'?>
      <?php endif;?>

      <div class="modal-content" id="contentfloor" style="outline:none;border:none;">
        <div href="" id="eswmhead1" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "eswmblock1" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?>     
        </div>

        <div href="" id="eswmhead2" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "eswmblock2" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="eswmhead3" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "eswmblock3" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?>  
        </div>

        <div href="" id="eswmhead4" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "eswmblock4" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?>  
        </div>

        <div href="" id="emedhead1" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock1" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?>   
        </div>

        <div href="" id="emedhead2" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock2" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead3" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock3" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead4" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock4" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead5" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock5" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead6" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock6" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead7" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock7" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead8" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock8" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead9" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock9" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead10" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock10" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead11" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock11" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead12" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock12" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead13" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock13" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="emedhead14" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "emedblock14" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <!-- CPD HEAD -->
        <div href="" id="cpdhead2" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock2" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead3" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock3" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead4" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock4" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead5" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock5" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead6" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock6" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead7" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock7" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead8" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock8" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead9" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock9" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead10" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock10" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead11" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock11" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead12" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock12" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead13" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock13" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead14" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock14" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead15" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock15" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead16" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock16" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext" style="right:4em;">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead17" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock17" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext" style="right:3.2em;">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="cpdhead18" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "cpdblock18" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="lglhead1" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "lglblock1" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext" style="right:3.2em;">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="lglhead2" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "lglblock2" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext" style="right:3.5em;">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>

        <div href="" id="lglhead3" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "lglblock3" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext" style="right:3.5em;">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>
        
        <div href="" id="lglhead4" class="ttip">
          <?php $highest_id=0; 
            foreach($orgchart as $row){
              if($row['block'] == "lglblock4" && $row['showhide'] == "1"){ 
                if($row['img'] == null || !$row['img']){?>
                  <img src="img/userdefault.png" alt="" draggable="false">
                  <?php } else { ?>
                  <img src="data:image/jpeg;base64, <?= $row['img'] ?>" alt="" draggable="false">
                <?php } ?>

                <?php foreach($fr as $frow) {
                  if ($row['frname'] == $frow['empName']){
                    $highest_id = max($highest_id, $frow['id']);
                  }
                }?>

                <span id="status-container" high-date="<?= $highest_id ?>" fr-name="<?php echo $row['frname']; ?>" >
                  <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                </span>

                <span class="ttiptext" style="right:3.5em;">
                  <?= $row['name'] ?>
                  <button class="btnclick" data-name="<?= $row['name'] ?>" data-id="<?= $row['id'] ?>"  data-toggle="modal" data-target="#myModal">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </button><br>
                </span>
          <?php }} ?> 
        </div>
      </div>

      <img id="technicalimg" src="https://i.ibb.co/g4Q3nf8/technical.jpg" alt="" draggable="false">

      <div id="legendprompt">
        <i class="fa-solid fa-square" style="color:#b53ce6;"></i> - ESWM&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-square" style="color:#f0525f;"></i> - EMED&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-square" style="color:#86f377;"></i> - CPD&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-square" style="color:#ebee54;"></i> - Legal
      </div>

      <div id="downprompt">
        <!-- <i class="fa-solid fa-circle-xmark" onClick="closeDownPrompt()" style="font-size: 20px;"></i> -->
        <h5><b>Technical and Legal</b></h5>
      </div>