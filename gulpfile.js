var gulp = require('gulp'),
mainBowerFiles = require('main-bower-files'),
handlebars = require('gulp-handlebars'),
wrap = require('gulp-wrap'),
declare = require('gulp-declare'),
concat = require('gulp-concat'),
filter = require('gulp-filter'),
uglify = require('gulp-uglify'),
less = require('gulp-less'),
minifyCSS = require('gulp-minify-css'),
del = require('del'),
dest = 'build/';

gulp.task('watch', function() {
  gulp.watch("html/*", ['html']);
  gulp.watch("js/app/config.js", ['js-config']);
	gulp.watch("backend/statuspage/**/**/*", ['php']);
});


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
	return gulp.src(['js/app/vendors.js', 'js/app/main.js', 'js/app/templates.js'])
	.pipe(concat('statuspage.js'))
	.pipe(uglify())
	.pipe(gulp.dest('js/app/'));
});

gulp.task('jsConfig', ['jsCombine'], function() {
	return gulp.src(['js/app/config.js', 'js/app/statuspage.js'])
	.pipe(concat('statuspage.min.js'))
	.pipe(gulp.dest(dest + 'js'));
});

gulp.task('icons', function() {
	return gulp.src('bower_components/fontawesome/fonts/**.*')
	.pipe(gulp.dest(dest + 'fonts'));
});

gulp.task('php', function() {
	return gulp.src('backend/statuspage/**/**/*')
	.pipe(gulp.dest(dest + 'statuspage'));
});

gulp.task('html', function() {
	return gulp.src('html/*')
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

gulp.task('default', ['jsConfig', 'icons', 'html', 'less', 'php']);
