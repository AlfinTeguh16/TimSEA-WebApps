<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Project Request</title>
</head>
<body>
    <h2>New Project Request</h2>
    <p>A new project request has been submitted with the following details:</p>

    <h3>Initial Data</h3>
    <p><strong>Package Name:</strong> {{ $packageName }}</p>
    <p><strong>Category:</strong> {{ $category }}</p>

    <h3>Company Information</h3>
    <p><strong>Company Name:</strong> {{ $companyName }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Location:</strong> {{ $location }}</p>
    <p><strong>Industry Type:</strong> {{ $industry }}</p>
    <p><strong>Telegram Username:</strong> {{ $telegram }}</p>

    <h3>Project Information</h3>
    <p><strong>Project Title:</strong> {{ $projectTitle }}</p>
    <p><strong>Project Description:</strong> {{ $projectDesc }}</p>

    <p>Best Regards,</p>
    <p>Your Website Team</p>
</body>
</html>
