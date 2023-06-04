<?php session_destroy(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/index.css" media="all">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <title>OC Login</title>
</head>
<body>
  <div class="content">
    <img draggable="false" id="denrlogo" alt="" src="<?php echo site_url('img/denr1.jpg'); ?>" />

    <div class="main-content">
      <div style="left:5em;position:absolute;">
        <span id="mainword">4BHive</span><br>
        <span id="sameword">&nbsp;On The Job Training System Project</span>
        <br><br>

        <?= form_open('Pages/authenticate');?>
            <div class="form-group">
                <i class="fa-solid fa-lock" style="margin-right:12px;margin-bottom:7px;"></i><input type="number" pattern="[0-9]{1,9}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2"  placeholder="Enter code"  name="codeinput" id="username" required><br>
                <button type="submit" class="btn btn-primary">ENTER</button>
            </div>
        <?= form_close(); ?>
    </div>
  </div>
</body>
</html>