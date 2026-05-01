<?php

$sourcePath = 'C:\Users\Shivam\erp lic\public\images\WhatsApp Image 2026-04-29 at 8.55.58 PM (1).jpeg';
$targetWebp = 'c:\Users\Shivam\erp lic\public\images\login-admin.webp';
$targetSize = 1024;

if (!file_exists($sourcePath)) {
    die("Source file not found: $sourcePath\n");
}

$src = imagecreatefromjpeg($sourcePath);
if (!$src) {
    die("Failed to load image\n");
}

$width = imagesx($src);
$height = imagesy($src);

$minDim = min($width, $height);
$cropX = max(0, floor(($width - $minDim) / 2));
$cropY = max(0, floor(($height - $minDim) / 2));

$dest = imagecreatetruecolor($targetSize, $targetSize);

// Maintain transparency if needed, though JPEG doesn't have it
imagealphablending($dest, false);
imagesavealpha($dest, true);

imagecopyresampled(
    $dest, $src,
    0, 0, $cropX, $cropY,
    $targetSize, $targetSize, $minDim, $minDim
);

// Save as WebP with good compression (quality 80)
if (imagewebp($dest, $targetWebp, 80)) {
    echo "Saved WebP to $targetWebp\n";
} else {
    echo "Failed to save WebP\n";
}

imagedestroy($src);
imagedestroy($dest);

