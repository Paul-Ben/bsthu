<!DOCTYPE html>
<html>
<head>
    <style>
        .letterhead {
            border-bottom: 3px solid #1a365d;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        .content {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
        }
        .signature {
            margin-top: 3rem;
            border-top: 1px solid #ccc;
            padding-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="letterhead">
        <h1>Benue State University Teaching Hospital</h1>
        <p>Makurdi, Benue State</p>
        <p>Date: {{ now()->format('F j, Y') }}</p>
    </div>

    <div class="content">
        <h2>OFFER OF ADMISSION</h2>
        
        <p>Dear {{ $admission->application->full_name }},</p>
        
        <p>We are pleased to offer you admission into the following program:</p>
        
        <div class="program-details">
            <p><strong>Program:</strong> {{ $admission->program->name }}</p>
            <p><strong>Faculty:</strong> {{ $admission->program->faculty->name }}</p>
            <p><strong>Admission Date:</strong> {{ $admission->offer_date->format('F j, Y') }}</p>
        </div>

        <p class="mt-4">To accept this offer, please complete the following steps:</p>
        <ol class="list-decimal pl-6">
            <li>Submit original academic documents</li>
            <li>Complete medical clearance form</li>
            <li>Pay acceptance fee within 14 days</li>
        </ol>

        <div class="signature">
            <p>Yours sincerely,</p>
            <p><strong>Dr. Ada Okoro</strong></p>
            <p>Director of Admissions</p>
            <p>Benue State University Teaching Hospital</p>
        </div>
    </div>
</body>
</html>