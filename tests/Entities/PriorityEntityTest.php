<?php

use Keep\Entities\Priority;

class PriorityEntityTest extends ModelTestCase
{
    public function testHasManyTasks()
    {
        $this->assertHasMany('tasks', Priority::class);
    }
}
