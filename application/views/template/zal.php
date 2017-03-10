<div class='result'></div>
<div class='counter_cost'></div>
<div class='cinemaHall zal1' data-zal="<?php echo $id;?>">
     <?php foreach ($seatres as $row=>$setslist){?>
          Ряд: <?php echo $row;?>
          <?php foreach ($setslist as $lists){?>

               <div class="<?php if($lists['status'] != 0){echo 'sold';}else{echo 'seat';}?>" data-row="<?php echo $lists['row'];?>"
                    data-seat="<?php echo $lists['seats'];?>" data-cost="<?php echo $lists['cost'];?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
          <?php }?>
          <br/>
     <?php }?>
</div>