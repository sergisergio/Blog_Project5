<ul>
    <li><?php echo '<a class="btn" href="index.php?action=blog&page='. ($currentPage - 1) . '">'.'Précédent'.'</a> '; ?></li>
        <?php
        for($i=1;$i<=$totalPages;$i++){
            if($i == $currentPage) {
                echo '<li><a class="btn active" href="index.php?action=blog&page='.$i. '">'.$i.'</a></li> ';
            } else {
                echo '<li><a class="btn" href="index.php?action=blog&page='.$i. '">'.$i.'</a></li> ';
            }
        }
        ?>
    <li><?php echo '<a class="btn" href="index.php?action=blog&page='. ($currentPage + 1) . '">'.'Suivant'.'</a> '; ?></li>
</ul>