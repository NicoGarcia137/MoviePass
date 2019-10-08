<?php 
    include_once('header.php');
?>


    <div class="form">
        
        <div id="login">   
            <h1 class="log-h1" >Welcome Back!</h1>
            
            <form action="/" method="post">
            
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
