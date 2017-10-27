/**
 * The application Gulp
 */

var Application = {
  version_asset : 0,
  dataJson : {},
};

Application.start = function(){
      this.getVersion();
}

Application.addVersion = function(){

}

Application.deleteOldVersion = function(){

}

Application.getVersion = function(){
    return this.version_asset;
}

Application.getOldVersion = function(){
    return this.getVersion() - 1;
}

Application.startServer = function(){

    phpConnect.server({
        port: 8888,                      // Port (8000 par défaut)
        base: './', // Base du projet
        hostname : 'localhost'
    });

}

Application.reloadServer = function(){

}

module.exports = Application;
