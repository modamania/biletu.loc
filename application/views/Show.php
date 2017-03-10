<div class="box">


     <h1 class="nomarg"><?php echo $show['name']; ?></h1>

     <?php  $show['id']; ?>


     <br class="clear">
     <div class="box">
          <div class="col70">
               <div class="content">


                    <?php echo $show['description']; ?>

               </div>
          </div>
          <div class="col30">
               <div class="dbevent">Вы можете приобрести билеты на ближайший спектакль:
                    <div>
                         <div><span><?php echo date('d.m.Y H:i', $show['time']); ?></span>
                              <a class="button" id="tickets"">Купить билеты</a>
                         </div>
                    </div>
               </div>
               <img class="rphoto" src="<?php echo $show['picture']; ?>" style="width:100%" alt="">


          </div>

     </div>
     <div id="info-block">
     <b>Жанр:</b><a href="/cat/<?php echo $show['janr']; ?>"><?php echo $show['jname']; ?></a><br/>

     <b>Театр:</b><a href="/theatre/<?php echo $show['theatre_id']; ?>"><?php echo $show['theatrename']; ?></a><br/>
     <br class="clear">
     </div>

</div>

<script>

     $(document).ready(function () {


     //$('.button').hide();
     // тут по клику определяем что место выкуплено
          $(document).on('click','.seat', function(e) {

          var count = $('.ticket').length;

          if(count < 5){
               // если первый раз кликнули билет выкупили,
               // если повторно значит вернули билет
               // $(e.currentTarget).toggleClass('bay');
               $(this).toggleClass('bay');

               if(count >= 0){
                    //$('.button').show();
                    //$('.button').after('.cinemaHall zal1').html('<button class="button" >Заказать</button>');
                    if(!$('.order').length){
                         $('.cinemaHall.zal1').append('<br/><br/><button class="order" >Заказать</button>');
                    }
               };
          }else{
               // -если больше 5 билетов выбрано то выводит сообщение.
               // Но если больше 5 билетов и пользователь хочет снять ответку то тоггда нужет этот иф
               if($(this).hasClass('bay')){
                    $(this).toggleClass('bay');

               }else{
                    alert('Можно заказать не более '+count+' билетов');
               }
          };
          //показываем сколько билетов выкуплено
          showBaySeat();

     });




     function showBaySeat(ajax=0) {
           result = '';
           cost = '';
               var p = [];

          //ищем все места купленные и показываем список выкупленных мест

          $.each($('.seat.bay'), function(key, item) {
               r = $(item).data().row;
               s = $(item).data().seat;

               result += '<div class="ticket">Ряд: ' +
                   r + ' Место:' +
                   s + '</div>';
               cost = Number(cost) + Number($(item).data().cost);
               p +=r+'='+s+'&';

          });

          if(ajax){
               return p;
          }
          $('.result').html(result);
          $('.counter_cost').html('Сумма: '+cost);

//если невыбрано место то кнопка отправки заказа убирается
          if($('.order').length && !$('.ticket').length){
               $('.order').remove();
          }

     };


     $(document).on('click','.enter',function (){
          //var reg = $('#form').serialize();
          var email = $("input[name='email']").val();
          var pass = $("input[name='pass']").val();
          var zakaz =  showBaySeat(1);
          $('#inperror').remove();
          $.ajax({
               cahce: false,
               method: 'POST',
               url:"/show/sell",
               dataType : 'json',
               data:({'show' :<?php echo $id?>, 'email':email,'pass':pass,'ticket':zakaz}),
               success : function (data) {
                    // alert();
                    //var res = $.getJSON(data);
                    //console.log(data['email']);
                    //console.log(data['password']);
                    //console.log(data);

                    $('.inperror').remove();
                    //resval = $.parseJSON(data);
                    if($.type(data) == 'null'){
                         $('.info').text('Вы вошли в систему. В личном кабинете вы можетет посмотреть ваши заказы');
                         $('.form').html('<a href="/user">перейти в личный кабинет</a>');
                    }else{
                         $.each(data, function(key, val){
                              if(key == 'email'||key == 'pass'){
                                   $('#'+key).after('<span class="inperror" >'+val+'</span>');
                              }else if(key == 'newuser'){
                                   $('.info').text('Спасибо за регистрацию.Вы вошли в систему. В личном кабинете вы можетет посмотреть ваши заказы');
                              $('.form').html('<a href="/user">перейти в личный кабинет</a>');
                              }else if(key == 'ticket'){
                                   $('.error').remove();
                                   $('.info').append('<span class="error"><br/>Попробуйте выбрать билеты еще раз</spna><input type="button" id="backzal" value="Выбрать">')

                              }

                         });
                    }


$('#backzal').click(function () {
     $('.cinemaHall.zal1').show();
     $('#form').remove();
});

                    /*else if(data['user']){

                         $('#info').text('Вы вошли в систему. В личном кабинете вы можетет <br/>посмотреть ваши заказы');
                    }else if(data['newuser']){

                         $('#info').text('Спасибо за регистрацию.<br/>Вы вошли в систему. В личном кабинете вы можетет <br/>посмотреть ваши заказы');
                    }
*/

                    //alert(data);
                    //$('.form').before(data);
                   // $('.form').remove('.form');
               }
          });
     });

          $(document).on('click','.order',function () {
   /*            try{*/
                    $.ajax({
                         cahce: false,
                         method: 'POST',
                         url:"/sistem/form.php",
                         dataType : 'text',
                         success :      function (data) {
                              $('.cinemaHall.zal1').hide();

                              $('#info-block').after( data);
                              //showBaySeat(1);
                              /*$('.form').before(data);
                               $('.form').remove('.form');*/

                         }
                    });
/*
                    return;
                    $(this).remove();
                    return false;
               }catch (e){
                    alert(e);
               }
*/

          });

          $('#tickets').click(function () {
               $(this).remove();
               $.ajax({
                    cahce: false,
                    method: 'POST',
                    url:"/show/get/<?php echo $id?>",
                    dataType : 'text',
                    success : function (data) {

                         $('#info-block').append(data);
                         /*$('.form').before(data);
                         $('.form').remove('.form');*/

                    }
               });

          });
     });
</script>