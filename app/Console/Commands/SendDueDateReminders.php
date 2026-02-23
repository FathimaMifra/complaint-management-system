<?php

namespace App\Console\Commands;

use App\Models\Complaint;
use App\Mail\ComplaintDueDateReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDueDateReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'complaints:send-due-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for complaints with approaching due dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for complaints with approaching due dates...');

        // Get complaints with due dates in the next 3 days or overdue
        $dueComplaints = Complaint::whereNotNull('due_date')
            ->whereIn('status', ['pending', 'in-progress']) // Only send for active complaints
            ->where('due_date', '<=', Carbon::now()->addDays(3))
            ->where('due_date', '>=', Carbon::now()->subDay()) // Don't send for very old overdue
            ->get();

        $sentCount = 0;
        $failedCount = 0;

        foreach ($dueComplaints as $complaint) {
            if ($complaint->user && $complaint->user->email) {
                try {
                    Mail::to($complaint->user->email)->send(
                        new ComplaintDueDateReminder($complaint)
                    );
                    $sentCount++;
                    $this->info("Reminder sent for complaint: {$complaint->title}");
                } catch (\Exception $e) {
                    $failedCount++;
                    $this->error("Failed to send reminder for complaint {$complaint->id}: " . $e->getMessage());
                }
            }
        }

        $this->info("Completed: {$sentCount} reminders sent, {$failedCount} failed.");
        
        return Command::SUCCESS;
    }
}

