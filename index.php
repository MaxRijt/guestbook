<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "max_vanderijt_guestbook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
  $insertSQL =
  "INSERT INTO
  guestbook
  (
  guestbookid,
  firstname,
  insertion,
  lastname,
  email,
  websiteAdres,
  messageTitle,
  messageDate,
  message
  )
  VALUES
  (
  null,
  '" . $_POST['firstname'] . "',
  '" . $_POST['insertion'] . "',
  '" . $_POST['lastname'] . "',
  '" . $_POST['email'] . "',
  '" . $_POST['websiteAdres'] . "',
  '" . $_POST['messageTitle'] . "',
  NOW(),
  '" . $_POST['message'] . "'
  )
  ";
    $result1 = $conn->query($insertSQL) or die($conn->error);
    header("Location: index.php");

}


//get Commands
  $getCommands = "SELECT * FROM guestbook";
  $resultCommand = $conn->query($getCommands) or die($conn->error);

  $heroRating = array();

  if ($resultCommand->num_rows > 0) {
    // output data of each row
    while ($row3 = $resultCommand->fetch_assoc())
    {
      $commands[]= $row3;
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Guestbook</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="description" content="Guestbook Max van de Rijt">
    <meta name="keywords" content="HTML,CSS">
    <meta name="author" content="Max van de Rijt">
    <meta name="copyright" content="Max van de Rijt">
  </head>
  <body>
    <div id="Main-Header">
      <h1>Guestbook - Max van de Rijt</h1>
    </div>
    <div class="Formulier">
      <form action="" action="" method="POST">
        <p>Post your command</p>
        <div class="first-name">
          <label for="fname">First Name:</label>
          <input type="text" id="fname" required name="firstname" placeholder="Your name..">*
        </div>

        <div class="insertion">
          <label for="lname">Insertion</label>
          <input type="text" id="insertion" name="insertion" placeholder="Insertion">
        </div>

        <div class="last-name">
          <label for="lname">Last Name:</label>
          <input type="text" id="lname" required name="lastname" placeholder="Your last name..">*
        </div>

        <div class="e-mail">
          <label for="lname">Your email:</label>
          <input type="email" id="email" required name="email" placeholder="Your email..">* <br />
        </div>

        <div class="webadress">
          <label for="lname">Website Adres:</label>
          <input type="text" id="SiteAdres" name="websiteAdres" placeholder="Your website adres.."> <br />
        </div>

        <div class="messageTitle">
          <label for="lname">Message Title</label>
          <input type="text" id="TitleMessage" required name="messageTitle" placeholder="Message Title..">* <br />
        </div>

        <div class="message">
          <br /><h1>Message:</h1>
          <textarea type="text" id="subject" required name="message" placeholder="What do you want to post?"></textarea>*<br />
        </div>

        <div class="Submit">
          <input type="hidden" required name="guestbookid"/>
          <a><input type="submit" name="submit" value="Submit" id="SubmitButton"></a>
        </div>

        <div class="Clear">
          <a><input type="button" value="Reset" id="ClearButton" onclick="clearContent()"></a>
        </div>

     </form>
    </div>

    <div class="Commands">

      <p>Posted commands</p>



      <?php
      if(!empty($commands))
      {
          // print table
          echo "<table class=\"reviewTable\">";
          foreach($commands as $guestbookCommand)
          {
              ?>
                <tr><td><i class="far fa-calendar" style="font-size:20px; color: #0282f9;"></i></td></tr>
                <td class="comment-firstname"><?php echo $guestbookCommand['firstname']; ?> <?php echo $guestbookCommand['insertion']; ?> <?php echo $guestbookCommand['lastname']; ?> |
                  <h1 class="comment-website">      </h1> <?php echo $guestbookCommand['websiteAdres']; ?> | <h1 class="comment-website">      </h1> <?php echo $guestbookCommand['messageDate']; ?>|</td>
                <tr><td class="comment-Title"><?php echo $guestbookCommand['messageTitle']; ?></td></tr>
                <tr><td class="comment-message"><?php echo $guestbookCommand['message']; ?></td></tr>
                <tr><td><i class="far fa-clock" style="font-size:24px; color: #0282f9;"></i></td></tr>
            <tr><td colspan="4"><hr /></td></tr>

              <?php
            }
              echo "</table>";
            }
            else
            {
          ?>
          <h5 class="reviewTable"><i class="fas fa-info-circle"></i>&nbsp;No comments yet..</h5>
          <?php
              }
              ?>

    </div>
    <div class="main-footer">
      <?php include 'inc/footer.php';?>
    </div>
  </body>
  <script src="js/main.js"></script>
</html>
