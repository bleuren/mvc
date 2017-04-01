<div ng-app="app">
    <div class="bs-component" ng-controller="listdata">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><input type="text" ng-model="search.$" class="form-control" placeholder="<?php echo $this->lang['article.search']['All']; ?>">
                    </th>
                    <th><input type="text" ng-model="search.category" class="form-control" placeholder="<?php echo $this->lang['article.search']['Category']; ?>">
                    </th>
                    <th><input type="text" ng-model="search.title" class="form-control" placeholder="<?php echo $this->lang['article.search']['Title']; ?>">
                    </th>
                    <th><input type="text" ng-model="search.date" class="form-control" placeholder="<?php echo $this->lang['article.search']['DateTime']; ?>"> 
                    </th>
                    <?php if ($this->hasRole): ?>
                         <th><?php if ($this->hasRole): ?>
            <a href='index.php?mod=<?php echo $this->module; ?>&act=add'><button type="button" class="btn btn-primary"><?php echo $this->lang['article.add']; ?></button></a>
            <?php endif; ?></th>
                    <?php endif; ?>                   
                </tr>
                <tr>
                    <th ng-click="sort('id')"><?php echo $this->lang['article.id']; ?>
                        <span class="fa fa-sort" ng-show="sortKey=='id'" ng-class="{'fa-sort-asc':reverse,'fa-sort-desc':!reverse}"></span>
                    </th>
                    <th ng-click="sort('first_name')"><?php echo $this->lang['article.category']; ?>
                        <span class="fa fa-sort" ng-show="sortKey=='first_name'" ng-class="{'fa-sort-asc':reverse,'fa-sort-desc':!reverse}"></span>
                    </th>
                    <th ng-click="sort('last_name')"><?php echo $this->lang['article.title']; ?>
                        <span class="fa fa-sort" ng-show="sortKey=='last_name'" ng-class="{'fa-sort-asc':reverse,'fa-sort-desc':!reverse}"></span>
                    </th>
                    <th ng-click="sort('date')"><?php echo $this->lang['article.dateTime']; ?>
                        <span class="fa fa-sort" ng-show="sortKey=='date'" ng-class="{'fa-sort-asc':reverse,'fa-sort-desc':!reverse}"></span>
                    </th>
                    <?php if ($this->hasRole): ?>
                         <th><?php echo $this->lang['article.actions']; ?></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="item in items|orderBy:sortKey:reverse|filter:search|itemsPerPage:<?php echo $this->itemsPerPage; ?>">
                    <td ng-repeat="col in item"><a href='index.php?mod=<?php echo $this->module; ?>&act=show&id={{item.id}}'>{{col}}</a></td>
                    <?php if ($this->hasRole): ?>
                         <td><a href='index.php?mod=<?php echo $this->module; ?>&act=update&id={{item.id}}'><?php echo $this->lang['article.update']; ?></a> | <a href='index.php?mod=<?php echo $this->module; ?>&act=delete&id={{item.id}}'><?php echo $this->lang['article.delete']; ?></a></td>
                    <?php endif; ?>
                </tr>
            </tbody>
        </table>
        <dir-pagination-controls
            max-size="<?php echo $this->maxSize; ?>"
            direction-links="true"
            boundary-links="true" >
        </dir-pagination-controls>
    </div>
</div>
<script>
var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('listdata', function($scope, $http) {
	$scope.items = [];
	$http.get("index.php?mod=<?php echo $this->module; ?>&act=json&group=<?php echo $this->group; ?>").success(function(response) {
		$scope.items = response;
	});
	$scope.sort = function(keyname) {
		$scope.sortKey = keyname;
		$scope.reverse = !$scope.reverse;
	}
});
</script>
