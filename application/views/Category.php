<ul class="nav">
     <li><a href="/">Главная</a></li>
     <?php foreach ($category as $value){?>
          <li><a href="/cat/<?php echo $value['id']?>"><?php echo $value['name']?></a></li>
     <?php }?>
</ul>
