Add-Type -AssemblyName System.Drawing
$newPath = "C:\Users\Shivam\erp lic\public\images\WhatsApp Image 2026-04-29 at 8.55.58 PM.jpeg"
if (Test-Path $newPath) {
    $img = [System.Drawing.Image]::FromFile($newPath)
    Write-Host "New Image: $($img.Width)x$($img.Height)"
    
    # Target size
    $targetSize = 1024
    
    # Calculate crop
    $minDim = [Math]::Min($img.Width, $img.Height)
    $cropX = [Math]::Max(0, [Math]::Floor(($img.Width - $minDim) / 2))
    $cropY = [Math]::Max(0, [Math]::Floor(($img.Height - $minDim) / 2))
    
    # Create cropped and resized image
    $bmp = New-Object System.Drawing.Bitmap($targetSize, $targetSize)
    $g = [System.Drawing.Graphics]::FromImage($bmp)
    $g.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
    $g.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
    $g.PixelOffsetMode = [System.Drawing.Drawing2D.PixelOffsetMode]::HighQuality
    $g.CompositingQuality = [System.Drawing.Drawing2D.CompositingQuality]::HighQuality
    
    $srcRect = New-Object System.Drawing.Rectangle($cropX, $cropY, $minDim, $minDim)
    $destRect = New-Object System.Drawing.Rectangle(0, 0, $targetSize, $targetSize)
    
    $g.DrawImage($img, $destRect, $srcRect, [System.Drawing.GraphicsUnit]::Pixel)
    
    # Save as PNG first (intermediate)
    $tempPng = "C:\Users\Shivam\erp lic\public\images\login-advisor-new.png"
    $bmp.Save($tempPng, [System.Drawing.Imaging.ImageFormat]::Png)
    
    $g.Dispose()
    $bmp.Dispose()
    $img.Dispose()
    
    Write-Host "Saved cropped/resized image to $tempPng"
} else {
    Write-Host "New image not found at $newPath"
}
