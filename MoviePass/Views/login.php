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
                            
                            <button class="button button-block">Log In</button>
                        
                        </form>
                        
                    </div><!-- tab-content -->
                    
                </div> <!-- /form -->

                
                
            </div>
        </div>
    </div>
</div>

<br><br><br><br>

<?php include_once("footer.php") ?>