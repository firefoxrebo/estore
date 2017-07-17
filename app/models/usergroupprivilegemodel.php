<?php
namespace PHPMVC\Models;

class UserGroupPrivilegeModel extends AbstractModel
{

    public $Id;
    public $GroupId;
    public $PrivilegeId;

    protected static $tableName = 'app_users_groups_privileges';

    protected static $tableSchema = array(
        'GroupId'               => self::DATA_TYPE_INT,
        'PrivilegeId'           => self::DATA_TYPE_INT
    );

    protected static $primaryKey = 'Id';
}