<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="<?php echo base_url('img/favicon.ico'); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('img/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url('css/edit.css')?>" medial="all">
    <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
    <title>Edit</title>
    <script type="text/javascript">
        var subjectObject = {
        
        "Regional Director": {
            "Chief": [
                "Chief"],
    
            "Regional Director (ORD)": [
                "Regional Executive Assistant",
                "Technical Staff",
                "Secretary",
                "Driver"],
            
            "Regional Director (Legal Unit)": [
                "Chief",
                "Legal Staff"],
    
            "Regional Director (REDI)": [
                "Chief",
                "GAD/REEIU Staff"],
    
    
            "Regional Director (PISMU)": [
                "Chief",
                "Planning Staff", 
                "Management Information Systems"],
            
            "Regional Director (REL)": [
                "Chief",
                "Laboratory Staff"],
    
        },
    
        "Finance and Administrative": {
            "Chief": ["N/A"],
            "Assistant Division Chief, Finance and Administrative Division": ["Chief", "Accounting Unit", "Cashier Unit", "Budget Unit", "Record Mgmt. & Documents Control"],
            "Administrative": ["N/A", "Human Resources Management and Development", "Property & General Services"],
        },
    
        "Environmental Monitoring and Enforcement": {
            "Chief": ["N/A"],
            "Assistant Division Chief": ["N/A"],
            "Water and Air Quality Monitoring": ["N/A"],
            "Support Staff": ["N/A"],
            "Ecological Solid Waste Management": ["N/A"],
            "Ambient Monitoring and Technical Services": ["N/A"],
            "Chemicals and Hazardous Waste Monitoring": ["N/A"],
        },
    
        "Clearance and Permitting": {
            "Chief": ["N/A"],
            "Environmental Impact Assessment": ["N/A"],
            "Chemical and Hazardous Wastes Permitting": ["N/A"],
            "Air and Water Permitting Section": ["N/A"],
        },
        
        "Occidental Mindoro": {
            "Chief": ["N/A"],
            "Support Staff": ["N/A"],
            "CENRO, San Jose": ["N/A"],
            "CENRO, Sablayan": ["N/A"],
        },
    
        "Oriental Mindoro": {
            "Chief": ["N/A"],
            "Technical Staff": ["N/A"],
            "CENRO, Roxas": ["N/A"],
            "CENRO, Soccoro": ["N/A"],
            "Support Staff": ["N/A"],
        },
    
        "Marinduque": {
            "Chief": ["N/A"],
            "Admin Technical Staff": ["N/A"],
        },
    
        "Romblon": {
            "Chief": ["N/A"],
            "Technical Staff": ["N/A"],
            "Support Staff": ["N/A"],
        },
    
        "Palawan": {
            "Chief": ["N/A"],
            "Technical Staff": ["N/A"],
            "Support Staff": ["N/A"],
            "CENRO, Taytay": ["N/A"],
            "CENRO, Roxas": ["N/A"],
            "CENRO, PPC": ["N/A"],
            "CENRO, Brooke's Pt.": ["N/A"],
            "CENRO, Coron": ["N/A"],
            "CENRO, Quezon": ["N/A"],
        },  
    }
    
    window.onload = function() {
        var divisionSel = document.getElementById("dvsnSelect");
        var sectionSel = document.getElementById("sectionSelect");
        var unitSel = document.getElementById("unitSelect");
        for (var x in subjectObject) {
            divisionSel.options[divisionSel.options.length] = new Option(x, x);
        }
        divisionSel.onchange = function() {
            //empty Chapters- and Topics- dropdowns
            unitSel.length = 1;
            sectionSel.length = 1;
            //display correct values
            for (var y in subjectObject[this.value]) {
            sectionSel.options[sectionSel.options.length] = new Option(y, y);
            }
        }
        sectionSel.onchange = function() {
            //empty Chapters dropdown
            unitSel.length = 1;
            //display correct values
            var z = subjectObject[divisionSel.value][this.value];
            for (var i = 0; i < z.length; i++) {
            unitSel.options[unitSel.options.length] = new Option(z[i], z[i]);
            }
        }
    }
</script>
</head>
<body>
    <div class="container">
        <div class="headerContent">
            <h1>EDIT EMPLOYEE</h1>
        </div>

        <div class="edit-container">
            <form method="post" action="<?php base_url(). 'edit/'.$id ?>" enctype="multipart/form-data" onsubmit="return checkFileSize();">
                <a href="javascript:history.back()"><i class="fa-solid fa-xmark"></i></a>

                <div class="inline-container" style="margin-top: 20px;">
                    <label>EMB ID</label><br>
                    <div class="inline">
                    <i id="icon-content" class="fa fa-user"></i>
                        <input type="hidden" name="embid" value="<?= $embid ?>"/>
                        <input value="EMBR4B - <?= $embid ?>" id="readinput" readonly/><br>
                    </div>
                </div>

                <div class="inline-container">
                    <label>Name</label><br>
                    <div class="inline">
                    <i id="icon-content" class="fa fa-user"></i>
                        <input type="text" name="name" placeholder="Enter Name" value="<?= $name ?>"/><br>
                    </div>
                </div>
                
                <div class="inline-container">
                    <label>Division</label><br>
                        <div class="inline">
                        <i id="icon-content" class="fa fa-sitemap"></i>
                        <select name="division" id="dvsnSelect" required>
                            <option value="<?= $division ?>" selected hidden>Please select division first.</option>
                            <option value="<?= $division ?>" selected hidden><?= $division ?></option>
                        </select>
                    </div>
                </div>

                <div class="inline-container">
                    <label>Section</label><br>
                    <div class="inline">
                        <i id="icon-content" class="fa fa-building"></i>
                        <select name="section" id="sectionSelect" required>
                            <option value="<?= $section ?>" hidden>Please select division first.</option>
                            <option value="<?= $section ?>" selected hidden><?= $section ?></option>
                        </select>
                    </div>
                </div>

                <div class="inline-container">
                <label>Unit</label><br>
                <div class="inline">
                    <i id="icon-content" class="fa fa-users"></i>
                    <select name="unit" id="unitSelect" required>
                        <option value="<?= $unit ?>" hidden>Please select section first.</option>
                        <option value="<?= $unit ?>"  selected hidden><?= $unit ?></option>
                    </select>
                </div>
                </div>

                <div class="inline-container">
                <label>Role</label><br>
                    <div class="inline">
                        <i id="icon-content" class="fa fa-flag"></i>
                        <select name="role" id="roleSelected" required>
                            <option value="<?= $role ?>" hidden>Please select unit first.</option>
                            <option value="<?= $role ?>"  selected hidden><?= $role ?></option>
                        </select>
                    </div>
                </div>

                <div class="inline-container">
                <label style="font-size: 15px;">Environmental Monitoring Officers (EnMOs)</label><br>
                <div class="inline">
                    <i id="icon-content" class="fa-solid fa-question" style="font-size: 30px; margin-right: 10px;"></i>
                    <select name="enmo" id="enmoSelected" required>
                        <option value="<?= $enmo ?>" hidden>Choose</option>
                        <option value="<?= $enmo ?>"  selected hidden><?= $enmo ?></option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                </div>

                <div class="inline-container">
                    <label>Employee Title</label><br>
                    <div class="inline">
                    <i id="icon-content" class="fa fa-user"></i>
                        <input type="text" name="emptitle" placeholder="Enter Employee Title" value="<?= $emptitle ?>"/><br>
                    </div>
                </div>

                <div class="inline-container">
                <label style="font-size: 15px;">Employee Status</label><br>
                <div class="inline">
                    <i id="icon-content" class="fa-solid fa-briefcase" style="font-size: 30px; margin-right: 10px;"></i>
                    <select name="empstatus" id="enmoSelected" required>
                    <option value="<?= $empstatus ?>" hidden>Choose</option>
                    <option value="<?= $empstatus ?>"  selected hidden><?= $empstatus ?></option>
                    <option value="permanent">Permanent</option>
                    <option value="jo/cso">JO/CSO</option>
                    </select>
                </div>
                </div>

                <div class="inline-container" id="uploadimage" style="color: black;">
                <label style="font-size: 15px;">Upload<br><i style="font-size:11px; margin-left:-2.6em; width:15vw;">NOTE: Maximum file size: 2mb</i></label><br>
                <div class="inline">
                    <i id="icon-content" class="fa-solid fa-image" style="font-size: 30px; margin-right: 10px;"></i>
                    <input type="file" name="img" accept="image/*" maxlength="2097152" />
                    <input type="hidden" name="imgdefault" value="<?= $img ?>" />
                </div>
                </div>

                <div class="inline-container">
                <label>Swap List Position</label><br>
                    <div class="inline">
                        <i id="icon-content" class="fa fa-right-left"></i>
                        <select name="swap" id="roleSelected">
                            <option value="" selected>None</option>
                            <?php 
                                foreach($orgchartget as $row) {
                                    if ($row['division'] == $division &&
                                        $row['section'] == $section  &&
                                        $row['unit'] == $unit &&
                                        $row['name'] != $name) {?>
                                            <option value="<?= $row['id'] ?>"><?= $row['name']; ?></option>
                                    <?php }
                                }     
                            ?>
                        </select>
                    </div>
                </div>

                <div class="inline-container">
                <label>Date</label><br>
                    <div class="inline">
                        <i id="icon-content" class="fa fa-calendar"></i>
                        <input type="date" name="date" pattern="\d{2}/\d{2}/\d{4}" placeholder="mm/dd/yyyy" id="datepicker" required><br>
                    </div>
                </div>

                <div class="inline-container">
                <label>Remarks</label><br>
                    <div class="inline">
                        <i id="icon-content" class="fa fa-comments"></i>
                        <input type="text" name="remarks" placeholder="Enter Remarks" value="" required/><br>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?= $id ?>">

                <button type="submit" name="submit" id="submit">UPDATE</button>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/editfooter.js"></script>
</html>