import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

function getAllFiles(directory, fileExtension) {
    const files = [];

    function findFiles(dir) {
        const items = fs.readdirSync(dir);
        items.forEach((item) => {
            const itemPath = path.join(dir, item);
            const stat = fs.statSync(itemPath);

            if (stat.isDirectory()) {
                findFiles(itemPath); // Recursively search in subdirectories
            } else if (stat.isFile() && item.endsWith(fileExtension)) {
                files.push(itemPath);
            }
        });
    }

    findFiles(directory);
    return files;
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...getAllFiles('resources/css', '.css'),
                ...getAllFiles('resources/js', '.js'),
            ],
            refresh: true,
        }),
    ],
});
