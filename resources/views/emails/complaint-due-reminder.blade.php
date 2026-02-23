<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Due Date Reminder</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: white; margin: 0;">⏰ Due Date Reminder</h1>
    </div>
    
    <div style="background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px;">
        <p style="margin-bottom: 20px;">Hello {{ $complaint->user->name ?? 'User' }},</p>
        
        <p style="margin-bottom: 20px;">This is a reminder that your complaint has a due date approaching:</p>
        
        <div style="background: white; padding: 20px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #f59e0b;">
            <h2 style="margin-top: 0; color: #1f2937;">{{ $complaint->title }}</h2>
            <p style="color: #6b7280; margin: 10px 0;"><strong>Due Date:</strong> 
                <span style="background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 4px; font-weight: bold;">
                    {{ $complaint->due_date->format('F j, Y') }}
                </span>
            </p>
            <p style="color: #6b7280; margin: 10px 0;"><strong>Status:</strong> 
                <span style="text-transform: capitalize; font-weight: bold;">{{ ucfirst($complaint->status) }}</span>
            </p>
            <p style="color: #6b7280; margin: 10px 0;"><strong>Priority:</strong> 
                <span style="text-transform: capitalize; font-weight: bold;">{{ $complaint->priority ?? 'Not Set' }}</span>
            </p>
            <p style="color: #dc2626; margin: 15px 0 0 0; font-weight: bold;">
                @if($complaint->due_date->isToday())
                    ⚠️ Due Today!
                @elseif($complaint->due_date->isPast())
                    ⚠️ Overdue by {{ $complaint->due_date->diffForHumans() }}
                @else
                    Due in {{ $complaint->due_date->diffForHumans() }}
                @endif
            </p>
        </div>
        
        <div style="background: #eff6ff; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
            <p style="margin: 0; color: #1e40af;"><strong>Description:</strong></p>
            <p style="margin: 10px 0 0 0; color: #1e40af;">{{ \Illuminate\Support\Str::limit($complaint->description, 200) }}</p>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('/complaints/' . $complaint->id) }}" 
               style="background: #f59e0b; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block; font-weight: bold;">
                View Complaint
            </a>
        </div>
        
        <p style="margin-top: 30px; color: #6b7280; font-size: 14px; border-top: 1px solid #e5e7eb; padding-top: 20px;">
            This is an automated reminder from the Complaint Management System.
        </p>
    </div>
</body>
</html>

