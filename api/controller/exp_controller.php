<?php

include '../model/exp_model.php';

$obj = new exp_model();

switch ($_GET['operation']) {

	case 'add_expense':
		$obj->add_expense();
		break;

	case 'list_all_expenses':
		$obj->list_all_expenses($_GET['uid']);
		break;

	case 'select_daterange_data':
		$obj->select_daterange_data($_GET['from'], $_GET['to'], $_GET['uid']);
		break;

	case 'update_exp':
		$obj->update_exp();
		break;

	case 'delete_exp':
		$obj->delete_exp($_GET['exp_id']);
		break;

	case 'piechart_data':
		$obj->piechart_data($_GET['uid']);
		break;
	
	default:
		echo 'Chal bhag yaha se!';
		break;
}