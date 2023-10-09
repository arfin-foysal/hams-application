<?php

namespace App\Services;

use App\Http\Traits\HelperTrait;
use App\Models\AboutClientSection;
use App\Models\AboutCustomer;
use App\Models\AboutElevationFeature;
use App\Models\AboutElevationSection;
use App\Models\AboutJourneySection;
use App\Models\AboutJourneyTimeline;
use App\Models\AboutProcessFeature;
use App\Models\AboutProcessSection;
use App\Models\AboutQualityFeature;
use App\Models\AboutQualitySection;
use App\Models\AboutWhoWeAreSection;
use App\Models\OurClient;
use App\Models\Product;

class AboutService
{
    use HelperTrait;
    public function whoWeAreSection()
    {
        $who = AboutWhoWeAreSection::first();
        return $this->apiResponse($who, 'success', true, 200);
    }

    public function whoWeAreSectionUpdate($request)
    {


        $who = AboutWhoWeAreSection::first();
        $who->update([
            'short_title' => $request->short_title,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $who->update([
                'image' => $this->imageUpload($request, 'image', 'image', $request->image),
            ]);
        }

        return $this->apiResponse($who, 'success', true, 200);
    }

    public function processSection()
    {

        $process = AboutProcessSection::first();
        return $this->apiResponse($process, 'success', true, 200);
    }

    public function processSectionUpdate($request)
    {
        $process = AboutProcessSection::first();
        $process->update([
            'short_title' => $request->short_title,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return $this->apiResponse($process, 'success', true, 200);
    }

    public function processSectionFeatureList()
    {
        $process = AboutProcessFeature::where('about_process_section_id', 1)->get();
        return $this->apiResponse($process, 'success', true, 200);
    }

    public function processSectionFeatureCreateOrUpdate($request)
    {
        try {

            $processSec = [
                'about_process_section_id' => $request->about_process_section_id,
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->is_active,

            ];

            $request->validate([
                'title' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
            ]);

            if (empty($request->id)) {
                $process = AboutProcessFeature::create($processSec);
                if ($request->hasFile('image')) {
                    $process->update([
                        'image' => $this->imageUpload($request, 'image', 'image', $request->image),
                    ]);
                }

                return $this->apiResponse([], 'success', true, 200);
            } else {

                $process = AboutProcessFeature::find($request->id);
                $process->update($processSec);
                if ($request->hasFile('image')) {
                    $process->update([
                        'image' => $this->imageUpload($request, 'image', 'image', $request->image),
                    ]);
                }
                return $this->apiResponse([], 'success', true, 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function journeySection()
    {
        $process = AboutJourneySection::first();
        return $this->apiResponse($process, 'success', true, 200);
    }

    public function journeySectionUpdate($request)
    {
        $journey = AboutJourneySection::first();
        $journey->update([
            'short_title' => $request->short_title,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return $this->apiResponse([], 'update successfully', true, 200);
    }

    public function journeySectionTimelineList()
    {
        $journey = AboutJourneyTimeline::where('about_journey_section_id', 1)->get();
        return $this->apiResponse($journey, 'success', true, 200);
    }


    public function journeySectionTimelineCreateOrUpdate($request)
    {
        try {

            $journeySec = [
                'about_journey_section_id' => $request->about_journey_section_id,
                'title' => $request->title,
                'description' => $request->description,
                'year' => $request->year,
                'is_active' => $request->is_active,
            ];

            $request->validate([
                'title' => 'required',
            ]);

            if (empty($request->id)) {
                $journey = AboutJourneyTimeline::create($journeySec);
                return $this->apiResponse([], 'Create successfully', true, 200);
            } else {

                $journey = AboutJourneyTimeline::find($request->id);
                $journey->update($journeySec);
                return $this->apiResponse([], 'Update successfully', true, 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function qualitySection()
    {
        $quality = AboutQualitySection::first();
        return $this->apiResponse($quality, 'success', true, 200);
    }

    public function qualitySectionUpdate($request)
    {
        $quality = AboutQualitySection::first();
        $quality->update([
            'short_title' => $request->short_title,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return $this->apiResponse([], 'update successfully', true, 200);
    }



    public function qualitySectionFeatureList()
    {
        $quality = AboutQualityFeature::where('about_quality_section_id', 1)->get();
        return $this->apiResponse($quality, 'success', true, 200);
    }

    public function qualitySectionFeatureCreateOrUpdate($request)
    {
        try {

            $qualitySec = [
                'about_quality_section_id' => $request->about_quality_section_id,
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->is_active,

            ];

            $request->validate([
                'title' => 'required',
            ]);

            if (empty($request->id)) {
                $quality = AboutQualityFeature::create($qualitySec);
                return $this->apiResponse([], 'success', true, 200);
            } else {

                $quality = AboutQualityFeature::find($request->id);
                $quality->update($qualitySec);
                return $this->apiResponse([], 'success', true, 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function clientSection()
    {
        $client = AboutClientSection::first();
        return $this->apiResponse($client, 'success', true, 200);
    }

    public function clientSectionUpdate($request)
    {
        $client = AboutClientSection::first();
        $client->update([
            'short_title' => $request->short_title,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return $this->apiResponse([], 'update successfully', true, 200);
    }



    public function elevatingSection()
    {
        $elevating = AboutElevationSection::first();
        return $this->apiResponse($elevating, 'success', true, 200);
    }

    public function elevatingSectionUpdate($request)
    {
        $elevating = AboutElevationSection::first();
        $elevating->update([
            'short_title' => $request->short_title,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return $this->apiResponse([], 'update successfully', true, 200);
    }

    public function elevatingSectionFeatureList()
    {
        $elevating = AboutElevationFeature::get();
        return $this->apiResponse($elevating, 'success', true, 200);
    }

    public function elevatingSectionFeatureCreateOrUpdate($request)
    {
        try {
            $request->validate([
                'title' => 'required',
            ]);

            $elevatingSec = [
                'about_elevation_section_id' => 1,
                'title' => $request->title,
                'description' => $request->description,
                'year' => $request->year,
                'is_active' => $request->is_active,
            ];

            if (empty($request->id)) {
                $elevating = AboutElevationFeature::create($elevatingSec);

                if ($request->hasFile('icon')) {
                    $elevating->icon = $this->imageUpload($request, 'icon', 'icon', $request->icon);
                    $elevating->save();
                }
                return $this->apiResponse([], 'Create successfully', true, 200);
            } else {

                $elevating = AboutElevationFeature::find($request->id);
                $elevating->update($elevatingSec);
                if ($request->hasFile('icon')) {
                    $elevating->icon = $this->imageUpload($request, 'icon', 'icon', $request->icon);
                    $elevating->save();
                }
                return $this->apiResponse([], 'Update successfully', true, 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function customerSupportSection()
    {
        $customerSupport = AboutCustomer::first();
        return $this->apiResponse($customerSupport, 'success', true, 200);
    }

    public function customerSupportSectionUpdate($request)
    {
        $customerSupport = AboutCustomer::first();
        $customerSupport->update([
            'short_title' => $request->short_title,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return $this->apiResponse([], 'update successfully', true, 200);
    }

    //client site api start

    public function aboutPage()
    {
        $about = [
            'who_we_are' => AboutWhoWeAreSection::select('short_title', 'title', 'description', 'image')->first(),
            'process' => AboutProcessSection::select('short_title', 'title', 'description')->first(),
            'process_feature' => AboutProcessFeature::where('about_process_section_id', 1)->select('title', 'description', 'image')
                ->get(),
            'journey' => AboutJourneySection::select(
                'short_title',
                'title',
                'description'
            )->first(),
            'journey_timeline' => AboutJourneyTimeline::where('about_journey_section_id', 1)->select('title', 'description', 'year')
                ->get(),
            'quality' => AboutQualitySection::select(
                'short_title',
                'title',
                'description'
            )->first(),
            'quality_feature' => AboutQualityFeature::where('about_quality_section_id', 1)
                ->select('title', 'description', 'icon')
                ->get(),
            'client' => AboutClientSection::select(
                'short_title',
                'title',
                'description'
            )->first(),
            'clientList' => OurClient::select('id', 'title', 'logo', 'name', 'link',)->get(),
            'elevating' => AboutElevationSection::select(
                'short_title',
                'title',
                'description'
            )->first(),
            'elevating_feature' => AboutElevationFeature::where('about_elevation_section_id', 1)
                ->select('title', 'description', 'icon')
                ->get(),
            'customer_support' => AboutCustomer::select('short_title', 'title', 'description')->first()
        ];

        return $this->apiResponse($about, 'success', true, 200);
    }


    public function productByClientId($request)
    {
        $id = $request->id ? $request->id : 0;
        $product = Product::where('client_id', $id)
            ->select('id', 'title', 'image')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();
        return $this->apiResponse($product, 'success', true, 200);
    }
}
