<?php

namespace App\Http\Controllers;

use App\Actions\CaptureVisitorDataAction;
use App\Actions\CreatePixelAction;
use App\Actions\ProcessVisitorDataAction;
use App\Http\Requests\CreatePixelRequest;
use App\Models\Pixel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PixelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pixels = Pixel::query()
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();
            
        return view('pixels.index', compact('pixels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pixels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePixelRequest $request, CreatePixelAction $action): RedirectResponse
    {
        try {
            $user = $request->user();
            $pixel = $action->handle($user, $request->validated());
            
            return redirect()->route('pixels.show', $pixel)
                ->with('success', 'Pixel created successfully! Install it on your website to start capturing leads.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pixel $pixel): View
    {
        // Make sure the user owns the pixel
        if ($pixel->user_id !== auth()->id()) {
            abort(403);
        }
        
        $leads = $pixel->leads()->latest()->take(5)->get();
        $visitorData = $pixel->visitorData()->latest()->take(10)->get();
        
        return view('pixels.show', compact('pixel', 'leads', 'visitorData'));
    }

    /**
     * Generate the pixel code for the user to install.
     */
    public function code(Pixel $pixel): View
    {
        // Make sure the user owns the pixel
        if ($pixel->user_id !== auth()->id()) {
            abort(403);
        }
        
        $pixelCode = $this->generatePixelJsCode($pixel);
        
        return view('pixels.code', compact('pixel', 'pixelCode'));
    }
    
    /**
     * Test the pixel to make sure it's working correctly.
     */
    public function test(Pixel $pixel): View
    {
        // Make sure the user owns the pixel
        if ($pixel->user_id !== auth()->id()) {
            abort(403);
        }
        
        $testPageUrl = route('pixels.test_page', $pixel);
        
        return view('pixels.test', compact('pixel', 'testPageUrl'));
    }
    
    /**
     * Show a test page that has the pixel installed.
     */
    public function testPage(Pixel $pixel): View
    {
        // Make sure the user owns the pixel
        if ($pixel->user_id !== auth()->id()) {
            abort(403);
        }
        
        $pixelCode = $this->generatePixelJsCode($pixel);
        
        return view('pixels.test_page', compact('pixel', 'pixelCode'));
    }
    
    /**
     * Handle the pixel tracking request.
     */
    public function track(Request $request, string $pixelCode, CaptureVisitorDataAction $captureAction, ProcessVisitorDataAction $processAction): JsonResponse
    {
        // Capture the visitor data
        $visitorData = $captureAction->handle($request, $pixelCode);
        
        if (!$visitorData) {
            return response()->json(['success' => false, 'message' => 'Invalid pixel code'], 400);
        }
        
        // Process the visitor data asynchronously
        // In a real app, we would use a queue for this
        $lead = $processAction->handle($visitorData);
        
        return response()->json([
            'success' => true,
            'message' => 'Tracking data received successfully',
        ]);
    }
    
    /**
     * Generate the JavaScript code for the pixel.
     */
    private function generatePixelJsCode(Pixel $pixel): string
    {
        $trackUrl = route('pixels.track', $pixel->pixel_code);
        
        return <<<JS
        <!-- Lead Pixel Tracking Code -->
        <script>
        (function() {
            var pixel = document.createElement('script');
            pixel.type = 'text/javascript';
            pixel.async = true;
            pixel.src = '{$trackUrl}?' + new Date().getTime() + '&page_url=' + encodeURIComponent(window.location.href);
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(pixel, s);
        })();
        </script>
        <!-- End Lead Pixel Tracking Code -->
        JS;
    }
} 