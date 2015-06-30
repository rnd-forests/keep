<?php

use Keep\Entities\Priority;

class PriorityEntityTest extends EntityTestCase
{
    public function testHasManyTasks()
    {
        $this->assertHasMany('tasks', Priority::class);
    }
}
