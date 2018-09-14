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
      <p class="subtitle_gray">Condividi questo sito fantastico con le amiche o gli amici!</p>
      <p class="subtitle_gray">Facendo clic su INVIA accetti che questi dettagli vengano aggiunti alla nostra banca dati.</p>
      
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
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
        <input type="image" src="images/submit.gif" name="submit" alt="submit button" />&nbspINVIA        
        <label></label>
      </form>

<!-- database connection with debugging message -->

<?php

// replace with name of database you are using:

$mydatabase = "aziendacampione";

$conn = mysqli_connect("localhost:8889", "root", "root", $mydatabase);

// in production, comment out from here...

  if (!$conn) {
      echo "<br>";
      echo "Error: Unable to connect to MySQL." . PHP_EOL;
      echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
  }
  echo "<br>";
  echo "A connection was made to the $mydatabase database on MySQL!" . PHP_EOL;
  echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;

// ...to here
?>

<?php

if(
  (isset($_POST['customername'])&& $_POST['customername'] !='') && 
  (isset($_POST['customeremail'])&& $_POST['customeremail'] !='') && 
  (isset($_POST['friendsname'])&& $_POST['friendsname'] !='') && 
  (isset($_POST['friendsemail'])&& $_POST['friendsemail'] !='')
  )

  {
    $customername =  $conn->real_escape_string($_POST['customername']);
    $customeremail =  $conn->real_escape_string($_POST['customeremail']);
    $friendsname =  $conn->real_escape_string($_POST['friendsname']);
    $friendsemail =  $conn->real_escape_string($_POST['friendsemail']);
    
    // replace with table you are writing to:

    $mytable = "recommendations";

    $sql = "INSERT INTO $mytable (customername, customeremail, friendsname, friendsemail)
      VALUES ('".$customername."', '".$customeremail."', '".$friendsname."', '".$friendsemail."')";
    
    if(!$result = $conn->query($sql)){
  die('There was an error running the query [' . $conn->error . ']');
  }
else
  {
    echo "<br>";
    echo "<br>Grazie mille, $customername. Il tuo amico / la tua amica $friendsname è stato contattato/a.";
    echo "<p>Questi sono i dati che hai aggiunto alla nostra banca dati:</p>";
    echo "<br>";
    echo "<span style='font-weight: bold;'>il tuo nome: </span>";
    echo $customername;
    echo "<br>";
    echo "<span style='font-weight: bold;'>il tuo e-mail: </span>";
    echo $customeremail;
    echo "<br>";
    echo "<span style='font-weight: bold;'>il nome del tuo amico / della tua amica: </span>";
    echo $friendsname;
    echo "<br>";
    echo "<span style='font-weight: bold;'>il e-mail del tuo amico / della tua amica: </span>";
    echo $friendsemail;
    echo "<br>";
    echo "<br>";
    echo "<p>Puoi tornare indietro e inviare un altro amico, se lo desideri.</p>";

  }
} 
?>

<?php include 'inc/footer.php';?>
