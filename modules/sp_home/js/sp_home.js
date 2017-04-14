app_sp_powa  = angular.module('app_sp_powa', ['schemaForm']);

app_sp_powa.controller('menu_left', function($scope) {

      $scope.items_menu_filted = filter_menu( sp_powa.menu_left );

});

function filter_menu( menu_arg )
{
      menu = new Object();
      menu['app'] = new Array();

      for ( key in menu_arg ) {

          if ( menu_arg[key].show_in_menu ) {

            categorie = menu_arg[key].categorie;

            if ( categorie ) {
                if ( !menu[categorie] ) {
                    menu[categorie] = new Array();
                }
               menu[categorie].push(menu_arg[key]);
            }
            else
            {
              menu['app'].push(menu_arg[key]);
            }

          }

      }

      return menu;
}
