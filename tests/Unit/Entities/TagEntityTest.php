<?php

use Keep\Entities\Tag;

class TagEntityTest extends EntityTestCase
{
    public function testBelongsToManyTasks()
    {
        $this->assertBelongsToMany('tasks', Tag::class);
    }
}
