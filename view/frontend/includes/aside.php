<aside class="col-md-4 col-sm-12 sidebar">
  <div class="sidebox box widget">
    <?php include "view/frontend/forms/form_search.php"; ?>
  </div>
  <div class="sidebox box widget">
    <h4>Derniers articles</h4>
    <?php
      while ($data = $posts1->fetch())
      {
      ?>
      <ul>
        <li>
          <a href="index.php?action=blogpost&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']); ?></a>
        </li>
      </ul>
      <?php  
        } 
        $posts1->closeCursor();
      ?>
  </div>
</aside>