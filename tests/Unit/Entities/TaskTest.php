<?php

use Carbon\Carbon;
use Keep\Entities\Task;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends EntityTestCase
{
    use DatabaseTransactions;

    public function testBelongsToUser()
    {
        $this->assertBelongsTo('user', 'Keep\Entities\Task');
    }

    public function testBelongsToManyTags()
    {
        $this->assertBelongsToMany('tags', 'Keep\Entities\Task');
    }

    public function testBelongsToAPriorityLevel()
    {
        $this->assertBelongsTo('priority', 'Keep\Entities\Task');
    }

    public function testBelongsToAnAssignment()
    {
        $this->assertBelongsTo('assignment', 'Keep\Entities\Task');
    }

    public function testFetchingUrgentTasks()
    {
        factory('Keep\Entities\Task')->create(['title' => 'Foo', 'priority_id' => 1, 'finishing_date' => Carbon::now()->addDays(2)]);
        factory('Keep\Entities\Task')->create(['title' => 'Bar', 'priority_id' => 1, 'finishing_date' => Carbon::now()->addDays(3)]);
        factory('Keep\Entities\Task')->create(['priority_id' => 1, 'completed' => true]);
        factory('Keep\Entities\Task')->create(['priority_id' => 1, 'is_failed' => true]);
        factory('Keep\Entities\Task')->create(['priority_id' => 2]);
        $this->assertCount(2, Task::urgent()->get());
        $this->assertEquals('Foo', Task::urgent()->get()->first()->title);
        $this->assertEquals('Bar', Task::urgent()->get()->last()->title);
    }

    public function testFetchingCompletedTasks()
    {
        factory('Keep\Entities\Task', 2)->create(['completed' => true]);
        factory('Keep\Entities\Task', 1)->create();
        $this->assertCount(2, Task::completed()->get());
    }

    public function testFetchingNewestTasks()
    {
        factory('Keep\Entities\Task', 2)->create(['is_failed' => true]);
        factory('Keep\Entities\Task')->create(['title' => 'Foo', 'created_at' => Carbon::now()->subDays(2)]);
        factory('Keep\Entities\Task')->create(['title' => 'Bar', 'created_at' => Carbon::now()->subDays(3)]);
        $this->assertCount(1, Task::newest()->take(1)->get());
        $this->assertCount(2, Task::newest()->take(2)->get());
        $this->assertCount(2, Task::newest()->take(3)->get());
        $this->assertEquals('Foo', Task::newest()->take(2)->get()->first()->title);
        $this->assertEquals('Bar', Task::newest()->take(2)->get()->last()->title);
    }

    public function testFetchingDeadlineTasks()
    {
        factory('Keep\Entities\Task')->create(['title' => 'Foo', 'finishing_date' => Carbon::now()->addDays(2)]);
        factory('Keep\Entities\Task')->create(['finishing_date' => Carbon::now()->addDays(3)]);
        factory('Keep\Entities\Task')->create(['finishing_date' => Carbon::now()->addDays(4)->addHours(2)]);
        factory('Keep\Entities\Task')->create(['title' => 'Bar', 'finishing_date' => Carbon::now()->addDays(4)->addHours(5)]);
        factory('Keep\Entities\Task')->create(['completed' => true]);
        factory('Keep\Entities\Task')->create(['is_failed' => true]);
        $this->assertCount(1, Task::toDeadline()->take(1)->get());
        $this->assertCount(2, Task::toDeadline()->take(2)->get());
        $this->assertCount(3, Task::toDeadline()->take(3)->get());
        $this->assertCount(4, Task::toDeadline()->take(4)->get());
        $this->assertCount(4, Task::toDeadline()->take(5)->get());
        $this->assertCount(4, Task::toDeadline()->take(6)->get());
        $this->assertEquals('Foo', Task::toDeadline()->take(4)->get()->first()->title);
        $this->assertEquals('Bar', Task::toDeadline()->take(4)->get()->last()->title);
    }

    public function testFetchingRecentlyCompletedTasks()
    {
        factory('Keep\Entities\Task', 2)->create(['completed' => false]);
        factory('Keep\Entities\Task')->create(['title' => 'Foo', 'completed' => true, 'finished_at' => Carbon::now()->addHours(2)]);
        factory('Keep\Entities\Task')->create(['title' => 'Bar', 'completed' => true, 'finished_at' => Carbon::now()->addHours(3)]);
        $this->assertCount(2, Task::recentlyCompleted()->get());
        $this->assertEquals('Foo', Task::recentlyCompleted()->get()->first()->title);
        $this->assertEquals('Bar', Task::recentlyCompleted()->get()->last()->title);
    }

    public function testFetchingAboutToFailTasks()
    {
        factory('Keep\Entities\Task')->create(['completed' => true, 'finishing_date' => Carbon::now()->subDays(1)]);
        factory('Keep\Entities\Task')->create(['is_failed' => true, 'finishing_date' => Carbon::now()->subDays(2)]);
        factory('Keep\Entities\Task')->create(['finishing_date' => Carbon::now()->subHours(3)]);
        $this->assertCount(1, Task::aboutToFail()->get());
    }

    public function testFetchingRecentlyFailedTasks()
    {
        factory('Keep\Entities\Task', 2)->create(['is_failed' => false]);
        factory('Keep\Entities\Task')->create(['title' => 'Foo', 'is_failed' => true, 'created_at' => Carbon::now()->subHours(2)]);
        factory('Keep\Entities\Task')->create(['title' => 'Bar', 'is_failed' => true, 'created_at' => Carbon::now()->subHours(3)]);
        $this->assertCount(2, Task::recentlyFailed()->get());
        $this->assertEquals('Foo', Task::recentlyFailed()->get()->first()->title);
        $this->assertEquals('Bar', Task::recentlyFailed()->get()->last()->title);
    }

    public function testFetchingDueTasks()
    {
        factory('Keep\Entities\Task')->create(['is_failed' => true]);
        factory('Keep\Entities\Task')->create(['completed' => true]);
        factory('Keep\Entities\Task', 2)->create();
        $this->assertCount(2, Task::due()->get());
    }

    public function testFetchingUserCreatedTasks()
    {
        factory('Keep\Entities\Task')->create(['user_id' => 1]);
        factory('Keep\Entities\Task', 2)->create();
        $this->assertCount(1, Task::userCreated()->get());
    }

    public function testFetchingUpcomingTasks()
    {
        factory('Keep\Entities\Task')->create(['is_failed' => true]);
        factory('Keep\Entities\Task')->create(['completed' => true]);
        factory('Keep\Entities\Task')->create(['finishing_date' => Carbon::now()]);
        factory('Keep\Entities\Task')->create(['finishing_date' => Carbon::now()->addDays(3)]);
        factory('Keep\Entities\Task')->create(['finishing_date' => Carbon::now()->addDays(5)]);
        factory('Keep\Entities\Task')->create(['finishing_date' => Carbon::now()->addDays(6)]);
        $this->assertCount(3, Task::upcoming()->get());
    }

    public function testSearchingForTasks()
    {
        factory('Keep\Entities\Task')->create(['title' => 'Foo']);
        factory('Keep\Entities\Task')->create(['title' => 'Foo Bar']);
        factory('Keep\Entities\Task')->create(['title' => 'Foo Bar Baz']);
        factory('Keep\Entities\Task')->create(['title' => 'Bar Baz']);
        factory('Keep\Entities\Task')->create(['title' => 'Baz']);
        $this->assertCount(3, Task::search('Foo')->get());
        $this->assertCount(3, Task::search('foo')->get());
        $this->assertCount(3, Task::search('Bar')->get());
        $this->assertCount(3, Task::search('Baz')->get());
        $this->assertCount(0, Task::search('Dummy')->get());
    }

    public function testCompletedStatus()
    {
        $task1 = factory('Keep\Entities\Task')->create(['completed' => true]);
        $task2 = factory('Keep\Entities\Task')->create(['completed' => false]);
        $this->assertSame(true, $task1->isCompleted());
        $this->assertSame(false, $task2->isCompleted());
    }

    public function testStartingDateAttributeWhenGet()
    {
        $task1 = factory('Keep\Entities\Task')->create(['starting_date' => Carbon::create(2015, 8, 8, 15, 45, 10)]);
        $task2 = factory('Keep\Entities\Task')->create(['starting_date' => Carbon::create(2014, 8, 8, 5, 45, 10)]);
        $this->assertSame('08/08/2015 03:45 PM', $task1->starting_date);
        $this->assertSame('08/08/2014 05:45 AM', $task2->starting_date);
    }

    public function testFinishingDateAttributeWhenGet()
    {
        $task1 = factory('Keep\Entities\Task')->create(['finishing_date' => Carbon::create(2015, 8, 8, 15, 45, 10)]);
        $task2 = factory('Keep\Entities\Task')->create(['finishing_date' => Carbon::create(2014, 8, 8, 5, 45, 10)]);
        $this->assertSame('08/08/2015 03:45 PM', $task1->finishing_date);
        $this->assertSame('08/08/2014 05:45 AM', $task2->finishing_date);
    }

    public function testTagListAttributeWhenGet()
    {
        $tag1 = factory('Keep\Entities\Tag')->create(['name' => 'Foo']);
        $tag2 = factory('Keep\Entities\Tag')->create(['name' => 'Bar']);
        $task = factory('Keep\Entities\Task')->create();
        $task->tags()->sync([$tag1->id, $tag2->id]);
        $this->assertEquals([$tag1->id, $tag2->id], $task->tag_list);
    }
}
