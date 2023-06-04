<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/floorplan-chief.css" media="all">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <title>OC Floorplan</title>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <img id="logo" alt="" src="img/logo.png" />

    <a href="home"><i class="fa fa-home"></i></a>
    <a href="floorplan-pismu"><i class="fa-sharp fa-solid fa-map-location-dot"></i></a>
    <a class="active" id="active"><i class="fa-solid fa-users"></i></a>
    <!-- <a href="frlogs"><i class="fa-solid fa-clock-rotate-left"></i></a> -->
  </div>

  <a href="floorplan-ord"><i id="right" class="fa-solid fa-chevron-right"></i></a>

  <div class="content" id="content">
    <div class="container" id="container">
        <div class="inline" id="inline">
            <img src="data:image/jpeg;base64, <?php
                foreach($orgchart as $row){
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
                        <?= $row['name']?>
                <?php }}?></b><br>
                Regional Director</p>
        </div>

        <div class="row" style="margin-top:3em;">
            <div class="col-sm-6">
                <div class="inline" id="inline">
                    <img src="data:image/jpeg;base64, <?php
                        foreach($orgchart as $row){
                            if($row['section'] == "Chief" 
                                && $row['division'] == "Finance and Administrative" 
                                && $row['role'] == "chief"
                                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">                
                        
                            <?php 
                                foreach($orgchart as $row){
                                    if($row['section'] == "Chief" 
                                    && $row['division'] == "Finance and Administrative" 
                                    && $row['role'] == "chief" 
                                    && $row['showhide'] == "1"){?>
                            
                            <span id="status-container" fr-name="<?php echo $row['frname']; ?>">
                                <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                            </span>

                            <p><b><?= $row['name']?>
                        <?php }}?></b><br>
                        Chief, Finance and <br>Administrative</p>
                </div><hr>

                <div class="inline" id="inline">
                    <img src="data:image/jpeg;base64, <?php
                        foreach($orgchart as $row){
                            if($row['section'] == "Chief" 
                                && $row['division'] == "Clearance and Permitting" 
                                && $row['role'] == "chief"
                                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">                
                        
                            <?php 
                                foreach($orgchart as $row){
                                    if($row['section'] == "Chief" 
                                    && $row['division'] == "Clearance and Permitting" 
                                    && $row['role'] == "chief" 
                                    && $row['showhide'] == "1"){?>
                                
                            <span id="status-container" fr-name="<?php echo $row['frname']; ?>">
                                <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                            </span>

                            <p><b><?= $row['name']?>
                        <?php }}?></b><br>
                        Chief, Clearance and <br>Permitting Division</p>
                </div><hr>

                <div class="inline" id="inline">
                    <img src="data:image/jpeg;base64, <?php
                        foreach($orgchart as $row){
                            if($row['section'] == "Regional Director (ORD)" 
                                && $row['division'] == "Regional Director" 
                                && $row['unit'] == "Regional Executive Assistant"
                                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">                
                        
                            <?php 
                                foreach($orgchart as $row){
                                    if($row['section'] == "Regional Director (ORD)" 
                                    && $row['division'] == "Regional Director" 
                                    && $row['unit'] == "Regional Executive Assistant" 
                                    && $row['showhide'] == "1"){?>
                            
                            <span id="status-container" fr-name="<?php echo $row['frname']; ?>">
                                <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                            </span>

                            <p><b><?= $row['name']?>
                        <?php }}?></b><br>
                        Regional Executive <br>Assistant</p>
                </div><hr>

                <div class="inline" id="inline">
                    <img src="data:image/jpeg;base64, <?php
                        foreach($orgchart as $row){
                            if($row['section'] == "Regional Director (PISMU)" 
                                && $row['division'] == "Regional Director" 
                                && $row['unit'] == "Chief"
                                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">     

                            <?php 
                                foreach($orgchart as $row){
                                    if($row['section'] == "Regional Director (PISMU)" 
                                    && $row['division'] == "Regional Director" 
                                    && $row['unit'] == "Chief" 
                                    && $row['showhide'] == "1"){?>
                                    
                            <span id="status-container" fr-name="<?php echo $row['frname']; ?>">
                                <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                            </span>

                            <p><b><?= $row['name']?>
                        <?php }}?></b><br>
                        Chief, Planning and Information <br>Systems Management Unit</p>
                </div>
                
            </div>

            <div class="col-sm-6">
                <div class="inline" id="inline">
                    <img src="data:image/jpeg;base64, <?php
                        foreach($orgchart as $row){
                            if($row['section'] == "Chief" 
                                && $row['division'] == "Environmental Monitoring and Enforcement" 
                                && $row['role'] == "chief"
                                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief"> 

                            <?php 
                                foreach($orgchart as $row){
                                    if($row['section'] == "Chief" 
                                    && $row['division'] == "Environmental Monitoring and Enforcement" 
                                    && $row['role'] == "chief" 
                                    && $row['showhide'] == "1"){?>

                            <span id="status-container" fr-name="<?php echo $row['frname']; ?>">
                                <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                            </span>

                            <p><b><?= $row['name']?>
                        <?php }}?></b><br>
                        Chief, Environmental Monitoring<br>and Enfocement Division</p>
                </div><hr>

                <div class="inline" id="inline" style="margin-top:-1.5em;">
                    <img src="data:image/jpeg;base64, <?php
                        foreach($orgchart as $row){
                            if($row['section'] == "Regional Director (Legal Unit)" 
                                && $row['division'] == "Regional Director" 
                                && $row['unit'] == "Chief"
                                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">                
                        
                            <?php 
                                foreach($orgchart as $row){
                                    if($row['section'] == "Regional Director (Legal Unit)" 
                                    && $row['division'] == "Regional Director" 
                                    && $row['unit'] == "Chief" 
                                    && $row['showhide'] == "1"){?>

                            <span id="status-container" fr-name="<?php echo $row['frname']; ?>">
                                <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                            </span>

                            <p><b><?= $row['name']?>
                        <?php }}?></b><br>
                        Chief, Legal Unit</p>
                </div><hr>
                
                <div class="inline" id="inline">
                    <img src="data:image/jpeg;base64, <?php
                        foreach($orgchart as $row){
                            if($row['section'] == "Regional Director (REDI)" 
                                && $row['division'] == "Regional Director" 
                                && $row['unit'] == "Chief"
                                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">                

                            <?php 
                                foreach($orgchart as $row){
                                    if($row['section'] == "Regional Director (REDI)" 
                                    && $row['division'] == "Regional Director" 
                                    && $row['unit'] == "Chief" 
                                    && $row['showhide'] == "1"){?>

                                    <span id="status-container" fr-name="<?php echo $row['frname']; ?>">
                                        <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                                    </span>

                            <p><b><?= $row['name']?>
                        <?php }}?></b><br>
                        Chief, Regional Environmental <br>Education and Information Unit</p>
                </div><hr>

                <div class="inline" id="inline">
                    <img src="data:image/jpeg;base64, <?php
                        foreach($orgchart as $row){
                            if($row['section'] == "Regional Director (REL)" 
                                && $row['division'] == "Regional Director" 
                                && $row['unit'] == "Chief"
                                && $row['showhide'] == "1"){ ?> <?= $row['img'] ?> <?php }} ?>" id="imgchief">    

                            <?php 
                                foreach($orgchart as $row){
                                    if($row['section'] == "Regional Director (REL)" 
                                    && $row['division'] == "Regional Director" 
                                    && $row['unit'] == "Chief" 
                                    && $row['showhide'] == "1"){?>

                                <span id="status-container" fr-name="<?php echo $row['frname']; ?>">
                                    <i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>
                                </span>

                            <p><b><?= $row['name']?>
                        <?php }}?></b><br>
                        Chief, Regional Environmental <br>Laboratory</p>
                </div>
            </div>

            <div id="downprompt">
                <b>Regional Director and<br>Division Chiefs</b>
            </div>
        </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="assets/js/floorplan-list.js"></script>
</body>
</html>