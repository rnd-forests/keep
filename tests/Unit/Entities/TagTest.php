<?php

class TagTest extends EntityTestCase
{
    public function testBelongsToManyTasks()
    {
        $this->assertBelongsToMany('tasks', 'Keep\Entities\Tag');
    }
}
