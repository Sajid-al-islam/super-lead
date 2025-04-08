<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Test Page - {{ $pixel->name }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    {!! $pixelCode !!}
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-blue-600 p-6 text-white">
                <h1 class="text-3xl font-bold mb-2">Pixel Test Page</h1>
                <p class="text-lg opacity-90">Testing pixel: {{ $pixel->name }}</p>
            </div>
            
            <div class="p-8">
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-8" role="alert">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="font-medium">Pixel is now tracking this page visit</p>
                    </div>
                    <p class="mt-2">
                        The pixel code has been installed on this page and is now tracking the visit. 
                        This simulates a real visitor to your website.
                    </p>
                </div>
                
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">About This Test</h2>
                <p class="text-gray-600 mb-4">
                    This page is simulating a visit to your website with the pixel installed. The pixel is capturing:
                </p>
                
                <ul class="list-disc pl-6 mb-6 text-gray-600">
                    <li class="mb-2">Your browser and device information</li>
                    <li class="mb-2">Referring page information</li>
                    <li class="mb-2">IP address (used to identify company information)</li>
                    <li class="mb-2">The URL of this page</li>
                </ul>
                
                <p class="text-gray-600 mb-8">
                    This information is processed to identify the company you work for and generate lead information.
                    In a real implementation, this pixel would be installed on all pages of your website.
                </p>
                
                <div class="bg-blue-50 p-6 rounded-lg mb-8">
                    <h3 class="text-lg font-medium text-blue-900 mb-2">How the Pixel Works</h3>
                    <ol class="list-decimal pl-6 text-blue-800">
                        <li class="mb-2">The pixel captures anonymous visitor data from your website</li>
                        <li class="mb-2">Our system processes this data to identify the visitor's company</li>
                        <li class="mb-2">Lead data is enriched with company and contact information</li>
                        <li class="mb-2">You receive notifications when new leads are identified</li>
                        <li class="mb-2">You can view and export leads from your dashboard</li>
                    </ol>
                </div>
                
                <div class="text-center">
                    <a href="javascript:window.close()" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Close This Page
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 