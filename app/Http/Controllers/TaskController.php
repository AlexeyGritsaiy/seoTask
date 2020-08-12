<?php

namespace App\Http\Controllers;

use App\Events\TaskCreatedEvent;
use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Services\DataForSeoHttpClient;
use Illuminate\Support\Collection;

class TaskController
{
    /**
     * @var DataForSeoHttpClient
     */
    private $client;

    public function __construct(DataForSeoHttpClient $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $tasks = Task::orderByDesc('id')->paginate(20);

        return view('tasks.index', compact('tasks'));
    }

    public function showTaskForm()
    {
        /** @var Collection $engines */
        $engines = collect(
            $this->client->getSearchEngines()
        )->filter(function ($data) {
            return $data['se_country_iso_code'] === 'UA';
        });

        return view('tasks.createForm', compact('engines'));
    }

    public function store(CreateTaskRequest $request)
    {
        $id = rand(0, 30000000);

        $params = [
            'se_id' => $request->se,
            'loc_id' => $request->region,
            'key' => mb_convert_encoding($request->keywords, "UTF-8"),
        ];

        $result = $this->client->createTask($id, $params);

        $data = $result[$id];

        $task = Task::create([
            'post_id' => $data['post_id'],
            'task_id' => $data['task_id'],
            'se_id' => $data['se_id'],
            'loc_id' => $data['loc_id'],
            'key_id' => $data['key_id'],
        ]);

        event(new TaskCreatedEvent($task));

        return redirect(
            route('task.index')
        );
    }

    public function countries(string $iso)
    {
        $regions = $this->client->getLocations($iso);

        return response()->json($regions);
    }
}
