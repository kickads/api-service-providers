<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		{{--		<link rel="stylesheet" href="" />--}}
		@vite('resources/css/app.css')
		<title>APi service providers</title>
	</head>
	<body>
		<main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-2">
			
			<div class="border-b border-gray-200 pb-5">
				<h2 class="text-lg font-medium leading-6 text-gray-900">Pushground</h2>
			</div>
			
			<div class="space-y-8 py-3">
				
				<div class="space-y-4">
					<h3 class="block text-sm font-medium text-gray-700">All Campaigns</h3>
					<div class="relative rounded-md shadow-sm">
						<span
							class="block w-full rounded-md border-gray-300 text-gray-600 pr-10 border p-2 sm:text-sm pointer-events-none select-none"
						>
							http://localhost/apiUpdate/pushground
						</span>
						<button class="btnTooltip absolute inset-y-0 right-0 flex items-center pr-3" data-url="http://localhost:8000/apiUpdate/pushground/">
							<svg
								class="h-5 w-5 text-gray-400 hover:text-cyan-500 duration-150"
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
								stroke-width="1.5"
								stroke="currentColor"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"
								/>
							</svg>
							<span
								class="tooltip absolute bottom-11 left-[-14px] bg-gray-900 text-gray-300 px-2 py-1 rounded text-xs after:content-[''] after:absolute after:bg-gray-900
									after:rotate-[45deg] after:right-[19px] after:block after:w-2 after:h-2 after:bg-gray-900 opacity-0"
							>
								Copy!
							</span>
						</button>
					</div>
				</div>
				
				<div class="space-y-4">
					<h3 class="block text-sm font-medium text-gray-700">Get ApiKey</h3>
					<div class="relative rounded-md shadow-sm">
						<span
							class="block w-full rounded-md border-gray-300 text-gray-600 pr-10 border p-2 sm:text-sm pointer-events-none select-none"
						>
							http://localhost/apiUpdate/pushground/apikey
						</span>
						<button class="btnTooltip absolute inset-y-0 right-0 flex items-center pr-3" data-url="http://localhost:8000/apiUpdate/pushground/apikey">
							<svg
								class="h-5 w-5 text-gray-400 hover:text-cyan-500 duration-150"
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
								stroke-width="1.5"
								stroke="currentColor"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"
								/>
							</svg>
							<span
								class="tooltip absolute bottom-11 left-[-14px] bg-gray-900 text-gray-300 px-2 py-1 rounded text-xs after:content-[''] after:absolute after:bg-gray-900
									after:rotate-[45deg] after:right-[19px] after:block after:w-2 after:h-2 after:bg-gray-900 opacity-0"
							>
								Copy!
							</span>
						</button>
					</div>
				</div>
				
				<div class="space-y-4">
					<h3 class="block text-sm font-medium text-gray-700">Get Metrics</h3>
					<div class="relative rounded-md shadow-sm">
						<span
							class="block w-full rounded-md border-gray-300 text-gray-600 pr-10 border p-2 sm:text-sm pointer-events-none select-none"
						>
							http://localhost/apiUpdate/pushground/metrics
						</span>
						<button class="btnTooltip absolute inset-y-0 right-0 flex items-center pr-3" data-url="http://localhost:8000/apiUpdate/pushground/metrics">
							<svg
								class="h-5 w-5 text-gray-400 hover:text-cyan-500 duration-150"
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
								stroke-width="1.5"
								stroke="currentColor"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"
								/>
							</svg>
							<span
								class="tooltip absolute bottom-11 left-[-14px] bg-gray-900 text-gray-300 px-2 py-1 rounded text-xs after:content-[''] after:absolute after:bg-gray-900
									after:rotate-[45deg] after:right-[19px] after:block after:w-2 after:h-2 after:bg-gray-900 opacity-0"
							>
								Copy!
							</span>
						</button>
					</div>
				</div>
				
				<div class="space-y-4">
					<h3 class="block text-sm font-medium text-gray-700">Save metrics in DB</h3>
					<div class="relative rounded-md shadow-sm">
						<span
							class="block w-full rounded-md border-gray-300 text-gray-600 pr-10 border p-2 sm:text-sm pointer-events-none select-none"
						>
							http://localhost/apiUpdate/pushground/saveMetrics
						</span>
						<button class="btnTooltip absolute inset-y-0 right-0 flex items-center pr-3" data-url="http://localhost:8000/apiUpdate/pushground/saveMetrics">
							<svg
								class="h-5 w-5 text-gray-400 hover:text-cyan-500 duration-150"
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
								stroke-width="1.5"
								stroke="currentColor"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"
								/>
							</svg>
							<span
								class="tooltip absolute bottom-11 left-[-14px] bg-gray-900 text-gray-300 px-2 py-1 rounded text-xs after:content-[''] after:absolute after:bg-gray-900
									after:rotate-[45deg] after:right-[19px] after:block after:w-2 after:h-2 after:bg-gray-900 opacity-0"
							>
								Copy!
							</span>
						</button>
					</div>
				</div>
			</div>
			
		</main>
		@vite('resources/js/app.js')
	</body>
</html>