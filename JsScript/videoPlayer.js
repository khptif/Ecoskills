
document.addEventListener("DOMContentLoaded",()=>{startPlayer();},false);
document.getElementById("progression").addEventListener("click",changeLecture,false);
document.getElementById("barre").addEventListener("click",ajusterSon,false);

var player;
var lecture = setInterval(positionLecture,1000);


function startPlayer()
{
    player = document.getElementById('videoPlayer');
    player.controls = false;
    
}

function play()
{
    if(player.paused)
    {
        document.getElementById("playButton").src ="images/Video/pause.png";
        player.play();
        lecture = setInterval(positionLecture,100);
        
    }
    else
    {
        document.getElementById("playButton").src ="images/Video/play.png";
        player.pause();
        
    }
    
}

function stop()
{
    player.pause();
    player.currentTime = 0;
    document.getElementById("playButton").src ="images/Video/play.png";
}

function positionLecture()
{
   
        let position = player.currentTime;
        let duree = player.duration;
        let loaded = player.buffered.end(0);

        let pourcentagePosition = (position/duree)*100;
        let pourcentageChargement = (loaded/duree)*100;
        document.getElementById("position").style.width = String(pourcentagePosition) + "%";
        document.getElementById("chargement").style.width = String(pourcentageChargement) + "%";
        
    
}

function changeLecture(event)
{
    let longueur = document.getElementById("progression").offsetWidth;
    let position = event.offsetX;
    let duree = player.duration;

    player.currentTime = (position/longueur)*duree;
}

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

function ajusterSon(event)
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