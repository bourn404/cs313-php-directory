<!DOCTYPE html>
<html lang="en">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/head.php'; ?>
  <title>Contacts Directory - Foundationful</title>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/header.php'; ?>
  <h1 class="page-title">Contacts Directory</h1>
  <div class="content-wrapper">
    <form action="" method="get" class="search-form">
      <input type="search" name="search" id="search" placeholder="Search by name or organization." value="<?php echo $search_query; ?>">
      <input type="submit" class="btn" value="Go" />
    </form>
    <ul>
      <?php foreach($contacts as $person):
        
        if($person['title']) { $title_text = $person['title'] . "</br>"; } else { $title_text = ""; }
        ?>
        <li>
          <p><?php echo "<strong><a href='/contact/$person[id]'>$person[first_name] $person[last_name]</a></strong></br>$title_text$person[org_name]"; ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/footer.php'; ?>
</body>
</html>