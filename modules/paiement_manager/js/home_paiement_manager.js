search_ajax = sp_ajax.new( sp_powa.current_module.slug, "ajax_query_travel" );

app_sp_powa.controller('subscription_list', function($scope, $http) {

		$scope.posts = data_list_request_subscription.posts;

		$scope.url_show_request = sp_powa.url_show_request; 

		$scope.redirection_show_request = function(id)
    {
          document.location.href= $scope.url_show_request + '&id_request=' + id;
    }

});
