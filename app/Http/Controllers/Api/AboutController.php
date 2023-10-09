<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AboutService;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $aboutService;

    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = new AboutService();
    }


    public function whoWeAreSection()
    {
        return $this->aboutService->whoWeAreSection();
    }

    public function whoWeAreSectionUpdate(Request $request)
    {
        return $this->aboutService->whoWeAreSectionUpdate($request);
    }


    public function processSection()
    {
        return $this->aboutService->processSection();
    }

    public function processSectionUpdate(Request $request)
    {
        return $this->aboutService->processSectionUpdate($request);
    }

    public function processSectionFeatureList()
    {

        return $this->aboutService->processSectionFeatureList();
    }


    public function processSectionFeatureCreateOrUpdate(Request $request)
    {

        return $this->aboutService->processSectionFeatureCreateOrUpdate($request);
    }
    public function journeySection()
    {

        return $this->aboutService->journeySection();
    }
    public function journeySectionUpdate(Request $request)
    {

        return $this->aboutService->journeySectionUpdate($request);
    }

    public function journeySectionTimelineList()
    {
        return $this->aboutService->journeySectionTimelineList();
    }

    public function journeySectionTimelineCreateOrUpdate(Request $request)
    {
        return $this->aboutService->journeySectionTimelineCreateOrUpdate($request);
    }

    public function qualitySection()
    {
        return $this->aboutService->qualitySection();
    }

    public function qualitySectionUpdate(Request $request)
    {
        return $this->aboutService->qualitySectionUpdate($request);
    }


    public function qualitySectionFeatureList()
    {
        return $this->aboutService->qualitySectionFeatureList();
    }

    public function qualitySectionFeatureCreateOrUpdate(Request $request)
    {
        return $this->aboutService->qualitySectionFeatureCreateOrUpdate($request);
    }

    public function  clientSection()
    {
        return $this->aboutService->clientSection();
    }

    public function  clientSectionUpdate(Request $request)
    {
        return $this->aboutService->clientSectionUpdate($request);
    }

    public function elevatingSection()
    {
        return $this->aboutService->elevatingSection();
    }

    public function elevatingSectionUpdate(Request $request)
    {
        return $this->aboutService->elevatingSectionUpdate($request);
    }

    public function elevatingSectionFeatureList()
    {
        return $this->aboutService->elevatingSectionFeatureList();
    }

    public function elevatingSectionFeatureCreateOrUpdate(Request $request)
    {
        return $this->aboutService->elevatingSectionFeatureCreateOrUpdate($request);
    }

    public function customerSupportSection()
    {
        return $this->aboutService->customerSupportSection();
    }

    public function customerSupportSectionUpdate(Request $request)
    {
        return $this->aboutService->customerSupportSectionUpdate($request);
    }


    // Client site api start

    public function aboutPage()
    {
        return $this->aboutService->aboutPage();
    }

    public function productByClientId(Request $request)
    {
        return $this->aboutService->productByClientId($request);
    }
}
