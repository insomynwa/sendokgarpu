$(document).ready(function(){

    $("#login-submit").click(
        function() {
            alert('woi');
            var username = $("#username").val();
            var password = $("#password").val();

            $.ajax({
                type: "POST",
                url: "index.php/login",
                dataType: "json",
                data: "username="+username+"&password="+password,
                cache:false,
                success:
                    function(data) {
                        $(".error-message").html(data.message).fadeIn("slow");
                    }
            });
            return false;
        }
        );

    
    /*$("#login_submit").click( 
    
      function(){
      
          var username=$("#username").val();
          var password=$("#password").val();
        
          $.ajax({
          type: "POST",
          url: "post_this",
          dataType: "json",
          data: "username="+username+"&password="+password,
          cache:false,
          success: 
            function(data){
              $("#form_message").html(data.message).css({'background-color' : data.bg_color}).fadeIn('slow'); 
            }
          
          });

        return false;

      });*/
  

});
