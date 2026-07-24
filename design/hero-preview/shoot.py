import os
from playwright.sync_api import sync_playwright

OUT = os.path.dirname(os.path.abspath(__file__))
BASE = "http://localhost:8731/"

combos = [
    ("dark", 393, 852),
    ("dark", 1440, 900),
    ("light", 393, 852),
    ("light", 1440, 900),
]

with sync_playwright() as p:
    browser = p.chromium.launch()
    for theme, w, h in combos:
        page = browser.new_page(viewport={"width": w, "height": h})
        page.goto(f"{BASE}?theme={theme}", wait_until="networkidle")
        page.screenshot(path=f"{OUT}/{theme}-{w}x{h}.png", full_page=True)
        cw = page.evaluate("document.documentElement.clientWidth")
        print(f"{theme} {w}x{h} -> clientWidth={cw}")
        page.close()
    browser.close()
