app.directive('ngExo', function(){
    return {
        template :"	<h1>{{exercice.nom}}</h1>
        Par : {{exercice.auteur}}<br>


    <p>
    <br><br><br>
    exo créé le  : {{exercice.date_creation}}<br>
    lien de l'exo  : {{exercice.link}}<br>

    </p>"
        
};
})
