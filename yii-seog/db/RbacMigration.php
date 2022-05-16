<?php

namespace seog\db;

class RbacMigration extends Migration
{
	private $auth;

	public function up()
	{
        $this->auth = \Yii::$app->authManager;

        $this->createPermissions();
        $this->createRoles();
        $this->createRules();

        $this->assignRolesRulesPermissionsToUserRoles();
	}

	private function createPermissions(): void
	{
        $permissions = [];
        foreach ($this->permissions as $action => $permission) {
            $permissions[$action] = $this->auth->createPermission($permission['name']);
            $permissions[$action]->description = $permission['description'];
            $this->auth->add($permissions[$action]);
        }
	}

	private function createRoles(): void
	{
    	foreach ($this->roles as $roleName => $actions) {
            $role = $this->auth->createRole($roleName);
            $this->auth->add($role);

            foreach ($actions as $action) {
            	$permissionName = $this->permissions[$action]['name'];
            	$permission = $this->auth->getPermission($permissionName);
                $this->auth->addChild($role, $permission);
            }
        }
	}

	private function createRules(): void
	{
        foreach ($this->rules as $ruleName) {
            $rule = new $ruleName();
            $this->auth->add($rule);
        }
	}

	private function assignRolesRulesPermissionsToUserRoles(): void
	{
        foreach ($this->rolesAssignments as $userRoleName => $array) {
            $userRole = $this->auth->getRole($userRoleName);

            $this->assignRoles($userRole, $array['roles']);
			$this->assignPermissions($userRole, $array['permissions']);      
			$this->assignRules($userRole, $array['rules']);
        }
	}

	private function assignRoles(object $userRole, array $roles): void
	{
        foreach ($roles as $roleName) {
            $role = $this->auth->getRole($roleName);
            $this->auth->addChild($userRole, $role);
        }
	}

	private function assignPermissions(object $userRole, array $permissions): void
	{
        foreach ($permissions as $permissionName) {
            $permission = $this->auth->getPermission($permissionName);
            $this->auth->addChild($userRole, $permission);
        }     
	}

	private function assignRules(object $userRole, array $rules): void
	{
        foreach ($rules as $ruleName) {
            $userRole->ruleName = $ruleName;
            $this->auth->update($userRole->name, $userRole);
        }
	}

    public function down() 
    {
        $this->auth = \Yii::$app->authManager;

        $this->removeRules();
        $this->removeRoles();
        $this->removePermissions();
    }	

    private function removeRules()
    {
        foreach ($this->rules as $ruleName) {
            $rule = $this->auth->getRule($ruleName);
            $this->auth->remove($rule);
        }
    }

    private function removeRoles()
    {
        foreach ($this->roles as $roleName => $actions) {
            $role = $this->auth->getRole($roleName);
            $this->auth->remove($role);
        }
    }

    private function removePermissions()
    {
    	foreach ($this->permissions as $action => $array) {
    		$permission = $this->auth->getPermission($array['name']);
    		$this->auth->remove($permission);
    	}
    }
}
