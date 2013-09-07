<?php
require_once('config.inc');
require_once('connect.php');
$sql= "select * from PLU order by name;";
$result = mysql_query($sql);
if(mysql_error() != ""){
echo "Problem with query " . $sql . " error message is " . mysql_error();		
}
$shelf= '';
while($row= mysql_fetch_array($result)){
	
$shelf.="<div class=\"simpleCart_shelfItem\">";
$shelf.="<h3 class=\"item_name\">". $row['name'] ."</h3>";
$shelf.="Dept <span class=\"item_deptid\" >" . $row['deptID'] . "</span>";
$shelf.=" PLU <span class=\"item_pluid\" >" . $row['id'] . "</span>";
$shelf.=" Clerk <span class=\"item_clerkid\" >" . $_COOKIE['clerkId'] . "</span>";
if($row['deptID']=='1'){
$shelf.= "Tax<span class=\"item_stax\">" . round($row['unitPrice'] * .06,2) . "</span>";
}else{
$shelf.=" Tax <span class=\"item_stax\">" . 0.00 ."</span>";
}
$shelf.=" QTY <span class=\"item_quantity\">1 </span>";
if($row['deptID']=='1'){
	$shelf.="Price<span class=\"item_price\">" . round($row['unitPrice'] * 1.06,2) . "</span>";
	}
if($row['deptID']=='2'){
	$shelf.="Price<input class=\"item_price\"value=\"". $row['unitPrice']  . "\">" ;
	}
if($row['deptID']=='3'){
	$shelf.="Price<span class=\"item_price\">" . $row['unitPrice']  . "</span>";
	}	
$shelf.="<input type=\"button\" class=\"item_add\" value=\"add to cart\" />";
$shelf.="</div>\n";

}

?>
<!DOCTYPE html> 
<html> 
	<head>

	<title>Shopping Cart</title>
	 
				

    	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	
		<script src="../simplecart/test/inc/jquery.1.6.1.min.js"></script>');
		
		<script src="../simplecart/simpleCart.js"></script>
		<script src="crSimpleCart.js"></script>
	<style >

	 	.itemContainer{
			width:100%;
			float:left;
		}

		.itemContainer div{
			float:left;
			margin: 5px 20px 5px 20px ;
		}

		.itemContainer a{
			text-decoration:none;
		}

		.cartHeaders{
			width:100%;
			float:left;
		}

		.cartHeaders div{
			float:left;
			margin: 5px 20px 5px 20px ;
		}


	</style>
</head> 
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Gray and White Shopping Cart</h1></div>
<div data-role="content">
<p>
	Cart: <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)
	<br />
	<a href="javascript:;" class="simpleCart_empty">empty cart</a>
	<br />
	</p>
<h2> <?php echo ORGNAME_DEF ?> Available Items  </h2>

	

	<div class="sc_demo_items" >
	<? echo $shelf ?>
	</div>
	<div class="simpleCart_items" ></div>
	<br />
	SubTotal: <span id="simpleCart_total" class="simpleCart_total"></span> <br />
	Tax Rate: <span id="simpleCart_taxRate" class="simpleCart_taxRate"></span> <br />
	Tax: <span id="simpleCart_tax" class="simpleCart_tax"></span> <br />
	Shipping: <span id="simpleCart_shipping" class="simpleCart_shipping"></span> <br />
	-----------------------------<br />
	Final Total: <span id="simpleCart_grandTotal" class="simpleCart_grandTotal"></span> <br />
	<a href="javascript:;" class="simpleCart_checkout">checkout</a>	
	
	<div id="test_id"></div>
</div><!--End of content-->
<div data-role=footer><h1>Shopping Cart</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>
