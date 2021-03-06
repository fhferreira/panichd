<?php

namespace PanicHD\PanicHD\Controllers;

use App\Http\Controllers\Controller;
use PanicHD\PanicHD\Models;
use PanicHD\PanicHD\Models\Category;
use PanicHD\PanicHD\Models\Member;
use PanicHD\PanicHD\Models\Ticket;

class DashboardController extends Controller
{
	
	public function index($indicator_period = 2)
    {
		if(Member::count() == 0
			or Category::count() == 0
			or Models\Priority::count() == 0
			or Models\Status::count() == 0){
			
			// Show pending configurations message
			return view('panichd::install.configurations_pending');
		}
		
		// Load Dashboard info
		$tickets_count = Ticket::count();
        $open_tickets_count = Ticket::whereNull('completed_at')->count();
        $closed_tickets_count = $tickets_count - $open_tickets_count;

        // Per Category pagination
        $categories = Category::paginate(10, ['*'], 'cat_page');

        // Total tickets counter per category for google pie chart
        $categories_all = Category::all();
        $categories_share = [];
        foreach ($categories_all as $cat) {
            $categories_share[$cat->name] = $cat->tickets()->count();
        }

        // Total tickets counter per agent for google pie chart
        $agents_share_obj = Member::agents()->with(['agentTotalTickets' => function ($query) {
            $query->addSelect(['id', 'agent_id']);
        }])->get();

        $agents_share = [];
        foreach ($agents_share_obj as $agent_share) {
            $agents_share[$agent_share->name] = $agent_share->agentTotalTickets->count();
        }

        // Per Agent
        $agents = Member::agents(10);

        // Per User
        $users = Member::users(10);

        // Per Category performance data
        $ticketController = new TicketsController(new Ticket(), new Member());
        $monthly_performance = $ticketController->monthlyPerfomance($indicator_period);

        if (request()->has('cat_page')) {
            $active_tab = 'cat';
        } elseif (request()->has('agents_page')) {
            $active_tab = 'agents';
        } elseif (request()->has('users_page')) {
            $active_tab = 'users';
        } else {
            $active_tab = 'cat';
        }

        return view('panichd::admin.index',
            compact(
                'open_tickets_count',
                'closed_tickets_count',
                'tickets_count',
                'categories',
                'agents',
                'users',
                'monthly_performance',
                'categories_share',
                'agents_share',
                'active_tab'
            ));
    }
}
