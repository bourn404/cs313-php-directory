<!DOCTYPE html>
<html lang="en">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/head.php'; ?>
  <title><?php echo $page_title;?> - Foundationful</title>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/header.php'; ?>
  <h1 class="page-title"><?php echo $page_title;?></h1>
  <div class="content-wrapper">
    <form action="" method="post">
    <table class="entry-details-table">
      <tr>
          <td><label for="first_name">First Name:</label></td>
          <td><input type="text" name="first_name" id="first_name" required value="<?php echo "$contact[first_name]"; ?>" autofocus/></td>
      </tr>
      <tr>
          <td><label for="last_name">Last Name:</label></td>
          <td><input type="text" name="last_name" id="last_name" required value="<?php echo "$contact[last_name]"; ?>"/></td>
      </tr>
      <tr>
          <td><label for="title">Title:</label></td>
          <td><input type="text" name="title" id="title" value="<?php echo "$contact[title]"; ?>"/></td>
      </tr>
      <tr>
          <td><label for="organization_id">Organization:</label></td>
          <td>
          <select name="organization_id" id="organization_id">
            <?php 
              $options = '';
              foreach($foundations as $foundation) {
                echo "<option value='$foundation[id]'>$foundation[org_name]</option>";
              }
            ?>
          </select></td>
      </tr>
      <tr>
        <td><label for="is_primary_contact">Primary Contact</label></td>
        <td><input type="checkbox" name="is_primary_contact" id="is_primary_contact" value="1"></td>
      </tr>
      <tr>
          <td><label for="email">Email:</label></td>
          <td><input type="text" name="email" id="email" value="<?php echo "$contact[email]"; ?>"/></td>
      </tr>
      <tr>
          <td><label for="phone">Phone:</label></td>
          <td><input type="text" name="phone" id="phone" value="<?php echo "$contact[phone]"; ?>"/></td>
      </tr>
      <tr>
        <td><label for="notes">Notes:</label></td>
        <td><textarea name="notes" id="notes"><?php echo "$contact[notes]"; ?></textarea></td>
      </tr>
    </table>
    <input type="hidden" name="id" value="<?php echo "$contact[id]"; ?>">
    <input type ="submit" value="<?php echo $submit_text ?>" class="btn" />

    </form>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/footer.php'; ?>
</body>
</html>