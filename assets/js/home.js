let tooltipStyle = document.createElement('style')
if (document.body.getAttribute('dA') == 1) {
  document.getElementById("statusword").innerHTML = "ADMIN ACCESS"
  tooltipStyle.innerHTML = `
    #showadmin{
      display:block;
    }
  `
}else {
  document.getElementById("statusword").innerHTML = "USER ACCESS"
  tooltipStyle.innerHTML = `
    #showuser{
      display:block;
    }
  `
}
document.head.appendChild(tooltipStyle)
