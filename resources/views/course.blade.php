<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Information</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container-scroller {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }

        .main-panel {
            flex: 1;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            box-sizing: border-box;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .table thead th {
            background-color: #007bff;
            color: #fff;
            text-align: left;
            padding: 12px;
        }

        .table tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .btn-add {
            display: inline-block;
            padding: 12px 25px;
            margin-bottom: 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-add:hover {
            background-color: #218838;
        }

        .btn-action {
            display: inline-block;
            width: 80px; /* Set consistent width */
            padding: 8px;
            text-align: center;
            color: white;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn-success {
            background-color: #007bff;
        }

        .btn-success:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .page-header {
            margin-bottom: 20px;
            font-weight: 500;
            color: #333;
        }

        .page-title {
            color: white;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="container-scroller">
                <div class="container-fluid page-body-wrapper">
                    <div class="main-panel">
                        <div class="content-wrapper">
                            <div class="page-header">
                                <h3 class="page-title">Course Information</h3>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ url('/courses/create') }}" class="btn-add">Add Course</a>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($courses as $course)
                                                <tr>
                                                    <td>{{ $course->id }}</td>
                                                    <td>{{ $course->title }}</td>
                                                    <td>{{ $course->description }}</td>
                                                    <td>
                                                        <a href="{{ url('courses/'.$course->id.'/edit') }}" class="btn-action btn-success mx-2">Edit</a>
                                                        <form method="POST" action="{{ url('courses/'.$course->id) }}" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-action btn-danger mx-2">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-app-layout>
</body>

</html>
