<div class="box">
     <h1>Спектакли</h1>

          <?php foreach ($seansu as $items) { ?>
     <div class="col4">
               <?php foreach ($items as $item) { ?>

                    <div class="homeittem artisis">
                         <a href="/show/<?php echo $item['id']; ?>"><img src="<?php echo $item['picture']; ?>"
                              style="width:90%" alt="">
                              <h2><?php echo $item['name']; ?></h2>
                              <?php echo $item['theatrename']; ?></a>
                    </div>

               <?php } ?>
               <div class="colsm">
               </div>
     </div>
          <?php } ?>



     <br class="clear">
     <?php echo $pagination;?>
</div>
<!--<div class="colsm">
</div>-->




