<?php

namespace App\Http\GraphQL\Queries;

use App\Models\Task;

class TaskQueries
{
  public function tasks()
  {
    return Task::all();
  }
}
