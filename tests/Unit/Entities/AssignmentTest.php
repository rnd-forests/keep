<?php

class AssignmentTest extends TestCase
{
    /** @test */
    public function it_belongs_to_many_users()
    {
        $this->assertMorphedByMany('users', 'Keep\Entities\Assignment');
    }

    /** @test */
    public function it_belongs_to_many_groups()
    {
        $this->assertMorphedByMany('groups', 'Keep\Entities\Assignment');
    }

    /** @test */
    public function it_has_only_one_task()
    {
        $this->assertHasOne('task', 'Keep\Entities\Assignment');
    }
}
