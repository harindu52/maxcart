<?php
$connect= mysqli_connect("localhost","root","");
$db=mysqli_select_db($connect,'maxcart');
session_start();

if(isset($_POST['add_to_cart']))
{                            
    if(isset($_SESSION['wishlist']))
    {
        $session_array_id=array_column($_SESSION['wishlist'],"name");
        if(!in_array($_GET['name'],$session_array_id))
        {
            $session_array=array(
                "name"=>$_GET['name'],
                "image"=>$_POST['image'],                
                "price"=>$_POST['price'],
                "Category"=>$_POST['category']
                );
            $_SESSION['wishlist'][]=$session_array;
        }
    }
    else
    {
        $session_array=array(
            "name"=>$_GET['name'],
            "image"=>$_POST['image'],
            "price"=>$_POST['price'],
            "Category"=>$_POST['category']
        );
        $_SESSION['wishlist'][]=$session_array;
        
    }
}
if(isset($_GET['action'])){
    if($_GET['action']=="clearall"){
        unset($_SESSION['wishlist']);
    }
    if($_GET['action']=="remove"){
        foreach($_SESSION['wishlist'] as $key =>$value){
            if($value['name']==$_GET['name']){
                unset($_SESSION['wishlist'][$key]);
            }
        }
    }
}
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d18ef4fa3a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        body{
            background-image:url("Images/background1.png")
        }
        div.Header{
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0px 50px;
            background-color: #072227;
            background-size: 100%;
            position: sticky;
            z-index: 1000;
            top: 0%;
            }
        #navbar{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #navbar li{
            list-style: none;
            padding: 0 20px;
        }   
        #navbar li a{
            text-decoration: none;
            font-weight: 400;
            color:white;
            position: relative;
        }
        #navbar li a:hover{
            color:#41AEA9;
        }
        .card{
            border-radius: 12px;
            margin-bottom:10px;
            box-shadow:0 6px 10px rgba(0,0,0,0.8),0 0 6px rgba(0,0,0,.05);
            transition:.3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
            cursor:pointer;
        }
        .card img{
            margin:20px;
        }
        .col-md-10{
            margin-top:20px;
        }
        .col-lg-3{
            overflow: hidden;
        }
    </style>
</head>
<body >
    <div class="Header" >
        <a href=""><img src="Images/Logo.png" class="logo" width="80px" height="80px"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="myCart.php">My Cart</a></li>
                <li><a href="Signup.html">Sign up</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="col-md-10 col-lg-12" >
            <div class="row container-fluid" >
                <div class="col-md-12" id="product1">
                    <div class="card h-100 " >
                        <div class="row">
                            <table class="table table-hover table-fixed ">
                                <thead class="col-lg-12"><tr>
                                <th><div class="w-50 ml-200">Name</div></th>
                                <th><div class="w-100">Category</div></th>
                                <th><div class="w-100">Price</div></th>
                                <th></th>
                                </tr></thead>
                                
                            <tbody>  
                            <?php
                             
                            if(!empty($_SESSION['wishlist'])){
                                foreach($_SESSION['wishlist'] as $key =>$value){ ?>
                                    <tr>
                                    <td><div class="w-100"><?=$value['name'];?></div></td>
                                    <td><div class="w-100"><?=$value['Category'];?></div></td>
                                    <td><div class="w-100"><?=$value['price'];?></div></td>
                                    
                                    <td><a href="wishlist.php?action=remove&name=<?=$value['name'];?>">
                                        <button class="btn btn-danger">Remove</button></a></td>
                                    </tr>
                                    
                                <?php
                                }
                            }
                            
                            ?>
                            <tr><td colspan="3"></td><td><a href="wishlist.php?action=clearall">
                                        <button class="btn btn-danger">Clear</button></a></td></tr></tbody>
                              </table>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-12 text-center">
                <img src="Images/Logo.png">
                <p>MAXCART is a global online marketplace, where people come together to make, sell, buy, and collect unique items. We’re also a community pushing for positive change for small businesses, people, and the planet.</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12 text-center">
                <h5 class="pb-3">Featured</h5>
                <ul class="text-uppercase list-unstyled">
                    <li><a href="#">Shirts</a></li>
                    <li><a href="#">Tshirts</a></li>
                    <li><a href="#">Watches</a></li>
                    <li><a href="#">Dresses</a></li>
                    <li><a href="#">Shoes</a></li>
                    <li><a href="#">men</a></li>
                </ul>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12 text-center">
                <h5 class="pb-3">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>223D/1 Wasana place, Udugampola, Sri Lanka</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>(+94) 123 456 789</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>maxcartsrilanka@gmail.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12 text-center">
                <h5 class="pb-3">Help</h5>
                <ul class="text-uppercase list-unstyled">
                    <li><a href="#">Delivery</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Guidelines</a></li>
                    <li><a href="#">Copyright</a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright mt-3">
            <div class="row container mx-auto">
            <div class="col-lg-4 col-md-4 col-12">
                    <p></p>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <p>maxcart eCommerce &copy; 2022. All Rights Reserved</p>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>