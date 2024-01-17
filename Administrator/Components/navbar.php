<?php
    $pages = array(
        'Home' => 'index.php',
        'Gestion Tokantrano' => 'tokantrano.php',
        'Gestion Mpiangona' => 'mpiangona.php',
        'Gestion Locations' => 'location.php',
        'Gestion utilisateur'=> 'user.php',
    );

?>
<style>
  a#nav-logo {
    font-family: algerian;
    margin-bottom: 25px;
  }
  #nav-logo>div:first-child{
    font-size: 25px;
    margin-left: 15px;
  }
  #nav-logo>div:last-child{
    margin-left: 60px;
  }
</style>
<div class="bg-color" id="notification">
  <div class="notificationSound" style="display: none">
  <audio id="audioNotif">
    <source src="../Sounds/notification.wav" type="audio/ogg">
    Your browser does not support the audio element.
  </audio>
  </div>
  <div class="topToast">Notification</div>
  <div id="messageToast"></div>
</div>
<div id="cmdp">
</div>
<div id="deconnexDiv" style="display: none">
  <div class="bg-color">
    <p>Voulez-vous vraiment vous deconnecter</p>
    <div class="deconnexBtn">
      <button class="ui button green">Oui</button>
      <button class="ui button red">Non</button>
    </div>
  </div>
</div>
<nav class="w3-sidebar w3-bar-block w3-collapse w3-animate-left w3-card" id="mySidebar">
  <a class="w3-bar-item w3-button w3-border-bottom w3-large" id="nav-logo" href="#"><img src="../Pictures/logoBetela.jpg" alt="Logo Entreprise"></a>
  <div class="version">
    Version 2.0.1
  </div>
  <a class="w3-bar-item w3-button w3-hide-large w3-large" href="javascript:void(0)" onclick="w3_close()">Fermer <i class="fa fa-remove"></i></a>
  <?php
    foreach ($pages as $page => $title) {
        ?>
        <a class="w3-bar-item w3-button <?php 
            if (isset($cpage))
            {
                if ($cpage == $page)
                {
                     echo 'w3-purple';
                }
            }
        ?>" href="<?= $title ?>"><?= $page ?></a>
        <?php
    }
    ?>
  <a class="w3-bar-item w3-button" style="bottom: 0;position: absolute;" id="deconnectionBtn">Deconnecter<i style="float: right;" class="ui icon logout"></i></a>
</nav>
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div class="w3-main" style="margin-left:250px;padding: 15px;">

<div id="nav-pages">
  <div class="menuShow" onclick="w3_open()">
    <i class="ui icon list"></i>
  </div>
  <table>
    <tr><td>Pages</td><td>/</td><td id="pageNow">Tableau de bord</td></tr>
    <tr><td id="pageNow2" colspan=3>Tableau de bord</td></tr>
  </table>
  <div class="nMode">
    <div>
      <i class="ui icon sun"></i>
    </div>
    <label class="switch">
      <input type="checkbox" id="dark">
      <span class="slider round"></span>
    </label>
    <div>
      <i class="ui icon moon"></i>
    </div>
  </div>
</div>
<div id="add-font"></div>
<script>
  <?php
    if ($_SESSION["darkMode"] == "on")
    {
      ?>
       $("#dark").attr("checked", "true")
       <?php
    } else {
      ?>
      $("#dark").removeAttr("checked")
      <?php
    }
  ?>
  var afficheNotif = null
  var affNot = null
  function notification(message)
  {
    clearTimeout(affNot)
    $("#notification").css('display', 'none')
    $("#messageToast").text(message)
    affNot = setTimeout(notificationAff, 50)
  }
  function notificationAff()
  {
    clearTimeout(afficheNotif)
    $("#notification").css('display', 'flex')
    document.getElementById("audioNotif").load()
    // document.getElementById("audioNotif").play()
    afficheNotif = setTimeout(notificationHide, 5000)
  }
  function notificationHide()
  {
    $("#notification").css('display', 'none')
  }

  $("#deconnexDiv .ui.button.red").click(function(){
    $("#deconnexDiv").css('display', 'none')
  })
  $("#deconnexDiv .ui.button.green").click(function(){
    deconnection()
  })
  $('#dark').click(function(){
    const check = $("#dark").prop("checked")
    if (check)
    {
      $("link[href='Styles/light.css']").attr("href","Styles/dark.css")
      $.post("Traitements/changeDarkMode.php", {dark: "on"},function (data){})
    } else {
      $("link[href='Styles/dark.css']").attr('href','Styles/light.css')
      $.post("Traitements/changeDarkMode.php", {dark: "off"},function (data){})
    }
  })
$(document).ready(function(){
    $(".button-setting>.ui.red.button").click(function(){
        $("#bg-setting").css('display','none')
    })
    $(".button-setting2>.ui.red.button").click(function(){
        $("#bg-login").css('display','none')
    })
    
})

$("#deconnectionBtn").click(function (){
  deconnection()
})
function deconnection(){
  document.location = "Traitements/deconnection.php"
}
function w3_open() {
  // console.log("teste")
  $("#mySidebar").css('display',"block")
}

function w3_close() {
  $("#mySidebar").css('display',"none")
}
</script>
<style>
  .ui.icon.sun{
    font-size: 25px;
  }
  input + .slider {
    background-color: #d6df1e;
  }
</style>