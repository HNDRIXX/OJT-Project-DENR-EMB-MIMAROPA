let canvas = document.getElementById("color-wheel"),
ctx = canvas.getContext("2d"),
width = 400,
height = 165
canvas.width = width
canvas.height = height
colorText = document.querySelectorAll("#text")

let colorTitle = document.querySelectorAll("#colortitle"),
headers = document.querySelectorAll(".panel-header"),
tooltipText = document.querySelectorAll(".tooltiptext"),
tooltipTextTop = document.querySelectorAll(".tooltiptexttop"),
tooltipStyle = document.createElement('style'),
tooltiptopStyle = document.createElement('style'),
headerChange = document.querySelectorAll("#headerColor"),
box = document.getElementById("box"),
moreSidebarContent = document.getElementById("moreSidebarContent"),
gradient = ctx.createLinearGradient(0, 0, width, 0)

gradient.addColorStop(0, "hsl(0, 100%, 50%)")
gradient.addColorStop(0.17, "hsl(60, 100%, 50%)")
gradient.addColorStop(0.34, "hsl(120, 100%, 50%)")
gradient.addColorStop(0.51, "hsl(180, 100%, 50%)")
gradient.addColorStop(0.68, "hsl(240, 100%, 50%)")
gradient.addColorStop(0.85, "hsl(300, 100%, 50%)")
gradient.addColorStop(1, "hsl(0, 100%, 50%)")
ctx.fillStyle = gradient
ctx.fillRect(0, 0, width, height)

canvas.onclick = function(event) {
    var x = event.offsetX
    var y = event.offsetY
    if (x >= 0 && x < width && y >= 0 && y < height) {
        var hue = Math.round(x * 360 / width)
        var saturation = Math.round((height - y) * 100 / height)

        colorTitle.forEach(colorTitle => {
    colorTitle.style.transition = "ease-in-out .3s"
    colorTitle.style.color = "hsl(" + hue + ", 100%, 50%)"
})

headers.forEach(headers => {
    headers.style.background = "hsl(" + hue + ", 100%, 50%)"
})

tooltipText.forEach(tooltipText => {
    tooltipText.style.background = "hsl(" + hue + ", 100%, 50%)"
})

tooltipTextTop.forEach(tooltipTextTop => {
    tooltipTextTop.style.background = "hsl(" + hue + ", 100%, 50%)"
})

box.style.border = "hsl(" + hue + ", 100%, 50%)" + "6px outset"

headerChange.forEach(headerChange => {
    headerChange.style.transition = "ease-in-out .5s"
    headerChange.style.color = "hsl(" + hue + ", 100%, 44%)"
})

tooltipStyle.innerHTML = `
    .tooltip .tooltiptext::after {
    display: none;
    }
`
document.head.appendChild(tooltipStyle)
    }
}

setTimeout(function() {
    var alertEdit = document.getElementById("alert-edit")
    alertEdit.style.opacity = "0"
}, 5000)

function displayDate() {
    const datePicker = document.getElementById("datepicker")
    const selectedDate = new Date(datePicker.value)
    const month = selectedDate.toLocaleString('default', { month: 'long' })
    const year = selectedDate.getFullYear()
    document.getElementById("selected-date").innerHTML = `The Organizational Structure was updated in ${month} ${year}.`
}

var moreShow = document.getElementById("moreShow")
var moreExit = document.getElementById("moreExit")

moreShow.addEventListener("click", function() {
    moreSidebarContent.style.opacity = "1"
    moreSidebarContent.style.display = "block"
    moreExit.style.display = "block"
    moreShow.style.display = "none"
})

moreExit.addEventListener("click", function() {
    moreShow.style.display = "block"
    moreExit.style.display = "none"
    moreSidebarContent.style.opacity = "0"
    moreSidebarContent.style.display = "none"
})

function filterOrgChart() {
    var joCheckbox = document.getElementById("jo-checkbox")
    var permanentCheckbox = document.getElementById("permanent-checkbox")
    var all = document.getElementById("all")
    const element = document.getElementById("headerSub")
    const definedResult = document.getElementById("definedresult")

    var rows = document.querySelectorAll("#orgchart-data div")
    for (var i = 0; i < rows.length; i++) {
    var row = rows[i]

    var status = row.getAttribute("data-division")
    var showRow = true

    if (joCheckbox.checked && status !== "permanent") {
        showRow = false
        element.innerHTML = "PERMANENT EMPLOYEES"
    }
    if (permanentCheckbox.checked && status !== "jo/cso") {
        showRow = false
        element.innerHTML = "JO/CSO EMPLOYEES"
    }
    if (all.checked && status !== "All") {
        showRow = true
        element.innerHTML = "(LANDSCAPE)"
    }

    row.style.display = showRow ? "" : "none"
    }
}

let maximizeButton = document.getElementById("maximizeButton"),
minimizeButton = document.getElementById("minimizeButton"),
sidebarDiv = document.getElementById("sidebar"),
prompt = document.getElementById("prompt"),
changeColor = document.getElementById("greenChangeColor"),
inline = document.getElementById("inline"),
mainChangeColor = document.getElementById("mainChangeColor"),
activeParameter = document.getElementById("active")
document.getElementById("mark").innerHTML = "PWL"
changeColor.addEventListener("click", function() {
    headers.forEach(header => {
        header.style.background = "green"
    })

    box.style.border = "6px green outset"

    headerChange.forEach(headerChange => {
        headerChange.style.color = "green"
    })

    tooltipText.forEach(tooltipText => {
        tooltipText.style.background = "green"
    })

    tooltipTextTop.forEach(tooltipTextTop => {
        tooltipTextTop.style.background = "green"
    })

    colorTitle.forEach(colorTitle => {
        colorTitle.style.color = "#0b570b"
    })

    tooltipStyle.innerHTML = `
        .tooltip .tooltiptext::after {
        border-color: green transparent transparent transparent;
        }
    `
    document.head.appendChild(tooltipStyle)

    minimizeButton.style.color = "green"
    sidebarDiv.style.background = "#1fb11f"
    moreSidebarContent.style.background = "#1fb11f"
    moreShow.style.background = "#1fb11f"
    moreExit.style.background = "#1fb11f"
    activeParameter.style.background = "#1fb11f"
    prompt.style.color = "green"
})

// if((localStorage.getItem("chartblock") != "noblock")) {
//     tooltipText.forEach(tooltipText => {
//     tooltipText.style.position = "relative"
// })}

mainChangeColor.addEventListener("click", function() {
    headers.forEach(headers => {
        headers.style.background = "#5469c4"
    })

    box.style.border = "6px #5469c4 outset"

    headerChange.forEach(headerChange => {
        headerChange.style.color = "#1b2d77"
    })

    tooltipText.forEach(tooltipText => {
        tooltipText.style.background = "#5469c4"
    })

    tooltipTextTop.forEach(tooltipTextTop => {
        tooltipTextTop.style.background = "#5469c4"
    })

    colorTitle.forEach(colorTitle => {
        colorTitle.style.color = "#13256d"
    })

    tooltipStyle.innerHTML = `
        .tooltip .tooltiptext::after {
        border-color: #5469c4 transparent transparent transparent;
        }
    `
    document.head.appendChild(tooltipStyle)

    sidebarDiv.style.background = "#8092e4"
    moreSidebarContent.style.background = "#8092e4"
    moreShow.style.background = "#8092e4"
    moreExit.style.background = "#8092e4"
    activeParameter.style.background = "#8092e4"
    minimizeButton.style.color = "#8092e4"
    prompt.style.color = "#0f1f6e"
})

let showIcon = document.getElementById("morebelow"),
hiddenDiv = document.getElementById("ojt-content"),
contentDiv = document.getElementById("content"),
length = document.getElementById("length"),
v2 = document.getElementById("v2")

maximizeButton.addEventListener("click", function() {
    contentDiv.style.marginLeft = "-500px"
    minimizeButton.style.display = "block"
    maximizeButton.style.display = "none"
    document.body.style.zoom = "72%";
    minimizeButton.style.fontSize = "35px"
    v2.style.left = "0em"
    length.style.display = "none"
    moreSidebarContent.style.transform = "scale(1.3)"
    moreSidebarContent.style.bottom = "40px"
    moreSidebarContent.style.left = "90px"
    
    sidebarDiv.style.width = "0"
    canvas.style.visibility = "hidden"
});

minimizeButton.addEventListener("click", function() {
    contentDiv.style.marginLeft = "70px"
    minimizeButton.style.display = "none"
    maximizeButton.style.display = "block"
    document.body.style.zoom = "100%"
    length.style.display = "block"
    v2.style.left = "4em"
    moreSidebarContent.style.transform = "scale(1.0)"
    moreSidebarContent.style.bottom = "2px"
    moreSidebarContent.style.left = "65px"
    maximizeButton.style.color = "white"

    sidebarDiv.style.width = "70px"
    canvas.style.visibility = "visible"
})

setTimeout(function() {
    var alertEdit = document.getElementById("alert-edit")
    alertEdit.style.opacity = "0"
}, 5100)

let pismuRec = document.getElementById("pismu-rectangle")

pismuRec.addEventListener("mouseover", function hoverIn() {
    document.getElementById("alert-prompt").style.opacity = "1"
    setTimeout(function() {
        document.getElementById("alert-prompt").style.opacity = "0"
        pismuRec.removeEventListener("mouseover", hoverIn);
    }, 5000);
});

function closePrompt() {
    var prompt = document.getElementById("prompt")
    prompt.style.opacity = "0"
}

