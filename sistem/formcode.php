<?php
$f = '
<div class="form" style="border: 0px solid blue;position:relative; top:100px; left:400px; height:200px; width:300px; display: none">
               <form action="" method="post">
                   <label>логин:</label><br/>
               <input name="login" type="text" size="15" maxlength="15"><br/>
                   <label>пароль:</label><br/>
               <input name="password" type="password" size="15" maxlength="15"><br/><br/>
                   <input type="button" class="enter" value="Войти">
                   <input type="button" class="register" value="Зарегистироваться"><br/><br/>
                   </form>
                   </div>';
return $f;
