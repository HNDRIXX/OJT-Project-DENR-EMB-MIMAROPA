<?php
  $is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : null;

  if ($is_admin != 1) {
    redirect("index");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>OC Control</title>
    <link rel="stylesheet" type="text/css" href="css/controls.css" media="all">
    <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="css/fontawesome-free-5.13.1-web/fontawesome-free-5.13.1-web/css/all.css"> -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="sidebar">
      <img id="logo" alt="" src="img/logo.png" />

      <a href="home"><i class="fa fa-home"></i></a>
      <a class="active"><i class="fa fa-user-plus"></i></a>
      <a href="landscape-chart"><i class="fa-solid fa-sitemap"></i></a>
      <!-- <a href="chart"><i class="fa-solid fa-up-down"></i></a> -->
      <a href="history"><i class="fa-solid fa-clock-rotate-left"></i></a>
    </div>

    <div class="content">
      <div class="container">
        <div id="prompt">
          <?php if($this->session->flashdata('post_added')) :?>
            <?=   '<p id="alert-edit"><img src="img/check.gif" id="check">&nbsp;'.$this->session->flashdata('post_added').'</p>'?>
          <?php endif;?>
        </div>

        <div class="headerContent">
          <h1>ADD EMPLOYEES</h1>
        </div>
        
        <div class="top1">
          <form method="post" name="controlForm" enctype="multipart/form-data"  onsubmit="return checkFileSize();" action="Pages/insert_data"required>
            <div class="inline-container" style="margin-top: 50px;">
              <label>EMB ID</label><br>
              <div class="inline">
                <i id="icon-content" class="fa fa-user" style="margin-right: 5px"></i>
                <input name="embid" type="number" pattern="[0-9]{1,9}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" maxlength="9" placeholder="Enter EMB ID" required>
              </div>
            </div>
            
            <div class="inline-container">
              <label>Name</label><br>
              <div class="inline">
                <i id="icon-content" class="fa fa-user" style="margin-right: 5px"></i>
                <input name="name" type="text" placeholder="Enter Name" required>
              </div>
            </div>
          
            <div class="inline-container">
              <label>Division</label><br>
                <div class="inline">
                <i id="icon-content" class="fa fa-sitemap"></i>
                  <select name="division" id="dvsnSelect" required>
                    <option value="" selected hidden>Please choose division first.</option>
                  </select>
              </div>
            </div>

            <div class="inline-container">
              <label>Section</label><br>
              <div class="inline">
                <i id="icon-content" class="fa fa-building" style="margin-left:-10px; margin-right: 7px;"></i>
                <select name="section" id="sectionSelect" required>
                  <option value="" selected hidden>Please choose division first.</option>
                </select>
              </div>
            </div>

            <div class="inline-container">
              <label>Unit</label><br>
              <div class="inline">
                <i id="icon-content" class="fa fa-users"></i>
                <select name="unit" id="unitSelect" required>
                  <option value="" selected hidden>Please choose section first.</option>
                </select>
              </div>
            </div>

            <div class="inline-container">
              <label>Role</label><br>
              <div class="inline">
                <i id="icon-content" class="fa fa-flag"></i>
                <select name="role" id="roleSelected" required>
                  <option value="" selected hidden>Please choose unit first.</option>
                </select>
              </div>
            </div>

            <div class="inline-container">
              <label style="font-size: 15px;">Environmental Monitoring Officers (EnMOs)</label><br>
              <div class="inline">
                <i id="icon-content" class="fa-solid fa-question" style="font-size: 30px; margin-right: 10px;"></i>
                <select name="enmo" id="enmoSelected" required>
                  <option value="" selected hidden>Choose</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
              </div>
            </div>

            <div class="inline-container">
              <label style="font-size: 15px;">Employee Status</label><br>
              <div class="inline">
                <i id="icon-content" class="fa-solid fa-briefcase" style="font-size: 30px; margin-right: 10px;"></i>
                <select name="employeestatus" id="enmoSelected" required>
                  <option value="" selected hidden>Choose Employee Status</option>
                  <option value="permanent">Permanent</option>
                  <option value="jo/cso">JO/CSO</option>
                </select>
              </div>
            </div>

            <div class="inline-container" id="uploadimage">
              <label style="font-size: 15px;">Upload</label><br>
              <i style="font-size:11px; margin-left:-3.5em; width:15vw;">NOTE: Maximum file size: 2mb</i><br>
              <div class="inline">
                <i id="icon-content" class="fa-solid fa-image" style="font-size: 30px; margin-right: 10px;"></i>
                <input type="file" name="image" accept="image/*" maxlength="2097152" />
              </div>
            </div>

            <div class="inline-container">
            <label>Date</label><br>
                <div class="inline">
                    <i id="icon-content" class="fa fa-calendar" style="font-size: 30px; margin-right: 10px;"></i>
                    <input type="date" name="date" pattern="\d{2}/\d{2}/\d{4}" placeholder="mm/dd/yyyy" id="datepicker"  required><br>
                </div>
            </div>

            <input type="hidden" name="remarks" value="New Added Employee" required/><br>

            <button id="submit">ADD</button>
          </form>
        </div>
        </div>
      </div>
    </div>
  
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="assets/js/control.js"></script>
</body>
</html>

