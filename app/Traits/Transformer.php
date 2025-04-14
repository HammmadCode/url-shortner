<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
trait Transformer
{

    public static function transformCollection($collection)
    {
        $params = http_build_query(request()->except('page'));
        $next = $collection->nextPageUrl();
        $previous = $collection->previousPageUrl();
        if ($params) {
            if ($next) {
                $next .= "&{$params}";
            }
            if ($previous) {
                $previous .= "&{$params}";
            }
        }
        $meta = [
            "next" => (string)$next,
            "previous" => (string)$previous,
            "per_page" => (int)$collection->perPage(),
            "total" => (int)$collection->total()
        ];
        return $meta;
    }

    // auth user login response body
    public static function transformUser($user, $token = '', $is_auth = false, $sProfile=null)
    {
        $avatar = getAvatar($user);
        $permission = $user->role->permissions()->get()->map(function ($permission) {
            return Transformer::transformUserPermission($permission);
        });
        $transformed_user = [
            'id' => (int)$user->id,
            'name' => (string)$user->name,
            'email' => (string)$user->email,
            'permissions' => $permission,

        ];

        if ($token) {
            $transformed_user['token'] = (string)$token;
        } else {
            $transformed_user['created_at'] = (string) $user->created_at;
            $transformed_user['updated_at'] = (string) $user->updated_at;
        }

        return $transformed_user;
    }
    public static function transformUserPermission($permission)
    {
        $transformed_permission = [
            'id' => (int)$permission->id,
            'name' => (string)$permission->name,
          
        ];
        return $transformed_permission;
    }
    public static function transformTranslations($translations)
    {
        return $translations->map(function ($translation) {
            return array(
                $translation->key => array(
                    'eng' => $translation->eng,
                    'arb' => $translation->arb,
                ),
            );
        });
    }

    public static function images($images)
    {
        $data = [];
        foreach ($images as $image) {
            $link = Storage::exists($image->link) ? Storage::url($image->link) : url('/img/no_image.png');
            if ($image->related_id) {
                $data[$image->related_id]['thumbnail'] = $link;
            } else {
                $data[$image->id]['image'] = $link;
            }
        }
        return array_values($data);
    }

}
