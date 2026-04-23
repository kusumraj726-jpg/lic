<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DummyController extends Controller
{
    public function index()
    {
        // High-Fidelity Dummy Data exactly as per the screenshot requirements
        $stats = [
            'clients_count' => '1,248',
            'open_queries' => '43',
            'pending_claims' => '12',
            'upcoming_renewals' => '88',
            'total_expected_comm' => '12,400,000', // ₹12.4M
        ];

        $urgent_items = collect([
            (object)[
                'type' => 'Query',
                'client_name' => 'Rajesh Kumar',
                'status' => 'Pending',
                'time' => '12m ago',
                'color' => 'rose'
            ],
            (object)[
                'type' => 'Claim',
                'client_name' => 'Anita Sharma',
                'status' => 'Pending',
                'time' => '2h ago',
                'color' => 'amber'
            ],
            (object)[
                'type' => 'Renewal',
                'client_name' => 'Vikram Singh',
                'status' => 'Pending',
                'time' => '5h ago',
                'color' => 'emerald'
            ]
        ]);

        $calendar_events = [
            ['day' => (int)date('d'), 'month' => (int)date('m'), 'type' => 'birthday', 'name' => 'Sameer Abbasi', 'title' => 'Birthday Today', 'i' => '🎂', 'c' => 'amber'],
            ['day' => (int)date('d'), 'month' => (int)date('m'), 'type' => 'anniversary', 'name' => 'Kavita Mishra', 'title' => 'Anniversary Today', 'i' => '💍', 'c' => 'rose']
        ];

        return view('dummy.demo-erp', compact('stats', 'urgent_items', 'calendar_events'));
    }
}
