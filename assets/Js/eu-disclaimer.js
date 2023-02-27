$(document).ready(
    function(){
        if(!document.cookie.includes("ejD86j7ZXF3x")){
            $("#myModal").modal("show");
        }
    }
);

function creerUnCookie(nomCookie,valeurCookie,dureeJours){
    //si le nombre de jours est spécifié 
    if(dureeJours){
      let date = new Date();
      // Converti le nombre de jours spécifié en millisecondes
      date.setTime(date.getTime()+(dureeJours * 24*3600*1000));
      //var expire = "";
      expire =date.toGMTString();
    }
    //si aucune valeur de jour n'est spécifiée
    else{
    var expire="";
    }
    document.cookie = nomCookie+"="+valeurCookie+";expires="+expire + "; path=/";
    document.cookie = "username = test;";
    document.cookie = "test = dr";
}


function lireUnCookie(nomCookie){
    //ajoute le signe égale virgule au nom pour la recherche dans le tableau contenant tous les cookies
    var nomFormate = nomCookie +"=";
    //tableau contenant tous les cookies
    var tableauCookies = document.cookie.split(';');
    //Recherche dans le tableau le cookie en question
    for(var i=0;i<tableauCookies.length;i++){
        var cookieTrouve = tableauCookies[i];
        //Tant que l'on trouve un espace on le supprime
        while (cookieTrouve.charAt(0) == ''){
            cookieTrouve = cookieTrouve.substring(1,cookieTrouve.length-1);
        }
        if (cookieTrouve.indexOf(nomFormate) == 0){
            return cookieTrouve.substring(nomFormate.length,cookieTrouve.length);   
        }
    }
    // On retourne une valeur null dans le cas où aucun cookie n'est trouvée
    return null;
}
function disclaimer(){
    creerUnCookie("eu-disclaimer-vapobar", "ejD86j7ZXF3x",1);
}
$("#cookie").click(disclaimer);

/*jQuery(document).ready(function($){
    let cookie = lireUnCookie ('eu-disclaimer-vapobar');

    if(cookie !="ejD86j7ZXF3x"){
        
        $("#myModal").modal({
            escapeClose:false,
            clickClose:false,
            showClose:false
        }
        );
        $("#myModal").hide();
    }
});*/