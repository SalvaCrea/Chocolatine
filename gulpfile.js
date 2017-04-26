var gulp        = require('gulp');
var browserSync = require('browser-sync').create();

// Static Server + watching scss/html/* files
gulp.task('serve', ['stream'], function() {
	
    browserSync.init({
      proxy: "192.168.1.28",
      notify: true
    });
 
    gulp.watch("*").on('change', browserSync.reload);
});


gulp.task('stream', function() {
    browserSync.stream();
});
  
gulp.task('default', ['serve']);
 