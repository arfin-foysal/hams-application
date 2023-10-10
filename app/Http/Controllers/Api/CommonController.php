<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CommonService;
use Illuminate\Http\Request;

class CommonController extends Controller
{

    protected $commonService;

    public function __construct( CommonService $commonService)
    {
       return $this->commonService = new CommonService();
    }

  
    public function mainMenuList()
    {
     return $this->commonService->mainMenuList();
    }

    public function saveOrUpdateMainMenu(Request $request)
    {
       return $this->commonService->saveOrUpdateMainMenu($request);
       
    }


    public function subMenuCreateOrUpdate(Request $request)
    {
       return $this->commonService->subMenuCreateOrUpdate($request);
    }

    public function subMenuByMenu(Request $request)
    {
       return $this->commonService->subMenuByMenu($request);
    }


    public function subMenuList(Request $request, $id)
    {
       return $this->commonService->subMenuList($request, $id);
    }


    public function deleteSubMenu($id)
    {
       return $this->commonService->deleteSubMenu($id);
    }


    public function saveOrUpdateMenuSection(Request $request)
    {
       return $this->commonService->saveOrUpdateMenuSection($request);
    }

    public function menuSectionList(Request $request,$id)
    {
       return $this->commonService->menuSectionList($request,$id);
    }

    public function deleteMenuSection($id)
    {
       return $this->commonService->deleteMenuSection($id);
    }

    public function deleteMainMenu($id)
    {
       return $this->commonService->deleteMainMenu($id);
    }

    public function commonInfo()
    {
       return $this->commonService->commonInfo();
    }
    
    public function saveOrUpdateCommonInfo(Request $request)
    {
       return $this->commonService->saveOrUpdateCommonInfo($request);
    }

    public function certificationList()
    {
       return $this->commonService->certificationList();
    }

    public function sectionAndSubMenuByMenuId($id)
    {
       return $this->commonService->sectionAndSubMenuByMenuId($id);
    }

    public function subscription(Request $request)
    {
       return $this->commonService->subscription($request);
    }
}
