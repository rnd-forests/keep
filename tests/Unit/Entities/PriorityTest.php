<?php

class PriorityTest extends UnitTestCase
{
    /** @test */
    public function it_has_many_associated_tasks()
    {
        $this->assertHasMany('tasks', Keep\Entities\Priority::class);
    }
}
