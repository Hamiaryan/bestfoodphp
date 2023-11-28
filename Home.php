<header>
	<div class="overlay">
    <nav class="custom-nav">
        <a href="http://localhost:8080/Bestfood/">Home</a>
		 <a href="http://localhost:8080/Bestfood/about.php">About</a>
		 <a href="http://localhost:8080/Bestfood/Buyer/buyer_login_form.php">Login</a>

    </nav>
<h1>BestFood</h1>
<h3>Fresh and Healthy Celery Goodness</h3>
<p class="welcome-text">Welcome to BestFood, your go-to destination for delicious and healthy celery-based dishes. We are passionate about promoting a healthy lifestyle through fresh and nutritious food choices</p>

<head>

</head>


		</div>
</header>

<style>
    *{padding: 0; margin: 0; box-sizing: border-box;}
body{height: 1000px;}
header {
	background: url('http://localhost:8080/bestfood/asset/headerPhoto.jpeg');
	text-align: center;
	width: 100%;
	height: auto;
	background-size: cover;
	background-attachment: fixed;
	position: relative;
	overflow: hidden;
	border-radius: 0 0 85% 85% / 30%;
	
}
header .overlay{
	width: 100%;
	height: 100%;
	padding: 50px;
	color: #CD4427 ;
	text-shadow: 1px 1px 1px #FCC8BD;
  background-image: linear-gradient( 135deg, #fff 1%, #fd5e086b 100%);
  
	
}
.welcome-container{
	
}

h1 {
	font-family: 'Dancing Script', cursive;
	font-size: 80px;
	margin-bottom: 30px;
	
}

h3{
	font-family: 'Open Sans', sans-serif;
	margin-bottom: 30px;
    color: #55170A;
}
.welcome-text {
    font-family: 'Open Sans', sans-serif;
    margin-bottom: 30px;
    color: #55170A;
    font-size: 20px;
    text-align: center;
    text-shadow: none;
    
   
   
    
}
.custom-nav {
    display: flex;
    justify-content: space-around;
    padding: 10px;
    background: rgba(148, 29, 8, 0.5); /* Semi-transparent background color */
    
}

.custom-nav a {
    color: white;
    text-decoration: none;
    text-shadow: none; 
}


.button_home {
	border: none;
	outline: none;
	padding: 10px 20px;
	border-radius: 50px;
	color: #fff;
	background: #852511 ;
	margin-bottom: 50px;
    text-shadow: none;
}
.button_home:hover{
	cursor: pointer;
}
</style>