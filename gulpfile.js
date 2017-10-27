<<<<<<< HEAD
var path = require('path');

appRoot = path.resolve(__dirname);

phpConnect  = require('gulp-connect-php');
livereload = require('gulp-livereload');

ToolsFile = require( './src_nodeJs/ToolsFile');

Application = require('./src_nodeJs/Application');

GulpTasks = require('./src_nodeJs/GulpTasks');

Application.start();
=======
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
>>>>>>> master
