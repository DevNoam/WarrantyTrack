<?php 
    $repo = 'https://github.com/sapirnoam/WarrantyTrack/archive/refs/heads/main.zip';
    $zip = new ZipArchive;
    $res = $zip->open('main.zip');
    if ($res === TRUE) {
        $zip->extractTo('.');
        $zip->close();
        echo '<br>Downloaded successfully!';
    } else {
        echo '<br>Download failed!';
    }
?>

