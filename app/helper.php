<?php

if (!function_exists('uploadImage')) {
    function uploadImage($dir, $file)
    {
        $dir = public_path() . '/uploads/' . $dir;
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $size = $file->getSize();
        $fileName =  $size . uniqid() . '-' . $file->getClientOriginalName();
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
