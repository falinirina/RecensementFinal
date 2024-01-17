<?php 
    session_start(); 
    if(!isset($_SESSION['utilisateur']))
    {
        header("Location:../");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/welcome.css">
    <title>Welcome</title>
</head>
<body>
<div style="position: absolute;width: 100%;height: 100%" id="screenwidth"></div>
	<div class="background" id="bg"></div>
	<img id="logojs" src="../Pictures/logoBetela.jpg">
	<div id="textup" class="textup1"></div>
	<div id="welcome" class="welcome1">
		<strong id="text1">B</strong><strong id="text2">i</strong><strong id="text3">e</strong><strong id="text4">n</strong><strong id="text5">v</strong><strong id="text6">e</strong><strong id="text7">n</strong><strong id="text8">u</strong><strong id="text9">e</strong><strong style="font-size: 200px"></strong>
	</div>
	<img id="testfile" style="position: absolute;display: none;">
	<div id="textdown" class="textdown1"></div>
    <div class="divload" id="load">
		<div id="loading" class="loading1"></div>
		<div id="loading2" class="loading2"></div>
	</div>
    <script>
        function id(id){return document.getElementById(id);}
        function display(getid,valeur) {id(getid).style.display = valeur;}
        function classes(getid,valeur) {id(getid).className = valeur;}

        intervalle = 500;
        inter = 1000;
        initial()

        function initial() {
            setTimeout(logojs,intervalle);
        }

        function logojs() {
            display("logojs","block");
            setTimeout(welcome,intervalle);
        }

        function welcome() {
            display("welcome","block");
            setTimeout(divtext,intervalle);
        }
        function divtext() {
            display("textup","block");display("textdown","block");
            setTimeout(loading,intervalle);;
        }
        function loading() {
            display("loading","inline-block");
            setTimeout(loading2,1000);
        }
        function loading2() {
            display("loading2","inline-block");
            setTimeout(loadingoff,3500);
        }
        function loadingoff() {
            id("loading").style.transform = "scale(0)";
            id("loading").style.opacity = "0";
            id("loading2").style.transform = "scale(0)";
            id("loading2").style.opacity = "0";
            setTimeout(divtextout,800);
        }

        function divtextout(){
            id("textup").style.transform = "scaleX(0)";
            id("textdown").style.transform = "scaleX(0)";
            setTimeout(logoout,200);
        }
        function logoout(){
            id("logojs").style.marginTop = "-500px";
            setTimeout(textout,300);
        }

        function textout(){
            id("welcome").style.transform = "scale(1.6)";
            setTimeout(change,400);
        }
        function change(){
            document.location.href = "/";
        }
    </script>
</body>
</html>