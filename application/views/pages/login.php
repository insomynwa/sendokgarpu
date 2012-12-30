<script>
    $(document).ready(function(){

        $("#r-form").click(function(){
            $("#register-form").show();
            $("#login-form").hide();
        });

        $("#l-form").click(function(){
            $("#login-form").show();
            $("#register-form").hide();
        });

        $("#login-submit").click(
            function() {
                var username = $("#username").val();
                var password = $("#password").val();

                $.ajax({
                    type: "POST",
                    url: "index.php/login",
                    //dataType: "json",
                    data: "username="+username+"&password="+password,
                    cache:false,
                    success:
                        function(data) {
                            if(data==true){
                                location.reload();
                            }else {
                                $(".error-message").html(data).fadeIn("slow");
                                $("#password").val("");
                            }
                            
                        }
                });
                return false;
            }
        );

        $("#r-submit").click(function(){
            var username = $("#r-username").val();
            var email = $("#r-email").val();
            var pass = $("#r-password").val();
            var pass2 = $("#r-password2").val();

            $.ajax({
                type: "POST",
                url: "index.php/registrasi",
                //dataType: "json",
                data: "username="+username+"&email="+email+"&password="+pass+"&password2="+pass2,
                cache:false,
                success:
                    function(data) {
                        if(data==true){
                            location.reload();
                        }else {
                            $(".error-message").html(data).fadeIn("slow");
                            $("#r-password").val("");
                            $("#r-password2").val("");
                        }
                    }
            });
            return false;
        });
        $(":submit").css("cursor","pointer");
    });
</script>
<?php $this->load->view('pages/basic'); ?>
<form id='login-form' method='post'>
    <section class="error-message"></section>
	<label for='username'>username:</label>
	<input name='username' type='text' id="username" />
	<label for='password' >password:</label>
	<input name='password' type='password' id="password" />
	<input type='submit' value='Login' name="login-submit" id='login-submit' /><br><a id="r-form">Registrasi ?</a>
</form>
<form id='register-form' method='post' hidden="hidden">
    <section class="error-message"></section>
    <label>username:</label>
    <input type="text" name="r-username" id="r-username">
    <label>e-mail:</label>
    <input type="email" name="email" id="r-email">
    <label>password:</label>
    <input type="password" id="r-password" name="r-password">
    <label>ketik ulang password:</label>
    <input type="password" id="r-password2" name="r-password2">
    <input type="submit" id="r-submit" name="r-submit" value="Registrasi" /><br><a id="l-form">Login ?</a>
</form>
