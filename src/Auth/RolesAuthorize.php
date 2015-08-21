<?php

namespace Rbac\Auth;

use Cake\Auth\BaseAuthorize;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Request;
use Rbac\Lib\Rbac;

class RolesAuthorize extends BaseAuthorize
{
    /**
     * Constructor
     *
     * @param ComponentRegistry $registry The controller for this request.
     * @param array $config An array of config. This class does not use any config.
     */
    public function __construct(ComponentRegistry $registry, array $config = [])
    {
        parent::__construct($registry, $config);
    }

    /**
     * Checks user authorization.
     *
     * @param array $user Active user data
     * @param \Cake\Network\Request $request Request instance.
     * @return bool
     */
    public function authorize($user, Request $request)
    {
        $modelName = 'Users';
        $modelId = $user['id'];

        $controllerPermissions = [];
        $controller = $this->_registry->getController();
        if ($controller && isset($controller->permissions)) {
            $controllerPermissions = $controller->permissions;
        }

        $Rbac = new Rbac();
        $_user = $Rbac->getUser($modelName, $modelId);
        $_roles = $Rbac->getUserRoles($modelName, $modelId);
        $_permissions = $Rbac->getUserPermissions($modelName, $modelId);

        // @TODO
    }
}