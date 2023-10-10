<?php

namespace App\Services;

use App\Http\Traits\HelperTrait;
use App\Models\Certification;
use App\Models\CompanyAchievement;
use App\Models\HeroSlider;
use App\Models\HomeAboutSection;
use App\Models\HomeCertification;
use App\Models\HomeProductSection;
use App\Models\HomeSustainability;
use App\Models\HomeSustainabilityFeature;
use App\Models\MenuSection;
use App\Models\OurClient;
use App\Models\OurService;
use App\Models\Product;
use App\Models\SliderFeatureSection;
use App\Models\SubMenu;
use App\Models\VirtuallySection;


class HomeService
{


    use HelperTrait;
    public function sliderList()
    {
        try {
            $sliders = HeroSlider::all();
            return $this->apiResponse($sliders, 'Slider List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function saveOrUpdateSlider($request)
    {
        try {
            $sliders = [
                'short_title' => $request->short_title,
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'is_active' => $request->is_active,
            ];

            $request->validate([
                'title' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
            ]);

            if (empty($request->id)) {
                $slider = HeroSlider::create($sliders);
                if ($request->hasFile('image')) {
                    $slider->image = $this->imageUpload($request, 'image', 'image');
                    $slider->save();
                }
                return $this->apiResponse([], 'Slider Saved Successfully', true, 200);
            } else {
                $slider = HeroSlider::find($request->id);
                $slider->update($sliders);
                if ($request->hasFile('image')) {
                    $slider->image = $this->imageUpload($request, 'image', 'image', $slider->image);
                    $slider->save();
                }
                return $this->apiResponse([], 'Slider Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function sliderSectionFeature()
    {
        $slider = SliderFeatureSection::first();
        return $this->apiResponse($slider, 'Slider Feature List Get Successfully', true, 200);
    }

    public function sliderSectionFeatureSaveOrUpdate($request)
    {
        try {
            $request->validate([
                'title_one' => 'required',
            ]);

            $sliders = [
                'logo' => $request->logo,
                'title_one' => $request->title_one,
                'title_two' => $request->title_two,
                'title_three' => $request->title_three,
                'title_four' => $request->title_four,
                'is_active' => $request->is_active,
            ];

            if (empty($request->id)) {
                $slider = SliderFeatureSection::create($sliders);
                if ($request->hasFile('logo')) {
                    $slider->logo = $this->imageUpload($request, 'logo', 'image');
                    $slider->save();
                }
                return $this->apiResponse([], 'Slider Feature Saved Successfully', true, 200);
            } else {
                $slider = SliderFeatureSection::find($request->id);
                $slider->update($sliders);
                if ($request->hasFile('logo')) {
                    $slider->logo = $this->imageUpload($request, 'logo', 'image', $slider->logo);
                    $slider->save();
                }
                return $this->apiResponse([], 'Slider Feature Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function deleteSlider($id)
    {
        try {
            $slider = HeroSlider::find($id);

            if ($slider->image != null) {
                $this->deleteImage($slider->image);
            }

            $slider->delete();
            return $this->apiResponse([], 'Slider Deleted Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function aboutSection()
    {
        try {
            $about = HomeAboutSection::first();
            return $this->apiResponse($about, 'Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function aboutSaveOrUpdate($request)
    {
        try {
            $aboutSec = [
                'short_title' => $request->short_title,
                'title' => $request->title,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'youtube_link' => $request->youtube_link,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'start_count' => $request->start_count,
                'end_count' => $request->end_count,
                'name' => $request->name,
            ];

            $request->validate([
                'title' => 'required',
            ]);

            if (empty($request->id)) {
                $about = HomeAboutSection::create($aboutSec);

                if ($request->hasFile('featured_image')) {
                    $about->featured_image = $this->imageUpload($request, 'featured_image', 'image');
                    $about->save();
                }

                return $this->apiResponse($about, 'About Section Saved Successfully', true, 200);
            } else {
                $about = HomeAboutSection::find($request->id);
                $about->update($aboutSec);
                if ($request->hasFile('featured_image')) {
                    $about->featured_image = $this->imageUpload($request, 'featured_image', 'image', $about->featured_image);
                    $about->save();
                }
                return $this->apiResponse($about, 'About Section Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function ourServiceList()
    {
        $service = OurService::get();
        return $this->apiResponse($service, 'Our Service List Get Successfully', true, 200);
    }

    public function ourServiceSaveOrUpdate($request)
    {
        try {
            $services = [
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ];

            $request->validate([
                'title' => 'required',
            ]);

            if (empty($request->id)) {
                $service = OurService::create($services);
                if ($request->hasFile('image')) {
                    $service->image = $this->imageUpload($request, 'image', 'image');
                    $service->save();
                }
                return $this->apiResponse($service, 'Our Service Saved Successfully', true, 200);
            } else {
                $service = OurService::find($request->id);
                $service->update($services);
                if ($request->hasFile('image')) {
                    $service->image = $this->imageUpload($request, 'image', 'image', $service->image);
                    $service->save();
                }
                return $this->apiResponse($service, 'Our Service Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function achievementList()
    {
        try {
            $achievements = CompanyAchievement::get();
            return $this->apiResponse($achievements, 'Achievement List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function achievementSaveOrUpdate($request)
    {
        try {
            $achieves = [
                'title' => $request->title,
                'count_start' => $request->count_start,
                'count_end' => $request->count_end,
                'link' => $request->link,
                'is_active' => $request->is_active,
            ];

            $request->validate([
                'title' => 'required',
            ]);

            if (empty($request->id)) {
                $achievement = CompanyAchievement::create($achieves);
                if ($request->hasFile('icon')) {
                    $achievement->icon = $this->imageUpload($request, 'icon', 'icon');
                    $achievement->save();
                }
                return $this->apiResponse($achievement, 'Achievement Saved Successfully', true, 200);
            } else {
                $achievement = CompanyAchievement::find($request->id);
                $achievement->update($achieves);
                if ($request->hasFile('icon')) {
                    $achievement->icon = $this->imageUpload($request, 'icon', 'icon', $achievement->icon);
                    $achievement->save();
                }
                return $this->apiResponse($achievement, 'Achievement Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function achievementDelete($id)
    {
        try {
            $achievement = CompanyAchievement::find($id);
            if ($achievement->icon != null) {
                $this->deleteImage($achievement->icon);
            }
            $achievement->delete();
            return $this->apiResponse([], 'Achievement Deleted Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function virtualSection()
    {
        try {
            $virtually = VirtuallySection::first();
            return $this->apiResponse($virtually, 'Virtually Section List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function virtualSectionSaveOrUpdate($request)
    {
        try {
            $vir = [
                'sort_title' => $request->sort_title,
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'link' => $request->link,
                'is_active' => $request->is_active,
            ];

            $request->validate([
                'title' => 'required',
            ]);

            if (empty($request->id)) {
                $virtually = VirtuallySection::create($vir);
                if ($request->hasFile('bg_image')) {
                    $virtually->bg_image = $this->imageUpload($request, 'bg_image', 'image');
                    $virtually->save();
                }
                return $this->apiResponse($virtually, 'Virtually Section Saved Successfully', true, 200);
            } else {
                $virtually = VirtuallySection::find($request->id);
                $virtually->update($vir);
                if ($request->hasFile('bg_image')) {
                    $virtually->bg_image = $this->imageUpload($request, 'bg_image', 'image', $virtually->bg_image);
                    $virtually->save();
                }
                return $this->apiResponse($virtually, 'Virtually Section Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function productSectionSaveOrUpdate($request)
    {

        try {

            $request->validate([
                'title' => 'required',
            ]);
            $product = [
                'sort_title' => $request->sort_title,
                'title' => $request->title,
                'description' => $request->description,
            ];

            $pSection = HomeProductSection::first();
            $pSection->update($product);
            return $this->apiResponse($pSection, ' Section Updated Successfully', true, 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function productSection()
    {
        try {
            $product = HomeProductSection::first();
            return $this->apiResponse($product, 'Product Section  Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function ourClientList()
    {
        try {
            $ourClients = OurClient::all();
            return $this->apiResponse($ourClients, 'Our Client List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function ourClientSaveOrUpdate($request)
    {
        try {
            $ourClient = [
                'title' => $request->title,
                'name' => $request->name,
                'link' => $request->link,
                'is_active' => $request->is_active,
            ];
            $request->validate([
                'title' => 'required',
            ]);
            if (empty($request->id)) {
                $ourClients = OurClient::create($ourClient);
                if ($request->hasFile('logo')) {
                    $ourClients->logo = $this->imageUpload($request, 'logo', 'image');
                    $ourClients->save();
                }
                return $this->apiResponse($ourClients, 'Our Client Saved Successfully', true, 201);
            } else {
                $ourClients = OurClient::find($request->id);
                $ourClients->update($ourClient);
                if ($request->hasFile('logo')) {
                    $ourClients->logo = $this->imageUpload($request, 'logo', 'image', $ourClients->logo);
                    $ourClients->save();
                }
                return $this->apiResponse($ourClients, 'Our Client Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function sustainabilitySection()
    {
        try {
            $sustain = HomeSustainability::first();
            return $this->apiResponse($sustain, 'Sustainability Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function sustainabilitySaveOrUpdate($request)
    {
        try {
            $sustainability = [
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
            ];
            $request->validate([
                'title' => 'required',
            ]);
            if (empty($request->id)) {
                $sustain = HomeSustainability::create($sustainability);
                return $this->apiResponse([], 'Sustainability Saved Successfully', true, 201);
            } else {
                $sustain = HomeSustainability::find($request->id);
                $sustain->update($sustainability);
                return $this->apiResponse([], 'Sustainability Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function sustainabilityFeatureList()
    {
        try {
            $sustain = HomeSustainabilityFeature::all();
            return $this->apiResponse($sustain, 'Sustainability Feature List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function sustainabilityFeatureSaveOrUpdate($request)
    {
        try {
            $sustainability = [
                'home_sustainability_id' => $request->home_sustainability_id,
                'title' => $request->title,
                'color' => $request->color,
                'count' => $request->count,
                'is_active' => $request->is_active,
            ];
            $request->validate([
                'title' => 'required',
            ]);
            if (empty($request->id)) {
                $sustain = HomeSustainabilityFeature::create($sustainability);
                if ($request->hasFile('icon')) {
                    $sustain->icon = $this->imageUpload($request, 'icon', 'icon');
                    $sustain->save();
                }
                return $this->apiResponse([], 'Sustainability Feature Saved Successfully', true, 201);
            } else {
                $sustain = HomeSustainabilityFeature::find($request->id);
                $sustain->update($sustainability);
                if ($request->hasFile('icon')) {
                    $sustain->icon = $this->imageUpload($request, 'icon', 'icon', $sustain->icon);
                    $sustain->save();
                }
                return $this->apiResponse([], 'Sustainability Feature Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function certificationSection()
    {
        try {
            $certification = HomeCertification::first();
            return $this->apiResponse($certification, 'Certification Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function certificationSectionUpdate($request)
    {
        try {
            $request->validate([
                'title' => 'required',
            ]);

            // update certification
            $certification = HomeCertification::first();
            $certification->update([
                'sort_title' => $request->sort_title,
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
            ]);
            return $this->apiResponse([], 'Certification Updated Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function certificationList()
    {
        try {
            $certification = certification::get();
            return $this->apiResponse($certification, 'Certification List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function certificationSaveOrUpdate($request)
    {

        try {
            $request->validate([
                'title' => 'required',
                'certificate_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
            ]);

            $certifications = [
                'certification_category_id' => $request->certification_category_id,
                'sort_title' => $request->sort_title,
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'is_active' => $request->is_active,
            ];

            if (empty($request->id)) {
                $certification = Certification::create($certifications);
                if ($request->hasFile('image')) {
                    $certification->image = $this->imageUpload($request, 'image', 'image');
                    $certification->save();
                }

                if ($request->hasFile('certificate_img')) {
                    $certification->certificate_img = $this->imageUpload($request, 'certificate_img', 'certificate_img');
                    $certification->save();
                }


                return $this->apiResponse([], 'Certification Saved Successfully', true, 201);
            } else {
                $certification = Certification::find($request->id);
                $certification->update($certifications);
                if ($request->hasFile('image')) {
                    $certification->image = $this->imageUpload($request, 'image', 'image', $certification->image);
                    $certification->save();
                }

                if ($request->hasFile('certificate_img')) {
                    $certification->certificate_img = $this->imageUpload($request, 'certificate_img', 'certificate_img', $certification->certificate_img);
                    $certification->save();
                }
                return $this->apiResponse([], 'Certification Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function homePage()
    {
        try {
            $homePage = [
                'slider' => HeroSlider::select('id', 'short_title', 'title', 'description', 'button_text', 'button_link', 'image')->get(),
                'sliderFeature' => SliderFeatureSection::select('id', 'title_one', 'title_two', 'title_three', 'title_four', 'logo')->first(),
                'about' => HomeAboutSection::select('id', 'short_title', 'title', 'short_description', 'description', 'button_text', 'button_link', 'featured_image', 'start_count', 'end_count', 'name')->first(),
                'ourService' => OurService::select('id', 'title', 'description', 'image')->get(), // 'image
                'achievement' => CompanyAchievement::select('id', 'title', 'count_start', 'count_end', 'link', 'icon')->get(),
                'subMenuList' => SubMenu::where('menu_id', 7)->select('id', 'menu_id', 'name', 'description', 'link',)->get(),
                'virtually' => VirtuallySection::select('id', 'sort_title', 'title', 'description', 'button_text', 'link', 'bg_image')->first(),
                'product' => HomeProductSection::select('id', 'sort_title', 'title', 'description')->first(),
                'productList' => Product::select('id', 'client_id', 'short_title', 'title', 'short_description', 'image')->take(6)->get(),
                'ourClient' => OurClient::select('id', 'title', 'name', 'link', 'logo')->get(),
                'sustainability' => HomeSustainability::select('id', 'title', 'description', 'button_text', 'button_link')->first(),
                'sustainabilityFeature' => HomeSustainabilityFeature::select('id', 'home_sustainability_id', 'title', 'color', 'count', 'icon')->get(),
                'certification' => HomeCertification::select('id', 'sort_title', 'title', 'description', 'button_text', 'button_link')->first(),
                'certificationList' => Certification::select('id', 'certification_category_id', 'sort_title', 'title', 'description', 'button_text', 'button_link', 'image', 'certificate_img')->take(6)->get(),
            ];
            return $this->apiResponse($homePage, 'Home Page Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function homeServiceBySubmenuId($request)
    {
        $id =  $request->id;
        $section = MenuSection::where('menu_id', 7)
            ->where('sub_menu_id', $id)->select('id', 'menu_id', 'sub_menu_id', 'title', 'description', 'image')->first();
        return $this->apiResponse($section, 'Home Service Get Successfully', true, 200);
    }
}
