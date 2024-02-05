<?php

namespace App\Http\GraphQL\Mutations;

use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskMutations
{
  public function createTask($root, array $args)
  {
    try {
      Task::create($args);
      return Task::all()->toArray();
    } catch (\Exception $e) {
      // Handle other exceptions (e.g., database errors)
      return $e;
    }
  }

  public function updateTask($root, array $args)
  {
    try {
      Task::findOrFail($args['id'])->update($args);
      return Task::all()->toArray();
    } catch (\Exception $e) {
      // Handle other exceptions (e.g., database errors)
      return $e;
    }
  }

  public function deleteTask($root, array $args)
  {
    try {
      Task::findOrFail($args['id'])->delete();
      return Task::all()->toArray();
    } catch (ModelNotFoundException $e) {
      // Task with the given ID was not found
      return $e;
    } catch (\Exception $e) {
      // Handle other exceptions (e.g., database errors)
      return $e;
    }
  }

  public function deleteDoneTasks()
  {
    try {
      Task::where('status', 'done')->delete();
      return Task::all()->toArray();
    }  catch (\Exception $e) {
      // Handle other exceptions (e.g., database errors)
      return $e;
    }
  }
}
