<!DOCTYPE html>
<!-- Do not edit this file, copy the code to use it in your module-->
<html>
<head>
	<meta charset="utf-8">
    <title>Cart_display</title>
	<link rel="stylesheet" href="../css/bootstrap.css"  type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui.css">
</head>
<body>
    <?php require_once "class.MySQL.php"; ?>
  	<div class="container-fluid" name="c1">
		<div class="row" role="header">
			<?php include_once "header.php"; session_start();?>
		</div>
		<div class="container" name="c2"><!-- you can delete this div if you don't want the side bar-->
				<!--Navigation sidebar-->

				<!--Main Content area-->
				<form name="form1" action="cart_display.php" method="get">
				<div class ="container-fluid col-sm-11 col-lg-9" name="c3">
				    <h2>Your Shopping Cart</h2>
                  <!--  <div class="container col-sm-8 col-lg-7"> -->
                        <?php

                        $omysql=new MySQL();
                        if(!isset($_SESSION['authentication']))
                        {
                            $_SESSION['authentication'] = 0;
                        }
                        $usernm = $_SESSION['user_nm'];
                        $auth =  $_SESSION['authentication'];
                        $rows = 0;
                        $where=array("user_nm like"=>$usernm);
                        $from = "cart";
                        $omysql->Select($from, $where);
                        $rows = $omysql->records;
                        $res1 = $omysql->arrayedResult;
                        ?>
		            <table class="table table striped">
                        <tbody>
                            <?php
                            $i = 0;
                            $total=0;
                            $tax = 0;
                            $grandtot = 0;
                            $from = "items";
                            if($rows>0){
                                while($i<$rows)
                                {
                                    $item_id = $res1[$i]["item_id"];
                                    $where = array("item_id like"=>$item_id);
                                    $omysql->Select($from, $where);
                                    $res2 = $omysql->arrayedResult;
                                    $total = $res1[$i]["qty"]*$res2[0]["cost"];
                                    $grandtot+=$total;
                                    $tax = (($res2[0]["tax"]/100)*$total);
                                    $grandtot+=$tax;
                                    $qtyStr = strval($i)."qtyCart";
                                    $table = "cart";
                                    $pic_loc ="../upload/".$res2[0]["pic_loc"];
                                    if($omysql->records > 0)
                                    {
                                        echo "<tr>
                                        <td>
                                        <img src=".'"'.$pic_loc.'"'." width=".'"120"'."height=".'"120"'.">
                                        </td>
                                        <td>
                                        <h4><a href=".'"sale.php?item_id='.$item_id.'"'." >".$res2[0]["item_nm"]."</a></h4>"
                                        ."\n"."<small>Item price: ₹".$res2[0]["cost"]
                                        ."<br>"."Condition: ".$res2[0]["item_condition"]."
                                        </small></td>
                                        <td>
                                        Quantity:
                                        <input id=".'"'.$qtyStr.'"'."type=".'"text"'."value=".'"'.$res1[$i]["qty"].'"'."maxlength=".'"11"'."style=".'"width: 30px;"'.'/'.">
                                        "."<br>
                                        <font size=".'"2"'." align=".'"right"'."><a href=".'"#"'." name=".'"update"'." type=".'"submit"'." onClick=".'"'."update_qty('".$qtyStr."','".$item_id."','"."cart"."')".'"'."><u>Update</u></a></font>
                                        <br><br><small>Instant Delivery: ";
                                        if(trim($res2[0]["delivery_type"])=='instant')
                                        {
                                            echo "Available";
                                        }
                                        elseif(trim($res2[0]["delivery_type"])=='normal')
                                        {
                                            echo "Not Available";
                                        }

                                        echo "</small>
                                        </td>
                                        <td> &nbsp;&nbsp;₹".$total."<br><small>+₹".$tax."</small></td>
                                        </tr>";
                                        echo "<tr><td></td><td></td><td></td>
                                            <td>
                                            <font size=".'"2"'." align=".'"right"'.">
                                            <a href=".'"#"'." onClick=".'"'."remove_item('".$item_id."','"."cart"."')".'"'."><u>Remove</u></a>
                                            &nbsp;|&nbsp;
                                            <a href=".'"#"'."onClick=".'"'."save_add('".$item_id."','"."cart"."','"."saved_list"."')".'"'."><u>Save for Later</u></a>
                                            </font></td>
                                            </tr>
                                            ";
                                    }
                                    $i++;
                                }
                                echo"<tr><td></td><td></td><td></td>
                                <td><font style=".'"Comic Sans MS"'." size=".'"4"'." align=".'"right"'.">
                                Total: ₹".$grandtot."
                                </font></td></tr>
                                ";
                                echo"</tbody>
                                </table>";
                                echo"<hr size=10></hr>
                                <div class = ".'"fr ralign"'." align=".'"right"'.">
                                <button class=".'"btn"'." type=".'"button"'." href=".'"#"'."onClick=".'"'."continueShop()".'"'."><b>Continue Shopping</b></button>
                                &nbsp;
                                <button class=".'"btn btn-primary"'." type=".'"button"'." href=".'"#"'."onClick=".'"'."checkout()".'"'."><i class=".'"glyphicon glyphicon-shopping-cart glyphicon-white"'."></i><b> Proceed to Checkout</b></button>
                                </div>";
                            }
                                else if($rows==0)
                                {
                                    echo "<font style=".'"Comic Sans MS"'."color=".'"AF36ED"'."><b><h4>Your shopping cart is empty, but it doesn't have to be.</h4></b><br>
                                        There are lots of great deals awaiting you to bid or buy.<br>
                                        <u><a href=".'"#"'."onClick=".'"'."continueShop()".'"'.">Start Shopping</a></u>, click the ".'"Add to Cart"'." button for any item you wish to buy.<br></font>
                                        ";
                                }
                                //<img src =".'"www.soccerkraze.com/images/Adidas%20Estadio%20Team%20Backpack.JPG"'. 'alt=""'.">
                             ?>


                    <br><br><br>
                    <h2>Your Saved Items</h2>
                    <table class="table table striped">
                        <tbody>
                            <?php
                            $where=array("user_nm like"=>$usernm);
                            $from = "saved_list";
                            $omysql->Select($from, $where);
                            $rows1 = $omysql->records;
                            $res1 = $omysql->arrayedResult;
                            $i = 0;
                            $total=0;
                            $tax = 0;
                            $from = "items";
                            if($rows1>0){
                                while($i<$rows1)
                                {
                                    $item_id = $res1[$i]["item_id"];
                                    $where = array("item_id like"=>$item_id);
                                    $omysql->Select($from, $where);
                                    $res2 = $omysql->arrayedResult;
                                    $total = $res1[$i]["qty"]*$res2[0]["cost"];
                                    $tax = (($res2[0]["tax"]/100)*$total);
                                    $qtyStr = strval($i)."qtySaved";
                                    $table = "saved_list";
                                    $pic_loc = "../upload/".$res2[0]["pic_loc"];
                                    if($omysql->records > 0)
                                    {
                                        echo "<tr>
                                        <td>
                                        <img src=".'"'.$pic_loc.'"'." width=".'"120"'."height=".'"120"'.">
                                        </td>
                                        <td>
                                        <h4><a href=".'"sale.php?item_id='.$item_id.'"'." >".$res2[0]["item_nm"]."</a></h4>"
                                        ."\n"."<small>Item price: ₹".$res2[0]["cost"]
                                        ."<br>"."Condition: ".$res2[0]["item_condition"]."
                                        </small></td>
                                        <td>
                                        Quantity:
                                        <input id=".'"'.$qtyStr.'"'."type=".'"text"'."value=".'"'.$res1[$i]["qty"].'"'."maxlength=".'"11"'."style=".'"width: 30px;"'.'/'.">
                                        "."<br>
                                        <font size=".'"2"'." align=".'"right"'."><a href=".'"#"'." name=".'"update"'." onClick=".'"'."update_qty('".$qtyStr."','".$item_id."','"."saved_list"."')".'"'."><u>Update</u></a></font>
                                        <br><br><small>Instant Delivery: ";

                                        if(trim($res2[0]["delivery_type"])=='instant')
                                        {
                                            echo "Available";
                                        }
                                        elseif(trim($res2[0]["delivery_type"])=='normal')
                                        {
                                            echo "Not Available";
                                        }

                                        echo "</small>
                                        </td>
                                        <td> &nbsp;&nbsp;₹".$total."<br><small>+₹".$tax."</small></td>
                                        </tr>";
                                        echo "<tr><td></td><td></td><td></td>
                                            <td>
                                            <font size=".'"2"'." align=".'"right"'.">
                                            <a href=".'"#"'." onClick=".'"'."remove_item('".$item_id."','"."saved_list"."')".'"'."><u>Remove</u></a>
                                            &nbsp;|&nbsp;
                                            <a href=".'"#"'."onClick=".'"'."save_add('".$item_id."','"."saved_list"."','"."cart"."')".'"'."><u>Add to Cart</u></a>
                                            </font></td>
                                            </tr>
                                            ";
                                    }
                                    $i++;
                                }
                            }
                                if($rows1==0)
                                {
                                    echo "<font style=".'"Comic Sans MS"'."><b><h4>Want to save items in your cart to buy later?</h4></b><br>
                                        Then just click the ".'"Save for Later"'.".Remember, saved items aren't reserved for you, so don't wait too long to buy them.<br></font>";
                                }
                                //<img src =".'"www.soccerkraze.com/images/Adidas%20Estadio%20Team%20Backpack.JPG"'. 'alt=""'.">
                             ?>
                        </tbody>
                    </table>
		           <!--
						Write all
						your code
						here...
						It will appear in the content
						section of webpage
		           -->
              <!--  </div>  -->
                <!--Cart Status container -->


	    		</div>

	    		<br><br><br>
	    		<div class="col-sm-2 col-lg-2.5 sidebar">
				    <div class="well">
	               <?php
	               echo "<b>"."Cart Summary "."</b> (".$rows."&nbsp;";
                    if($rows==1)
                    {
                        echo "Item)";
                    }
                    else
                    {
                        echo "Items)";
                    }
                    echo "<br>";
                    if($rows>0)
                    {
                        echo "<b>"."Total: ₹".$grandtot."</b>"."<br>";
                    }
                    if($rows>0)
                    {
                        echo"<br><br><button class=".'"btn btn-primary"'." type=".'"button"'." href=".'"#"'."onClick=".'"'."checkout()".'"'."><i class=".'"glyphicon glyphicon-shopping-cart glyphicon-white"'."></i><b> Checkout</b></button>";
	                }
	               ?>
                </div>

                </div>
                </form>
		</div>
	</div>
	<!--All javascript placed at the end so that the page loads faster-->
    <script src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/custom/search_suggestions.js"></script>
	<script type="text/javascript">

        function validate_number(qtyStr){

          //  alert("Inside func validate");
            //Get the value of input field with id=qtyStr
            var val = document.getElementById(qtyStr).value;
            //If value is space or not a number
            if (val == "" || isNaN(val))
            {
                //"Not a Number" in the element
                return 0;
            }
            else
            {
                return 1;
            }

        }

        function update_qty(qtyStr,item_id,table){

           //alert("Inside func update");
            if(validate_number(qtyStr)==1)
            {
               // alert("Valid number");
                var q = document.getElementById(qtyStr).value;
                $.ajax({
                        url: "cartajax_update.php",
                        dataType: "json",
                        type: "GET",
                        data: {
                                qtyStr : q,
                                item_id : item_id,
                                table : table
                              },
                        success: function(response_data){
                        console.log(response_data);
                            if(response_data=="1")
                            {
                                alert("Updated");
                            }
                            else if(response_data=="0")
                            {
                                alert("Could not be Updated not in Stock!!!");
                            }
                            // as we have written datatype as json so jquery automatically converts the result
                            //from json... so responce_data is not json its already parsed
                        },
                        /*As of jQuery 1.5, the $.ajax() method returns the jqXHR object, which is a superset of the XMLHTTPRequest object.
                        error:  Function( jqXHR jqXHR, String textStatus, String errorThrown )
                        */
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError);
                        }
                    });
                }
                else
                {
                    alert("Please enter a numeric value ");
                }
        }

        function remove_item(item_id,table){
            //alert("Inside func remove");
            $.ajax({
                    url: "cartajax_remove.php",
                    dataType: "json",
                    type: "GET",
                    data: {
                            item_id : item_id,
                            table : table
                            },
                    success: function(response_data){
                    console.log(response_data);
                        if(response_data=="1")
                        {
                            alert("Removed, reloading page");
                            window.location.reload();
                        }
                        else if(response_data=="0")
                        {
                            alert("Could not be removed!!!");
                        }
                        // as we have written datatype as json so jquery automatically converts the result
                        //from json... so responce_data is not json its already parsed
                    },
                    /*As of jQuery 1.5, the $.ajax() method returns the jqXHR object, which is a superset of the XMLHTTPRequest object.
                    error:  Function( jqXHR jqXHR, String textStatus, String errorThrown )
                    */
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
        }

        function save_add(item_id,fromtable,totable){
            //alert("Inside func save_add");
            $.ajax({
                    url: "cartajax_save.php",
                    dataType: "json",
                    type: "GET",
                    data: {
                            item_id : item_id,
                            fromtable : fromtable,
                            totable : totable
                            },
                    success: function(response_data){
                    console.log(response_data);
                        if(response_data=="1")
                        {
                            alert("Removing, reloading page");
                            window.location.reload();
                        }
                        else if(response_data=="0")
                        {
                            alert("Operation unsuccessful!!!");
                        }
                        else if(response_data=="stock alert")
                        {
                            alert("Sorry, cannot move the item as not enough stock!!!");
                        }
                        // as we have written datatype as json so jquery automatically converts the result
                        //from json... so responce_data is not json its already parsed
                    },
                    /*As of jQuery 1.5, the $.ajax() method returns the jqXHR object, which is a superset of the XMLHTTPRequest object.
                    error:  Function( jqXHR jqXHR, String textStatus, String errorThrown )
                    */
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

        }

        function checkout(){
            //alert("in func checkout");
            var a = <?php echo $auth;?>;
            //alert(a);
            if(a)
            {
                window.location.href = "def_check.php";
                //authenticated so go to checkout.php

            }
            else
            {
                window.location.href = "cart_login.php";
                //not authenticated so go login page
            }
        }
        function continueShop(){
          //  alert("in func continueShop");
            window.location.href = "index.php";
        }

	</script>
</body>
</html>
