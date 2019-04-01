<?php # DISPLAY POST MESSAGE FORM.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'userid' ] ) ) { require ( 'login_tools1.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Post Message' ;
include ( 'includes/header.html' ) ;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Hardware</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!--navigation links-->
            <li class="nav-item active">
                <a class="nav-link" href="shop1.php">Shop</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="cart1.php">View Cart</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="forum1.php">Forum</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="home1.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="goodbye1.php">Logout</a>
            </li>
        </ul>
        <span class="form-inline my-2 my-lg-0 text-right pr-1">
            <?=$_SESSION['firstname']?><?=$_SESSION['lastname']?> : <?=$_SESSION[ 'emailaddress' ]?>
            <br /><?=$_SESSION['location']?>
        </span>
    </div>
</nav>

<?php

# Display form.
echo '<form action="post_action1.php" method="post" accept-charset="utf-8">
<p>Subject:<br><input name="title" type="text" size="64" maxlength="100"></p>
<p>Message:<br><textarea name="message" rows="5" cols="50"></textarea></p>
<p><input name="submit" type="submit" value="Submit"></p></form>';

?>


<?php
# Display footer section.
include ( 'includes/footer.html' ) ;

?>
