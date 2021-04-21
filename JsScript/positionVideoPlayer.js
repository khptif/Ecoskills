var pourcentage;
var player = document.getElementById('videoPlayer');

function positionLecture()
{
    while(1)
    {
        let position = player.currentTime;
        let duree = player.duration;
        let loaded = player.seekable.end[0];

        let pourcentagePosition = (position/duree)*100;
        let pourcentageChargement = (loaded/duree)*100;

        pourcentage = [pourcentagePosition,pourcentageChargement];
        postMessage(pourcentage);
        
    }
}

positionLecture();