<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Customer System</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 50px;
            background-color: #f9fafb;
        }
        h1 {
            color: #1f2937;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Welcome to the Customer Enquiry, Feedback & Survey System</p>

    <ul>
        <li><a href="{{ url('/customers') }}">Manage Customers</a></li>
        <li><a href="{{ url('/enquiries') }}">View Enquiries</a></li>
        <li><a href="{{ url('/feedback') }}">Feedback Responses</a></li>
        <li><a href="{{ url('/surveys') }}">Survey List</a></li>
    </ul>
</body>
</html>
