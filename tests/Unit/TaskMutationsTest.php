<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Http\GraphQL\Mutations\TaskMutations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskMutationsTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateTask()
    {
        $mutation = new TaskMutations();
        $tasks = $mutation->createTask(null, [
            'title' => 'Test Task',
            'status' => 'todo'
        ]);
        $this->assertIsArray($tasks);
        $this->assertNotEmpty($tasks);
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'status' => 'todo'
        ]);
    }

    public function testUpdateTask()
    {
        $task = Task::factory()->create(['title' => 'Old Title']);

        $mutation = new TaskMutations();
        $updatedTasks = $mutation->updateTask(null, [
            'id' => $task->id,
            'title' => 'New Title',
            'status' => 'done'
        ]);

        $this->assertIsArray($updatedTasks);
        $this->assertNotEmpty($updatedTasks);
        $this->assertEquals('New Title', $updatedTasks[0]['title']);
        $this->assertEquals('done', $updatedTasks[0]['status']);
    }

    public function testDeleteTask()
    {
        $task = Task::factory()->create();

        $mutation = new TaskMutations();
        $deletedTask = $mutation->deleteTask(null, ['id' => $task->id]);

        $this->assertIsArray($deletedTask);
        $this->assertNotContains($task, $deletedTask);
    }

    public function testDeleteDoneTasks()
    {
        $taskMutations = new TaskMutations();
        
        $args = [
            'title' => 'Task 1',
            'status' => 'done'
        ];
        $taskMutations->createTask(null, $args);
        
        $args = [
            'title' => 'Task 2',
            'status' => 'done'
        ];
        $taskMutations->createTask(null, $args);
        
        $args = [
            'title' => 'Task 3',
            'status' => 'todo'
        ];
        $taskMutations->createTask(null, $args);
        
        // Delete all tasks with status 'done'
        $deletedTasks = $taskMutations->deleteDoneTasks();
        
        $this->assertIsArray($deletedTasks);
        // Check if the tasks with status 'done' are deleted
        $this->assertCount(0, Task::where('status', 'done')->get());
        // Check if the tasks with status 'todo' are not deleted
        $this->assertCount(1, Task::where('status', 'todo')->get());
    }

    public function testFetchAllTasks()
    {
        Task::factory()->count(3)->create();

        $tasks = Task::all();
        $this->assertNotEmpty($tasks);
    }

    public function testErrorHandling()
    {
        // Test error handling (e.g., trying to update a non-existent task)
        $mutation = new TaskMutations();
        $result = $mutation->updateTask(null, [
            'id' => 999,
            'title' => 'New Title',
            'status' => 'done'
        ]);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\ModelNotFoundException::class, $result);
    }
}