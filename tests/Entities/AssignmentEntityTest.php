<?php

use Keep\Entities\Assignment;

class AssignmentEntityTest extends ModelTestCase
{
    public function testBelongsToManyUsers()
    {
        $this->assertMorphedByMany('users', Assignment::class);
    }

    public function testBelongsToManyGroups()
    {
        $this->assertMorphedByMany('groups', Assignment::class);
    }

    public function testHasOneTask()
    {
        $this->assertHasOne('task', Assignment::class);
    }
}
