<?php 
    include_once('header.php');
?>

<html>

<head>
    
</head>

<body>
    <div class="form">
        
        <ul class="tab-group">
            <li class="tab active"><a href="signup.php">Sign Up</a></li>
            <li class="tab"><a href="login.php">Log In</a></li>
        </ul>
        
            <div id="login">   
            <h1>Welcome Back!</h1>
            
            <form action="/" method="post">
            
                <div class="field-wrap">
                <label>
                Email Address
                </label>
                <input type="email" placeholder="example@gmail.com" required/>
            </div>
            
            <div class="field-wrap">
                <label>
                Password
                </label>
                <input type="password" placeholder="••••••" required />
            </div>
            
            <!-- Forgot password opcional -->
            <p class="forgot"><a href="#" class="log-a">Forgot Password?</a></p>
            
            <button class="button button-block">Log In</button>
            
            </form>

            </div>
            
        </div><!-- tab-content -->
        
    </div> <!-- /form -->
</body>



</html>