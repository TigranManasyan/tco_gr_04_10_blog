<?php

function get_file_ext($file_name) {
    $ext = explode(".", $file_name);
    return end($ext);
}

function unique_name($file_name) {
    $ext = get_file_ext($file_name);
    $new_name = "avatar_" . time() . "." . $ext;
    return $new_name;
}

function upload($file) {
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/images/";
    $upload_file_name = unique_name($file['name']);
    $upload = move_uploaded_file($file['tmp_name'], $upload_dir . $upload_file_name);
    if($upload) {
        return $upload_file_name;
    } else {
        return '';
    }
}

