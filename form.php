<?php include 'inc/header.php';?>

<!-- form entry and validation -->

<?php 
// set empty variables
$customernameErr = $customeremailErr = $friendsnameErr = $friendsemailErr = "";
$customername = $customeremail = $friendsname = $friendsemail = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["customername"])) {
    $customernameErr = "inserisci il tuo nome";
  } else {
    $customername = form_input($_POST["customername"]);
     // only letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$customername)) {
      $customernameErr = "inserisci un nome valido";
    }
  }

  if (empty($_POST["customeremail"])) {
    $customeremailErr = "inserisci il tuo indirizzo e-mail";
  } else {
    $customeremail = form_input($_POST["customeremail"]);
     // check if e-mail address is well-formed
    if (!filter_var($customeremail, FILTER_VALIDATE_EMAIL)) {
      $customeremailErr = "inserisci un indirizzo e-mail valido";
    }
  }

if (empty($_POST["friendsname"])) {
    $friendsnameErr = "inserisci un nome";
  } else {
    $friendsname = form_input($_POST["friendsname"]); 
    // only letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$friendsname)) {
      $friendsnameErr = "inserisci un nome valido";
    }
  }

if (empty($_POST["friendsemail"])) {
    $friendsemailErr = "inserisci un indirizzo e-mail";
  } else {
    $friendsemail = form_input($_POST["friendsemail"]);
    // check if e-mail address is well-formed
    if (!filter_var($friendsemail, FILTER_VALIDATE_EMAIL)) {
      $friendsemailErr = "inserisci un indirizzo e-mail valido";
    }
  }

}

// this is needed to return the form data below the form

function form_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

      <h2 class="secondary_heading">Invia ad un'amica o un amico</h2>
      <p class="subtitle_gray">condividi questo sito fantastico con le amiche o gli amici!</p>
      
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
      <!-- if you replace action='filename' with "echo htmlspecialchars($_SERVER["PHP_SELF"]);", it will be more secure -->
      <ul>
        <li class="main_form">
          <label>Il tuo nome * </label>
          <input type="text" name="customername" value="<?php echo $_POST['customername']; ?>">
          <span class="error">&nbsp<?php echo $customernameErr;?></span>
        </li>
        
        <li class="main_form">
          <label>Il tuo indirizzo email * </label>
          <input type="text" name="customeremail" value="<?php echo $_POST['customeremail']; ?>">
          <span class="error">&nbsp<?php echo $customeremailErr;?></span>
        </li>
        
        <li class="main_form">
          <label>il nome del tuo amico / della tua amica * </label>
          <input type="text" name="friendsname" value="<?php echo $_POST['friendsname']; ?>">
          <span class="error">&nbsp<?php echo $friendsnameErr;?></span>
        </li>
        
        <li class="main_form">
          <label>il indirizzo e-mail del tuo amico / della tua amica * </label>
          <input type="text" name="friendsemail" value="<?php echo $_POST['friendsemail']; ?>">
          <span class="error">&nbsp<?php echo $friendsemailErr;?></span>
        </li>
      </ul>
      
      <p class="main_form">
        <label></label>
        <input type="image" src="images/submit.gif" name="submit" alt="submit button" />&nbspINVIA</p>
      </form>

<?php
echo "<span style='font-style: italic; font-weight: bold;'>Il tuo ingresso: </span>";
echo "<br>";
echo $customername;
echo "<br>";
echo $customeremail;
echo "<br>";
echo $friendsname;
echo "<br>";
echo $friendsemail;
?>



<?php include 'inc/footer.php';?>
