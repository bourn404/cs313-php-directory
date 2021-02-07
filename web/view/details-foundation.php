<!DOCTYPE html>
<html lang="en">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/head.php'; ?>
  <title>Foundation Details - Foundationful</title>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/header.php'; ?>
  <h1 class="page-title">Foundation Details</h1>
  <div class="content-wrapper">
    <h2><?php echo $foundation['org_name']; ?></h2>
    <p>
      <?php echo "$foundation[address1]</br>$foundation[city], $foundation[state] $foundation[zip]"; ?>
    </p>
    <p><?php echo "<a href='$foundation[website]'>$foundation[website]</a>"; ?></p>

    <h3>Contacts</h3>
    <ul>
      <?php foreach($foundation_contacts as $contact):?>
        <li><?php echo "<a href='/contact/$contact[id]'>$contact[first_name] $contact[last_name]</a>, $contact[title]"; ?></li>
      <?php endforeach; ?>
    </ul>

    <h3>Programs</h3>
    <ul>
      <?php foreach($foundation_programs as $program):?>
        <li><?php echo "$program[program_name]</br>($program[program_frequency] $program[label])"; ?></li>
      <?php endforeach; ?>
    </ul>

  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/footer.php'; ?>
</body>
</html>