<?php
function hasRole(){
  $roles = Auth::User()->roles()->getResults();
  $hasRole = false;
  foreach($roles as $r){
    if($r == "exec" || $r == "chair" || $r == "admin"){
      $hasRole = true;
    }
  }
  return $hasRole;
}
?>
