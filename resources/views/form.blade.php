<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Child Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="{{ route('category.page') }}">
            <button type="submit">Category Page</button>
        </form>
    </div>
    
<div class="container">
    
    <h2>Submit Parent and Child Information</h2>
    <form id="parentChildForm">
        <p id="error-message" style="color: red"></p>
        <p id="success-message" style="color: green"></p>
        <div class="form-group">
            <label for="father_name">Father's Name</label>
            <input type="text" id="father_name" name="father_name" required>
        </div>
        <div class="form-group">
            <label for="mother_name">Mother's Name</label>
            <input type="text" id="mother_name" name="mother_name" required>
        </div>
        <div class="form-group">
            <label for="child_name">Child's Name</label>
            <input type="text" id="child_name" name="child_name" required>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#parentChildForm').submit(function(event) {
        // Prevent the default form submission
        event.preventDefault();
        // Serialize form data
        var formData = $(this).serialize();
        // Send Ajax request
        $.ajax({
            type: 'POST',
            url: '/api/submit',
            data: formData,
            dataType:'json',
            success: function(response) {
                $('#error-message').text('');
                $('#success-message').text(response.success);
                // $('#parentChildForm')[0].reset();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseJSON.error);
                $('#success-message').text('');
                $('#error-message').text(xhr.responseJSON.error);
            }
        });
    });
});
</script>

</body>
</html>
