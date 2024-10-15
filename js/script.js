var state = false;

function toggle () {
  if(state) {
    document.getElementById('password').setAttribute("type","password");
    document.getElementById("eye").style.color='#000';

    state = false;
  }

  else {
    document.getElementById('password').setAttribute("type","text");
    document.getElementById("eye").style.color='#9EC8B9 ';

    state = true;
  }
}




