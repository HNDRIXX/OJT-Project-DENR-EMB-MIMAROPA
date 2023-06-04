function checkFileSize() {
    let input = document.querySelector('input[type="file"]'),
    maxSize = input.getAttribute('maxlength')

    if (input.files[0].size > maxSize) {
        alert('The file size exceeds the maximum limit.\nLIMIT IS 2 MB')
        return false
    }

    return true
}

$('#unitSelect').change(function() {
  if ($('#sectionSelect').val() == "Regional Director (ORD)" || 
      $('#sectionSelect').val() == "Regional Director (REL)" || 
      $('#dvsnSelect').val() == "Finance and Administrative" ){
      $('#roleSelected').find('option').remove().end()
  
      if ($('#unitSelect').val() == "Chief" || $('#unitSelect').val() == "chief")
        $('#roleSelected').append('<option value="" disabled selected hidden>Choose Role</option><option value="chief">Chief</option>')
      else
        $('#roleSelected').append('<option value="" disabled selected hidden>Choose Role</option><option value="employee">Employee</option>')
  }
  
  if ($('#unitSelect').val() == "Management Information Systems" || $('#dvsnSelect').val() == "Finance and Administrative" && $('#unitSelect').val() == "Record Mgmt. & Documents Control" || $('#dvsnSelect').val() == "Finance and Administrative" && $('#unitSelect').val() == "Human Resources Management and Development" || $('#dvsnSelect').val() == "Finance and Administrative" && $('#unitSelect').val() == "Property & General Services" || $('#sectionSelect').val() == "Administrative" && $('#unitSelect').val() == "N/A"
  || $('#sectionSelect').val() == "Water and Air Quality Monitoring" && $('#unitSelect').val() == "N/A" || $('#sectionSelect').val() == "Ambient Monitoring and Technical Services" && $('#unitSelect').val() == "N/A" || $('#sectionSelect').val() == "Chemicals and Hazardous Waste Monitoring" && $('#unitSelect').val() == "N/A"
  || $('#sectionSelect').val() == "Environmental Impact Assessment" && $('#unitSelect').val() == "N/A"
  || $('#sectionSelect').val() == "Chemical and Hazardous Wastes Permitting" && $('#unitSelect').val() == "N/A"
  || $('#sectionSelect').val() == "Air and Water Permitting Section" && $('#unitSelect').val() == "N/A"
  || $('#sectionSelect').val() == "Ecological Solid Waste Management" && $('#unitSelect').val() == "N/A"
  || $('#sectionSelect').val() == "Assistant Division Chief, Finance and Administrative Division" && $('#unitSelect').val() == "Accounting Unit"
  || $('#sectionSelect').val() == "Assistant Division Chief, Finance and Administrative Division" && $('#unitSelect').val() == "Cashier Unit"
  || $('#sectionSelect').val() == "Assistant Division Chief, Finance and Administrative Division" && $('#unitSelect').val() == "Budget Unit"
  ){
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

  if ($('#sectionSelect').val() == "chief" || $('#sectionSelect').val() == "Chief")
    $('#roleSelected').append('<option value="" disabled selected hidden>Choose Role</option><option value="chief">Chief</option>');
  else 
    $('#roleSelected').append('<option value="" disabled selected hidden>Choose Role</option><option value="employee">Employee</option>');
})