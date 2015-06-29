<?php

use Keep\Entities\Tag;

class TagEntityTest extends ModelTestCase
{
    public function testBelongsToManyTasks()
    {
        $this->assertBelongsToMany('tasks', Tag::class);
    }
}
