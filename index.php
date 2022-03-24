<?php
$connect= mysqli_connect("localhost","root","");
$db=mysqli_select_db($connect,'maxcart');
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
            top: 0%;
            z-index: 1000;
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
        
        div.cover{
            background-image: url("Images/cover1.jpg");
            background-repeat: no-repeat;
            background-size: 100%;
            background-position: top;
            height: 75vh;
        }
        .col-md-2{
            margin-bottom:20px;
            margin-top:0px;
        }
        
        .card{
            text-decoration:none;
            border-radius: 8px;
            margin-bottom:10px;
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
            transition:.3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
            cursor:pointer;
        }
        .card:hover{
            transform:scale(1.05);
            
            box-shadow:0 6px 10px rgba(0,0,0,0.8),0 0 6px rgba(0,0,0,.05);
        }
        .card img{
            margin:5px;
        }
        .btn{
            background-color:white;
            color:#41AEA9;
            border-radius:4px;
            size:150%;
            border:none;
        }
        .btn:hover{
            background-color:#41AEA9;
        }
        .p-name{
            display: block;
            display: -webkit-box;
            max-width: 400px;
            height: 50px;
            margin: 0 auto;
            line-height:1.5;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .btn-group{
            margin-bottom: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
            transition:.3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
            cursor:pointer;  
        }
        
    </style>
</head>
<body >
    <div class="Header" >
        <a href=""><img src="Images/Logo.png" class="logo col-md-16" width="80px" height="80px"></a>
        <div class="container ">
            <form action="Searchitem.php" method="GET" class="searchbar">
            <div class="row">
                <div class="col-md-5 pt-1" >
                <input type="search" name="search" class="form-control " placeholder="Search Here..." value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>"/>
                </div>
                <div class="col-md-1 mb-1">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
                </div>
                  
            </form>
            <?php
            if(isset($_GET['search']))
            {
                $filter=$_GET['search'];
                $myquery="SELECT * FROM items WHERE name LIKE '%$filter%'";
                $query_run=mysqli_query($connect,$myquery);

                if(mysqli_num_rows($query_run)>0){
                    
                    while($row = mysqli_fetch_array($query_run)){ ?>
                    <div class="col-md-2" id="product1">
                    <a href="itempage.php?name=<?php echo $row['name'];?>" class="productcard" style="text-decoration:none; color:black;">
                        <div class="card h-100 " >
                        
                            <div class="text-center">
                                <?php echo'<img src="data:image;base64,'.base64_encode($row['image']).'"/ height="150px">'?>
                                <div class="card-body ">
                                    <p class="p-name" ><?=$row['name'];?></p>                           
                                    <p class="p-price">$<?=number_format($row['price'],2);?></p>
                                    <div class="card-footer">
                                    <button class="buy-btn">Buy</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </a>
                    </div>
                    <?php }
                    
                }
            }
            ?>

    </div>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="">Wishlist</a></li>
                <li><a href="cart.html">My Cart</a></li>
                <li><a href="Signup.html">Sign up</a></li>
            </ul>
        </div>

    </div>
    
    <div class="cover">
        <h2>Shop with us</h2>
        
    </div>
    <div class="container-fluid">
    <div class="btn-group col-md-12 " role="group">
        <button type="button" class="btn btn-secondary">All</button>
        <button type="button" class="btn btn-secondary">Shirts</button>
        <button type="button" class="btn btn-secondary">T-shirts</button>
        <button type="button" class="btn btn-secondary">Dresses</button>
        <button type="button" class="btn btn-secondary">Kids</button>
        <button type="button" class="btn btn-secondary">Shoes</button>
        <button type="button" class="btn btn-secondary">Watches</button>
    </div>
    </div>
    
    <div class="container-fluid">
            <div class="col-md-12" >
                <div class="row container-fluid" >
                    <?php
                    $query = "SELECT * FROM items";
                    $result= mysqli_query($connect,$query);

                    while($row = mysqli_fetch_array($result)){ ?>
                    <div class="col-md-2" id="product1">
                    <a href="itempage.php?name=<?php echo $row['name'];?>" class="productcard" style="text-decoration:none; color:black;">
                        <div class="card h-100 " >
                        
                            <div class="text-center">
                                <?php echo'<img src="data:image;base64,'.base64_encode($row['image']).'"/ height="150px">'?>
                                <div class="card-body ">
                                    <p class="p-name" ><?=$row['name'];?></p>                           
                                    <p class="p-price text-muted">$<?=number_format($row['price'],2);?></p>
                                    <div class="card-footer">
                                    <button class="buy-btn">Buy</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </a>
                    </div>
                    <?php }
                    ?>
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