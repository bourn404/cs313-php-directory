<!DOCTYPE html>
<html lang="en">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/head.php'; ?>
  <title>Foundations Directory - Foundationful</title>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/header.php'; ?>
  <h1 class="page-title">Foundations Directory</h1>
  <div class="content-wrapper">
    <form action="" method="get" class="search-form">
      <input type="search" name="search" id="search" placeholder="Search by name, city, or state." value="<?php echo $search_query; ?>">
      <input type="submit" class="btn" value="Go" />
    </form>
    <ul>
      <?php foreach($foundations as $org): ?>
        <li>
          <p><?php echo "<strong><a href='/foundation/$org[id]'>$org[org_name]</a></strong></br>$org[city], $org[state]"; ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/footer.php'; ?>
</body>
</html>