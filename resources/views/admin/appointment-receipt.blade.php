<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Receipt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #dbeafe, #e5e7eb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .card {
            width: 100%;
            max-width: 28rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .logo {
            width: 5rem;
            height: auto;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .patient-info {
            
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            font-size: 0.875rem;
        }

        .label {
            color: #6b7280;
            font-weight: 500;
        }

        .value {
            color: #1f2937;
        }

        .appointment-details {
            margin-bottom: 1.5rem;
        }

        .subtitle {
            font-size: 1.125rem;
            font-weight: 600;
            text-align: center;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            font-size: 0.875rem;
            color: #4b5563;
            text-align: left;
        }

        .table-header {
            font-size: 0.75rem;
            color: #374151;
            text-transform: uppercase;
            background: #f9fafb;
        }

        .table-cell {
            padding: 0.75rem 1rem;
        }

        .table-row {
            background: white;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-row:hover {
            background: #f9fafb;
        }

        .status {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
        }

        .status-confirmed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .footer {
            text-align: center;
        }

        .thank-you {
            font-size: 0.875rem;
            color: #4b5563;
            margin-bottom: 1rem;
        }

        .footer-divider {
            border-top: 1px dashed #d1d5db;
            padding-top: 1rem;
        }

        .contact {
            font-size: 0.875rem;
            color: #4b5563;
        }

        .contact-item {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body class="body">
    <div class="card">
        <!-- Header with Logo -->
        
        <h2 class="title">Appointment Receipt</h2>

        <!-- Patient Information -->
        <div class="patient-info">
            <div class="info-grid">
                <div class="label">Patient Name:</div>
                <div class="value">{{ $appoinments->name }}</div>
                <div class="label">Email:</div>
                <div class="value">{{ $appoinments->email }}</div>
                <div class="label">Doctor Name:</div>
                <div class="value">{{ $appoinments->doctor->user->name }}</div>
                <div class="label">Department:</div>
                <div class="value">{{ $appoinments->doctor->department->name ?? 'N/A' }}</div>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="appointment-details">
            <h3 class="subtitle">Appointment Details</h3>
            <div class="table-container">
                <table class="table">
                    <thead class="table-header">
                        <tr>
                            <th class="table-cell">Date</th>
                            <th class="table-cell">Time</th>
                            <th class="table-cell">Status</th>
                            <th class="table-cell">Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row">
                            <td class="table-cell">{{ $appoinments->date }}</td>
                            <td class="table-cell">{{ $appoinments->created_at->format('h:i A') }}</td>
                            <td class="table-cell">
                                <span class="status {{ $appoinments->status === 'Confirmed' ? 'status-confirmed' : 'status-pending' }}">
                                    {{ $appoinments->status }}
                                </span>
                            </td>
                            <td class="table-cell">{{ $appoinments->fee ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="thank-you">Thank you for booking your appointment with Healing Touch.</p>
            <div class="footer-divider"></div>
            <div class="contact">
                <div class="contact-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span>healingtouch@gmail.com</span>
                </div>
                <div class="contact-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    <span>+99 7992257695</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>