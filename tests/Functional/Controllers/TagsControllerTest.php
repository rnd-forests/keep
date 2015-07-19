<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $mock, $user;

    /**
     * @before
     */
    public function it_initializes_testing_environment()
    {
        $this->mock = $this->mock(Keep\Repositories\Tag\TagRepositoryInterface::class);
        $this->user = $this->setAuthenticatedUser();
    }

    /** @test */
    public function it_fetches_all_tags_associated_with_a_user()
    {
        $tags = factory(Keep\Entities\Tag::class, 2)->create();
        $this->mock->shouldReceive('fetchAttachedTags')->with($this->user->slug)->once()->andReturn($tags);

        $this->route('GET', 'member::tags.all', ['users' => $this->user->slug]);

        $this->assertResponseOk();
        $this->assertViewIs('users.tags.index');
        $this->assertViewHas('tags', $tags);
        $this->assertInstanceOf(Illuminate\Database\Eloquent\Collection::class, $this->response->original->getData()['tags']);
    }

    /** @test */
    public function it_fetches_all_tasks_of_a_user_associated_with_a_tag()
    {
        $paginator = $this->mockPaginator();
        $tag = factory(Keep\Entities\Tag::class)->create(['name' => 'personal']);
        $this->mock->shouldReceive('findBySlug')->with('personal')->once()->andReturn($tag);
        $this->mock->shouldReceive('fetchTasksAssociatedWithTag')->once()->andReturn($paginator);

        $this->route('GET', 'member::tags.task', ['users' => $this->user->slug, 'tags' => 'personal']);

        $this->assertResponseOk();
        $this->assertViewIs('users.tags.show');
        $this->assertViewHasAll(['tag' => $tag, 'tasks' => $paginator]);
    }
}
