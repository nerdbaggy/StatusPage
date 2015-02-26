var gulp = require('gulp');
var mainBowerFiles = require('main-bower-files');
var handlebars = require('gulp-handlebars');
var wrap = require('gulp-wrap');
var declare = require('gulp-declare');
var concat = require('gulp-concat');
var filter = require('gulp-filter');
var uglify = require('gulp-uglify');
var less = require('gulp-less');
var minifyCSS = require('gulp-minify-css');
var runSequence = require('run-sequence');
var del = require('del');
var dest = 'build/';

gulp.task('templates', function(){
	return gulp.src(['js/app/templates/table.hbs', 'js/app/templates/logs.hbs'])
	.pipe(handlebars())
	.pipe(wrap('Handlebars.template(<%= contents %>)'))
	.pipe(declare({
      namespace: 'StatusPage.templates',
      noRedeclare: true, // Avoid duplicate declarations 
    }))
	.pipe(concat('templates.js'))
	.pipe(gulp.dest('js/app/'));
});

gulp.task('vendors', function() {
	return gulp.src(mainBowerFiles())
	.pipe(filter('*.js'))
	.pipe(concat('vendors.js'))
	.pipe(gulp.dest('js/app/'));
});

gulp.task('jsCombine', ['vendors', 'templates'], function() {
	return gulp.src(['js/app/vendors.js', 'js/app/main.js', 'js/app/templates.js', 'js/app/config.js'])
	.pipe(concat('statuspage.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest(dest + 'js'));
});

gulp.task('icons', function() {
	return gulp.src('bower_components/fontawesome/fonts/**.*')
	.pipe(gulp.dest(dest + 'fonts'));
});

gulp.task('php', function() {
	return gulp.src('backend/statuspage/*')
	.pipe(gulp.dest(dest + 'statuspage'));
});

gulp.task('html', function() {
	return gulp.src('html/*.html')
	.pipe(gulp.dest(dest));
});

gulp.task('less', function() {
	return gulp.src('less/*.less')
	.pipe(less())
	.pipe(concat('statuspage.min.css'))
	.pipe(minifyCSS())
	.pipe(gulp.dest(dest + 'css'));
});

gulp.task('clean', function(cb) {
  del(['build'], cb);
});

gulp.task('default', ['jsCombine', 'icons', 'html', 'less', 'php']);
