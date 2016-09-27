<?php

//This function returns true if the current user is logged in and has a role
function hasRole(){
  $hasRole = false;

  if(Auth::User() != NULL){
    $roles = Auth::User()->roles()->getResults();
    foreach($roles as $r){
      if($r->type == "exec" || $r->type == "chair" || $r->type == "admin"){
        $hasRole = true;
      }
    }
  }
  return $hasRole;
}

//This function returns true if the current user is logged in and is admin or exec
function isExecOrAdmin(){
  $hasRole = false;

  if(Auth::User() != NULL){
    $roles = Auth::User()->roles()->getResults();
    foreach($roles as $r){
      if($r->type == "exec" || $r->type == "admin"){
        $hasRole = true;
      }
    }
  }
  return $hasRole;

}
?>
