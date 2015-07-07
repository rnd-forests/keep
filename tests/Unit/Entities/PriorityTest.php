<?php

class PriorityTest extends EntityTestCase
{
    public function testHasManyTasks()
    {
        $this->assertHasMany('tasks', 'Keep\Entities\Priority');
    }
}
