<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9; /* Soft background for contrast */
            margin: 0;
            padding: 0;
            color: #333; /* Slightly darker text for readability */
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
            max-width: 600px;
            margin: auto;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        }
       

        .page-header h3 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            color: #495057;
            background-color: #f9fafb;
            border: 1px solid #ced4da;
            border-radius: 8px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.3);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .text-danger {
            font-size: 0.85rem;
            color: #dc3545;
            margin-top: 5px;
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }
        .page-title{
            color: white;
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
                                <h3 class="page-title">Add New Course</h3>
                            </div>
                            <div class="form-container">
                                <form action="{{ url('courses') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Course Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter course title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter course description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Course</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-app-layout>
</body>

</html>
