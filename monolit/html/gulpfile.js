var gulp = require('gulp');
var sass = require('gulp-sass');// подключаем gulp-sass
var minifyCss = require('gulp-clean-css');//минификация css
var rename = require('gulp-rename');
var notify = require("gulp-notify");
var rollup = require('rollup');
const alias = require('rollup-plugin-alias');
var autoprefixer = require('gulp-autoprefixer');
var clean = require('gulp-clean');
var combineMq = require('gulp-combine-mq');
var spritesmith = require('gulp.spritesmith');

var env         = require('minimist')(process.argv.slice(2)),
    gutil       = require('gulp-util'),
    plumber     = require('gulp-plumber'),
    jade        = require('gulp-jade'),
    browserify  = require('gulp-browserify'),
    browserify  = require('gulp-if'),
    browserSync = require('browser-sync');

//==============================================================================
//**************************  FrontEnd  ****************************************
//==============================================================================
//ПУТИ
var F_webDir = 'frontend/web/';

var F_sourseDir = F_webDir + 'source/',
    F_sassDir = F_sourseDir + 'sass/',
    F_sassMainFile = F_sassDir + 'main.scss',
    F_sassCustomFile = F_sassDir + 'custom.scss';

var F_destCssDir = F_sourseDir + 'styles/css/',
    F_destCssMinDir = F_sourseDir + 'styles/css-min/';

var F_scriptDir =  F_sourseDir + "js/",
    F_jsBuildDir = F_scriptDir + "build/";

var sassOptions = {
    outputStyle: 'nested',
    precison: 3,
    errLogToConsole: true,
};

//------------------------------------------------------------------------------
//                  компиляция sass
//------------------------------------------------------------------------------

// Очистка перед новой записью
gulp.task('front:clean', function() {
  return gulp.src([F_destCssDir, F_destCssMinDir], {read: false,allowEmpty: true})
    .pipe(clean())
    .pipe(notify("front:clean was compiled!"));
});

gulp.task('front:compileSass', gulp.series('front:clean', function(){
  return gulp
    .src([F_sassMainFile,F_sassCustomFile],{ allowEmpty: true })
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer({
            cascade: false
        }))
    .pipe(combineMq({
        beautify: false
    }))
    .pipe(gulp.dest(F_destCssDir))
    .pipe(rename({suffix: '.min'}))
    .pipe(minifyCss({processImport: false}))
    .pipe(gulp.dest(F_destCssMinDir))
    .pipe(notify("front:compileSass was compiled!"));
}));

//------------------------------------------------------------------------------
//Создание спрайтов
//------------------------------------------------------------------------------
gulp.task('sprite', function () {
    var spriteData = gulp.src(F_webDir + 'img-styles/icons48X48/*.png',{ allowEmpty: true }).pipe(spritesmith({
      imgName: 'sprite-icons48X48.png',
      cssName: 'sprite-icons48X48.scss'
    }));
    return spriteData.pipe(gulp.dest(F_webDir + 'img-styles/sprite-icons48X48/'));
});


//------------------------------------------------------------------------------
//Наблюдение за файлами. (запуск из консоли - gulp watch)
//------------------------------------------------------------------------------

gulp.task('watch', function(){
	gulp.watch(F_sassDir + '**/*.scss',gulp.series('front:clean'));
	gulp.watch(F_sassDir + '**/*.scss',gulp.series('front:compileSass'));

});
