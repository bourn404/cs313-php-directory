<!DOCTYPE html>
<html lang="en">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/head.php'; ?>
  <title>Programs Directory - Foundationful</title>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/header.php'; ?>
  <h1 class="page-title">Programs Directory</h1>
  <div class="content-wrapper">
    <form action="" method="get" class="search-form">
      <input type="search" name="search" id="search" placeholder="Search by name or organization." value="<?php echo $search_query; ?>">
      <input type="submit" class="btn" value="Go" />
    </form>
    <ul>
      <?php foreach($programs as $program):?>
        <li>
          <p><?php echo "<strong>$program[program_name]</strong></br>($program[program_frequency] $program[label])</br><a href='/foundation/$program[organization_id]'>$program[org_name]</a>"; ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/footer.php'; ?>
</body>
</html>