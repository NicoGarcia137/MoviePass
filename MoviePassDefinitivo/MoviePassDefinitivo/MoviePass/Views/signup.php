<?php 

    include_once('header.php');
?>



    <div class="form">
        
        <div class="tab-content">
            <div id="signup">   
            <h1 class="log-h1" >Sign Up for Free</h1>
            
            <form action="/" method="post">
            
                <div class="top-row">
                    <div class="field-wrap">
                        <label class="log-label" >First Name</label>
                        <input class="log-input" type="text" name="firstName" required />
                    </div>
                </div>

                <div class="top-right" >
                    <div class="field-wrap">
                        <label class="log-label" >Last Name</label>
                        <input class="log-input" type="text" name="lastName" required />
                    </div>
                </div>

                <div class="field-wrap">
                    <label class="log-label" >Email Address </label>
                    <input class="log-input" type="email" name="email" placeholder="example@gmail.com" required />
                </div>
            
                <div class="field-wrap">
                    <label class="log-label" >Set a Password</label>
                    <input class="log-input" type="password" name="password" placeholder="••••••" required/>
                </div>

                <div class="field-wrap" >

                    <button type="submit" class="button button-block">Create account</button>

                </div>
            
            </form>

        </div><!-- tab-content -->
        
    </div> <!-- /form -->

