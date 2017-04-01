<h4 class="classic-title"><span>活動</span></h4>



<div ng-app="app">    
    <div class="bs-component" ng-controller="listdata">
    <!--
        <div class="alert alert-info">
            <p>Sort key: {{sortKey}}</p>
            <p>Reverse: {{reverse}}</p>
            <p>Search String : {{search}}</p>
        </div>
        -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><input type="text" ng-model="search.$" class="form-control" placeholder="<?php echo $this->lang['activity.search']['All']; ?>">
                    </th>
                    <th><input type="text" ng-model="search.name" class="form-control" placeholder="<?php echo $this->lang['activity.search']['Name']; ?>">
                    </th>
                    <th><input type="text" ng-model="search.description" class="form-control" placeholder="<?php echo $this->lang['activity.search']['Description']; ?>">
                    </th>
                    <th><input type="text" ng-model="search.datetime" class="form-control" placeholder="<?php echo $this->lang['activity.search']['Date']; ?>"> 
                    </th>
                    <?php if ($this->hasRole): ?>
                         <th><?php if ($this->hasRole): ?>
            <a href='index.php?mod=activity&act=add'><button type="button" class="btn btn-primary"><?php echo $this->lang['activity.add']; ?></button></a>
            <?php endif; ?></th>
                    <?php endif; ?>                     
                </tr>            
                <tr>
                    <th ng-click="sort('id')"><?php echo $this->lang['activity.id']; ?>
                        <span class="fa fa-sort" ng-show="sortKey=='id'" ng-class="{'fa-sort-asc':reverse,'fa-sort-desc':!reverse}"></span>
                    </th>
                    <th ng-click="sort('name')"><?php echo $this->lang['activity.name']; ?>
                        <span class="fa fa-sort" ng-show="sortKey=='name'" ng-class="{'fa-sort-asc':reverse,'fa-sort-desc':!reverse}"></span>
                    </th>
                    <th ng-click="sort('description')"><?php echo $this->lang['activity.description']; ?>
                        <span class="fa fa-sort" ng-show="sortKey=='description'" ng-class="{'fa-sort-asc':reverse,'fa-sort-desc':!reverse}"></span>
                    </th>
                    <th ng-click="sort('datetime')"><?php echo $this->lang['activity.date']; ?>
                        <span class="fa fa-sort" ng-show="sortKey=='datetime'" ng-class="{'fa-sort-asc':reverse,'fa-sort-desc':!reverse}"></span>
                    </th>
                    <?php if ($this->hasRole): ?>
                         <th><?php echo $this->lang['activity.actions']; ?></th>
                    <?php endif; ?>                     
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="activity in activities|orderBy:sortKey:reverse|filter:search|itemsPerPage:10">
                    <td><a href='{{activity.url}}'>{{activity.id}}</a></td>
                    <td><a href='{{activity.url}}'>{{activity.name}}</a></td>
                    <td><a href='{{activity.url}}'>{{activity.description}}</a></td>
                    <td><a href='{{activity.url}}'>{{activity.datetime}}</a></td>
                    <?php if ($this->hasRole): ?>
                         <td><a href='index.php?mod=activity&act=update&id={{activity.id}}'><?php echo $this->lang['activity.update']; ?></a> | <a href='index.php?mod=activity&act=delete&id={{activity.id}}'><?php echo $this->lang['activity.delete']; ?></a></td>
                    <?php endif; ?>                     
                </tr>
            </tbody>
        </table> 
        <dir-pagination-controls
            max-size="10"
            direction-links="true"
            boundary-links="true" >
        </dir-pagination-controls>
    </div>
</div>


<script>
var app = angular.module('app', ['angularUtils.directives.dirPagination']);

app.controller('listdata',function($scope, $http){
	$scope.activities = []; 
	$http.get("index.php?mod=activity&act=json").success(function(response){ 
		$scope.activities = response;
	});
	$scope.sort = function(keyname){
		$scope.sortKey = keyname;   
		$scope.reverse = !$scope.reverse; 
	}
});
</script>
