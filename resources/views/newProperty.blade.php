
@extends('layout')

@section('content')



    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Form</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="card">
        <h2>Add Property</h2>
        <form action="/submit-property" method="POST">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" placeholder="Title" maxlength="128" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="property_type" placeholder="Property Type" maxlength="32" value="apartment" required>
                </div>
            </div>

            <div class="mb-3">
                <textarea class="form-control" name="description" placeholder="Description" rows="3" required></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="city" placeholder="City" maxlength="32" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="municipality" placeholder="Municipality" maxlength="32" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="address" placeholder="Address" maxlength="64" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="number" class="form-control" name="price" placeholder="Price" step="0.01" min="0" required>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="area" placeholder="Area (m²)" step="0.1" min="0" required>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="floor" placeholder="Floor" min="0">
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="total_floors" placeholder="Total Floors" min="0">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <select class="form-select" name="heating_type" required>
                        <option value="" disabled selected>Heating Type</option>
                        <option value="central">Central</option>
                        <option value="ta">TA</option>
                        <option value="gas">Gas</option>
                        <option value="floor">Floor</option>
                        <option value="none">None</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="construction_year" placeholder="Construction Year" min="1800" max="2100">
                </div>
                <div class="col-md-2 form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="parking" id="parking">
                    <label class="form-check-label" for="parking">Parking</label>
                </div>
                <div class="col-md-2 form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="furnished" id="furnished">
                    <label class="form-check-label" for="furnished">Furnished</label>
                </div>
            </div>

            <!-- Hidden user_id -->
            <input type="hidden" name="user_id" value="1">

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Submit Property</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





@endsection
