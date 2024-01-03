import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';
function getAllCssFiles(directory) {
    const cssFiles = [];
    const files = fs.readdirSync(directory);

    files.forEach((file) => {
        const filePath = path.join(directory, file);
        const stat = fs.statSync(filePath);

        if (stat.isFile() && file.endsWith('.css')) {
            cssFiles.push(filePath);
        }
    });

    return cssFiles;
}

export default defineConfig({
    plugins: [
        laravel({
            input: getAllCssFiles('resources/css'),
            refresh: true,
        }),
    ],
});