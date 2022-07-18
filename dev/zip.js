const shell = require("shelljs");
const path = require("path");
const fs = require("fs");
const archiver = require("archiver");
const { log, error: logError } = console;
const pjson = require("../package.json");
const chalk = require("chalk");

const themesPath = path.resolve(path.dirname(__dirname), "../");
const workingPath = path.resolve(themesPath, `${pjson.name}-build-${Date.now()}`);
const srcPath = path.resolve(path.dirname(__dirname));
const fileName = `${pjson.name}-${pjson.version}.zip`;
const filePath = path.resolve(themesPath, fileName);

log(`${chalk.yellowBright("Building your project...")}`);

if(fs.existsSync(workingPath)){
    shell.rm("-rf", workingPath);
}

if(fs.existsSync(filePath)){
    shell.rm("-rf", filePath);
}

shell.mkdir(workingPath);
shell.cp("-r", path.resolve(srcPath, "*"), workingPath);

const toDelete = [
    "assets/src",
    "dev",
    "node_modules",
    "composer*",
    "gulpfile.js",
    "package*",
    ".git*",
    "README*",
    "LICENSE*",
    ".DS_Store"
];
toDelete.forEach((del) => {
    shell.rm("-rf", path.resolve(workingPath, del));
});

const output = fs.createWriteStream(filePath);
const archive = archiver("zip", { zlib: {level: 9 }});

output.on("close", () => {
    shell.rm("-rf", workingPath);
    var fileSize = ((archive.pointer()/1000)/1000).toFixed(1);
    log(`${chalk.blueBright(`Final zip file created with ${fileSize}MB`)}`);
    log(`${chalk.blueBright(`You can find your final ZIP file here: ${filePath}`)}`);
    log(`${chalk.greenBright("Done! :-)")}`);
});
output.on('end', function() {
    console.log('Data has been drained');
});
archive.on('warning', function(err) {
    if (err.code === 'ENOENT') {
        logError(err);
    } else {
        throw err;
    }
});
archive.on('error', function(err) {
    throw err;
});

archive.pipe(output);
archive.directory(workingPath, pjson.name);
archive.finalize();