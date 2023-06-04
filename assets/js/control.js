var subjectObject = {
    "Regional Director": {
        "Chief": ["Chief"],

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
    let divisionSel = document.getElementById("dvsnSelect"),
    sectionSel = document.getElementById("sectionSelect"),
    unitSel = document.getElementById("unitSelect")

    for (var x in subjectObject) {
        divisionSel.options[divisionSel.options.length] = new Option(x, x)
    }

    divisionSel.onchange = function() {
        unitSel.length = 1;
        sectionSel.length = 1;
        for (var y in subjectObject[this.value]) {
            sectionSel.options[sectionSel.options.length] = new Option(y, y);
        }
    }

    sectionSel.onchange = function() {
        unitSel.length = 1;
        var z = subjectObject[divisionSel.value][this.value];
        for (var i = 0; i < z.length; i++) {
            unitSel.options[unitSel.options.length] = new Option(z[i], z[i]);
        }
    }
}


function checkFileSize() {
    let input = document.querySelector('input[type="file"]'),
    maxSize = input.getAttribute('maxlength')

    if (input.files[0].size > maxSize) {
        alert('The file size exceeds the maximum limit.\nLIMIT IS 2 MB')
        return false
    }
    
    return true
}

setTimeout(function() {
    let alertEdit = document.getElementById("alert-edit")
    alertEdit.style.opacity = "0"
}, 5000);

$('#unitSelect').change(function() {
    if ($('#sectionSelect').val() == "Regional Director (ORD)" || 
        $('#sectionSelect').val() == "Regional Director (PISMU)" || 
        $('#sectionSelect').val() == "Regional Director (REL)" || 
        $('#dvsnSelect').val() == "Finance and Administrative" ){
    $('#roleSelected').find('option').remove().end()

    if ($('#unitSelect').val() == "Chief" || $('#unitSelect').val() == "chief"){
        $('#roleSelected').append('<option value="" disabled selected hidden>Choose Role</option><option value="chief">Chief</option>')
    }else 
        $('#roleSelected').append('<option value="" disabled selected hidden>Choose Role</option><option value="employee">Employee</option>')
    }

    if ($('#dvsnSelect').val() == "Finance and Administrative" && $('#unitSelect').val() == "Record Mgmt. & Documents Control" || $('#dvsnSelect').val() == "Finance and Administrative" && $('#unitSelect').val() == "Human Resources Management and Development" || $('#dvsnSelect').val() == "Finance and Administrative" && $('#unitSelect').val() == "Property & General Services" || $('#sectionSelect').val() == "Administrative" && $('#unitSelect').val() == "N/A"
    || $('#sectionSelect').val() == "Water and Air Quality Monitoring" && $('#unitSelect').val() == "N/A" || $('#sectionSelect').val() == "Ambient Monitoring and Technical Services" && $('#unitSelect').val() == "N/A" || $('#sectionSelect').val() == "Chemicals and Hazardous Waste Monitoring" && $('#unitSelect').val() == "N/A"
    || $('#sectionSelect').val() == "Environmental Impact Assessment" && $('#unitSelect').val() == "N/A"
    || $('#sectionSelect').val() == "Chemical and Hazardous Wastes Permitting" && $('#unitSelect').val() == "N/A"
    || $('#sectionSelect').val() == "Air and Water Permitting Section" && $('#unitSelect').val() == "N/A"){
    $('#roleSelected').find('option').remove().end()
    $('#roleSelected').append('<option value="" disabled selected hidden>Choose Role</option><option value="chief">Chief</option><option value="employee">Employee</option>')
    }
})

$('#sectionSelect').change(function() {
    $('#roleSelected').find('option').remove().end()

    let selectedValue = $('#dvsnSelect').val(), 
    sectionValue = $('#sectionSelect').val(),
    uploadImage = document.getElementById("uploadimage")

    if($('#sectionSelect').val == "chief" || $('#sectionSelect').val() == "Chief")
        uploadImage.style.display = "block"
    else uploadImage.style.display = "none"
    

    if ($('#sectionSelect').val() == "chief" || $('#sectionSelect').val() == "Chief"){
    $('#roleSelected').append('<option value="" disabled selected hidden>Choose Role</option><option value="chief">Chief</option>');
    }else
    $('#roleSelected').append('<option value="" disabled selected hidden>Choose Role</option><option value="employee">Employee</option>');
})