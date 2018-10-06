(function()
{ // On utilise une IEF pour ne pas polluer l'espace global
    // Fonction de désactivation de l'affichage des « tooltips »
    function deactivateTooltips()
    {
        var spans = document.getElementsByTagName('span'),
        spansLength = spans.length;
        
        for (var i = 0 ; i < spansLength ; i++)
        {
            if (spans[i].className == 'help-block')
            {
                spans[i].style.display = 'none';
            }
        }
    }
    // La fonction ci-dessous permet de récupérer la « tooltip » qui correspond à notre input 
    function getTooltip(element)
    { 
        while (element = element.nextSibling)
        {
            if (element.className === 'help-block')
            {
                return element;
            }
        }
        return false;
    } 
    // Fonctions de vérification du formulaire, elles renvoient « true » si tout est OK
    var check = {}; // On met toutes nos fonctions dans un objet littéral
    
//On commence les vérifs    

    
        check['contenu'] = function(id)
	{
    
        var name = document.getElementById(id),
            tooltipStyle = getTooltip(name).style;
    
        if (name.value.length <= 10)
	{
            name.className = 'form-control correct';
            tooltipStyle.display = 'none';
            return true;
        } else
	{
            name.className = 'form-control incorrect';
            tooltipStyle.display = 'block';
            return false;
        }
    
	};
    
//Fin des vérifs

// Mise en place des événements
    
    (function()
	{ // Utilisation d'une fonction anonyme pour éviter les variables globales.
    
        var formulaire = document.getElementById('comment_form'),
            inputs = formulaire.getElementsByTagName('input'),
            inputsLength = inputs.length;
    
        for (var i = 0 ; i < inputsLength ; i++)
	{
            if (inputs[i].type == 'text' || inputs[i].type == 'password')
	    {
    
                inputs[i].onkeyup = function()
		{
                    check[this.id](this.id); // « this » représente l'input actuellement modifié
                };
    
            }
        }
    
        formulaire.onsubmit = function()
	{
    
            var result = true;
    
            for (var i in check)
	    {
                result = check[i](i) && result;
            }
    
            if (result){}
    
            else {return false};
    
        };
    
        formulaire.onreset = function()
	{
    
            for (var i = 0 ; i < inputsLength ; i++)
	    {
                if (inputs[i].type == 'text' || inputs[i].type == 'password')
		{
                    inputs[i].className = 'form-control';
                }
            }
            deactivateTooltips();
    
        };
    
	})();
    // Maintenant que tout est initialisé, on peut désactiver les « tooltips »
    deactivateTooltips();

})();