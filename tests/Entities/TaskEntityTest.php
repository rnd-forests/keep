<?php

use Carbon\Carbon;
use Keep\Entities\Tag;
use Keep\Entities\Task;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskEntityTest extends ModelTestCase
{
    use DatabaseTransactions;

    public function testBelongsToAnOwner()
    {
    }

    public function testBelongsToADestroyer()
    {
    }

    public function testBelongsToManyTags()
    {
        $this->assertBelongsToMany('tags', Task::class);
    }

    public function testBelongsToAPriorityLevel()
    {
        $this->assertBelongsTo('priority', Task::class);
    }

    public function testBelongsToAnAssignment()
    {
        $this->assertBelongsTo('assignment', Task::class);
    }

    public function testFetchingUrgentTasks()
    {
        factory(Task::class)->create(['title' => 'Foo', 'priority_id' => 1, 'finishing_date' => Carbon::now()->addDays(2)]);
        factory(Task::class)->create(['title' => 'Bar', 'priority_id' => 1, 'finishing_date' => Carbon::now()->addDays(3)]);
        factory(Task::class)->create(['priority_id' => 1, 'completed' => true]);
        factory(Task::class)->create(['priority_id' => 1, 'is_failed' => true]);
        factory(Task::class)->create(['priority_id' => 2]);
        $this->assertCount(5, Task::get());
        $this->assertCount(2, Task::urgent()->get());
        $this->assertEquals('Foo', Task::urgent()->get()->first()->title);
        $this->assertEquals('Bar', Task::urgent()->get()->last()->title);
    }

    public function testFetchingCompletedTasks()
    {
        factory(Task::class, 2)->create(['completed' => true]);
        factory(Task::class, 1)->create();
        $this->assertCount(3, Task::get());
        $this->assertCount(2, Task::completed()->get());
    }

    public function testFetchingNewestTasks()
    {
        factory(Task::class, 2)->create(['is_failed' => true]);
        factory(Task::class)->create(['title' => 'Foo', 'created_at' => Carbon::now()->subDays(2)]);
        factory(Task::class)->create(['title' => 'Bar', 'created_at' => Carbon::now()->subDays(3)]);
        $this->assertCount(4, Task::get());
        $this->assertCount(1, Task::newest()->take(1)->get());
        $this->assertCount(2, Task::newest()->take(2)->get());
        $this->assertCount(2, Task::newest()->take(3)->get());
        $this->assertEquals('Foo', Task::newest()->take(2)->get()->first()->title);
        $this->assertEquals('Bar', Task::newest()->take(2)->get()->last()->title);
    }

    public function testFetchingDeadlineTasks()
    {
        factory(Task::class)->create(['title' => 'Foo', 'finishing_date' => Carbon::now()->addDays(2)]);
        factory(Task::class)->create(['finishing_date' => Carbon::now()->addDays(3)]);
        factory(Task::class)->create(['finishing_date' => Carbon::now()->addDays(4)->addHours(2)]);
        factory(Task::class)->create(['title' => 'Bar', 'finishing_date' => Carbon::now()->addDays(4)->addHours(5)]);
        factory(Task::class)->create(['completed' => true]);
        factory(Task::class)->create(['is_failed' => true]);
        $this->assertCount(6, Task::get());
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
        factory(Task::class, 2)->create(['completed' => false]);
        factory(Task::class)->create(['title' => 'Foo', 'completed' => true, 'finished_at' => Carbon::now()->addHours(2)]);
        factory(Task::class)->create(['title' => 'Bar', 'completed' => true, 'finished_at' => Carbon::now()->addHours(3)]);
        $this->assertCount(4, Task::get());
        $this->assertCount(2, Task::recentlyCompleted()->get());
        $this->assertEquals('Foo', Task::recentlyCompleted()->get()->first()->title);
        $this->assertEquals('Bar', Task::recentlyCompleted()->get()->last()->title);
    }

    public function testFetchingAboutToFailTasks()
    {
        factory(Task::class)->create(['completed' => true, 'finishing_date' => Carbon::now()->subDays(1)]);
        factory(Task::class)->create(['is_failed' => true, 'finishing_date' => Carbon::now()->subDays(2)]);
        factory(Task::class)->create(['finishing_date' => Carbon::now()->subHours(3)]);
        $this->assertCount(3, Task::get());
        $this->assertCount(1, Task::aboutToFail()->get());
    }

    public function testFetchingRecentlyFailedTasks()
    {
        factory(Task::class, 2)->create(['is_failed' => false]);
        factory(Task::class)->create(['title' => 'Foo', 'is_failed' => true, 'created_at' => Carbon::now()->subHours(2)]);
        factory(Task::class)->create(['title' => 'Bar', 'is_failed' => true, 'created_at' => Carbon::now()->subHours(3)]);
        $this->assertCount(4, Task::get());
        $this->assertCount(2, Task::recentlyFailed()->get());
        $this->assertEquals('Foo', Task::recentlyFailed()->get()->first()->title);
        $this->assertEquals('Bar', Task::recentlyFailed()->get()->last()->title);
    }

    public function testFetchingDueTasks()
    {
        factory(Task::class)->create(['is_failed' => true]);
        factory(Task::class)->create(['completed' => true]);
        factory(Task::class, 2)->create();
        $this->assertCount(4, Task::get());
        $this->assertCount(2, Task::due()->get());
    }

    public function testFetchingUserCreatedTasks()
    {
        factory(Task::class)->create(['user_id' => 1]);
        factory(Task::class, 2)->create();
        $this->assertCount(3, Task::get());
        $this->assertCount(1, Task::userCreated()->get());
    }

    public function testFetchingUpcomingTasks()
    {
        factory(Task::class)->create(['is_failed' => true]);
        factory(Task::class)->create(['completed' => true]);
        factory(Task::class)->create(['finishing_date' => Carbon::now()]);
        factory(Task::class)->create(['finishing_date' => Carbon::now()->addDays(3)]);
        factory(Task::class)->create(['finishing_date' => Carbon::now()->addDays(5)]);
        factory(Task::class)->create(['finishing_date' => Carbon::now()->addDays(6)]);
        $this->assertCount(6, Task::get());
        $this->assertCount(3, Task::upcoming()->get());
    }

    public function testSearchingForTasks()
    {
        factory(Task::class)->create(['title' => 'Foo']);
        factory(Task::class)->create(['title' => 'Foo Bar']);
        factory(Task::class)->create(['title' => 'Foo Bar Baz']);
        factory(Task::class)->create(['title' => 'Bar Baz']);
        factory(Task::class)->create(['title' => 'Baz']);
        $this->assertCount(5, Task::get());
        $this->assertCount(3, Task::search('Foo')->get());
        $this->assertCount(3, Task::search('foo')->get());
        $this->assertCount(3, Task::search('Bar')->get());
        $this->assertCount(3, Task::search('Baz')->get());
        $this->assertCount(0, Task::search('Dummy')->get());
    }

    public function testCompletedStatus()
    {
        $task1 = factory(Task::class)->create(['completed' => true]);
        $task2 = factory(Task::class)->create(['completed' => false]);
        $this->assertSame(true, $task1->isCompleted());
        $this->assertSame(false, $task2->isCompleted());
    }

    public function testStartingDateAttributeWhenGet()
    {
        $task1 = factory(Task::class)->create(['starting_date' => Carbon::create(2015, 8, 8, 15, 45, 10)]);
        $task2 = factory(Task::class)->create(['starting_date' => Carbon::create(2014, 8, 8, 5, 45, 10)]);
        $this->assertSame('08/08/2015 03:45 PM', $task1->starting_date);
        $this->assertSame('08/08/2014 05:45 AM', $task2->starting_date);
    }

    public function testFinishingDateAttributeWhenGet()
    {
        $task1 = factory(Task::class)->create(['finishing_date' => Carbon::create(2015, 8, 8, 15, 45, 10)]);
        $task2 = factory(Task::class)->create(['finishing_date' => Carbon::create(2014, 8, 8, 5, 45, 10)]);
        $this->assertSame('08/08/2015 03:45 PM', $task1->finishing_date);
        $this->assertSame('08/08/2014 05:45 AM', $task2->finishing_date);
    }

    public function testTagListAttributeWhenGet()
    {
        $tag1 = factory(Tag::class)->create(['name' => 'Foo']);
        $tag2 = factory(Tag::class)->create(['name' => 'Bar']);
        $task = factory(Task::class)->create();
        $task->tags()->sync([$tag1->id, $tag2->id]);
        $this->assertEquals([$tag1->id, $tag2->id], $task->tag_list);
    }
}
