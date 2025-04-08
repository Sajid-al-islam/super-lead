<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Pixel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $pixels = $user->pixels()->pluck('name', 'id');
        
        $query = Lead::query()
            ->where('user_id', $user->id)
            ->with('pixel');
            
        if ($request->filled('pixel_id')) {
            $query->where('pixel_id', $request->input('pixel_id'));
        }
        
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('job_title', 'like', "%{$search}%");
            });
        }
        
        $leads = $query->orderByDesc('created_at')->paginate(20);
        
        return view('leads.index', compact('leads', 'pixels'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead): View
    {
        // Make sure the user owns the lead
        if ($lead->user_id !== auth()->id()) {
            abort(403);
        }
        
        $visitorData = $lead->visitorData()->latest()->take(10)->get();
        
        return view('leads.show', compact('lead', 'visitorData'));
    }
    
    /**
     * Export leads to CSV.
     */
    public function export(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $user = $request->user();
        
        $query = Lead::query()
            ->where('user_id', $user->id);
            
        if ($request->filled('pixel_id')) {
            $query->where('pixel_id', $request->input('pixel_id'));
        }
        
        $leads = $query->orderByDesc('created_at')->get();
        
        // Mark leads as exported
        foreach ($leads as $lead) {
            $lead->is_exported = true;
            $lead->save();
        }
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="leads-' . now()->format('Y-m-d') . '.csv"',
        ];
        
        $columns = [
            'Name', 'Email', 'Phone', 'Company', 'Job Title', 'Annual Revenue',
            'LinkedIn Connections', 'LinkedIn Joined', 'LinkedIn Last Active',
            'Twitter Connections', 'Twitter Joined', 'Twitter Last Active',
            'Instagram Connections', 'Instagram Joined', 'Instagram Last Active',
            'Captured Date', 'Pixel', 'Insights'
        ];
        
        $callback = function() use ($leads, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($leads as $lead) {
                fputcsv($file, [
                    $lead->name,
                    $lead->email,
                    $lead->phone,
                    $lead->company,
                    $lead->job_title,
                    $lead->annual_revenue,
                    $lead->linkedin_connections,
                    $lead->linkedin_joined_date,
                    $lead->linkedin_last_active_date,
                    $lead->twitter_connections,
                    $lead->twitter_joined_date,
                    $lead->twitter_last_active_date,
                    $lead->instagram_connections,
                    $lead->instagram_joined_date,
                    $lead->instagram_last_active_date,
                    $lead->created_at->format('Y-m-d H:i:s'),
                    $lead->pixel->name,
                    $lead->insights,
                ]);
            }
            
            fclose($file);
        };
        
        return Response::stream($callback, 200, $headers);
    }
} 