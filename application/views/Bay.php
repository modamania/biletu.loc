<table border="1" width="100%" cellspacing="0" cellpadding="4">
     <tr><th>title</th><th>description</th><th>picture</th><th>time</th><th>date</th></tr>
     <?php foreach ($listrez as $lists){?>
          <tr>
               <td width="1%"><?php echo $lists['title']; ?></td>
               <td width="1%"><?php echo $lists['description']; ?></td>
               <td width="1%"><img src="<?php echo stristr($lists['picture'], ',', true); ?>" width="50%" /></td>
               <td width="1%"><?php echo $lists['time']; ?>:00</td>
               <td width="1%"><?php echo $lists['date']; ?></td>
          </tr>
     <?php }?>
</table>
<br/><br/><br/>
<div class='result'></div>
<div class='counter_cost'></div>
<div class='cinemaHall zal1' data-zal="<?php echo $id;?>">
     <?php foreach ($seats as $row=>$setslist){?>
         Ряд: <?php echo $row;?>
          <?php foreach ($setslist as $lists){?>

               <div class="<?php if($lists['reserv'] != 0){echo 'sold';}else{echo 'seat';}?>" data-row="<?php echo $lists['row'];?>"
                    data-seat="<?php echo $lists['seats'];?>" data-cost="<?php echo $lists['cost'];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
          <?php }?>
<br/>
     <?php }?>
</div>
<div class="form"  style="border: 0px solid blue;position:relative; top:100px; left:400px; height:200px; width:300px; display: none">
     <form id="form">
          <label>Емаил:</label><br/>
          <input name="email" type="text" size="15" ><br/>
          <!--<label>пароль:</label><br/>
          <input name="password" type="password" size="15" maxlength="15"><br/><br/>-->
          <input type="button" class="zakaz" value="Оформить заказ"><br/><br/>
     </form>
</div>
<!--<button class="button">Заказать</button>-->