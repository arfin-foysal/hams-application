<?php

namespace App\Services;

use App\Http\Traits\HelperTrait;
use App\Models\Certification;
use App\Models\CommonInfo;
use App\Models\MainMenu;
use App\Models\MenuSection;
use App\Models\SubMenu;
use App\Models\Subscription;

class CommonService
{
    use HelperTrait;
    public function mainMenuList()
    {
        try {
            $mainMenus = MainMenu::all();
            return $this->apiResponse($mainMenus, 'Main Menu List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function saveOrUpdateMainMenu($request)
    {
        try {
            $mainMenus = [
                'name' => $request->name,
                'link' => $request->link,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'is_active' => $request->is_active,
            ];
            $request->validate([
                'name' => 'required',
            ]);
            if (empty($request->id)) {
                $mainMenu = MainMenu::create($mainMenus);

                return $this->apiResponse([], 'Main Menu Saved Successfully', true, 200);
            } else {
                $mainMenu = MainMenu::find($request->id);
                $mainMenu->update($mainMenus);
                return $this->apiResponse([], 'Main Menu Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function subMenuCreateOrUpdate($request)
    {
        try {
            $subMenus = [
                'menu_id' => $request->menu_id,
                'name' => $request->name,
                'description' => $request->description,
                'link' => $request->link,
                'is_active' => $request->is_active,
            ];
            $request->validate([
                'name' => 'required',
            ]);
            if (empty($request->id)) {
                $subMenu = SubMenu::create($subMenus);
                return $this->apiResponse([], 'Sub Menu Saved Successfully', true, 200);
            } else {
                $subMenu = SubMenu::find($request->id);
                $subMenu->update($subMenus);
                return $this->apiResponse([], 'Sub Menu Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function subMenuByMenu($request)
    {
        try {
            $menu_id = $request->id ? $request->id : 0;
            $subMenus = SubMenu::where('menu_id', $menu_id)->get();
            return $this->apiResponse($subMenus, 'Sub Menu List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function subMenuList($request, $id)
    {
        try {
            $subMenus = SubMenu::where('menu_id', $id)->get();
            return $this->apiResponse($subMenus, 'Sub Menu List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function deleteSubMenu($id)
    {
        try {
            $subMenu = SubMenu::find($id);
            if ($subMenu->icon != null) {
                $this->deleteImage($subMenu->icon);
            }
            if ($subMenu->bg_image != null) {
                $this->deleteImage($subMenu->bg_image);
            }
            $subMenu->delete();
            return $this->apiResponse([], 'Sub Menu Deleted Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }


    public function saveOrUpdateMenuSection($request)
    {
        try {
            $Section = [
                'menu_id' => $request->menu_id,
                'sub_menu_id' => $request->sub_menu_id,
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ];

            $request->validate([
                'title' => 'required',
            ]);

            if (empty($request->id)) {

                $menuSection = MenuSection::where('sub_menu_id', $request->sub_menu_id)->first();

                if ($menuSection) {
                    return $this->apiResponse([], 'Menu Section Already Exist For This Sub Menu', false, 500);
                }

                if ($request->hasFile('image')) {
                    $Section['image'] = $this->imageUpload($request, 'image', 'image');
                }
                $menuSection = MenuSection::create($Section);

                return $this->apiResponse([], 'Menu Section Saved Successfully', true, 200);
            } else {
                $menuSection = MenuSection::find($request->id);
                if ($request->hasFile('image')) {
                    $menuSection->image = $this->imageUpload($request, 'image', 'image', $menuSection->image);
                    $menuSection->save();
                }
                $menuSection->update($Section);

                return $this->apiResponse($menuSection, 'Menu Section Updated Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function menuSectionList($request, $id)
    {
        try {
            $sub_menu_id = $id;
            $menuSections = MenuSection::where('sub_menu_id', $sub_menu_id)
                ->get();
            return $this->apiResponse($menuSections, 'Menu Section List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function deleteMenuSection($id)
    {
        try {
            $menuSection = MenuSection::find($id);
            if ($menuSection->image != null) {
                $this->deleteImage($menuSection->image);
            }
            $menuSection->delete();
            return $this->apiResponse([], 'Menu Section Deleted Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function deleteMainMenu($id)
    {
        try {
            $mainMenu = MainMenu::find($id);

            if ($mainMenu->icon != null) {
                $this->deleteImage($mainMenu->icon);
            }

            $mainMenu->delete();
            return $this->apiResponse([], 'Main Menu Deleted Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function commonInfo()
    {
        try {
            $commonInfo = CommonInfo::first();
            return $this->apiResponse($commonInfo, 'Common Info Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function saveOrUpdateCommonInfo($request)
    {
        try {


            if (empty($request->id)) {
                $info = $request->all();
                if ($request->hasFile('logo')) {
                    $info['logo'] = $this->imageUpload($request, 'logo', 'image');
                }
                if ($request->hasFile('favicon')) {
                    $info['favicon'] = $this->imageUpload($request, 'favicon', 'image');
                }
                if ($request->hasFile('banner')) {
                    $info['banner'] = $this->imageUpload($request, 'banner', 'image');
                }
                $commonInfo = CommonInfo::create($info);
                return $this->apiResponse([], 'Common Info Saved Successfully', true, 200);
            } else {
                $info = $request->all();
                $commonInfo = CommonInfo::find($request->id);
                if ($request->hasFile('logo')) {
                    $info['logo'] = $this->imageUpload($request, 'logo', 'image', $commonInfo->logo);
                }
                if ($request->hasFile('favicon')) {
                    $info['favicon'] = $this->imageUpload($request, 'favicon', 'image', $commonInfo->favicon);
                }
                if ($request->hasFile('banner')) {
                    $info['banner'] = $this->imageUpload($request, 'banner', 'image', $commonInfo->banner);
                }
                $commonInfo->update($info);

                return $this->apiResponse([], 'Common Info Update Successfully', true, 200);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }


    public function certificationList()
    {
        try {
            $certifications = Certification::get();
            return $this->apiResponse($certifications, 'Certification List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function sectionAndSubMenuByMenuId($id)
    {
        try {
            $menuSections = MenuSection::where('menu_id', $id)->get();
            $subMenus = SubMenu::where('menu_id', $id)->get();
            return $this->apiResponse(['menuSections' => $menuSections, 'subMenus' => $subMenus], 'Menu Section And Sub Menu List Get Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }

    public function subscription($request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);
            $subscription = [
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'company' => $request->company,
                'remark' => $request->remark,
            ];
            $subscription = Subscription::create($subscription);
            return $this->apiResponse([], 'Subscription Saved Successfully', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), false, 500);
        }
    }
}
