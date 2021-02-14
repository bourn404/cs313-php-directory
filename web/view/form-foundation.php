<?php

$states = array(
	'AL'=>'ALABAMA',
	'AK'=>'ALASKA',
	'AZ'=>'ARIZONA',
	'AR'=>'ARKANSAS',
	'CA'=>'CALIFORNIA',
	'CO'=>'COLORADO',
	'CT'=>'CONNECTICUT',
	'DE'=>'DELAWARE',
	'DC'=>'DISTRICT OF COLUMBIA',
	'FL'=>'FLORIDA',
	'GA'=>'GEORGIA',
	'HI'=>'HAWAII',
	'ID'=>'IDAHO',
	'IL'=>'ILLINOIS',
	'IN'=>'INDIANA',
	'IA'=>'IOWA',
	'KS'=>'KANSAS',
	'KY'=>'KENTUCKY',
	'LA'=>'LOUISIANA',
	'ME'=>'MAINE',
	'MD'=>'MARYLAND',
	'MA'=>'MASSACHUSETTS',
	'MI'=>'MICHIGAN',
	'MN'=>'MINNESOTA',
	'MS'=>'MISSISSIPPI',
	'MO'=>'MISSOURI',
	'MT'=>'MONTANA',
	'NE'=>'NEBRASKA',
	'NV'=>'NEVADA',
	'NH'=>'NEW HAMPSHIRE',
	'NJ'=>'NEW JERSEY',
	'NM'=>'NEW MEXICO',
	'NY'=>'NEW YORK',
	'NC'=>'NORTH CAROLINA',
	'ND'=>'NORTH DAKOTA',
	'OH'=>'OHIO',
	'OK'=>'OKLAHOMA',
	'OR'=>'OREGON',
	'PW'=>'PALAU',
	'PA'=>'PENNSYLVANIA',
	'PR'=>'PUERTO RICO',
	'RI'=>'RHODE ISLAND',
	'SC'=>'SOUTH CAROLINA',
	'SD'=>'SOUTH DAKOTA',
	'TN'=>'TENNESSEE',
	'TX'=>'TEXAS',
	'UT'=>'UTAH',
	'VT'=>'VERMONT',
	'VI'=>'VIRGIN ISLANDS',
	'VA'=>'VIRGINIA',
	'WA'=>'WASHINGTON',
	'WV'=>'WEST VIRGINIA',
	'WI'=>'WISCONSIN',
	'WY'=>'WYOMING'
);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/head.php'; ?>
  <title><?php echo $page_title; ?> - Foundationful</title>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/header.php'; ?>
  <h1 class="page-title"><?php echo $page_title; ?></h1>
  <div class="content-wrapper">
  <form action="" method="post">
  <label for="org_name">Foundation Name:</label>
    <input type="text" name="org_name" id="org_name" required value="<?php echo $foundation['org_name']; ?>" autofocus/>
    <label for="address1">Street Address:</label>
    <input type="text" name="address1" id="address1" value="<?php echo $foundation['address1']; ?>" />
    <label for="city">City:</label>
    <input type="text" name="city" id="city" value="<?php echo $foundation['city']; ?>" />
    <label for="state">State:</label>
    <select name="state" id="state">
        <?php 
            $options = '';
            foreach($states as $abbreviation => $state) {
                $options .= "<option value='$abbreviation'>$state</option>";
            }
            echo "<option disabled selected>Select One</option>";
            echo $options;
        ?>
    </select>
    <label for="zip">Zip Code:</label>
    <input type="text" name="zip" id="zip" value="<?php echo $foundation['zip']; ?>" />
    <input type="hidden" name="id" value="<?php echo $foundation['id']; ?>">
    </br></br>
    <input type ="submit" value="<?php echo $submit_text ?>" class="btn" />
  </form>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partials/footer.php'; ?>
</body>
</html>