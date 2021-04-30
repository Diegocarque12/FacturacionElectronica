<?php

function is_login(){
	$id_usuario= session()->get('id_usuario');
	if($id_usuario>0){
		return true;
	}else{
		return false;
	}
}