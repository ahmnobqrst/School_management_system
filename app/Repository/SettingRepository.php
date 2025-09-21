<?php
namespace App\Repository;

use App\Interface\SettingInterface;
use App\Models\Setting;
use App\Traits\studentimagetrait;

class SettingRepository implements SettingInterface
{

    use studentimagetrait;

    public function index()
    {

        $locale = app()->getLocale();

        $settings = Setting::all()->mapWithKeys(function ($item) use ($locale) {
            $keyJson   = json_decode($item->key, true);
            $valueJson = json_decode($item->value, true);

            $key   = $keyJson['en'];
            $value = $valueJson[$locale] ?? '';

            return [$key => $value];
        });

        return view('Dashboard.setting.index', ['setting' => $settings]);

    }

    public function update($request)
{
    try {
        $locale = app()->getLocale();

        foreach ($request->except(['_token', '_method', 'logo']) as $key => $value) {
            $setting = Setting::all()->first(function ($item) use ($key) {
                return json_decode($item->key, true)['en'] === $key;
            });

            if ($setting) {
                $valueJson = json_decode($setting->value, true);
                $valueJson[$locale] = $value;

                $setting->update([
                    'value' => json_encode($valueJson),
                ]);
            }
        }

        if ($request->hasFile('logo')) {
            $setting = Setting::all()->first(function ($item) {
                return json_decode($item->key, true)['en'] === 'Logo';
            });

            if ($setting) {
                $oldValues = json_decode($setting->value, true);
                foreach (['en', 'ar'] as $lang) {
                    if (!empty($oldValues[$lang])) {
                        $this->delete_file($oldValues[$lang]);
                    }
                }
                $logo = $this->uploadImageimage($request->logo, 'Logo');

                $setting->update([
                    'value' => json_encode([
                        'en' => $logo,
                        'ar' => $logo,
                    ]),
                ]);
            }
        }

        toastr()->success(trans('Students_trans.Setting updated successfully'));
        return redirect()->route('setting.index');

    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
}


}
