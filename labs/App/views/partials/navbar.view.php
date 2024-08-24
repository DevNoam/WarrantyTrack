<?php
    $query = "SELECT  'navbar' AS tablename, id, displayName AS name, url, highlighted,NULL AS service, NULL AS icon, NULL AS skipBottom 
    FROM navbar UNION ALL SELECT 'social' AS tablename, id, NULL AS social_name, url, NULL AS highlighted, service, icon, skipBottom FROM social";
    $stmt = $database->query($query);
    $request = $stmt->fetchAll();
    $navbar = [];
    $social = [];
    
    foreach ($request as $row) {
        if ($row->tablename == 'navbar') {
            $navbar[] = $row;
        } else {
            $social[] = $row;
        }
    }
    ?>


  <nav class="navbar is-light is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
    <a class="navbar-item" href="/">
        <img src="/img/logo.webp" width="112" height="28">
      </a>
      <a id="navbar-button" role="button" class="navbar-burger">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="nav" class="navbar-menu">
      <div id="navbar-pages" class="navbar-start">
      </div>
      <div class="navbar-end">
        <div id="navbar-end" class="navbar-item has-text-centered">
        </div>
      </div>
    </div>
  </nav>
  
  
  <script>
    // Iterate over the navbar array
    <?php foreach ($navbar as $item): ?>
        $("#navbar-pages").append("<a class='navbar-item' href='<?php echo $item->url; ?>'> <p class='<?php echo $item->highlighted ? 'has-text-weight-medium' : ''; ?>'><?php echo $item->name; ?></p></a>");
    <?php endforeach; ?>


    <?php foreach ($social as $item): ?>
        <?php if ($item->name == "mail"): ?>
            $("#navbar-end").append("<a class='navbar-item <?php echo $item->icon; ?>' href='<?php echo $item->url; ?>' alt='<?php echo $item->name; ?>'></a>");
        <?php else: ?>
            $("#navbar-end").append("<a class='navbar-item <?php echo $item->icon; ?>' href='<?php echo $item->url; ?>' target='_blank' alt='<?php echo $item->name; ?>'></a>");
            $("#socialFront").append("<li> <a class='socialFront <?php echo $item->icon; ?>' href='<?php echo $item->url; ?>' target='_blank' </a> </li>");
            <?php if ($item->skipBottom === 0): ?>
                $("#socialFrontBtm").append("<li> <a class='socialFront <?php echo $item->icon; ?>' href='<?php echo $item->url; ?>' target='_blank' </a> </li>");
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</script>


<script src="js/navbar.js"></script>