<?php

use Carbon\Carbon;

class TaskTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_user()
    {
        $this->assertBelongsTo('user', 'Keep\Entities\Task');
    }

    /** @test */
    public function it_belongs_to_many_tags()
    {
        $this->assertBelongsToMany('tags', 'Keep\Entities\Task');
    }

    /** @test */
    public function it_belongs_to_a_priority_level()
    {
        $this->assertBelongsTo('priority', 'Keep\Entities\Task');
    }

    /** @test */
    public function it_belongs_to_an_assignment()
    {
        $this->assertBelongsTo('assignment', 'Keep\Entities\Task');
    }

    /** @test */
    public function it_has_the_correct_completed_status()
    {
        $task = factory('Keep\Entities\Task')->make(['completed' => false]);
        $this->assertSame(false, $task->isCompleted());
    }

    /** @test */
    public function it_formats_starting_date_value_when_this_value_is_retrieved()
    {
        $task = factory('Keep\Entities\Task')->make(['starting_date' => Carbon::create(2014, 8, 8, 5, 45, 10)]);
        $this->assertSame('08/08/2014 05:45 AM', $task->starting_date);
    }

    /** @test */
    public function it_formats_finishing_date_value_when_this_value_is_retrieved()
    {
        $task = factory('Keep\Entities\Task')->make(['finishing_date' => Carbon::create(2014, 8, 8, 5, 45, 10)]);
        $this->assertSame('08/08/2014 05:45 AM', $task->finishing_date);
    }
}
