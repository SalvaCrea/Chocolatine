var gulp        = require('gulp'),
    livereload = require('gulp-livereload'),
    php        = require('gulp-connect-php'),
    http = require('http');

livereload({ start: true });

// Static Server + watching scss/html/* files
gulp.task('reload', function() {
      livereload.reload();
});

gulp.task('watch',function(){
    livereload.listen();
    gulp.watch([ 'app/**/*.php'], ['reload']);
});

gulp.task('server_start', function(done) {
  // http.createServer(
  //   st({ path: __dirname , cache: false })
  // ).listen(8080, done);
});

gulp.task('default', ['watch']);

gulp.task('server', ['server_start', 'watch']);
