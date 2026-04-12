import sys
from PIL import Image

try:
    img_path = r"C:\Users\Shivam\.gemini\antigravity\brain\29915f39-35ee-462c-9e59-e5c7010f3a5a\media__1775970387157.png"
    with Image.open(img_path) as img:
        print(f"Format: {img.format}")
        print(f"Size: {img.size}")
        print(f"Mode: {img.mode}")
except Exception as e:
    print(f"Error: {e}")
