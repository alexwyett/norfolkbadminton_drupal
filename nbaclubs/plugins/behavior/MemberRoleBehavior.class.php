<?php
/**
 * Class YourFieldBehavior
 */
class MemberRoleBehavior extends EntityReference_BehaviorHandler_Abstract
{
    /**
     * Alter the schema to add our field
     *
     * @param $schema
     * @param $field
     */
    public function schema_alter(&$schema, $field) {
        $schema['columns']['clubmember_member_role'] = array(
            'description' => 'Role the member has in the club',
            'type'        => 'varchar',
            'length'      => 255,
            'default'     => 0,
            'not null'    => TRUE,
        );
    }
}