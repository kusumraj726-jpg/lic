import sys
from PIL import Image

try:
    img_path = r"C:\Users\Shivam\.gemini\antigravity\brain\29915f39-35ee-462c-9e59-e5c7010f3a5a\media__1775970387157.png"
    out_path = r"C:\Users\Shivam\erp lic\public\images\logo.png"
    
    with Image.open(img_path) as img:
        # The image is 1024x689. The logo is on the left, text on the right.
        # Let's crop the left part: from x=200 to x=550 roughly, y=200 to y=550
        # Let's just crop exactly half to be safe, then maybe crop more if needed
        # Or let's do left=180, upper=150, right=500, lower=550
        box = (200, 150, 500, 550)
        cropped_img = img.crop(box)
        
        # Ensure 'public/images' exists
        import os
        os.makedirs(os.path.dirname(out_path), exist_ok=True)
        
        cropped_img.save(out_path)
        print("Cropped image saved successfully to:", out_path)
except Exception as e:
    print(f"Error: {e}")
