import fs from 'fs';
import { execSync } from 'child_process';

console.log("Fetching HTML...");
const html = execSync("php artisan tinker test_render.php").toString();

const buttonMatches = html.match(/<button[^>]+@click="openInquiry[^>]+>/g);
if (!buttonMatches) {
    console.log("No buttons found!");
    process.exit(1);
}

for (let i = 0; i < buttonMatches.length; i++) {
    const btn = buttonMatches[i];
    const clickMatch = btn.match(/@click="([^"]+)"/);
    if (!clickMatch) continue;
    
    let jsCode = clickMatch[1];
    
    // Unescape HTML entities inside the attribute, just like a browser does
    jsCode = jsCode.replace(/&quot;/g, '"')
                   .replace(/&#039;/g, "'")
                   .replace(/&amp;/g, '&')
                   .replace(/&lt;/g, '<')
                   .replace(/&gt;/g, '>');

    console.log("Evaluating JS snippet " + i + ":\n" + jsCode.substring(0, 50) + "...\n");
    try {
        const openInquiry = (obj, mode) => { return true; };
        eval(jsCode);
        console.log("Snippet " + i + " OK.");
    } catch (e) {
        console.error("Syntax Error in Button " + i + ":", e.message);
        console.error(jsCode);
        process.exit(1);
    }
}
console.log("ALL BUTTONS OK");
