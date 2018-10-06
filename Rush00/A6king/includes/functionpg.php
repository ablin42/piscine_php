<?php
//Appel de la fonction pour afficher la pagination des pages

       
//---------------------- fonction pagination ---------------------------------
function paginate($url, $link, $total, $current, $numdiv, $adj=3) {
    // Initialisation des variables
    $prev = $current - 1; // numéro de la page précédente
    $next = $current + 1; // numéro de la page suivante
    $penultimate = $total - 1; // numéro de l'avant-dernière page
    $pagination = ''; // variable retour de la fonction : vide tant qu'il n'y a pas au moins 2 pages
  
        // Remplissage de la chaîne de caractères à retourner
        $pagination .= '<center><ul class="pager"><div id="pagination'.$numdiv.' ">';
    
        /* =================================
         *  Affichage du bouton [précédent]
         * ================================= */
        if ($current == 2) 
        {
            // la page courante est la 2, le bouton renvoie donc sur la page 1, remarquez qu'il est inutile de mettre $url{$link}1
            $pagination .= '<li class"previous"><a href="'.$link.'1"><span><i class="fui-arrow-left"></i></span></a><li>';
        } elseif ($current > 2) 
        {
            // la page courante est supérieure à 2, le bouton renvoie sur la page dont le numéro est immédiatement inférieur
            $pagination .= '<li class="previous"><a href="'.$link.''.$prev.'"><span><i class="fui-arrow-left"></i></span></a></li>';
        } else        {
            // dans tous les autres, cas la page est 1 : désactivation du bouton [précédent]
            $pagination .= '<li class="previous disabled"><span><i class="fui-arrow-left"></i></span></li>';
        }


        /* ===============================
         *  Affichage du bouton [suivant]
         * =============================== */
        if ($current == $total)
        {
            $pagination .= '<li class="next disabled"><span>Suivant <i class="fui-arrow-right"></i></span></li>';
        }
        else
        {
            $pagination .= '<li class="next"><a href="'.$url.''.$link.''.$next.'" id="next"><span>Suivant <i class="fui-arrow-right"></i></span></a></li>';
        }
  
        $pagination .= '</div></ul></center>';
     
  
    return ($pagination);
}

?>