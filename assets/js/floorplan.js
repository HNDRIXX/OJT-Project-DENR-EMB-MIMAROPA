$(document).ready(function() {
  setInterval(updateStatusFr, 750)
})

  function updateStatusFr() {
    $.ajax({
      url: 'Pages/updateStatusFr',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        $('span#status-container').each(function() {
          var high = 0,
              highest = $(this).attr('high-date'),
              frname = $(this).attr('fr-name'),
              container = $(this)
          container.empty()
          let tzone = "matchingRow.authTime"
          var totalRows = 0
  
          $.each(data, function(i, row) {
            if (row.empName == frname) {
              high = Math.max(high, row.id)
              totalRows++
            }
          })
          
          var est = high.toString(),
           matchingRow = data.find(function(row) {
            return row.id === est
          })

          if (totalRows === 0) {
            container.append('<i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>')
          } else if (moment(matchingRow.authTime, 'HH:mm:ss.SSSSSS').isSameOrAfter(moment('16:00:00.000000', 'HH:mm:ss.SSSSSS'))) {
            container.append('<i class="fa-solid fa-circle fa-beat-fade" style="color:red;"></i>')
          } 
            else if (totalRows % 2 === 0) {
            container.append('<i class="fa-solid fa-circle fa-beat-fade" style="color:red;"></i>')
          } else if (totalRows % 2 !== 0) {
            container.append('<i class="fa-solid fa-circle fa-beat-fade" style="color:#29e029;"></i>')
          } else {
            container.append('<i class="fa-solid fa-circle fa-beat-fade" style="color:gray;"></i>')
          }
        })
      },
      error: function() {
        alert('Error fetching data from server.');
        location.reload();
      }
    });
  }
  
    setTimeout(function() {
      var alertBlock = document.getElementById("alert-edit")
      alertBlock.style.opacity = "0"
    }, 3000)

    const checkboxes = document.querySelectorAll('input[type="radio"]')
		let lastChecked
		function handleCheck(e) {
			if(this.checked) {
				if(lastChecked) {
					lastChecked.checked = false;
				}
				lastChecked = this
			}
		}

		checkboxes.forEach(checkbox => checkbox.addEventListener('click', handleCheck))

    var pismuLeft = document.getElementById("pismuleft"),
        recordsLeft = document.getElementById("recordsleft"),
        recordsRight = document.getElementById("recordsright"),
        technicalLeft = document.getElementById("technicalleft"),
        technicalRight = document.getElementById("technicalright"),
        fadLeft = document.getElementById("fadleft"),
        fadRight = document.getElementById("fadright"),
        ordLeft = document.getElementById("ordleft"),
        ordRight = document.getElementById("ordright"),
        recordsBlock = document.getElementById("recordsblock"),
        pismuBlock = document.getElementById("pismublock"),
        technicalBlock = document.getElementById("technicalblock"),
        fadBlock = document.getElementById("fadblock"),
        ordBlock = document.getElementById("ordblock"),
        content = document.getElementById("container"),
        links = document.getElementsByClassName("btnclick")

    pismuLeft.addEventListener("click", function() {
      pismuBlock.style.display = "none"
      recordsBlock.style.display = "block"
    })

    recordsRight.addEventListener("click", function() {
      pismuBlock.style.display = "block"
      recordsBlock.style.display = "none"
    })

    recordsLeft.addEventListener("click", function() {
      technicalBlock.style.display = "block"
      recordsBlock.style.display = "none"
    })

    technicalLeft.addEventListener("click", function() {
      fadBlock.style.display = "block"
      technicalBlock.style.display = "none"
    })

    technicalRight.addEventListener("click", function() {
      recordsBlock.style.display = "block"
      technicalBlock.style.display = "none"
    })

    fadLeft.addEventListener("click", function() {
      fadBlock.style.display = "none"
      ordBlock.style.display = "block"
    })

    fadRight.addEventListener("click", function() {
      fadBlock.style.display = "none"
      technicalBlock.style.display = "block"
    })

    ordRight.addEventListener("click", function() {
      ordBlock.style.display = "none"
      fadBlock.style.display = "block"
    })

    function checkFullScreen() {
        if (window.innerHeight == screen.height) {
            content.style.marginTop = "60px"
        } else {
            content.style.marginTop = "0px"
        }
    }
    checkFullScreen()
    window.addEventListener("resize", checkFullScreen)
    
    for (var i = 0; i < links.length; i++) {
      var link = links[i];

      link.addEventListener("click", function() {
        var id = this.getAttribute("data-id")
        var name = this.getAttribute("data-name")
        document.getElementById("id-content").value = id
        document.getElementById("name-content").innerHTML = name
        document.getElementById("nameinput-content").value = name
      })
    }

    // function closePrompt() {
    //   var prompt = document.getElementById("prompt")
    //   prompt.style.opacity = "0"
    // }

    // function closeDownPrompt() {
    //   var prompt = document.getElementById("downprompt")
    //   prompt.style.opacity = "0"
    // }