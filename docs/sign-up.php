<?php include("templates/var_defs.php");?>
<?php include("templates/page_top.php");?>
    <style type="text/css">
#content-box{text-align:center;}
</style>
<h1>Sign Up!</h1>
<div style="display:inline-block; width:72%;"><p6>(This webpage isn't ready yet. I don't believe that we will receive any information you submit, but don't try it with sensitive information anyways! Otherwise, feel free to type in any crap you want and push submit. :)</p6></div>
<br><br>
<form action="process_sign_up.php" method="post">
Email:<br><br>
<input type="email" name="email">
<br><br>
Password:<br><p6>(Don't use this yet!)</p6><br><br>
<input type="password" name="password">
<br><br>
Username:<br><br>
<input type="text" name="username">
<br><br>
<input type="submit">

</form>

<br><br>


    <?php include("templates/page_bottom.php");?>