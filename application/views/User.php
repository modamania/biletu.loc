<div class="box">
<form action="/user" method="post">
<table border="5" cellpadding="2" cellspacing="0">
     <th>Представление</th>
     <th>Дата представления</th>
     <th>Театр</th>
     <th>Места</th>
     <th>Сумма</th>
     <?php if(!empty($wievres)){foreach ($wievres as $infarr){?>


     <tr>
          <td><p><a href="/show/<?php echo $infarr['show']?>"><?php echo $infarr['name']?><br/><br/><img src="<?php echo $infarr['picture']?> " width=100></a></p></td>
          <td ><?php echo $infarr['time']?></td>
          <td style=' width: 30%;'><a href="/theatre/<?php echo $infarr['theatre_id']?>"><?php echo $infarr['theatrename']?></a></td>
          <td style=' width: 30%;'><!--<table>-->

               <?php for($i=0;$i<count($infarr['row']);$i++){ ?>
                   Ряд: <?php echo $infarr['row'][$i]; ?> / Место:<?php echo $infarr['seats'][$i];?> / Цена: <?php echo $infarr['cost'][$i]; ?>
                    <input type="checkbox" name="show[<?php echo $infarr['show']?>][<?php echo $infarr['row'][$i]; ?>][<?php echo $infarr['seats'][$i];?>]">

                    <br/>
                    <!--echo "<tr><td >".$infarr['row'][$i]."</td>";
                    echo "<td>".$infarr['seats'][$i]."</td></tr>";-->

               <?php }} ?>



                   <!--</table>--> </td>
          <td><?php echo array_sum($infarr['cost'])?></td>

     </tr>
     <?php }?>
</table>
     <input type="submit" name="Cancel" value="Отменить" style="margin-left: 90%">
     </form>
</div>





