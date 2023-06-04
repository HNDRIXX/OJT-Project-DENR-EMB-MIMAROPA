<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="<?php echo base_url('img/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url('css/delete.css')?>">
    <link rel="icon" href="<?php echo base_url('img/favicon.ico'); ?>" type="image/x-icon">
    <title>Delete</title>
</head>
<body>
    <div class="container">
        <div class="delete-container">
            <?= form_open('delete/'.$id);?>
                <h3>Are you sure you want to delete <br> ( <?= $name ?> )</h3>
                <input type="hidden" name="embid" value="<?= $embid ?>">
                <input type="hidden" name="name" value="<?= $name ?>">
                <input type="hidden" name="division" value="<?= $division ?>">
                <input type="hidden" name="section" value="<?= $section ?>">
                <input type="hidden" name="unit" value="<?= $unit ?>">
                <input type="hidden" name="role" value="<?= $role ?>">
                <input type="hidden" name="enmo" value="<?= $enmo ?>">
                <input type="hidden" name="empstatus" value="<?= $empstatus ?>">
                <br>

                <div class="inline-container">
                    <div class="inline">
                        <i id="icon-content" class="fa fa-calendar" style="font-size: 20px; margin-right: 10px;"></i>
                        <input type="date" name="date" pattern="\d{2}/\d{2}/\d{4}" placeholder="mm/dd/yyyy" id="datepicker" required><br>
                    </div>
                </div><br>

                <div class="inline-container">
                    <div class="inline">
                        <i id="icon-content" class="fa fa-comment" style="font-size: 20px; margin-right: 10px;"></i>
                        <input type="text" name="remarks" placeholder="Enter Remarks" value="" required/><br>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" name="submit" id="submit">DELETE</button>
                
            <?= form_close() ?>
            <button onclick="history.back();" id="cancel">CANCEL</button>
        </div>
    </div>
</body>
</html>