<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = new HomeService();
    }
    public function sliderList()
    {
        return $this->homeService->sliderList();
    }

    public function saveOrUpdateSlider(Request $request)
    {
        return $this->homeService->saveOrUpdateSlider($request);
    }

    public function sliderSectionFeature()
    {
        return $this->homeService->sliderSectionFeature();
    }

    public function sliderSectionFeatureSaveOrUpdate(Request $request)
    {
        return $this->homeService->sliderSectionFeatureSaveOrUpdate($request);
    }

    public function deleteSlider($id)
    {
        return $this->homeService->deleteSlider($id);
    }

    public function aboutSection()
    {
        return $this->homeService->aboutSection();
    }

    public function aboutSaveOrUpdate(Request $request)
    {
        return $this->homeService->aboutSaveOrUpdate($request);
    }

    public function achievementList()
    {
        return $this->homeService->achievementList();
    }

    public function achievementSaveOrUpdate(Request $request)
    {
        return $this->homeService->achievementSaveOrUpdate($request);
    }



    public function achievementDelete($id)
    {
        return $this->homeService->achievementDelete($id);
    }

    public function virtualSection()
    {
        return $this->homeService->virtualSection();
    }

    public function virtualSectionSaveOrUpdate(Request $request)
    {
        return $this->homeService->virtualSectionSaveOrUpdate($request);
    }

    public function productSectionSaveOrUpdate(Request $request)
    {

        return $this->homeService->productSectionSaveOrUpdate($request);
    }

    public function productSection()
    {
        return $this->homeService->productSection();
    }

    public function ourClientList()
    {
        return $this->homeService->ourClientList();
    }

    public function ourClientSaveOrUpdate(Request $request)
    {
        return $this->homeService->ourClientSaveOrUpdate($request);
    }

    public function sustainabilitySection()
    {
        return $this->homeService->sustainabilitySection();
    }

    public function sustainabilitySaveOrUpdate(Request $request)
    {
        return $this->homeService->sustainabilitySaveOrUpdate($request);
    }

    public function sustainabilityFeatureList()
    {
        return $this->homeService->sustainabilityFeatureList();
    }

    public function sustainabilityFeatureSaveOrUpdate(Request $request)
    {
        return $this->homeService->sustainabilityFeatureSaveOrUpdate($request);
    }

    public function certificationSection()
    {
        return $this->homeService->certificationSection();
    }

    public function certificationSectionUpdate(Request $request)
    {
        return $this->homeService->certificationSectionUpdate($request);
    }

    public function certificationList()
    {
        return $this->homeService->certificationList();
    }

    public function certificationSaveOrUpdate(Request $request)
    {
        return $this->homeService->certificationSaveOrUpdate($request);
    }

    public function ourServiceList()
    {
        return $this->homeService->ourServiceList();
    }

    public function ourServiceSaveOrUpdate(Request $request)
    {
        return $this->homeService->ourServiceSaveOrUpdate($request);
    }

    // client site api start

    public function homePage()
    {
        return $this->homeService->homePage();
    }

    public function homeServiceBySubmenuId(Request $request)
    {
        return $this->homeService->homeServiceBySubmenuId($request);
    }
}
