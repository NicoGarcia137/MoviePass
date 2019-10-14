<?php 
    include_once("header.php");
    include_once("navUser.php");
?>
</div> <!-- div cerrado que le corresponde al nav -->

    <div class="form">
        
        <div id="login">   
            <h1 class="log-h1" >Welcome Back!</h1>
            <br><br>
            
            <form action="<?php echo FRONT_ROOT."Login/Login" ?>" method="post">
            
                <div class="field-wrap">
                    <label class="log-label">Email Address </label>                    
                    <input class="log-input" type="email" name="email" placeholder="example@gmail.com" required/>
                </div>
            
                <div class="field-wrap">
                    <label class="log-label">Password</label>
                    <input class="log-input" type="password" name="password" placeholder="••••••" required />
                </div>
                
                <button class="button button-block">Log In</button>
            
            </form>
            
        </div><!-- tab-content -->
        
    </div> <!-- /form -->


<?php include_once("footer.php") ?>