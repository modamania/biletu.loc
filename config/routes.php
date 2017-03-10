<?php
return array(
    'bay/([0-9]+)' => 'bay/showitem/$1',
    'cat/([0-9]+)' =>'category/view/$1',
    'cat/([0-9]+)/([0-9]+)' =>'category/view/$1/$2',
    'page/([0-9]+)' =>'home/home/$1',
    'show/([0-9]+)' =>'show/view/$1',
    'theatre/([0-9]+)' =>'theatre/view/$1',
    'theatre/([0-9]+)/([0-9]+)' =>'theatre/view/$1',
    'show/get/([0-9]+)' =>'show/getseats/$1',
    'show/sell' =>'show/sell',
    'user' =>'user/showinfo',
    'clean' =>'user/cleanlist',
    '' =>'home/home',//должен быть последним в списке

);