const path = require("path");
const fs = require("fs");
const {dest, parallel, series, src, task, watch} = require("gulp");
const plumber = require("gulp-plumber");
const sass = require("gulp-sass")(require("node-sass"));
const imagemin = require('gulp-imagemin');
const browserify = require('browserify');
const babelify = require('babelify');
const source = require('vinyl-source-stream');
const purgecss = require('gulp-purgecss');
const rename = require('gulp-rename');
const concat = require("gulp-concat");

const rootPath = path.resolve(__dirname);
const srcPath = path.resolve(__dirname, "assets/src");
const distPath = path.resolve(__dirname, "assets/dist");
const jsDeps = require("./assets/src/js/dependencies.json");

task("css:build", (done) => {
    return (
        src([
            path.resolve(srcPath, "scss/admin.scss"),
            path.resolve(srcPath, "scss/main.scss")
        ])
        .pipe(plumber())
        .pipe(sass.sync({outputStyle: "compressed"}).on("error", sass.logError))
        .pipe(dest(path.resolve(distPath, "css")))
    );
});

task("css:purge", (done) => {
    return (
        src([
            path.resolve(distPath, "css/*.css"),
            "!"+path.resolve(distPath, "css/*.min.css")
        ])
        .pipe(plumber())
        .pipe(purgecss({
            content: [
                path.resolve(rootPath, "*.php"),
                path.resolve(rootPath, "templates/**/*.php"),
                path.resolve(rootPath, "includes/**/*.php"),
                path.resolve(distPath, "js/**/*.js"),
                path.resolve(srcPath, "scss/.purgekeep")
            ]
        }))
        .pipe(rename({suffix: ".min"}))
        .pipe(dest(path.resolve(distPath, "css")))
    );
});

task("css:watch", (done) => {
    watch(path.resolve(srcPath, "scss/**/*.scss"), series("css:build", "css:purge"));

    watch([
        path.resolve(rootPath, "*.php"),
        path.resolve(rootPath, "templates/**/*.php"),
        path.resolve(rootPath, "includes/classes/**/*.php"),
        path.resolve(rootPath, "includes/helpers/**/*.php"),
        path.resolve(distPath, "js/**/*.js"),
        path.resolve(srcPath, "scss/.purgekeep")
    ], series("css:purge"));

    done();
});

task("css", series("css:build", "css:purge"));

task("js:admin:build", (done) => {
    return (
        browserify({entries: path.resolve(srcPath, "js/admin.js")})
        .transform(babelify.configure({
            presets: ["@babel/preset-env"]
        }))
        .bundle()
        .on("error", (e) => {
            console.error(e.message);
        })
        .pipe(source("admin.build.js"))
        .pipe(dest(path.resolve(distPath, "js/standalone")))
    );
});

task("js:frontend:build", (done) => {
    return (
        browserify({entries: path.resolve(srcPath, "js/main.js")})
            .transform(babelify.configure({
                presets: ["@babel/preset-env"]
            }))
            .bundle()
            .on("error", (e) => {
                console.error(e.message);
            })
            .pipe(source("main.build.js"))
            .pipe(dest(path.resolve(distPath, "js/standalone")))
    );
});

task("js:admin:deps", (done) => {
    let adminDeps = jsDeps.admin.map((asset) => {
        return asset.indexOf("node_modules") > -1 ? asset : path.resolve(srcPath, "js/plugins", asset);
    });

    if(adminDeps.length > 0){
        src(adminDeps)
        .pipe(plumber())
        .pipe(concat("admin.deps.js"))
        .pipe(dest(path.resolve(distPath, "js/standalone")));
    }

    done();
});

task("js:frontend:deps", (done) => {
    let mainDeps = jsDeps.main.map((asset) => {
        return asset.indexOf("node_modules") > -1 ? asset : path.resolve(srcPath, "js/plugins", asset);
    });

    if(mainDeps.length > 0){
        src(mainDeps)
        .pipe(plumber())
        .pipe(concat("main.deps.js"))
        .pipe(dest(path.resolve(distPath, "js/standalone")));
    }

    done();
});

task("js:admin:concat", (done) => {
    let adminDeps = path.resolve(distPath, "js/standalone/admin.deps.js");
    let adminBuild = path.resolve(distPath, "js/standalone/admin.build.js");

    let admin = fs.existsSync(adminDeps) ? [adminDeps, adminBuild] : [adminBuild];

    return (
        src(admin)
        .pipe(plumber())
        .pipe(concat("admin.bundle.js"))
        .pipe(dest(path.resolve(distPath, "js")))
    );
});

task("js:frontend:concat", (done) => {
    let mainDeps = path.resolve(distPath, "js/standalone/main.deps.js");
    let mainBuild = path.resolve(distPath, "js/standalone/main.build.js");

    let main = fs.existsSync(mainDeps) ? [mainDeps, mainBuild] : [mainBuild];
    
    return (
        src(main)
        .pipe(plumber())
        .pipe(concat("main.bundle.js"))
        .pipe(dest(path.resolve(distPath, "js")))
    );
});

task("js:admin", series("js:admin:build", "js:admin:deps", "js:admin:concat"));
task("js:frontend", series("js:frontend:build", "js:frontend:deps", "js:frontend:concat"));
task("js", series("js:admin", "js:frontend"));

task("js:watch", (done) => {
    return (
        watch(path.resolve(srcPath, "js/**/*.js"), series("js"))
    );
});

// task("js", series("js:build", "js:deps", "js:concat"));

task("img:build", (done) => {
    return (
        src(path.resolve(srcPath, "img/*"))
        .pipe(plumber())
        .pipe(imagemin())
        .pipe(dest(path.resolve(distPath, "img")))
    );
});

task("img:watch", (done) => {
    return (
        watch(path.resolve(srcPath, "img/*"),series("img:build"))
    );
});

task("img", series("img:build"));

task("fonts:copy", (done) => {
    src(path.resolve(srcPath, "fonts/*"))
    .pipe(plumber())
    .pipe(dest(path.resolve(distPath, "fonts")));

    src(path.resolve(srcPath, "webfonts/*"))
    .pipe(plumber())
    .pipe(dest(path.resolve(distPath, "webfonts")));

    done();
});

task("fonts:watch", (done) => {
    return (
        watch([
            path.resolve(srcPath, "fonts/*"),
            path.resolve(srcPath, "webfonts/*")
        ], series("fonts:copy"))
    );
});

task("fonts", series("fonts:copy"));

task("build", series("css", "js", "img", "fonts"))

task("watch", parallel("css:watch", "js:watch", "img:watch", "fonts:watch"));

task("default", series("build", "watch"));