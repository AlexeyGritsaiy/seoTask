<?php
/**
 * @var $tasks \App\Models\Task[]|\Illuminate\Pagination\LengthAwarePaginator
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Post ID</th>
                <th>Task Id</th>
                <th>Se ID</th>
                <th>Loc ID</th>
                <th>Key ID</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->post_id }}</td>
                    <td>{{ $task->task_id }}</td>
                    <td>{{ $task->se_id }}</td>
                    <td>{{ $task->loc_id }}</td>
                    <td>{{ $task->key_id }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        {{ $tasks->links() }}
    </div>
@endsection
