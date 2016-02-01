<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*function getAmountofPension($last_pay, $basicSalary, $pensionCategory, $pensionFor, $pensionScheme) {
	$bp = $basicSalary;
	if($pensionCategory=="A") {
		return ceil($last_pay*60/100);
	} elseif ($pensionCategory=="B" || $pensionCategory=="C") {
		if($pensionScheme=="no") {
			$val = (($bp*40)/100);
			if($val<4550) {
				return 4550;
			} else {
				return ceil($val);
			}
		} elseif ($pensionScheme=="yes") {
			$val = (($bp*60)/100);
			if($val<7000) {
				return 7000;
			} else {
				return ceil($val);
			}
		}
	} elseif ($pensionCategory=="D" || $pensionCategory=="E") {
		if($pensionFor=="widow") {
			return ceil($last_pay);
		} elseif ($pensionFor=="widow_remarriage") {
			return ceil($last_pay*60/100);
		} elseif ($pensionFor=="no_widow_but_survived_by_children") {
			$val = (($bp*60)/100);
			if($val<7000) {
				return 7000;
			} else {
				return ceil($val);
			}
		} elseif ($pensionFor=="both_parents_are_alive") {
			return ceil($last_pay*75/100);
		} elseif ($pensionFor=="only_one_of_them_is_alive") {
			return ceil($last_pay*60/100);
		} else {
			return "";
		}
	}
}*/

/*function getDCR($last_pay, $da_percent, $year_of_service) {
	$result = (($last_pay+$da_percent)*1/2)*$year_of_service;
	if($result > 1000000) {
		return "1000000";
	} else {
		return ceil($result);
	}
}*/