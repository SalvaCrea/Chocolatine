// ToolsFile.js
// ========


var ToolsFile = {};
var fs = require('fs');
/**
 * cleanAssetFolder Delete Assets Folder
 */
ToolsFile.deleteFile = function( path_file ){

    fs.unlink( path_file, function(err){
      if(err) {
          return console.log(err);
      }
      console.log("The file deleted");
    });

}
/**
 * [ Can write a file]
 * @param  {[string]} path_file      [The file path]
 * @param  {[string]} name_file     [ name + extension of file]
 * @param  {[string]} content        [content of file]
 * @return {[Boolean]}               [True if good operation]
 */
ToolsFile.writeFile = function( path_file, name_file, content ){

      fs.writeFile( path_file + name_file, content, function(err) {
          if(err) {
               console.log(err);
               return false
          }
          else{
              console.log("The file is writed");
              return true;
          }
    });

}
/**
 * Get a file
 * @param  {[string]} path_file [Path File]
 * @return {[string]}           [Content file]
 */
ToolsFile.getFile = function( path_file ){
  console.log( path_file );
  return fs.readFileSync( path_file, 'utf8')
}

/**
 * Get a file
 * @param  {[string]} path_file [Path File]
 * @return {[string]}           [Content file]
 */
ToolsFile.getFileJson = function( path_file ){
      return  JSON.parse( this.getFile( path_file ) );
}

module.exports = ToolsFile;
