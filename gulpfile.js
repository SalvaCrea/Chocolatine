var path = require('path');

appRoot = path.resolve(__dirname);

phpConnect  = require('gulp-connect-php');
livereload = require('gulp-livereload');

ToolsFile = require( './src_nodeJs/ToolsFile');

Application = require('./src_nodeJs/Application');

GulpTasks = require('./src_nodeJs/GulpTasks');

Application.start();
