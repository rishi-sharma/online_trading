<!DOCTYPE html>
<!-- Do not edit this file, copy the code to use it in your module-->
<html>
<head>
    <meta charset="utf-8">
    <title>Template</title>
    <link rel="stylesheet" href="../css/bootstrap.css"  type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui.css">



    <!--some problem in this link-->
    <link href="../css/bootstrap-combined.min.css" rel="stylesheet" type="text/css">








    <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap-datetimepicker.min.css">
    
</head>
<body>
    <div class="container-fluid">
        <div class="row" role="header">
            <?php include_once "header.php";?> 
        </div>


<?php 
                    $user_nm = $_SESSION["user_nm"];
                require_once "class.MySQL.php";
                  $object = new MySQL();
    $where=array("user_nm like"=>$user_nm);
    $object->Select("user",$where);
     if($object->records>0){
                        $result = $object->arrayedResult;
                        foreach($result as $row){
                          //$pic = $row["pic_loc"];
                          $credits = (int)$row["credit"];
                      }
                      }
                        $promotion=(int)$_POST['promotion'];
                         $credit_new = $credits - $promotion;
                          
                         $new = new MySQL();
                         $set = array('credit'=>$credit_new);
                      $where = array("user_nm like"=>$user_nm);
            $new->Update("user",$set,$where);
                      ?>





<?php  
            require_once "class.MySQL.php";           
            $test = new MySQL(); 
            $type = "auction";
           // session_start();
            $usrnm=$_SESSION["user_nm"];
            $date1 = $_POST['start_date_1'];
            $date2 = $_POST['close_date_1'];
            $datetime1 = new DateTime($date1);
            $datetime2 = new DateTime($date2);
            $f=$datetime2->diff($datetime1);
            $fy = $f->y;
            $fm = $f->m;
            $fd = $f->d;
            $fh = $f->h;
            $fi = $f->i;
            $fs = $f->s;
            $g=($fy*31536000)+($fm*2592000)+($fd*86400)+($fh*3600)+($fi*60)+$fs;
            //echo $g;
            if($datetime2->format('U') > $datetime1->format('U') && $g>=7200){

            if(isset($_POST["base_price_1"]) && isset($_POST['close_date']) && isset($_POST['type_1']) && isset($_POST['condition_1']) && isset($_POST['name_1']) && isset($_POST['description_1']) && isset($_POST['mrp_1']) && isset($_POST['model_1']) && isset($_POST['brand_1']) && isset($_POST['quantity_1']))
            {
                
           
           //echo "mittal1";
                $allowedExts = array("gif", "jpeg", "jpg", "png");
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);    
                    if ((($_FILES["file"]["type"] == "image/gif")       
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && in_array($extension, $allowedExts))  
                {
                        if ($_FILES["file"]["error"] > 0)
                            {
                                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                            }
                        else
                            {     
                                echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                                echo "Type: " . $_FILES["file"]["type"] . "<br>";
                                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                            if (file_exists("../upload/" . $_FILES["file"]["name"]))
                                {
                                    echo $_FILES["file"]["name"] . " already exists. ";
                                }
                            else
                                {
                                $count = new MySQL();
                                $x = $count->Select("items","","item_id DESC","1");
                                echo $count->records;
                    
                                $pic_loc= $x[0]["item_id"]+1;
                                $_FILES["file"]["name"] =$pic_loc.".jpg";
                                move_uploaded_file($_FILES["file"]["tmp_name"],
                                "../upload/" . $_FILES["file"]["name"]);
                                echo "Stored in: " . "../upload/" . $_FILES["file"]["name"];
                $sale_type="auction";
                        // remove and for getting username use $_SERVER["user_nm"]
                        $category1 = "Electronics";
                       // $type = "auction";
                        $type_1 = $_POST['type_1'];
                        $name = $_POST['name_1'];
                        $brand = $_POST['brand_1'];
                        $model = $_POST['model_1'];
                        $mrp=$_POST['mrp_1'];
                        $quantity=$_POST['quantity_1'];
                        $condition = $_POST['condition_1'];
                        $description = $_POST['description_1'];
                        $base_price = $_POST['base_price_1'];
                        $close_date = $_POST['close_date'];
                        $start_date = $_POST['start_date'];
                        $category=$category1.":".$type_1;
                        $string5 = "";
                        if (isset($_POST['Mobiles'])){
                            $string5=$string5."mobiles,";
                        }
                        if(isset($_POST['Computers'])){
                            $string5=$string5."computers,";
                        }
                        if(isset($_POST['Tablets'])){
                            $string5=$string5."tablets,";
                        }
                        if(isset($_POST['Mobile_Accessories'])){
                            $string5=$string5."mobile accessories,";
                        }
                         if (isset($_POST['Computer_Accessories'])){
                            $string5=$string5."computer accessories,";
                        }
                        if(isset($_POST['Speakers'])){
                            $string5=$string5."speakers,";
                        }
                        if(isset($_POST['Cameras_and_Accessories'])){
                            $string5=$string5."cameras and accessories,";
                        }
                        if(isset($_POST['Audio_and_Video_players'])){
                            $string5=$string5."audio and video players,";
                        }
                        $x="description: ".$description." ;"."category: ".$category." ;"."type: ".$type." ;"."brand: ".$brand." ;"."name: ".$name." ;"."mrp: ".$mrp." ;"."base_price: ".$base_price." ;"."start_date: ".$start_date." ;"."close_date: ".$close_date." ;"."model: ".$model;
            $vars = array('promotion_amnt'=>$promotion,'tags'=>$string5,'user_nm'=>$usrnm,'quantity'=>$quantity,'pic_loc'=>$_FILES["file"]["name"],'item_nm'=>$name,'cost'=>$mrp,'item_condition'=>$condition,'description'=>$x,'type'=>$type,'category'=>$category,'last_date'=>$_POST['close_date'],'start_date'=>$start_date,'model'=>$model,'sale_type'=>$sale_type,'base_price'=>$base_price);
            $test->Insert($vars,"items");
            
            // echo $test->lastQuery;
                       echo "Thank u";
                        

                                }
                            }
                }
                    else
                    {
                    echo "Invalid file0";
                    }

            }

                       else if(isset($_POST["type_2"]) && isset($_POST['name_2']) && isset($_POST['author_2']) && isset($_POST['condition_2']) && isset($_POST['mrp_2']) && isset($_POST['description_2']) && isset($_POST['base_price_2'])  && isset($_POST['close_date']))
                       {
                        // echo "mittal1";
                        //session_start();
                         $allowedExts = array("gif", "jpeg", "jpg", "png");
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);    
                    if ((($_FILES["file"]["type"] == "image/gif")       
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && in_array($extension, $allowedExts))  
                {
                        if ($_FILES["file"]["error"] > 0)
                            {
                                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                            }
                        else
                            {
                                echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                                echo "Type: " . $_FILES["file"]["type"] . "<br>";
                                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                            if (file_exists("../upload/" . $_FILES["file"]["name"]))
                                {
                                    echo $_FILES["file"]["name"] . " already exists. ";
                                }
                            else
                                {
                                $count = new MySQL();
                                $x = $count->Select("items","","item_id DESC","1");
                                $pic_loc=$x[0]["item_id"]+1;
                                $_FILES["file"]["name"] =$pic_loc.".jpg";
                                move_uploaded_file($_FILES["file"]["tmp_name"],
                                "../upload/" . $_FILES["file"]["name"]);
                                echo "Stored in: " . "../upload/" . $_FILES["file"]["name"];
                
                            // echo $test->lastQuery;
                            $sale_type="auction";
                        //$_SESSION["user_nm"]="shubahm";// remove and for getting username use $_SERVER["user_nm"]
                        $category1 = "Books";
                        $name = $_POST['name_2'];
                        $author = $_POST['author_2'];
                        $mrp=$_POST['mrp_2'];
                        $genre=$_POST['type_2'];
                        $type_1=$_POST['type_2'];
                        $quantity=$_POST['quantity_2'];
                        $condition = $_POST['condition_2'];
                        $description = $_POST['description_2'];
                        $base_price = $_POST['base_price_2'];
                        $close_date = $_POST['close_date'];
                        $start_date = $_POST['start_date'];
                        $category=$category1.":".$type_1;
                        $string4 = "";
                        if (isset($_POST['Textbooks'])){
                            $string4=$string4."textbooks,";
                        }
                        if(isset($_POST['Literature'])){
                            $string4=$string4."literature,";
                        }
                        if(isset($_POST['Bussiness_Magazines'])){
                            $string4=$string4."business magazines,";
                        }
                        if(isset($_POST['Science_journals'])){
                            $string4=$string4."science journals,";
                        }
                       // echo $string4;
                         $x="description: ".$description." ;"."category: ".$category." ;"."type: ".$type." ;"."author: ".$author." ;"."name: ".$name." ;"."mrp: ".$mrp." ;"."base_price: ".$base_price." ;"."start_date: ".$start_date." ;"."close_date: ".$close_date;
                        $vars = array('promotion_amnt'=>$promotion,'tags'=>$string4,'user_nm'=>$usrnm,'quantity'=>$quantity,'type'=>$type,'author_nm'=>$author,'pic_loc'=>$_FILES["file"]["name"],'item_nm'=>$name,'cost'=>$mrp,'item_condition'=>$condition,'description'=>$x,'genre'=>$genre,'category'=>$category,'start_date'=>$start_date,'last_date'=>$close_date,'sale_type'=>$sale_type,'base_price'=>$base_price);
                        $test->Insert($vars,"items");
                        echo "wow";
                        
                                }
                            }
                         }
                    else
                    {
                    echo "Invalid file90";
                    }
                       }



                       else if(isset($_POST["type_4"]) && isset($_POST['name_4']) && isset($_POST['brand_4']) && isset($_POST['condition_4']) && isset($_POST['mrp_4']) && isset($_POST['description_4']) && isset($_POST['base_price_4'])  && isset($_POST['close_date']) && isset($_POST['model_4']) && isset($_POST['start_date']))
                       {
                        // echo "mittal1";
                        echo "appliances";
                        //session_start();
                             $allowedExts = array("gif", "jpeg", "jpg", "png","PNG");
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);    
                    if ((($_FILES["file"]["type"] == "image/gif")       
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/PNG")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && in_array($extension, $allowedExts))  
                {
                        if ($_FILES["file"]["error"] > 0)
                            {
                                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                            }
                        else
                            {
                                echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                                echo "Type: " . $_FILES["file"]["type"] . "<br>";
                                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                            if (file_exists("../upload/" . $_FILES["file"]["name"]))
                                {
                                    echo $_FILES["file"]["name"] . " already exists. ";
                                }
                            else
                                {
                                $count = new MySQL();
                                $x = $count->Select("items","","item_id DESC","1");
                                $pic_loc=$x[0]["item_id"]+1;
                                $_FILES["file"]["name"] =$pic_loc.".jpg";
                                move_uploaded_file($_FILES["file"]["tmp_name"],
                                "../upload/" . $_FILES["file"]["name"]);
                                echo "Stored in: " . "../upload/" . $_FILES["file"]["name"];
                
                            // echo $test->lastQuery;
                             $sale_type="auction";
                      //  $_SESSION["user_nm"]="shubahm";// remove and for getting username use $_SERVER["user_nm"]
                        $category1 = "Appliances";
                        $type_1 = $_POST['type_4'];
                        $name = $_POST['name_4'];
                        $brand = $_POST['brand_4'];
                        $mrp=$_POST['mrp_4'];
                        $model=$_POST['model_4'];
                        $quantity=$_POST['quantity_4'];
                        $condition = $_POST['condition_4'];
                        $description = $_POST['description_4'];
                        $base_price = $_POST['base_price_4'];
                        $close_date = $_POST['close_date'];
                        $start_date = $_POST['start_date'];
                        $category=$category1.":".$type_1;
                        $string1 = "";
                        if (isset($_POST['Cookers'])){
                            $string1=$string1."cookers,";
                        }
                        if(isset($_POST['Irons'])){
                            $string1=$string1."irons,";
                        }
                        if(isset($_POST['Coffee_Makers'])){
                            $string1=$string1."coffeemakers,";
                        }
                        if(isset($_POST['Others'])){
                            $string1=$string1."a.others,";
                        }
                       // echo $string1;
                         $x="description: ".$description." ;"."category: ".$category." ;"."type: ".$type." ;"."brand: ".$brand." ;"."name: ".$name." ;"."mrp: ".$mrp." ;"."base_price: ".$base_price." ;"."start_date: ".$start_date." ;"."close_date: ".$close_date." ;"."model: ".$model;
                        
                        $vars = array('promotion_amnt'=>$promotion,'tags'=>$string1,'user_nm'=>$usrnm,'quantity'=>$quantity,'brand'=>$brand,'pic_loc'=>$_FILES["file"]["name"],'model'=>$model,'item_nm'=>$name,'cost'=>$mrp,'item_condition'=>$condition,'description'=>$x,'category'=>$category,'start_date'=>$start_date,'last_date'=>$close_date,'type'=>$type,'sale_type'=>$sale_type,'base_price'=>$base_price);
                        $test->Insert($vars,"items");
                        echo "wow";
                        
                                }
                            }
                         }
                    else
                    {
                    echo "Invalid file1";
                    }
                       }





                        else if(isset($_POST["type_3"]) && isset($_POST['name_3']) && isset($_POST['brand_3']) && isset($_POST['condition_3']) && isset($_POST['mrp_3']) && isset($_POST['description_3']) && isset($_POST['base_price_3'])  && isset($_POST['close_date']) && isset($_POST['model_3']) && isset($_POST['start_date']))
                        {
                            // echo "mittal1";
                         echo "stationary";
                        //session_start();
                          $allowedExts = array("gif", "jpeg", "jpg", "png");
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);    
                    if ((($_FILES["file"]["type"] == "image/gif")       
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && in_array($extension, $allowedExts))  
                {
                        if ($_FILES["file"]["error"] > 0)
                            {
                                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                            }
                        else
                            {
                                echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                                echo "Type: " . $_FILES["file"]["type"] . "<br>";
                                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                            if (file_exists("../upload/" . $_FILES["file"]["name"]))
                                {
                                    echo $_FILES["file"]["name"] . " already exists. ";
                                }
                            else
                                {
                                $count = new MySQL();
                                $x = $count->Select("items","","item_id DESC","1");
                                $pic_loc=$x[0]["item_id"]+1;
                                $_FILES["file"]["name"] =$pic_loc.".jpg";
                                move_uploaded_file($_FILES["file"]["tmp_name"],
                                "../upload/" . $_FILES["file"]["name"]);
                                echo "Stored in: " . "../upload/" . $_FILES["file"]["name"];
                
                            // echo $test->lastQuery;
                           
                         $sale_type="auction";
                        //$_SESSION["user_nm"]="shubahm";// remove and for getting username use $_SERVER["user_nm"]
                        $category1 = "Stationary";
                        $type_1 = $_POST['type_3'];
                        $name = $_POST['name_3'];
                        $brand = $_POST['brand_3'];
                        $mrp=$_POST['mrp_3'];
                        $model=$_POST['model_3'];
                        $quantity=$_POST['quantity_3'];
                        $condition = $_POST['condition_3'];
                        $description = $_POST['description_3'];
                        $base_price = $_POST['base_price_3'];
                        $close_date = $_POST['close_date'];
                        $start_date = $_POST['start_date'];
                        $category=$category1.":".$type_1;
                        $string2 = "";
                        if (isset($_POST['Pens'])){
                            $string2=$string2."pens,";
                        }
                        if(isset($_POST['Calculator'])){
                            $string2=$string2."calculator,";
                        }
                        if(isset($_POST['Drafters'])){
                            $string2=$string2."drafters,";
                        }
                        if(isset($_POST['College_Supplies'])){
                            $string2=$string2."college supplies,";
                        }
                        if(isset($_POST['Others'])){
                            $string2=$string2."s.others,";
                        }
                     //   echo $string2;
                         $x="description: ".$description." ;"."category: ".$category." ;"."type: ".$type." ;"."brand: ".$brand." ;"."name: ".$name." ;"."mrp: ".$mrp." ;"."base_price: ".$base_price." ;"."start_date: ".$start_date." ;"."close_date: ".$close_date." ;"."model: ".$model;
                        
                        $vars = array('promotion_amnt'=>$promotion,'tags'=>$string2,'user_nm'=>$usrnm,'quantity'=>$quantity,'brand'=>$brand,'pic_loc'=>$_FILES["file"]["name"],'model'=>$model,'item_nm'=>$name,'cost'=>$mrp,'item_condition'=>$condition,'description'=>$x,'category'=>$category,'start_date'=>$start_date,'last_date'=>$close_date,'type'=>$type,'sale_type'=>$sale_type,'base_price'=>$base_price);
                        $test->Insert($vars,"items");
                                 }
                            }
                         }
                    else
                    {
                    echo "Invalid file2";
    
                       }
                    }



                    else if(isset($_POST['name_5']) && isset($_POST['brand_5']) && isset($_POST['condition_5']) && isset($_POST['mrp_5']) && isset($_POST['description_5']) && isset($_POST['base_price_5'])  && isset($_POST['close_date']) && isset($_POST['model_5']) && isset($_POST['start_date']))
                        {

                         echo "others";
                       // session_start();
                          $allowedExts = array("gif", "jpeg", "jpg", "png");
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);    
                    if ((($_FILES["file"]["type"] == "image/gif")       
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && in_array($extension, $allowedExts))  
                {
                        if ($_FILES["file"]["error"] > 0)
                            {
                                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                            }
                        else
                            {
                               // echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                               // echo "Type: " . $_FILES["file"]["type"] . "<br>";
                               // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                               // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                            if (file_exists("../upload/" . $_FILES["file"]["name"]))
                                {
                                    echo $_FILES["file"]["name"] . " already exists. ";
                                }
                            else
                                {
                                $count = new MySQL();
                                $x = $count->Select("items","","item_id DESC","1");
                                $pic_loc=$x[0]["item_id"]+1;
                                $_FILES["file"]["name"] =$pic_loc.".jpg";
                                move_uploaded_file($_FILES["file"]["tmp_name"],
                                "../upload/" . $_FILES["file"]["name"]);
                               // echo "Stored in: " . "../upload/" . $_FILES["file"]["name"];
                
                            // echo $test->lastQuery;
                         //  $type_1= $_POST['type_5'];
                         $sale_type="auction";
                       // $_SESSION["user_nm"]="shubahm";// remove and for getting username use $_SERVER["user_nm"]
                        $category1 = "Others";
                        
                        $name = $_POST['name_5'];
                        $brand = $_POST['brand_5'];
                        $mrp=$_POST['mrp_5'];
                        $model=$_POST['model_5'];
                        $quantity=$_POST['quantity_5'];
                        $condition = $_POST['condition_5'];
                        $description = $_POST['description_5'];
                        $base_price = $_POST['base_price_5'];
                        $close_date = $_POST['close_date'];
                        $start_date = $_POST['start_date'];
                        $category=$category1;
                        $string3 = "";
                        if (isset($_POST['Cycles'])){
                            $string3=$string3."cycles,";
                        }
                        if(isset($_POST['Plants_and_Shrubs'])){
                            $string3=$string3."plants and shrubs,";
                        }
                        if(isset($_POST['Room_docorators'])){
                            $string3=$string3."room decorators,";
                        }
                        if(isset($_POST['Others'])){
                            $string3=$string3."o.others,";
                        }
                    //    echo $string3;
                        $x="description: ".$description." ;"."category: ".$category." ;"."type: ".$type." ;"."brand: ".$brand." ;"."name: ".$name." ;"."mrp: ".$mrp." ;"."base_price: ".$base_price." ;"."start_date: ".$start_date." ;"."close_date: ".$close_date." ;"."model: ".$model;
                        $vars = array('promotion_amnt'=>$promotion,'tags'=>$string3,'user_nm'=>$usrnm,'type'=>$type,'quantity'=>$quantity,'brand'=>$brand,'pic_loc'=>$_FILES["file"]["name"],'model'=>$model,'item_nm'=>$name,'cost'=>$mrp,'item_condition'=>$condition,'description'=>$x,'category'=>$category,'start_date'=>$start_date,'last_date'=>$_POST['close_date'],'sale_type'=>$sale_type,'base_price'=>$base_price);
                        $test->Insert($vars,"items");
                                }
                            }
                         }
                    else
                    {
                   // echo "Invalid file3";
    
                       }
                    }
                } 
                else{
                echo "Please check the dates";
            }   

                    include_once "insert_search_index.php";
                    // header("Location: myitems.php");
                    
		               ?>
                       </div>
                       </body>
                       </html>

                    