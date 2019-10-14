<?php 
    include_once("header.php");
    include_once("navUser.php");
?>


<div id="signupSlogan">
    <div class="inside">
        <h2>Sign<span>Up</span></h2>
        <p>Please complete all the fields for the signup.</p>
    </div>
</div>


<div class="box">
    <div class="border-right">
        <div class="border-left">
            <div class="inner">

                <div class="form">
        
                    <div class="tab-content">
                        <div id="signup">   
                            <!-- <h1 class="log-h1" >Sign Up for Free</h1>
                            <br><br> -->
                        
                            <form action="<?php echo FRONT_ROOT."User/Add" ?>" method="post">
                            
                                <div class="field-wrap">
                                    <label class="log-label" >First Name</label>
                                    <input class="log-input" type="text" name="firstName" required />
                                </div>

                                <div class="field-wrap">
                                    <label class="log-label" >Last Name</label>
                                    <input class="log-input" type="text" name="lastName" required />
                                </div>
                                
                                <div class="field-wrap">
                                    <label class="log-label" >DNI</label>
                                    <input class="log-input" type="number" name="dni" required />
                                </div>

                                <div class="field-wrap">
                                    <label class="log-label" >Email Address </label>
                                    <input class="log-input" type="email" name="email" placeholder="example@gmail.com" required />
                                </div>
                            
                                <div class="field-wrap">
                                    <label class="log-label" >Set a Password</label>
                                    <input class="log-input" type="password" name="password" placeholder="••••••" required/>
                                </div>

                                <br>
                                <br>

                                <button class="button button-block">Create account</button>
                            
                            </form>
                        </div>
                    </div><!-- tab-content -->
                </div> <!-- /form -->

            </div>
        </div>
    </div>
</div>

<br><br><br><br>     

<?php include_once("footer.php") ?>
