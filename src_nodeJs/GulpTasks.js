// Requis
var gulp = require('gulp');

var  livereload = require('gulp-livereload');
/**
 * The mains tasks
 */

gulp.task('server', ['serve', 'watch']);

gulp.task('all', ['assets', 'reload']);

/**
 * Simple Task
 */

 gulp.task('assets', function () {
   gulp.src('less/*.less')
   .pipe(livereload());
 });

 gulp.task('watch', function () {

      livereload.listen();

       gulp.watch([
         'assets/styles/src/*.css',
         'assets/scripts/src/*.js',
         'assets/styles/scss/components/*.scss',
         'app/**/*.php',
         'templates/**/*.twig'
       ],
         ['all']
       )
 });

 gulp.task('typo_convert', function () {

 });

 gulp.task('reload', function () {
     Application.reloadServer();
 });

 gulp.task('serve', function() {
      Application.startServer();
 });
