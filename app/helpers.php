<?php

 
  if(!function_exists('setActiveRoute')){
        function setActiveRoute($route){
                return Route::is($route) ? 'active' : "";
        }
  }
    
        
     
     
 

 