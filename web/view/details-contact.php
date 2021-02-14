<!DOCTYPE html>
<html lang="en">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/head.php'; ?>
  <title>Contact Details - Foundationful</title>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/header.php'; ?>
  <h1 class="page-title">Contact Details</h1>
  <p class="text-center"><a class="btn" href="/contact/edit/<?php echo $contact['id'];?>"><i class="fas fa-pencil"></i> Edit</a> <a class="btn" href="/contact/delete/<?php echo $contact['id'];?>"><i class="fas fa-trash"></i> Delete</a></p>
  <div class="content-wrapper">
    <h2><?php echo "$contact[first_name] $contact[last_name]"; ?></h2>
    <table class="entry-details-table">
      <tr>
        <td>Title:</td>
        <td><?php echo "$contact[title]"; ?></td>
      </tr>
      <tr>
        <td>Organization:</td>
        <td><?php echo "<a href='/foundation/$contact[organization_id]'>$contact[org_name]</a>"; ?></td>
      </tr>
      <tr>
        <td>Primary Contact:</td>
        <td><?php if($contact['is_primary_contact']) { echo "Yes"; } else { echo "No"; } ?></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><?php echo "<a href='mailto:$contact[email]'>$contact[email]</a>"; ?></td>
      </tr>
      <tr>
        <td>Phone:</td>
        <td><?php echo "<a href='tel:$contact[phone]'>$contact[phone]</a>"; ?></td>
      </tr>
      <tr>
        <td>Notes:</td>
        <td><?php echo "$contact[notes]"; ?></td>
      </tr>
    </table>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/footer.php'; ?>
</body>
</html>