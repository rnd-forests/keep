<?php

class AssignmentTest extends EntityTestCase
{
    public function testBelongsToManyUsers()
    {
        $this->assertMorphedByMany('users', 'Keep\Entities\Assignment');
    }

    public function testBelongsToManyGroups()
    {
        $this->assertMorphedByMany('groups', 'Keep\Entities\Assignment');
    }

    public function testHasOneTask()
    {
        $this->assertHasOne('task', 'Keep\Entities\Assignment');
    }
}
