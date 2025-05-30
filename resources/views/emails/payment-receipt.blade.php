<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        /* Base Styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333333;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 0;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        /* Header Styles */
        .header {
            text-align: center;
            padding: 30px 0 20px;
            background-color: #9c0c58;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .logo {
            margin-bottom: 15px;
        }
        
        /* Content Styles */
        .content {
            padding: 35px 40px;
            text-align: center;
        }
        .greeting {
            font-size: 20px;
            color: #9c0c58;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            font-size: 16px;
            color: #555555;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        /* Receipt Box Styles */
        .receipt-container {
            margin: 25px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            text-align: left;
            border: 1px dashed #dddddd;
        }
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt-table th {
            text-align: left;
            padding: 10px;
            color: #9c0c58;
            font-weight: 600;
            width: 40%;
            border-bottom: 1px solid #eeeeee;
        }
        .receipt-table td {
            padding: 10px;
            color: #555555;
            border-bottom: 1px solid #eeeeee;
        }
        .receipt-table tr:last-child th,
        .receipt-table tr:last-child td {
            border-bottom: none;
        }
        .receipt-status {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4caf50;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        
        /* Button Styles */
        .button-container {
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            padding: 14px 32px;
            background-color: #9c0c58;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #7c0946;
        }
        
        /* Footer Styles */
        .footer {
            text-align: center;
            padding: 25px 20px;
            font-size: 14px;
            color: #666666;
            background-color: #f9f9f9;
            border-top: 1px solid #eeeeee;
        }
        .footer p {
            margin: 0 0 10px 0;
        }
        .disclaimer {
            font-size: 12px;
            color: #999999;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <!-- Optional: Add your logo here -->
            <!-- <div class="logo"><img src="your-logo.png" alt="Logo" width="120"></div> -->
            <h1>Payment Receipt</h1>
        </div>
        
        <div class="content">
            <p class="greeting">Dear {{ $payment->user->name }},</p>
            
            <div class="message">
                <p>Thank you for your payment. Here is your receipt for your records.</p>
            </div>
            
            <div class="receipt-container">
                <table class="receipt-table">
                    <tr>
                        <th>Order ID</th>
                        <td>{{ $payment->order_id }}</td>
                    </tr>
                    <tr>
                        <th>Package</th>
                        <td>{{ $payment->package->{'package_name_' . app()->getLocale()} }}</td>
                    </tr>
                    <tr>
                        <th>Contact Limit</th>
                        <td>{{ $payment->package->contact_limit }}</td>
                    </tr>
                    <tr>
                        <th>Payment Date</th>
                        <td>{{ $payment->paid_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span class="receipt-status">{{ strtoupper($payment->status) }}</span></td>
                    </tr>
                </table>
            </div>
            
            <div class="button-container">
                <a href="{{ route('user.dashboard') }}" class="button">View Dashboard</a>
            </div>
        </div>
        
        <div class="footer">
            <p>Thanks,<br><strong>{{ config('app.name') }}</strong></p>
            
            <div class="disclaimer">
                This is an automated receipt. Please keep it for your records.
            </div>
        </div>
    </div>
</body>
</html> 