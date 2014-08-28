<!DOCTYPE HTML>
<html>

    <head>
    
        <title>Monitoring SPAN - Login</title>
        
        <!-- JQuery & Bootstrap JS -->
        <script src="<?php echo URL; ?>public/JQuery/jquery-2.1.1.min.js"></script>
        <script src="<?php echo URL; ?>public/Bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Bootstrap CSS -->
        <link href="<?php echo URL; ?>public/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Application CSS -->
        <link href="<?php echo URL; ?>public/monster.css" rel="stylesheet">
    
    </head>
    
    <body>
        
        <div class="container" id="login-container">
            
            <div class="row">
                
                <div class="col-lg-4 col-md-3"></div>
                
                <div class="col-lg-4 col-md-6">
                    
                    <form id="login-form" action="<?php echo URL; ?>auth/login" method="post">

                        <div class="panel panel-default glow-span-blue">

                            <div class="panel-heading" style="text-align: center"><img src="<?php echo URL; ?>public/monster-logo-small.png">&nbsp;&nbsp;<span style="font-size: 18px; position: relative; top: 2px;">Online Monitoring</span></div>

                            <div class="panel-body">

                                <?php
                                    if (isset($this->error)) {
                                        echo '<div class="alert alert-danger" id="notfound">' . $this->error . '</div>';
                                    }
                                ?>

                                <p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span><input type="text" class="form-control" name="user" id="nuser" placeholder="Nama Pengguna">
                                    </div>
                                    <div class="alert alert-warning" id="wuser" style="display:none; margin-top: 10px;"></div>
                                </p>

                                <p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span><input class="form-control" name="pass" id="pass" type="password" placeholder="Kata Sandi">
                                    </div>
                                    <div class="alert alert-warning" id="wpass" style="display:none; margin-top: 10px;"></div>
                                </p>

                                <p><button type="submit" id="submit-login" class="btn btn-default btn-block" >Masuk</button></p>

                                <br/>

                            </div>

                        </div>
                
                    </form>
                    
                    <p style="text-align: center"><img src="<?php echo URL; ?>public/span-logo.png"></p>
                    
                </div>
                
                <div class="col-lg-4 col-md-3"></div>
                
            </div>
        
        </div>
    
    </body>

    <script type="text/javascript">
        
        function responsiveVerticalCenter() {
            heightCalculation = Math.round(($(window).innerHeight() - $('#login-container').outerHeight()) / 2) - Math.round($('#login-container').outerHeight() / 3);
            if (heightCalculation < 20) {
                heightCalculation = 20;
            }
            $('#login-container').css('margin-top', heightCalculation);
        }
        
        function checkValidity() {
            valid = 0;
            
            if ($('#pass').val() == '') {
                $('#wpass').html('Isikan kata sandi Anda.');
                $('#wpass').fadeIn();
            } else {
                valid++;
            }
            
            if ($('#nuser').val() == '') {
                $('#wuser').html('Isikan nama pengguna Anda.');
                $('#wuser').fadeIn();
            } else {
                valid++;
            }
            
            if (valid >= 2) {
                $('#login-form').submit();
            }
        }
        
        function checkNotFound() {
            
            var notfound = document.getElementById('notfound');
            
            $('#nuser').focus();
            $('#wuser').fadeOut();
            $('#wpass').fadeOut();
            
            $('#nuser').keyup(function() {
                if (notfound != null) {
                    $('#notfound').fadeOut();
                }
                if ($('#nuser').val() != '') {
                    $('#wuser').fadeOut();
                }
            });
            
            $('#pass').keyup(function() {
                if (notfound != null) {
                    $('#notfound').fadeOut();
                }
                if ($('#npass').val() != '') {
                    $('#wpass').fadeOut();
                }
            });
        }
        
        $(document).ready(function() {
            responsiveVerticalCenter();
            checkNotFound();
        });
        
        $(window).resize(function() {
            responsiveVerticalCenter();
        });
        
        $('#login-form').submit(function(event) {
            checkValidity();
            event.preventDefault();
        });


    </script>

</html>