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
