<?php # DISPLAY COMPLETE PRODUCTS PAGE.
session_start() ;
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'userid' ] ) ) { require ( 'login_tools1.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Shop' ;
include ( 'includes/header.html' ) ;

# Open database connection.
require ( 'connect_db1.php' ) ;
# Retrieve items from 'shop' database table whether there is a filter or not
if(!empty($_POST['type'])){
	$filter = $_POST['type'];
	$q = "SELECT * FROM product WHERE producttype='$filter'" ;
}
else {
	$q = "SELECT * FROM product" ;
}

if(!empty($_POST['sort'])){
	$sort = $_POST['sort'];
	$q = "SELECT * FROM product ORDER BY productprice $sort" ;
}
else {
	$q = "SELECT * FROM product" ;
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!--navigation links-->
            <li class="nav-item active">
                <a class="nav-link" href="cart1.php">View Cart</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="search1.php">Search Item</a>
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

<div class="container-fluid">
    <div class="row py-3">
        <div class="col-md-8">
            <?php
            if($_SESSION['privlevel'] == 'admin'){
            ?>	
	            <button type="button" class="btn btn-info">
		            Add Product
	            </button>
	
            <?php	
            }
            else { echo 'You are not an admin'; }
            ?>
        </div>
        <div class="col-md-4 text-right">
            <form action="shop1.php" method="post">
	            Price:
	            <select name="sort">
		            <option value="ASC">Lowest to Highest</option>
		            <option value="DESC">Highest to Lowest</option>
	            </select>
	            <input type="Submit" value="Sort" />
            </form>
        </div>
    </div>
    <?php
    if(!empty($_POST['type'])){ ?>
        <div class="row">
                <div class="col-8">
		            <div class="alert alert-info" role="alert">
			            You are viewing products of type: <?php echo $filter; ?>. 
			            <button type="button" class="btn btn-warning">
				            <a href="shop.php">Clear Filter</a>
			            </button>

		            </div>
	            </div>
        </div>
    <?php } ?>

    <div class="row">
        <?php 
          
            $r = mysqli_query( $dbc, $q ) ;
            if ( mysqli_num_rows( $r ) > 0 )
            {
                while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
                { ?>
            <div class="col-md-4 text-center p-3 mt-5">
                <h3><?php echo $row['productname']; ?></h3>
                <div style="font-size:smaller"> 
                    <?php echo $row['productdescription']; ?>
                </div>
                <div class="mt-2">
                    <img src='images/<?php echo $row['productimage']; ?>' style="max-width:200px;">
                </div>
                <div>
                    $<?php echo $row['productprice']; ?>
                </div>
                <a href="added1.php?id=<?php echo $row['productid']?>">Add To Cart</a>
            </div>
  
        <?php } ?>
    </div>
</div>

 
  
  <?php
  # Close database connection.
  mysqli_close( $dbc ) ; 
}
# Or display message.
else { echo '<p>There are currently no items in this shop.</p>' ; }

?>
<?php
# Display footer section.
include ( 'includes/footer.html' ) ;
?>
