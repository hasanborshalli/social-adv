<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_replies_nest_to_any_depth_in_one_table(): void
    {
        $comment = Comment::factory()->create();
        $reply = Comment::factory()->replyTo($comment)->create();
        $replyToReply = Comment::factory()->replyTo($reply)->create();

        $this->assertTrue($comment->replies->contains($reply));
        $this->assertTrue($reply->replies->contains($replyToReply));
        $this->assertTrue($replyToReply->parent->is($reply));
        $this->assertTrue($replyToReply->isReply());
        $this->assertFalse($comment->isReply());

        $post = $comment->post;
        $this->assertSame(3, $post->comments()->count());
        $this->assertSame([$comment->id], $post->topLevelComments()->pluck('id')->all());
    }

    public function test_deleting_a_comment_deletes_its_replies(): void
    {
        $comment = Comment::factory()->create();
        $reply = Comment::factory()->replyTo($comment)->create();
        $replyToReply = Comment::factory()->replyTo($reply)->create();

        $comment->delete();

        $this->assertModelMissing($reply);
        $this->assertModelMissing($replyToReply);
    }

    public function test_a_user_can_comment_on_a_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user)
            ->test('comment-section', ['post' => $post])
            ->set('body', 'Nice post!')
            ->call('addComment')
            ->assertHasNoErrors()
            ->assertSet('body', '')
            ->assertSee('Nice post!');

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment_id' => null,
            'body' => 'Nice post!',
        ]);
    }

    public function test_a_user_can_reply_to_a_reply(): void
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        $reply = Comment::factory()->replyTo($comment)->create();

        Livewire::actingAs($user)
            ->test('comment-section', ['post' => $comment->post])
            ->call('reply', $reply->id)
            ->set('body', 'Deep reply')
            ->call('addComment')
            ->assertHasNoErrors()
            ->assertSet('replyingTo', null)
            ->assertSee('Deep reply');

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'post_id' => $comment->post_id,
            'comment_id' => $reply->id,
            'body' => 'Deep reply',
        ]);
    }

    public function test_a_user_cannot_reply_to_a_comment_on_another_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $commentOnOtherPost = Comment::factory()->create();

        Livewire::actingAs($user)
            ->test('comment-section', ['post' => $post])
            ->call('reply', $commentOnOtherPost->id)
            ->set('body', 'Sneaky')
            ->call('addComment')
            ->assertHasErrors(['replyingTo' => 'exists']);

        $this->assertDatabaseMissing('comments', ['body' => 'Sneaky']);
    }

    public function test_a_comment_body_is_required(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Livewire::actingAs($user)
            ->test('comment-section', ['post' => $post])
            ->set('body', '')
            ->call('addComment')
            ->assertHasErrors(['body' => 'required']);

        $this->assertDatabaseCount('comments', 0);
    }

    public function test_users_cannot_comment_on_a_post_they_cannot_see(): void
    {
        $stranger = User::factory()->create();
        $post = Post::factory()->private()->create();

        Livewire::actingAs($stranger)
            ->test('comment-section', ['post' => $post])
            ->set('body', 'Hello')
            ->call('addComment')
            ->assertForbidden();

        $this->assertDatabaseCount('comments', 0);
    }
}
