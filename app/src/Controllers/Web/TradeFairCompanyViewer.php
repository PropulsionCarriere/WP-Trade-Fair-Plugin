<?php


namespace TradeFair\Controllers\Web;

use TradeFair;
use WPEmerge\Requests\Request;

use TradeFair\Controllers\Controller;

class TradeFairCompanyViewer extends Controller
{

	public function index(Request $request, $template, $company_id){
		$this->pageTitle = __(TradeFair::getExhibitorNameByID($company_id), 'trade_fair');
		return TradeFair::view("trade-fair-company")->with(['companyID' => $company_id]);
	}
}
