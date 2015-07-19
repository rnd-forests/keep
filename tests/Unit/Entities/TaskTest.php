<?php

class TaskTest extends UnitTestCase
{
    /** @test */
    public function it_belongs_to_a_user()
    {
        $this->assertBelongsTo('user', Keep\Entities\Task::class);
    }

    /** @test */
    public function it_belongs_to_many_tags()
    {
        $this->assertBelongsToMany('tags', Keep\Entities\Task::class);
    }

    /** @test */
    public function it_belongs_to_a_priority_level()
    {
        $this->assertBelongsTo('priority', Keep\Entities\Task::class);
    }
}
