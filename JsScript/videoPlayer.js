
// initialise la variable player dès que la page est chargé
document.addEventListener("DOMContentLoaded",()=>{startPlayer();},false);
document.addEventListener("DOMContentLoaded",()=>{setInterval(updateLecture,100);},false);
// change la position de lecture
document.getElementById("progression").addEventListener("mousedown",changeLecture,false);
document.getElementById("progression").addEventListener("mousemove",changeLecture,false);

//change le volume du son
document.getElementById("son").addEventListener("mouseover",afficheSon,false);
document.getElementById("son").addEventListener("mouseout",cacheSon,false);
document.getElementById("barre").addEventListener("mousemove",ajusterSon,false);
document.getElementById("barre").addEventListener("mousedown",ajusterSon,false);

// change la vitesse de lecture
document.getElementById("vitesse").addEventListener("mouseover",afficheVitesse,false);
document.getElementById("vitesse").addEventListener("mouseout",cacheVitesse,false);
document.getElementById("tableVitesse").addEventListener("mouseover",afficheVitesse,false);

let elementsLI = document.getElementsByTagName("LI")// permet à chaque vitesse possible d'être choisi
for(let i in elementsLI)
{
    if(elementsLI[i].parentNode.parentNode.id == "tableVitesse")
    {
        elementsLI[i].addEventListener("click",changeVitesse,false);
    }
}


var player;
var fullscreen = false;
// débute le lecteur video
function startPlayer()
{
    player = document.getElementById('videoPlayer');
    player.controls = false;
    
}

// mettre en pause ou en lecture
function play()
{
    if(player.paused)
    {
        player.play();
        
    }
    else
    {
        player.pause();
        
    }
    
}

// arrêter la video
function stop()
{
    player.pause();
    player.currentTime = 0;
    document.getElementById("playButton").src ="images/Video/play.png";
}

// met à jour les informations affichés concernant la lecture video
function updateLecture()
{
        // mise à jour de la position dans la barre de lecture
        let position = player.currentTime;
        let duree = player.duration;
        let loaded = player.buffered.end(0);

        let pourcentagePosition = (position/duree)*100;
        let pourcentageChargement = (loaded/duree)*100;
        document.getElementById("position").style.width = String(pourcentagePosition) + "%";
        document.getElementById("chargement").style.width = String(pourcentageChargement) + "%";

        // mise à jour du temps affiché

        let tempsCourant = player.currentTime;
        let tempsTotal = player.duration;

        let heureTotal = Math.floor(tempsTotal / 3600);
        let minuteTotal = '0' + Math.floor(tempsTotal/60);
        minuteTotal = minuteTotal.slice(-2);
        let secondeTotal = '0' + Math.floor(tempsTotal % 60);
        secondeTotal = secondeTotal.slice(-2);

        let heure = Math.floor(tempsCourant / 3600);
        let minute = '0' + Math.floor(tempsCourant/60);
        minute = minute.slice(-2);
        let seconde = '0' + Math.floor(tempsCourant%60);
        seconde = seconde.slice(-2);

        if(heure > 0)
        {
            document.getElementById("temps").innerHTML = String(heure)+ ":" + minute + ":" + seconde + " / "+String(heureTotal) + ":" + minuteTotal +":"+secondeTotal;
        }
        else
        {
            document.getElementById("temps").innerHTML = String(minute) + ":" + seconde+" / " + minuteTotal +":"+secondeTotal;
        }
        
        // selon que la video est en pause ou en lecture, change l'icone play
        if(!player.paused)
        {
            document.getElementById("playButton").src ="images/Video/pause.png";
        }
        else
        {
             document.getElementById("playButton").src ="images/Video/play.png";
        }
    
}

// permet de changer la position de lecture avec la souris sur la barre de lecture
function changeLecture(event)
{
    if(event.which == 1)
    {
        let longueur = document.getElementById("progression").offsetWidth;
        let position = event.offsetX;
        let duree = player.duration;

        player.currentTime = (position/longueur)*duree;
    }
}
    

// permet d'afficher et cacher les contrôles du lecteur video
function afficheControl()
{
    document.getElementById("controlers").style.display = "block";
    document.getElementById("progression").style.display = "block";
}

function cacheControl()
{
    if(!player.paused)
    {
        document.getElementById("controlers").style.display = "none";
        document.getElementById("progression").style.display = "none";
    }
    
}

// afficher et cache la barre du volume selon que la souris s'y trouve
function afficheSon()
{
    document.getElementById("ajusterSon").style.display = "block";
    //document.getElementById("temps").style.left = "38%";
    document.getElementById("son").style.width = "200px";
}

function cacheSon()
{
    document.getElementById("ajusterSon").style.display = "none";
    //document.getElementById("temps").style.left = "25%";
    document.getElementById("son").style.width = "var(--controllerHeight)";
}

// changer le son avec la souris
function ajusterSon(event)
{
    if(event.which == 1)// on vérifie que le bouton gauche de la souris est pressé
    {
        let longueur = document.getElementById("barre").offsetWidth;
        let position = event.offsetX;
    
        document.getElementById("volume").style.width = String(position*100/longueur) + "%";

        if(position/longueur < 0.05)
        {
           player.volume = 0;
           document.getElementById("iconeSon").childNodes[1].src = "images/Video/mute.png";
        }
        else
        {
           player.volume = (position/longueur);
           document.getElementById("iconeSon").childNodes[1].src = "images/Video/sound.png";
        }

    }
    
}

// les contrôles pour la vitesse de lecture
function afficheVitesse()
{
    document.getElementById("tableVitesse").style.display = "block";
}

function cacheVitesse()
{
    document.getElementById("tableVitesse").style.display = "none";
}

function changeVitesse(event)
{
    document.getElementById("tableVitesse").style.display = "none";
    document.getElementById("iconeVitesse").innerHTML = event.target.innerHTML;
    player.playbackRate = Number(event.target.innerHTML.substr(0,4));
}

// le pleine écran
function full()
{
    if(!fullscreen)
    {
        document.getElementById("blocVideoPlayer").style.position= "fixed";
        document.getElementById("blocVideoPlayer").style.minWidth = "100%";
        document.getElementById("blocVideoPlayer").style.minHeight = "100%";
        document.getElementById("blocVideoPlayer").style.right = "0";
        document.getElementById("blocVideoPlayer").style.bottom = "0";
        document.getElementById("blocVideoPlayer").style.zIndex = "1000000";
        document.getElementById("corps").style.overflowY = "hidden";
        document.getElementById("corps").style.overflowX = "hidden";
        fullscreen = true;
    }
    else
    {
        document.getElementById("blocVideoPlayer").style.position= "relative";
        document.getElementById("blocVideoPlayer").style.minWidth = "";
        document.getElementById("blocVideoPlayer").style.minHeight = "";
        document.getElementById("blocVideoPlayer").style.right = "";
        document.getElementById("blocVideoPlayer").style.bottom = "";
        document.getElementById("blocVideoPlayer").style.zIndex = "";
        document.getElementById("corps").style.overflowY = "scroll";
        document.getElementById("corps").style.overflowX = "scroll";
        fullscreen = false;
    }
   

}