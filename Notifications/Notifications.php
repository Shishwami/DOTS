<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Notifications.css">
    <title></title>
</head>
<body>

    <div class="alert danger">
    <span class="closebtn">&times;</span>  
    <strong>Danger!</strong> OH NOOO!!! HIHI
    </div>

    <div class="alert success">
    <span class="closebtn">&times;</span>  
    <strong>Success!</strong> YEY! KUHA MO PAAAREHH...
    </div>

    <div class="alert info">
    <span class="closebtn">&times;</span>  
    <strong>Info!</strong> SOMETHING SOMETHING PAAREEEHH...
    </div>

    <div class="alert warning">
    <span class="closebtn">&times;</span>  
    <strong>Warning!</strong> OOPPS!!! MAY SOMETHING MALI PAREEEHHH...
</div>

<script>
    var close = document.getElementsByClassName("closebtn");
    var i;

        for (i = 0; i < close.length; i++) {
        close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function(){ div.style.display = "none"; }, 600);
        }
    }
</script>

</body>
</html>


   
      <link rel="stylesheet" href="style.css">
   
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   </head>
   <body>
      <button>Show Alert</button>
      <div class="alert hide">
         <span class="fas fa-exclamation-circle"></span>
         <span class="msg">Warning: This is a warning alert!</span>
         <div class="close-btn">
            <span class="fas fa-times"></span>
         </div>
      </div>
      <script>
         $('button').click(function(){
           $('.alert').addClass("show");
           $('.alert').removeClass("hide");
           $('.alert').addClass("showAlert");
           setTimeout(function(){
             $('.alert').removeClass("show");
             $('.alert').addClass("hide");
           },5000);
         });
         $('.close-btn').click(function(){
           $('.alert').removeClass("show");
           $('.alert').addClass("hide");
         });
      </script>
   </body>
</html>