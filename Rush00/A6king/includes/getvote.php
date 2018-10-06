    <?php
    include(''.$_SERVER['DOCUMENT_ROOT'].'/A6king/includes/connect.php');
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $pageID = $donnees['ID']; // The ID of the page, the article or the video ...

    //function to calculate the percent

    // check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
        $dislike_sql = $bdd->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = :ip and id_item = :pageID and rate = 2 ');
        $dislike_sql->execute(array(
                                    'ip'        => $user_ip,
                                    'pageID'    => $pageID
                                    ));
        $clickdislike = $dislike_sql->fetch();
        $dislike_count = $clickdislike[0];

        $like_sql = $bdd->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = :ip and id_item = :pageID and rate = 1 ');
        $like_sql->execute(array(
                                    'ip'        => $user_ip,
                                    'pageID'    => $pageID
                                    ));
        $clicklike = $like_sql->fetch();
        $like_count = $clicklike[0];

        // count all the rate 
        $rate_all_count = $bdd->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = :pageID');
               $rate_all_count->execute(array(
                                    'pageID'    => $pageID
                                    ));
        $allcount = $rate_all_count->fetch();
        $finalcount = $allcount[0];

        $rate_like_count = $bdd->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = :pageID and rate = 1');
        $rate_like_count->execute(array(
                                    'pageID'    => $pageID
                                    ));
        $alllike = $rate_like_count->fetch();
        $finallike = $alllike[0];
        
        $rate_like_percent = percent($finallike, $finalcount);

        $rate_dislike_count = $bdd->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = :pageID and rate = 2');
        $rate_dislike_count->execute(array(
                                    'pageID'    => $pageID
                                    ));
        $alldislike = $rate_dislike_count->fetch();
        $finaldislike = $alldislike[0];
        
        $rate_dislike_percent = percent($finaldislike, $finalcount);
        
?>

<script>
    $(function(){ 
        var pageID = <?php echo $pageID;  ?>;

        $('.like-btn').click(function(){
            $('.dislike-btn').removeClass('dislike-h active');    
            $(this).addClass('active like-h');
            
            $.ajax({
                type:"POST",
                url:"/A6king/includes/ajax.php",
                data:'act=like&pageID='+pageID,
                success: function(){
                }
            });
            
        });
        $('.dislike-btn').click(function(){
            $('.like-btn').removeClass('like-h active');
            $(this).addClass('dislike-h active');
            
            $.ajax({
                type:"POST",
                url:"/A6king/includes/ajax.php",
                data:'act=dislike&pageID='+pageID,
                success: function(){
                }
            });
            
        });
    });
</script>