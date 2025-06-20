<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Appointment Receipt</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 13px;
      margin: 0;
      padding: 0;
    }

    .page {
      width: 100%;
      max-width: 794px;
      padding: 30px;
      margin: 0 auto;
      box-sizing: border-box;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
      border-bottom: 1px solid #000;
      padding-bottom: 10px;
    }

    .header h1 {
      font-size: 22px;
      margin: 0;
    }

    .sub-header {
      font-size: 13px;
      color: #333;
    }

    .section {
      margin-bottom: 20px;
    }

    .section-title {
      font-weight: bold;
      margin-bottom: 10px;
      font-size: 14px;
      border-bottom: 1px solid #000;
    }

    .info-table {
      width: 100%;
    }

    .info-table td {
      padding: 6px 4px;
      vertical-align: top;
    }

    .instructions ul {
      padding-left: 20px;
      margin: 0;
    }

    .instructions li {
      margin-bottom: 5px;
    }

    .footer {
      font-size: 12px;
      border-top: 1px solid #000;
      padding-top: 8px;
    }

    .highlight {
      font-weight: bold;
    }

    .status {
      border: 1px solid #28a745;
      padding: 5px 10px;
      display: inline-block;
      color: #28a745;
      font-size: 12px;
      float: right;
      margin-top: -30px;
    }
  </style>
</head>

<body>
  <div class="page">
    <!-- Header -->
    <div class="header">
      <h1>HealingTouch Hospital</h1>
      <p class="sub-header">Excellence in Healthcare</p>
      <p class="sub-header">Appointment ID: 202506200085</p>
      <div class="status">Confirmed</div>
    </div>

    <!-- Patient Info -->
    <div class="section">
      <div class="section-title">Patient Information</div>
      <table class="info-table">
        <tr>
          <td><strong>Appointment Number:</strong></td>
          <td>202506200085</td>
        </tr>
        <tr>
          <td><strong>Amount Paid:</strong></td>
          <td>Rs. 0.00 (due)</td>
        </tr>
        <tr>
          <td><strong>Full Name:</strong></td>
          <td>Sadique Hussain</td>
        </tr>
        <tr>
          <td><strong>Patient ID:</strong></td>
          <td>#1</td>
        </tr>
        <tr>
          <td><strong>Gender:</strong></td>
          <td>Male</td>
        </tr>
        <tr>
          <td><strong>Contact:</strong></td>
          <td>9546805580</td>
        </tr>
      </table>
    </div>

    <!-- Doctor Info -->
    <div class="section">
      <div class="section-title">Appointment Details</div>
      <table class="info-table">
        <tr>
          <td><strong>Doctor:</strong></td>
          <td>Dr. Charly Kumar Sinha</td>
        </tr>
        <tr>
          <td><strong>Department:</strong></td>
          <td>Surgeon</td>
        </tr>
        <tr>
          <td><strong>Consultation Fee:</strong></td>
          <td>Rs. 500.00</td>
        </tr>
        <tr>
          <td><strong>Date:</strong></td>
          <td>20 June 2025</td>
        </tr>
        <tr>
          <td><strong>Day:</strong></td>
          <td>Friday</td>
        </tr>
        <tr>
          <td><strong>Reporting Time:</strong></td>
          <td>12:30 PM</td>
        </tr>
        <tr>
          <td><strong>Queue Number:</strong></td>
          <td>#001</td>
        </tr>
      </table>
    </div>

    <!-- Instructions -->
    <div class="section instructions">
      <div class="section-title">Important Instructions</div>
      <ul>
        <li>Please arrive 15 minutes before your scheduled appointment.</li>
        <li>Bring this appointment slip or PDF.</li>
        <li>Carry all relevant medical records and reports.</li>
        <li>For rescheduling, contact 24 hours in advance.</li>
      </ul>
    </div>

    <!-- Footer -->
    <div class="footer">
      <strong>Contact:</strong> +91 9471659700 |
      <strong>Address:</strong> Hope Chauraha, Rambagh Road, Linebazar, Purnea 854301
    </div>
  </div>
</body>

</html>