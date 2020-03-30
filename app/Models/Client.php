<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'unique_name',
        'description',
        'logo',
        'logo2',
        'landingpage_title',
        'landingpage_content',
        'banner',
        'address1',
        'address2',
        'city',
        'province',
        'postal_code',
        'phone1',
        'phone2',
        'referee_url'
    ];

    public function managers()
    {
    	return $this->hasMany('App\Models\Client\ClientManager');
    }


    public static function getAllClients()
    {
    	return Self::with('managers')->get();
    }

    public static function initCloudinary()
    {
        $cloud = config('services.cloudinary.cloud_name');
            \Cloudinary::config(array(
            "cloud_name" => $cloud,
            "api_key" => config('services.cloudinary.api_key'),
            "api_secret" => config('services.cloudinary.api_secret')
        ));
    }

    public static function createNewClient($request)
    {
        Self::initCloudinary();

        $logo1 = $request->file('clientimage');
        $logo2 = $request->file('clientimage2');
        $banner = $request->file('bannerimage');

        $logo1upload = \Cloudinary\Uploader::upload($logo1);
        $banner = \Cloudinary\Uploader::upload($banner);
        if($logo2){
            $logo2upload = \Cloudinary\Uploader::upload($logo2);
        }

        if ($logo1upload && $banner) {
            $client = [
                'name' => $request->name,
                'unique_name' => $request->unique_name,
                'description' => $request->description,
                'logo' => "v" . $logo1upload['version'] . "/" . $logo1upload['public_id'] . "." . $logo1upload['format'],
                'landingpage_title' => $request->landingpage_title,
                'landingpage_content' => $request->landingpage_content,
                'banner' => "v" . $banner['version'] . "/" . $banner['public_id'] . "." . $banner['format'],
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'province' => $request->province,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'referee_url' => $request->referee_url,
            ];

            if (isset($logo2upload)) {
                $client['logo2'] = "v" . $logo2upload['version'] . "/" . $logo2upload['public_id'] . "." . $logo2upload['format'];
            }

            Client::create($client);
        }
        // return $client;
        return redirect()->to('/admin/clients');
    }

    public static function updateClient(Request $request)
    {
        \Log::info($request->all());
        $client = Client::find($request->clientId);

        $old_logo1 = $client->logo;
        $old_logo2 = $client->logo2;
        $old_banner = $client->banner;

        $logo1 = $request->logo;
        $logo2 = $request->logo2;
        $banner = $request->banner;

        $data = [
            'name' => $request->company_name,
            'unique_name' => $request->unique_name,
            'description' => $request->description,
            'landingpage_title' => $request->landingpage_title,
            'landingpage_content' => $request->landingpage_content,
            'banner' => $old_banner,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'logo' => $old_logo1,
            'logo2' => $old_logo2,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'province' => $request->province,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'referee_url' => $request->referee_url,
        ];

        if( isset($logo1) || isset($logo2) || isset($banner) ){

            Self::initCloudinary();

            if($logo1){
                $upload_logo = \Cloudinary\Uploader::upload($logo1);
                if ($upload_logo) {
                    $image_logo1 = "v" . $upload_logo['version'] . "/" . $upload_logo['public_id'] . "." . $upload_logo['format'];
                    \Log::info($image_logo1);
                }
            } else {
                $image_logo1 = $old_logo1; //just put the old one back.
            }

            if($logo2){
                $upload_logo2 = \Cloudinary\Uploader::upload($logo2);
                if ($upload_logo2) {
                    $image_logo2 = "v" . $upload_logo2['version'] . "/" . $upload_logo2['public_id'] . "." . $upload_logo2['format'];
                    \Log::info($image_logo2);
                }
            } else {
                $image_logo2 = $old_logo2; //just put the old one back.
            }

            if($banner){
                $upload_banner = \Cloudinary\Uploader::upload($banner);
                if ($upload_banner) {
                    $image_banner = "v" . $upload_banner['version'] . "/" . $upload_banner['public_id'] . "." . $upload_banner['format'];
                    \Log::info($image_banner);
                }
            } else {
                $image_banner = $old_banner; //just put the old one back.
            }

            $data['logo'] = $image_logo1;
            $data['logo2'] = $image_logo2;
        }

        $client->update($data);

        return $client;
    }

    public static function getClientById($id)
    {
        return Client::with('managers')->find($id);
    }

    public static function deleteClient($id)
    {
        return Client::find($id)->delete();
    }
}
