<?php

class TagTest extends UnitTestCase
{
    /** @test */
    public function it_belongs_to_many_tasks()
    {
        $this->assertBelongsToMany('tasks', Keep\Entities\Tag::class);
    }
}
