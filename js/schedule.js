

function showDay(event, day) {
    let i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(day).style.display = "block";
    if (event) {
        event.currentTarget.className += " active";
    } else {
        let btn = document.getElementById('btnOne');
        btn.classList.add('active');
    }
    
  }
  window.addEventListener('load', showDay(event, 'day-one'));
  