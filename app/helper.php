<?php

if (!function_exists('uploadImage')) {
    function uploadImage($dir, $file, $isMulti = false)
    {
        $dir = public_path() . '/uploads/' . $dir;
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $size = $file->getSize();
        if ($isMulti) {
            $fileName = $file->getClientOriginalName();
        } else {
            $fileName =  $size . uniqid() . '-' . $file->getClientOriginalName();
        }

        $file->move($dir, $fileName);

        return $fileName;
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        $result = \Carbon\Carbon::parse($date)->format('d-m-Y');

        return $result;
    }
}

if (!function_exists('cutRedisKey')) {
    function cutRedisKey($key)
    {
        $new = str_replace('laravel_database_', '', $key);

        return $new;
    }
}

if (!function_exists('getEmailRedis')) {
    function getEmailRedis($key)
    {
        $email = str_replace('chat_log:', '', $key);

        return $email;
    }
}
