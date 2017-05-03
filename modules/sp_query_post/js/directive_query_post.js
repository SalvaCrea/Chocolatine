raccourci = 'test';
app_sp_powa.controller('spquery', function( $scope )
{
raccourci = $scope;
  ajax_res  = sp_query_post.find().data;
  $scope.posts = ajax_res.posts;

  $scope.keys = function()
  {
    key_list = new Array();
    for (var key in ajax_res.posts[0] ) {
        key_list.push( key );
    }
    return key_list;
  }

  $scope.list_post = function()
  {
    for (var post in $scope.posts) {
      for (var key in $scope.keys() ) {

      }
    }

  }

  $scope.test = "test";

})
.directive('spquery', function() {

  return {

    restrict: 'AE', //attribute or element
    require: 'ngModel',
    template: sp_ajax.new(
      'sp_wp_post',
      'give_me_directive'
    ).send().data

  };

});
