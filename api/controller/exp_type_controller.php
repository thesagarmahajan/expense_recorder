<?php

include '../model/exp_type_model.php';

$obj = new exp_type_model();

switch ($_GET['operation']) {

	case 'add_exp_type':
		$obj->add_exp_type();
		break;

	case 'list_exp_type':
		$obj->list_exp_type($_GET['uid']);
		break;

	case 'edit_exp_type_title':
		$obj->edit_exp_type_title();
		break;
	
	default:
		echo 'Chal bhag yaha se!';
		break;
}