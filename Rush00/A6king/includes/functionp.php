<?php
//Appel de la fonction pour afficher la pagination des pages

       
//---------------------- fonction pagination ---------------------------------
function paginate($url, $link, $total, $current, $numdiv, $adj=3) {
    // Initialisation des variables
    $prev = $current - 1; // numéro de la page précédente
    $next = $current + 1; // numéro de la page suivante
    $penultimate = $total - 1; // numéro de l'avant-dernière page
    $pagination = ''; // variable retour de la fonction : vide tant qu'il n'y a pas au moins 2 pages
  
    if ($total > 1) {
        // Remplissage de la chaîne de caractères à retourner
        $pagination .= "<div class=\"paginate\"><center><ul class=\"pager\"><div id=\"pagination" . $numdiv . "\" class=\"pagination\">\n";
        $pagination .= '<li><a href="?page=1"> &larr; Deb </li>';
        /* =================================
         *  Affichage du bouton [précédent]
         * ================================= */
        if ($current == 2) {
            // la page courante est la 2, le bouton renvoie donc sur la page 1, remarquez qu'il est inutile de mettre $url{$link}1
            $pagination .= "<li><a href=\"{$link}1\">&laquo;</a><li>";
        } elseif ($current > 2) {
            // la page courante est supérieure à 2, le bouton renvoie sur la page dont le numéro est immédiatement inférieur
            $pagination .= "<li><a href=\"{$link}{$prev}\">&laquo;</a></li>";
        } else {
            // dans tous les autres, cas la page est 1 : désactivation du bouton [précédent]
            $pagination .= '<li class="disabled"><span>&laquo;</span></li>';
        }
  
        /**
         * Début affichage des pages, l'exemple reprend le cas de 3 numéros de pages adjacents (par défaut) de chaque côté du numéro courant
         * - CAS 1 : il y a au plus 12 pages, insuffisant pour faire une troncature
         * - CAS 2 : il y a au moins 13 pages, on effectue la troncature pour afficher 11 numéros de pages au total
         */
  
        /* ===============================================
         *  CAS 1 : au plus 12 pages -> pas de troncature
         * =============================================== */
        if ($total < 7 + ($adj * 2)) {
            // Ajout de la page 1 : on la traite en dehors de la boucle pour n'avoir que index.php au lieu de index.php?p=1 et ainsi éviter le duplicate content
            $pagination .= ($current == 1) ? '<li class="active"><span>1</span></li>' : "<li><a href=\"{$link}1\">1</a></li>"; // Opérateur ternaire : (condition) ? 'valeur si vrai' : 'valeur si fausse'
  
            // Pour les pages restantes on utilise itère
            for ($i=2; $i<=$total; $i++) {
                if ($i == $current) {
                    // Le numéro de la page courante est mis en évidence (cf. CSS)
                    $pagination .= "<li class=\"active\"><span>{$i}</span></li>";
                } else {
                    // Les autres sont affichées normalement
                    $pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                }
            }
        }
        /* =========================================
         *  CAS 2 : au moins 13 pages -> troncature
         * ========================================= */
        else {
            /**
             * Troncature 1 : on se situe dans la partie proche des premières pages, on tronque donc la fin de la pagination.
             * l'affichage sera de neuf numéros de pages à gauche ... deux à droite
             * 1 2 3 4 5 6 7 8 9 … 16 17
             */
            if ($current < 2 + ($adj * 2)) {
                // Affichage du numéro de page 1
                $pagination .= ($current == 1) ? "<li class=\"active\"><span>1</span>" : "<a href=\"{$url}\">1</a></li>";
  
                // puis des huit autres suivants
                for ($i = 2; $i < 4 + ($adj * 2); $i++) {
                    if ($i == $current) {
                        $pagination .= "<li class=\"active\"><span>{$i}</span></li>";
                    } else {
                        $pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                    }
                }
  
                // ... pour marquer la troncature
                $pagination .= '&hellip;';
  
                // et enfin les deux derniers numéros
                $pagination .= "<li><a href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
                $pagination .= "<li><a href=\"{$url}{$link}{$total}\">{$total}</a></li>";
            }
            /**
             * Troncature 2 : on se situe dans la partie centrale de notre pagination, on tronque donc le début et la fin de la pagination.
             * l'affichage sera deux numéros de pages à gauche ... sept au centre ... deux à droite
             * 1 2 … 5 6 7 8 9 10 11 … 16 17
             */
            elseif ( (($adj * 2) + 1 < $current) && ($current < $total - ($adj * 2)) ) {
                // Affichage des numéros 1 et 2
                $pagination .= "<li><a href=\"{$url}\">1</a></li>";
                $pagination .= "<li><a href=\"{$url}{$link}2\">2</a></li>";
                $pagination .= '&hellip;';
  
                // les pages du milieu : les trois précédant la page courante, la page courante, puis les trois lui succédant
                for ($i = $current - $adj; $i <= $current + $adj; $i++) {
                    if ($i == $current) {
                        $pagination .= "<li class=\"active\"><span>{$i}</span></li>";
                    } else {
                        $pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                    }
                }
  
                $pagination .= '&hellip;';
  
                // et les deux derniers numéros
                $pagination .= "<li><a href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
                $pagination .= "<li><span><a href=\"{$url}{$link}{$total}\">{$total}</a></li>";
            }
            /**
             * Troncature 3 : on se situe dans la partie de droite, on tronque donc le début de la pagination.
             * l'affichage sera deux numéros de pages à gauche ... neuf à droite
             * 1 2 … 9 10 11 12 13 14 15 16 17
             */
            else {
                // Affichage des numéros 1 et 2
                $pagination .= "<li><a href=\"{$url}\">1</a></li>";
                $pagination .= "<li><a href=\"{$url}{$link}2\">2</a></li>";
                $pagination .= '&hellip;';
  
                // puis des neuf derniers numéros
                for ($i = $total - (2 + ($adj * 2)); $i <= $total; $i++) {
                    if ($i == $current) {
                        $pagination .= "<li class=\"active\"><span>{$i}</span></li>";
                    } else {
                        $pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                    }
                }
            }
        }
  
        /* ===============================
         *  Affichage du bouton [suivant]
         * =============================== */
        if ($current == $total)
            $pagination .= "<li class=\"disabled\"><span>&raquo;</span></li>\n";
        else
            $pagination .= "<li class=\"previous\"><a href=\"{$url}{$link}{$next}\" id=\"next\">&raquo;</a></li>\n";
  
        $last = $i - 1;
        $pagination .= '<li><a href="?page='.$last.'"> Fin &rarr; </a></li>';// Fermeture de la <div> d'affichage
        $pagination .= "</div></ul></center></div>\n\n";
    }
  
    return ($pagination);
}


?>