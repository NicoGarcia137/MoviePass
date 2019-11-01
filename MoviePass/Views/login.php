<?php 
    include_once("header.php");
    include_once("navUser.php");
?>

<div id="signupSlogan">
    <div class="inside">
        <h2>Log<span>In</span></h2>
        <p>Never share your account information with anyone.</p>
    </div>
</div>

<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

                <div class="form">
                    
                    <div id="login">   

                        <form action="<?php echo FRONT_ROOT."Login/Login" ?>" method="post">
                        
                            <div class="field-wrap">
                                <label class="log-label">Email Address </label>                    
                                <input class="log-input" type="email" name="email" placeholder="example@gmail.com" required/>
                            </div>
                        
                            <div class="field-wrap">
                                <label class="log-label">Password</label>
                                <input class="log-input" type="password" name="password" placeholder="••••••" required />
                            </div>

                            <br>
                            <br>
                            
                            <input type="submit" class="button button-block" value="Log In">                            

                        
                        </form>
                        <br>
                        <a href="https://www.facebook.com/v5.0/dialog/oauth?client_id=3079459188747276&state=a046cd1737175c594ec5140cda05ffde&response_type=code&sdk=php-sdk-5.7.0&redirect_uri=http%3A%2F%2Flocalhost%2FMoviePass%2FLogin%2FFacebookLogin&scope=">
                            <img src="<?php echo FRONT_ROOT?>Views/images/fblogin.png" ></a>

                         <!-- <form action="<?php echo FRONT_ROOT."Login/FacebookLogin" ?>">

                            <input type="submit" class="button button-block" value="Log in with facebook">  

                        </form>  -->

                        
                        
                    </div><!-- tab-content -->
                    
                </div> <!-- /form -->

                
                
            </div>
        </div>
    </div>
</div>

<?php include_once("footer.php") ?>