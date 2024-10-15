<?php
session_start();
require_once "../connection/config.php";

$loggedInUserId = $_SESSION['users_id'];
$username = $_SESSION['user_name'];

if(!isset($username)) {
    header("Location: login.php");
    exit; // Terminate the script if username is not set
}


if(!isset($loggedInUserId)) {
    header("Location: login.php");
    exit; // Terminate the script if username is not set

}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../photos/ritelogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css ">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Dashboard</title>
</head>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');



*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body{
    background-image: var(--bg-color);
    background-size: cover;

}

h1{
   font-size: 3em;
    font-weight: bold;
    margin-bottom: 0.5em;
    text-align: center;
    color: var(--font-color);
  
}
h2{
    font-size: 1.4rem;
    color: #fff;
    margin-right: 60vh;
    text-align: center;
    margin-top: 5px;
}
h3{
    font-size: 1rem;
    color: var(--font-color);
    margin-bottom: 0.5em;
    text-align: center;
}

h4{
    font-size: 1.5rem;
    color: #fff;
    font-weight: bold;
    margin-bottom: 0.5em;
    text-align: center;
}


h4 span { 
  color:   var(--span-color);

}




.btn {
    display: inline-block;
    padding: 5px 30px;
    border-radius: 5px;
    background-color:   var(--add-color);
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.3s ease;
}
  
.btn:hover {
    background-color: var(--addhover-color);
}

.side-menu{
    position: fixed;
    background: var(--secondary-color) ;
    width: 20vw;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    box-shadow: 3px 3px 6px var(--outline-color);
   transition: background-color 0.3s ease;
}
.side-menu .brand-name{
    height: 10vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
    flex: 0.2;
    padding: 0;
    margin: 0;
}

.side-menu li{
    font-size: 1.2rem;
    color: #fff;
    font-weight: 400;
    flex: 0.2;
    padding: 10px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #ffffff;
}

.side-menu li:last-child {
    border-bottom: none;
} 

.side-menu li:hover{
    background: var(--sidenav-color);
    color: #FFF;
    cursor: pointer;
}

.side-menu  li a {
    color: #fff;
    text-decoration: none;
    display: flex;
    margin-left: 20px;
    align-items: center;
  }
  
  .side-menu  li i {
    font-size: 20px;
    margin-right: 10px;
  }

.container{
    position: absolute;
    right: 0;
    width: 80vw;
    height: 100vh;

}

.container .header{
 position: fixed;
 top: 0;
 right: 0;
 width: 80vw;
 height: 8vh;
 background: var(--secondary-color);
 display: flex;
 align-items: center;
 justify-content: center;
 box-shadow: 3px 3px 6px var(--outline-color);
 transition: background-color 0.3s ease;

}


.container .header .nav{
    width: 90%;
    display: flex;
    align-items: center;
}
.container .header .nav  .search{
    flex: 3;
    display: flex;
    justify-content: center;
  
}

.container .header .nav  .search button{
    width: 40px;
    height: 40px;
    border: none;
}



.container .header .nav .search input[type="text"]{
    border: none; 

    padding: 10px;
    width: 50%;
    text-align: center;
}


.container .header .nav .user{
    justify-content: space-between;
    display: flex;
    align-items: center;
    flex: 1;
}

.container .header .nav .user img{
    width: 40px;
    height: 40px;
}
.container .header .nav .user .image-case{
    position: relative;
    width: 50px;
    height: 50px;
}

.container .header .nav .user .image-case img{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}


.container .content{
    position: relative;
    margin-top: 10vh;
    min-height: 90vh;

}

.container .content .cards{
    padding: 25px 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;

}
.container .content .cards .card{
    flex: 0 1 calc(30% - 1em);
    width: 250px;
    height: 180px;
    margin: 1em;
    background-color: var(--card-color);
    overflow: hidden;
    box-shadow: 3px 3px 6px var(--outline-color) ;
    border-radius: 10px;
    transition: background-color 0.3s ease;

}
.container .content .cards  .icon-case {
    background-color: var(--secondary-color);
    color: #fff;
    text-align: center;
    width: 100%;
    padding: 8em;
    border-radius: 0 0 5px 5px;
    transition: background-color 0.3s ease;
  }

.profile-img{
    border-radius: 100%;
    margin-left: 190px;
    height: 50px;
    width: 50px;
    border: 3px solid var(--span-color);
    
}  
/*Dark Mode*/
#icon{
  width: 35px;
  cursor:pointer;
  float: right;
  margin-right: 2%;
  margin-top: 1.3%;
  font-size: 2rem;
  color: var(--add-color);
  transition: background-color 0.3s ease;
}

:root{
  --bg-color:  linear-gradient(rgba(50,50,50,0.75),rgba(40,40,40,0.75)), url(../photos/plant2.jpg);
  --secondary-color: #172621;
  --1-color:#5C8374;
  --2-color:#1B4242;
  --mode-color:#fff;
  --nav-color:  #74512D;
  --sidenav-color:#3B593F;
  --add-color:#3B593F;
  --addhover-color:#1A4D2E;
  --container-color:#172621;
  --card-color:#3B593F;
  --outline-color:  #4F6F52;
  --font-color: #F5EFE6;
  --bgside-color:#fff;
  --span-color:#4F6F52;

}
.white-theme{
  --bg-color: url(../photos/plant2.jpg);
  --secondary-color: #4F6F52;
  --1-color:#AFC8AD;
  --2-color:#4F6F52;
  --mode-color:#000;
  --nav-color: #1A4D2E;
  --sidenav-color:#B5C18E;
  --add-color:#7ABA78;
  --addhover-color: #0A6847;
  --container-color:#4F6F52;
  --card-color: #EADBC8;
  --outline-color:  #F1F1F1;
  --font-color: #4F6F52;
  --bgside-color:#000;
  --span-color:#7ABA78;

}



/*note*/
::selection{
  color: #fff;
  background: #618cf8;

}
.wrapper{
  margin-top: 100px;
  margin-left: 70px;
  display: grid;
  gap: 25px;
  grid-template-columns: repeat(auto-fill, 265px);
}
.wrapper li{
  height: 250px;
  list-style: none;
  border-radius: 5px;
  padding: 15px 20px 20px;
  background: #fff;
  box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}
.add-box, .icon, .bottom-content, 
.popup, header, .settings .menu li{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.add-box{
  cursor: pointer;
  flex-direction: column;
  justify-content: center;
}
.add-box .icon{
  height: 78px;
  width: 78px;
  color: var(--span-color);
  font-size: 40px;
  border-radius: 50%;
  justify-content: center;
  border: 2px dashed var(--span-color);
}
.add-box p{
  color: var(--span-color);
  font-weight: 500;
  margin-top: 20px;
}
.note{
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.note .details{
  max-height: 165px;
  overflow-y: auto;
}
.note .details::-webkit-scrollbar,
.popup textarea::-webkit-scrollbar{
  width: 0;
}
.note .details:hover::-webkit-scrollbar,
.popup textarea:hover::-webkit-scrollbar{
  width: 5px;
}
.note .details:hover::-webkit-scrollbar-track,
.popup textarea:hover::-webkit-scrollbar-track{
  background: #f1f1f1;
  border-radius: 25px;
}
.note .details:hover::-webkit-scrollbar-thumb,
.popup textarea:hover::-webkit-scrollbar-thumb{
  background: #e6e6e6;
  border-radius: 25px;
}
.note p{
  font-size: 22px;
  font-weight: 500;
}
.note span{
  display: block;
  color: #575757;
  font-size: 16px;
  margin-top: 5px;
}
.note .bottom-content{
  padding-top: 10px;
  border-top: 1px solid #ccc;
}
.bottom-content span{
  color: #6D6D6D;
  font-size: 14px;
}
.bottom-content .settings{
  position: relative;
}
.bottom-content .settings i{
  color: #6D6D6D;
  cursor: pointer;
  font-size: 15px;
}
.settings .menu{
  z-index: 1;
  bottom: 0;
  right: -5px;
  padding: 5px 0;
  background: #fff;
  position: absolute;
  border-radius: 4px;
  transform: scale(0);
  transform-origin: bottom right;
  box-shadow: 0 0 6px rgba(0,0,0,0.15);
  transition: transform 0.2s ease;
}
.settings.show .menu{
  transform: scale(1);
}
.settings .menu li{
  height: 25px;
  font-size: 16px;
  margin-bottom: 2px;
  padding: 17px 15px;
  cursor: pointer;
  box-shadow: none;
  border-radius: 0;
  justify-content: flex-start;
}
.menu li:last-child{
  margin-bottom: 0;
}
.menu li:hover{
  background: #f5f5f5;
}
.menu li i{
  padding-right: 8px;
}
.popup-box{
  position: fixed;
  top: 0;
  left: 0;
  z-index: 2;
  height: 100%;
  width: 100%;
  background: rgba(0,0,0,0.4);
}
.popup-box .popup{
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 3;
  width: 100%;
  max-width: 400px;
  justify-content: center;
  transform: translate(-50%, -50%) scale(0.95);
}
.popup-box, .popup{
  opacity: 0;
  pointer-events: none;
  transition: all 0.25s ease;
}
.popup-box.show, .popup-box.show .popup{
  opacity: 1;
  pointer-events: auto;
}
.popup-box.show .popup{
  transform: translate(-50%, -50%) scale(1);
}
.popup .content{
  border-radius: 5px;
  background: #fff;
  width: calc(100% - 15px);
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
.content header{
  padding: 15px 25px;
  border-bottom: 1px solid #ccc;
}
.content header p{
  font-size: 20px;
  font-weight: 500;
}
.content header i{
  color: #8b8989;
  cursor: pointer;
  font-size: 23px;
}
.content form{
  margin: 15px 25px 35px;
}
.content form .row{
  margin-bottom: 20px;
}
form .row label{
  font-size: 18px;
  display: block;
  margin-bottom: 6px;
}
form :where(input, textarea){
  height: 50px;
  width: 100%;
  outline: none;
  font-size: 17px;
  padding: 0 15px;
  border-radius: 4px;
  border: 1px solid #999;
}
form :where(input, textarea):focus{
  box-shadow: 0 2px 4px rgba(0,0,0,0.11);
}
form .row textarea{
  height: 150px;
  resize: none;
  padding: 8px 15px;
}
form button{
  width: 100%;
  height: 50px;
  color: #fff;
  outline: none;
  border: none;
  cursor: pointer;
  font-size: 17px;
  border-radius: 4px;
  background: var(--span-color);
}
@media (max-width: 660px){
  .wrapper{
    margin: 15px;
    gap: 15px;
    grid-template-columns: repeat(auto-fill, 100%);
  }
  .popup-box .popup{
    max-width: calc(100% - 15px);
  }
  .bottom-content .settings i{
    font-size: 17px;
  }
}

</style>
<body>
    <div class="side-menu">
        <div class="brand-name">
        <h4>USER <span><?php echo $username ?></span></h4>

        </div>
        <hr>
        <ul>
            <li><a href="userdashboard.php"><i class="fa-solid fa-chart-line"></i>Dashboard</a></li>
          <!--<li><a href="department.php"><i class="fa-solid fa-building-user"></i>Department</a></li>
            <li><a href="staffs.php"><i class="fa-solid fa-clipboard-user"></i>Staff</a></li> -->
            <li><a href="report.php"><i class="fa-regular fa-pen-to-square"></i>Report</a></li>
            <li><a href="usershiftlist.php"><i class="fa-solid fa-calendar-days"></i>Shift</a></li>
            <li><a href="leave.php"><i class="fa-solid fa-message"></i>Leave  Request</a></li>
            <li><a href="login.php "><i class="fa-solid fa-right-from-bracket"></i>Log out</a></li>
     
        
       
        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
            
                <div class="search">

                <h2>Ritetrack Enviro Services, Inc. EMS</h2> 
                </div>
           
              

                <div class="user">
                

                    <?php
                       

                        $query = "SELECT * FROM users_tbl";
                        $result = $conn->query($query);
                        if(!$result) {
                          die($conn->error);
                        }
                        while ($row = $result->fetch_assoc()) {
                            // Assuming you have a variable $loggedInUserId that stores the ID of the currently logged-in user
                            if ($row['id'] == $loggedInUserId) {
                                ?>
                       <a href="prof.php"> <img src="../photos/<?php echo $row['image']; ?>" height="70"; width="70"; class="profile-img"></a>
                    <?php
                            }
                        }
                    ?>
                    <!--<img src="photo/sun.png" id="icon">-->
                    <i class="fa-solid fa-circle-half-stroke" id="icon"></i>
                </div>
            </div>
        </div>

       <div class="popup-box">
      <div class="popup">
        <div class="content">
          <header>
            <p></p>
            <i class="uil uil-times"></i>
          </header>
          <form action="userdashboard.php" method="post">
            <div class="row title">
              <label>Title</label>
              <input type="text" spellcheck="false" name="title">
            </div>
            <div class="row description">
              <label>Description</label>
              <textarea spellcheck="false" name="desc"></textarea>
            </div>
            <button type="submit"></button>
          </form>
        </div>
      </div>
    </div>
    <div class="wrapper">
      <li class="add-box">
        <div class="icon"><i class="uil uil-plus"></i></div>
        <p>Add new note</p>
      </li>
    </div>

       
<script type="text/javascript">
var icon = document.getElementById("icon");

if (localStorage.getItem("theme") === "dark") {
  document.body.classList.add("dark-theme");
  icon.src = "fa-regular fa-lightbulb"; 
} else {
  document.body.classList.add("white-theme");
  icon.src = "fa-solid fa-lightbulb";
}

icon.onclick = function() {
  if (document.body.classList.contains("white-theme")) {
    document.body.classList.remove("white-theme");
    document.body.classList.add("dark-theme");
    icon.src = "fa-regular fa-lightbulb";
    localStorage.setItem("theme", "dark");
  } else {
    document.body.classList.remove("dark-theme");
    document.body.classList.add("white-theme");
    icon.src = "ffa-solid fa-lightbulb";
    localStorage.setItem("theme", "light");
  }
};


/* NOTE */


const loggedInUserId = '<?php echo $loggedInUserId; ?>';
const username = '<?php echo $username; ?>';

// Use a user-specific key for storing notes
const userNotesKey = `notes_${loggedInUserId}`;

const addBox = document.querySelector(".add-box"),
popupBox = document.querySelector(".popup-box"),
popupTitle = popupBox.querySelector("header p"),
closeIcon = popupBox.querySelector("header i"),
titleTag = popupBox.querySelector("input"),
descTag = popupBox.querySelector("textarea"),
addBtn = popupBox.querySelector("button");

const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];
const notes = JSON.parse(localStorage.getItem(userNotesKey) || "[]");
let isUpdate = false, updateId;

addBox.addEventListener("click", () => {
    popupTitle.innerText = "Add a new Note";
    addBtn.innerText = "Add Note";
    popupBox.classList.add("show");
    document.querySelector("body").style.overflow = "hidden";
    if(window.innerWidth > 660) titleTag.focus();
});

closeIcon.addEventListener("click", () => {
    isUpdate = false;
    titleTag.value = descTag.value = "";
    popupBox.classList.remove("show");
    document.querySelector("body").style.overflow = "auto";
});

function showNotes() {
    if(!notes) return;
    document.querySelectorAll(".note").forEach(li => li.remove());
    notes.forEach((note, id) => {
        let filterDesc = note.description.replaceAll("\n", '<br/>');
        let liTag = `<li class="note">
                        <div class="details">
                            <p>${note.title}</p>
                            <span>${filterDesc}</span>
                        </div>
                        <div class="bottom-content">
                            <span>${note.date}</span>
                            <div class="settings">
                                <i onclick="showMenu(this)" class="uil uil-ellipsis-h"></i>
                                <ul class="menu">
                                    <li onclick="updateNote(${id}, '${note.title}', '${filterDesc}')"><i class="uil uil-pen"></i>Edit</li>
                                    <li onclick="deleteNote(${id})"><i class="uil uil-trash"></i>Delete</li>
                                </ul>
                            </div>
                        </div>
                    </li>`;
        addBox.insertAdjacentHTML("afterend", liTag);
    });
}
showNotes();

function showMenu(elem) {
    elem.parentElement.classList.add("show");
    document.addEventListener("click", e => {
        if(e.target.tagName != "I" || e.target != elem) {
            elem.parentElement.classList.remove("show");
        }
    });
}

function deleteNote(noteId) {
    let confirmDel = confirm("Are you sure you want to delete this note?");
    if(!confirmDel) return;
    notes.splice(noteId, 1);
    localStorage.setItem(userNotesKey, JSON.stringify(notes));
    showNotes();
}

function updateNote(noteId, title, filterDesc) {
    let description = filterDesc.replaceAll('<br/>', '\r\n');
    updateId = noteId;
    isUpdate = true;
    addBox.click();
    titleTag.value = title;
    descTag.value = description;
    popupTitle.innerText = "Update a Note";
    addBtn.innerText = "Update Note";
}

addBtn.addEventListener("click", e => {
    e.preventDefault();
    let title = titleTag.value.trim(),
    description = descTag.value.trim();

    if(title || description) {
        let currentDate = new Date(),
        month = months[currentDate.getMonth()],
        day = currentDate.getDate(),
        year = currentDate.getFullYear();

        let noteInfo = {title, description, date: `${month} ${day}, ${year}`}
        if(!isUpdate) {
            notes.push(noteInfo);
        } else {
            isUpdate = false;
            notes[updateId] = noteInfo;
        }
        localStorage.setItem(userNotesKey, JSON.stringify(notes));
        showNotes();
        closeIcon.click();
    }
});    </script>
</body>
</html>